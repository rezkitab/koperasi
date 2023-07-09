<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use Config\MyConfig;

class LaporanController extends BaseController
{
    protected $session, $db, $myConfig, $simpanan, $simpanan_manasuka, $riwayat_simpanan;
    function __construct()
    {

        $this->session = \Config\Services::session();
        $this->session->start();
        $this->myConfig = new MyConfig;
        $this->db = \Config\Database::connect();
        $this->simpanan = $this->db->table('simpanan_pokok');
        $this->simpanan_manasuka = $this->db->table('simpanan_manasuka');
        $this->riwayat_simpanan = $this->db->table('riwayat_simpanan');
        date_default_timezone_set("Asia/jakarta");
    }
    public function simpanan_pokok()
    {
        $id_user = "";
        $tgl_bayar = "";
        $simpanan_pokok = $this->db->query('SELECT sp.*, u.full_name FROM simpanan_pokok sp left join users u on u.id_user=sp.id_user where u.role = 2')->getResult();
        $users = $this->db->query('SELECT * FROM users where role = 2')->getResult();
        // var_dump($simpanan_pokok);
        // die;
        $d = ['title' => 'Laporan Simpanan Pokok', 'simpanan_pokok' => $simpanan_pokok, 'users' => $users, 'id_user' => $id_user, 'tgl_bayar' => $tgl_bayar];
        return view('laporan/simpanan_pokok', $d);
    }
    public function simpanan_wajib()
    {
        $id_user = "";
        $tgl_bayar = "";
        $simpanan_wajib = $this->db->query('SELECT sw.*, u.full_name, b.nama_bulan FROM riwayat_simpanan sw left join users u on u.id_user=sw.id_user left join bulan b on sw.id_bulan=b.id_bulan where u.role = 2')->getResult();
        $users = $this->db->query('SELECT * FROM users where role = 2')->getResult();
        // var_dump($simpanan_pokok);
        // die;
        $d = ['title' => 'Laporan Simpanan Wajib', 'simpanan_wajib' => $simpanan_wajib, 'users' => $users, 'id_user' => $id_user, 'tgl_bayar' => $tgl_bayar];
        return view('laporan/simpanan_wajib', $d);
    }
    public function simpanan_manasuka()
    {
        $id_user = "";
        $tgl_bayar = "";
        $simpanan_manasuka = $this->db->query('SELECT sw.*, u.full_name FROM riwayat_manasuka sw left join users u on u.id_user=sw.id_user where u.role = 2')->getResult();
        $users = $this->db->query('SELECT * FROM users where role = 2')->getResult();
        // var_dump($simpanan_pokok);
        // die;
        $d = ['title' => 'Laporan Simpanan Manasuka', 'simpanan_manasuka' => $simpanan_manasuka, 'users' => $users, 'id_user' => $id_user, 'tgl_bayar' => $tgl_bayar];
        return view('laporan/simpanan_manasuka', $d);
    }
    public function search_pokok()
    {
        $id_user = $this->request->getPost('id_user');
        $tgl_bayar = $this->request->getPost('tgl_bayar');
        $simpanan_pokok = $this->db->query('SELECT sp.*, u.full_name FROM simpanan_pokok sp left join users u on u.id_user=sp.id_user where sp.id_user = ' . $id_user . ' and sp.tgl_bayar like "%' . $tgl_bayar . '%" and u.role = 2')->getResult();
        $users = $this->db->query('SELECT * FROM users where role = 2')->getResult();
        // var_dump($simpanan_pokok);
        // die;
        // $this->pdf_pokok();
        $d = ['title' => 'Laporan Simpanan Pokok', 'simpanan_pokok' => $simpanan_pokok, 'users' => $users, 'id_user' => $id_user, 'tgl_bayar' => $tgl_bayar];
        return view('laporan/simpanan_pokok', $d);
    }
    public function pdf_pokok_all()
    {
        $simpanan_pokok = $this->db->query('SELECT sp.*, u.full_name FROM simpanan_pokok sp left join users u on u.id_user=sp.id_user where u.role = 2')->getResult();
        $users = $this->db->query('SELECT * FROM users where role = 2')->getResult();
        // var_dump($simpanan_pokok);
        // die;
        $d = ['title' => 'Laporan Simpanan Pokok', 'simpanan_pokok' => $simpanan_pokok, 'users' => $users];
        return view('laporan/pdf_pokok', $d);
    }
    public function pdf_pokok($id_user)
    {


        $simpanan_pokok = $this->db->query('SELECT sp.*, u.full_name FROM simpanan_pokok sp left join users u on u.id_user=sp.id_user where sp.id_user = "' . $id_user . '%" and u.role = 2')->getResult();


        $users = $this->db->query('SELECT * FROM users where role = 2')->getResult();
        // var_dump($simpanan_pokok);
        // die;
        $d = ['title' => 'Laporan Simpanan Pokok', 'simpanan_pokok' => $simpanan_pokok, 'users' => $users];
        return view('laporan/pdf_pokok', $d);
    }
    public function search_wajib()
    {
        $id_user = $this->request->getPost('id_user');
        $tgl_bayar = $this->request->getPost('tgl_bayar');
        $status = $this->request->getPost('status');
        if($status==""){
            $simpanan_wajib = $this->db->query('SELECT sw.*, u.full_name, b.nama_bulan FROM riwayat_simpanan sw left join users u on u.id_user=sw.id_user left join bulan b on sw.id_bulan=b.id_bulan where sw.id_user = "' . $id_user . '" and u.role = 2;')->getResult();
        }else{
        $simpanan_wajib = $this->db->query('SELECT sw.*, u.full_name, b.nama_bulan FROM riwayat_simpanan sw left join users u on u.id_user=sw.id_user left join bulan b on sw.id_bulan=b.id_bulan where sw.status = "' . $status . '" and sw.id_user = "' . $id_user . '" and u.role = 2;')->getResult();
        }

        $users = $this->db->query('SELECT * FROM users where role = 2')->getResult();
        // var_dump($simpanan_wajib);
        // die;
        // $this->pdf_pokok();
        $d = ['title' => 'Laporan Simpanan Wajib', 'simpanan_wajib' => $simpanan_wajib, 'users' => $users, 'id_user' => $id_user, 'tgl_bayar' => $tgl_bayar, 'status' => $status];
        return view('laporan/simpanan_wajib', $d);
    }
    public function pdf_wajib($id_user, $status)
    {
        $simpanan_wajib = $this->db->query('SELECT sw.*, u.full_name, b.nama_bulan FROM riwayat_simpanan sw left join users u on u.id_user=sw.id_user left join bulan b on sw.id_bulan=b.id_bulan where sw.status = ' . $status . ' and sw.id_user = "' . $id_user . '" and u.role = 2')->getResult();
        $users = $this->db->query('SELECT * FROM users where role = 2')->getResult();
        // var_dump($simpanan_pokok);
        // die;
        $d = ['title' => 'Laporan Simpanan Wajib', 'simpanan_wajib' => $simpanan_wajib, 'users' => $users];
        return view('laporan/pdf_wajib', $d);
    }
    public function pdf_wajib_all()
    {
        $simpanan_wajib = $this->db->query('SELECT sw.*, u.full_name, b.nama_bulan FROM riwayat_simpanan sw left join users u on u.id_user=sw.id_user left join bulan b on sw.id_bulan=b.id_bulan where u.role = 2')->getResult();
        $users = $this->db->query('SELECT * FROM users where role = 2')->getResult();
        // var_dump($simpanan_pokok);
        // die;
        $d = ['title' => 'Laporan Simpanan Wajib', 'simpanan_wajib' => $simpanan_wajib, 'users' => $users];
        return view('laporan/pdf_wajib', $d);
    }
    public function search_manasuka()
    {
        $id_user = $this->request->getPost('id_user');
        $tgl_bayar = $this->request->getPost('tgl_bayar');
        $simpanan_manasuka = $this->db->query('SELECT sw.*, u.full_name FROM riwayat_manasuka sw left join users u on u.id_user=sw.id_user where sw.id_user = ' . $id_user . ' and sw.tgl_penarikan like "%' . $tgl_bayar . '%" and u.role = 2')->getResult();

        $users = $this->db->query('SELECT * FROM users where role = 2')->getResult();
        // var_dump($simpanan_wajib);
        // die;
        // $this->pdf_pokok();
        $d = ['title' => 'Laporan Simpanan Manasuka', 'simpanan_manasuka' => $simpanan_manasuka, 'users' => $users, 'id_user' => $id_user, 'tgl_bayar' => $tgl_bayar];
        return view('laporan/simpanan_manasuka', $d);
    }
    public function pdf_manasuka($id_user, $tgl_bayar)
    {
        $simpanan_manasuka = $this->db->query('SELECT sw.*, u.full_name FROM riwayat_manasuka sw left join users u on u.id_user=sw.id_user where sw.id_user = ' . $id_user . ' and sw.tgl_penarikan like "%' . $tgl_bayar . '%" and u.role = 2')->getResult();
        $users = $this->db->query('SELECT * FROM users where role = 2')->getResult();
        // var_dump($simpanan_pokok);
        // die;
        $d = ['title' => 'Laporan Simpanan Manasuka', 'simpanan_manasuka' => $simpanan_manasuka, 'users' => $users];
        return view('laporan/pdf_manasuka', $d);
    }
    public function pdf_manasuka_all()
    {
        $simpanan_manasuka = $this->db->query('SELECT sw.*, u.full_name FROM riwayat_manasuka sw left join users u on u.id_user=sw.id_user where u.role = 2')->getResult();
        $users = $this->db->query('SELECT * FROM users where role = 2')->getResult();
        // var_dump($simpanan_pokok);
        // die;
        $d = ['title' => 'Laporan Simpanan Manasuka', 'simpanan_manasuka' => $simpanan_manasuka, 'users' => $users];
        return view('laporan/pdf_manasuka', $d);
    }
}
