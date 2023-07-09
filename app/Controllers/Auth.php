<?php

namespace App\Controllers;

use App\Models\UserModel;


class Auth extends BaseController
{
    protected $session;
    protected $db, $builder;
    function __construct()
    {

        $this->session = \Config\Services::session();
        $this->session->start();
        $this->db = \Config\Database::connect();

        date_default_timezone_set("Asia/jakarta");
        // $this->cekTransasaksi();
    }
    public function index()
    {
        if ($this->session->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'session' => \Config\Services::session(),
            'validation' => \Config\Services::validation()
        ];

        return view('auth/login', $data);
    }
    public function login()
    {
        $validate = $this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username harus diisi.'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus diisi.'
                ]
            ]
        ]);

        if (!$validate) {
            $validation = \Config\Services::validation();
            return redirect()->to('/')->withInput()->with('validation', $validation);
        }


        $userModel = new UserModel();

        $cek_user = $userModel->getUser($this->request->getVar('username'));
        
        // jika username tidak ditemukan
        if (!$cek_user) {
            return redirect()->to('/')->with('msg', '<div class="alert alert-danger">Username tidak ditemukan.</div>');
        }

        // jika status tidak tidak aktif
        if ($cek_user['is_active'] != 1) {
            return redirect()->to('/')->with('msg', '<div class="alert alert-danger">User diblokir.</div>');
        }

        // jika password salah
        if (!password_verify($this->request->getVar('password'), $cek_user['password'])) {
            return redirect()->to('/')->with('msg', '<div class="alert alert-danger">Password salah.</div>');
        }

        // LOGIN BERHASIL
        
        // set session
        $newdata = [
            'id_user' => $cek_user['id_user'],
            'username' => $cek_user['username'],
            'full_name' => $cek_user['full_name'],
            'role' => $cek_user['role'],
            'logged_in' => TRUE
        ];
        // var_dump($newdata);
        // die;
        $this->session->set($newdata);

        return redirect()->to('/dashboard');
    }
    // public function cekTransasaksi()
    // {

    //     $getorderid = $this->db->query('SELECT order_id FROM simpanan_pokok where id_user = ' . $this->session->get('id_user') . '')->getRowArray();

    //     $status = \Midtrans\Transaction::status($getorderid['order_id']);
    //     // var_dump($status);
    //     // die;
    //     if ($status->status_code == 200) {
    //         $data = [
    //             'status' => 1
    //         ];
    //     } elseif ($status->status_code == 201) {
    //         $data = [
    //             'status' => 2
    //         ];
    //     } else {
    //         $data = [
    //             'status' => 3
    //         ];
    //     }
    // }
    public function logout()
    {
        // remove session
        $newdata = ['username', 'role', 'logged_in'];
        $this->session->remove($newdata);

        return redirect()->to('/')->with('msg', '<div class="alert alert-info">Logout berhasil.</div>');
    }
}
