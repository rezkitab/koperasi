<?php

namespace App\Controllers;

use Throwable;
use Config\MyConfig;
use App\Models\Laporan\JurnalUmum;

class PengunduranDiri extends BaseController
{
    protected $validation;
    protected $session;
    protected $db, $builder, $anggota, $myConfig, $jurnalModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
        $this->builder = $this->db->table('users');
        $this->anggota = $this->db->table('anggota');
        $this->jurnalModel              = new JurnalUmum();
        $this->myConfig = new MyConfig;
        $this->validation       =  \Config\Services::validation();
        date_default_timezone_set("Asia/jakarta");
        // $this->gender = $this->db->table('gender');
        // $this->spp_bulanan = $this->db->table('spp_bulanan');
        // $this->bill = $this->db->table('pembayaran_bulanan');
        // $this->userModel = new UsersModel();
    }
    public function index()
    {
        $users  = $this->db->query('SELECT * FROM users where id_user = ' . $this->session->get('id_user') . '')->getRow();
        $total_pokok = $this->db->query('SELECT sum(nominal) as total FROM simpanan_pokok where id_user = ' . $this->session->get('id_user') . ' and status = 1')->getRow();
        $total_simpanan = $this->db->query('SELECT sum(nominal) as total FROM riwayat_simpanan where id_user = ' . $this->session->get('id_user') . ' and status = 200')->getRow();
        $total_manasuka = $this->db->query('SELECT sum(nominal) as total FROM simpanan_manasuka where id_user = ' . $this->session->get('id_user') . ' and status = 1')->getRow();

        $nominal = $total_pokok->total + $total_simpanan->total + $total_manasuka->total;
        // var_dump($nominal);
        // die;
        $d = ['title' => 'Data User', 'users' => $users, 'nominal' => $nominal];
        return view('pengundurandiri/view', $d);
    }
    function request()
    {
        // var_dump($this->request->getPost('id_user'));
        // die;
        $id_user = $this->request->getPost('id_user');
        $data = [
            'is_active' => 3,
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $data1 = [
            'nama_penerima' => $this->request->getPost('nama_penerima'),
            'nama_bank' => $this->request->getPost('nama_bank'),
            'no_rekening' => $this->request->getPost('no_rekening'),
            'nominal' => $this->request->getPost('nominal'),
        ];
        $success = $this->anggota->where('user_id', $id_user)->set($data1)->update();
        $success = $this->builder->where('id_user', $id_user)->set($data)->update();
        if ($success) {
            // session()->setFlashdata('msg', 'Pengunduran diri berhasil');
            $newdata = ['username', 'role', 'logged_in'];
            $this->session->remove($newdata);

            return redirect()->to('/')->with('msg', '<div class="alert alert-info">Pengunduran diri berhasil.</div>');
        }
    }
    function viewAdmin() {
        $users  = $this->db->query('SELECT * FROM users u, anggota a where u.id_user=a.user_id and is_active = 3')->getResult();
        $d = ['title' => 'Data Pengunduran Diri', 'users' => $users];
        return view('pengundurandiri/viewAdmin', $d);
    }
    public function upload_image($id)
    {
        $users  = $this->db->query('SELECT * FROM users where id_user = ' . $id . '')->getRow();
        $total_pokok = $this->db->query('SELECT sum(nominal) as total FROM simpanan_pokok where id_user = ' . $id . ' and status = 1')->getRow();
        $total_simpanan = $this->db->query('SELECT sum(nominal) as total FROM riwayat_simpanan where id_user = ' . $id . ' and status = 200')->getRow();
        $total_manasuka = $this->db->query('SELECT sum(nominal) as total FROM simpanan_manasuka where id_user = ' . $id . ' and status = 1')->getRow();

        // dd($total_simpanan->total);
        $dataimage = $this->request->getFile('image');
        // var_dump($this->request->getPost('nominal'));
        // die;

        $fileName = $dataimage->getClientName();
        $data1 = [
            'image' => $fileName,
        ];
        $data = [
            'is_active' => 2,
        ];
        $this->db->table('anggota')->where('user_id', $id)->set($data1)->update();
        $this->db->table('users')->where('id_user', $id)->set($data)->update();
        $dataimage->move('assets/foto/bukti_transfer/', $fileName);

        

        $tanggal = date('Y-m-d');
        $periode = set_periode($tanggal);
        $nominal = $total_manasuka->total;
        $kode = 'TRX-MANASUKA-' . $id;
        $keterangan = 'Pernarikan Simpanan Manasuka Anggota - ' . $id;
        $kode_akun_debet = "1102"; //bank
        $kode_akun_kredit = "3202"; //simpanan wajib
        $gl = [
            [
                'tanggal'       => $tanggal,
                'periode'       => $periode,
                'kode_akun'     => $kode_akun_kredit,
                'deskripsi'     => $keterangan,
                'no_bukti'      => $kode,
                'dc'            => 'c',
                'nominal'       => $nominal,
                'trans_ref'     => 'SIMPANAN MANASUKA'
            ],
        ];
        $this->jurnalModel->insertBatch($gl);

        $tanggal = date('Y-m-d');
        $periode = set_periode($tanggal);
        $nominal = $total_pokok->total;
        $kode = 'TRX-WAJIB-' . $id;
        $keterangan = 'Pembayaran Simpanan Wajib Anggota - ' . $id;
        $kode_akun_debet = "1102"; //bank
        $kode_akun_kredit = "3202"; //simpanan wajib
        $gl = [
            [
                'tanggal'       => $tanggal,
                'periode'       => $periode,
                'kode_akun'     => $kode_akun_kredit,
                'deskripsi'     => $keterangan,
                'no_bukti'      => $kode,
                'dc'            => 'c',
                'nominal'       => $nominal,
                'trans_ref'     => 'SIMPANAN WAJIB'
            ],
        ];
        $this->jurnalModel->insertBatch($gl);

        $tanggal = date('Y-m-d');
        $periode = set_periode($tanggal);
        $nominal = $total_simpanan->total;
        $kode = 'TRX-MANASUKA-' . $id;
        $keterangan = 'Pernarikan Simpanan Manasuka Anggota - ' . $id;
        $kode_akun_debet = "1102"; //bank
        $kode_akun_kredit = "3202"; //simpanan wajib
        $gl = [
            [
                'tanggal'       => $tanggal,
                'periode'       => $periode,
                'kode_akun'     => $kode_akun_kredit,
                'deskripsi'     => $keterangan,
                'no_bukti'      => $kode,
                'dc'            => 'c',
                'nominal'       => $nominal,
                'trans_ref'     => 'SIMPANAN MANASUKA'
            ],
        ];
        $this->jurnalModel->insertBatch($gl);
        session()->setFlashdata('success', 'image Berhasil diupload');

        return redirect()->to(base_url('pengunduranDiri/viewAdmin'));
    }
}
