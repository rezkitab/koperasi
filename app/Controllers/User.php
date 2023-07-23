<?php

namespace App\Controllers;

use Config\MyConfig;
use Throwable;

class User extends BaseController
{

    protected $db, $builder, $pengurus, $myConfig;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->pengurus = $this->db->table('pengurus');
        $this->myConfig = new MyConfig;
        date_default_timezone_set("Asia/jakarta");
        // $this->gender = $this->db->table('gender');
        // $this->spp_bulanan = $this->db->table('spp_bulanan');
        // $this->bill = $this->db->table('pembayaran_bulanan');
        // $this->userModel = new UsersModel();
    }
    public function index()
    {
        $users  = $this->db->query('SELECT * FROM users')->getResult();
        // var_dump($data);
        // die;
        $d = ['title' => 'Data User', 'users' => $users];
        return view('user/index', $d);
    }
    public function add()
    {
        // var_dump($data);
        // die;
        $d = [
            'title' => 'Tambah Data User',
            'pengurus'  => $this->db->query('SELECT * FROM pengurus')->getResultArray()
        ];
        return view('user/add', $d);
    }
    public function add_proses()
    {
        try {
            $this->db = \Config\Database::connect();
            $this->builder = $this->db->table('users');
            // DB Transaction
            $validation =  \Config\Services::validation();
            
            $validation->setRules([
                "username" => ["label" => " Username", "rules" => "required|min_length[3]|max_length[20]"],
                "full_name" => ["label" => "Full Name", "rules" => "required|min_length[3]|max_length[40]"],
                "nik" => ["label" => "Nik", "rules" => "required|min_length[3]|max_length[20]"],
                "no_hp" => ["label" => "No Hp", "rules" => "required|min_length[3]|max_length[15]"],
                "password" => ["label" => "Password", "rules" => "required|min_length[4]|max_length[20]"],
            ]);
      
            if($validation->withRequest($this->request)->run()){
                $id_user = rand(000, 999);
                $data = [
                    'id_user' => $id_user,
                    'username' => $this->request->getPost('username'),
                    'full_name' => $this->request->getPost('full_name'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'nik' => $this->request->getPost('nik'),
                    'no_hp' => $this->request->getPost('no_hp'),

                    'image' => 'anggota.png',
                    'is_active' => 1,
                    'role' => 2,
                    'tgl_registrasi' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s'),
                ];
                $simpanaPokok = [
                    'id_user' => $id_user,
                    'kode_transaksi' => 'TRK' . rand(000, 999),
                    'nominal' => 100000,
                    'status' => 2,
                    'metode_pembayaran' => 'Online',

                ];

                $success = $this->builder->insert($data);
                $success = $this->db->table('simpanan_pokok')->insert($simpanaPokok);

                // data anggota
                $anggota = [
                    'kode_anggota'      => 'AGT' . rand(000, 999),
                    'user_id'           => $id_user,
                    // 'tempat_lahir'      => $this->request->getPost('tempat_lahir'),
                    // 'tanggal_lahir'     => $this->request->getPost('tanggal_lahir'),
                    // 'jenis_kelamin'     => $this->request->getPost('jenis_kelamin'),
                ];

                $success = $this->db->table('anggota')->insert($anggota);
            }else{
                $data["validation"] = $validation->getErrors();
                return redirect()->to(base_url('/user/add'));
            }
 
            if ($success) {
                session()->setFlashdata('msg', 'ditambahkan');
                return redirect()->to(base_url('/user/index'));
            }
        } catch (Throwable $th) {
            // Melakukan rollback, data tidak akan insert atau update jika code gagal dieksekusi
            // $this->logError($th);
            session()->setFlashdata('pesan', 'ditambahkan');
            return [
                'status' => false,
                'message' => 'Gagal melakukan insert data',
            ];
        }
    }
    public function edit($id)
    {
        $data = $this->builder->getWhere(['id_user' => $id])->getRowArray();


        $d = ['title' => 'Edit Data User', 'data' => $data];
        return view('user/edit', $d);
    }
    public function edit_proses($id)
    {
        try {
            $this->db = \Config\Database::connect();
            $this->builder = $this->db->table('users');
            // DB Transaction
            $this->db->transBegin();
            if ($this->request->getVar('password') == NULL) {
                $data = [

                    'username' => $this->request->getPost('username'),
                    'full_name' => $this->request->getPost('full_name'),
                    'nik' => $this->request->getPost('nik'),
                    'no_hp' => $this->request->getPost('no_hp'),

                    'image' => 'anggota.png',
                    'is_active' => 1,
                    'role' => 2,
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            } else {
                $data = [
                    'username' => $this->request->getPost('username'),
                    'full_name' => $this->request->getPost('full_name'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'nik' => $this->request->getPost('nik'),
                    'no_hp' => $this->request->getPost('no_hp'),

                    'image' => 'anggota.png',
                    'is_active' => 1,
                    'role' => 2,
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }

            // $this->builder->getWhere('id_user', $id);
            $success = $this->builder->where('id_user', $id)->set($data)->update();

            $this->db->transCommit();
            if ($success) {
                session()->setFlashdata('msg', 'diubah');
                return redirect()->to(base_url('/user/index'));
            }
        } catch (Throwable $th) {
            // Melakukan rollback, data tidak akan insert atau update jika code gagal dieksekusi
            // $this->logError($th);
            $this->db->transRollback();
            session()->setFlashdata('pesan', 'diubah');
            return [
                'status' => false,
                'message' => 'Gagal melakukan edit data',
            ];
        }
    }
    public function delete_proses($id)
    {

        $this->builder->delete(['id_user' => $id]); // Panggil fungsi delete() yang ada di SiswaModel.php
        return redirect()->to(base_url('/user/index'));
    }
}
