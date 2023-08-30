<?php

namespace App\Controllers;

use Config\MyConfig;

class Dashboard extends BaseController
{
    protected $session;
    protected $db, $simpanan_pokok, $myConfig;
    function __construct()
    {

        \Midtrans\Config::$serverKey = 'SB-Mid-server-z5T9WhivZDuXrJxC7w-civ_k';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $this->session = \Config\Services::session();
        $this->session->start();
        $this->db = \Config\Database::connect();
        $this->simpanan_pokok = $this->db->table('simpanan_pokok');
        $this->myConfig = new MyConfig;
        $this->insertSimpananWajib();
        date_default_timezone_set("Asia/jakarta");
    }
    public function index()
    {
        // $cekSimpananpokok = $this->db->query('SELECT * FROM simpanan_pokok where id_user = ' . $this->session->get('id_user') . ' and status = 1')->getResult();
        // if ($cekSimpananpokok == false) {
        //     $newdata = ['username', 'role', 'logged_in'];
        //     $this->session->remove($newdata);

        //     return redirect()->to('/')->with('msg', '<div class="alert alert-info">Logout berhasil.</div>');
        // }
        if ($this->session->get('id_user') == 1) {
            $total_pokok = $this->db->query('SELECT sum(sp.nominal) as total FROM simpanan_pokok sp, users u where sp.id_user=u.id_user and sp.status = 1 and u.is_active = 1')->getRowArray();
        } else {
            $total_pokok = $this->db->query('SELECT sum(nominal) as total FROM simpanan_pokok where id_user = ' . $this->session->get('id_user') . ' and status = 1')->getRowArray();
        }
        if ($this->session->get('id_user') == 1) {
            $total_simpanan = $this->db->query('SELECT sum(rs.nominal) as total FROM riwayat_simpanan rs, users u where rs.id_user=u.id_user and rs.status = 200 and u.is_active = 1')->getRowArray();
        } else {
            $total_simpanan = $this->db->query('SELECT sum(nominal) as total FROM riwayat_simpanan where id_user = ' . $this->session->get('id_user') . ' and status = 200')->getRowArray();
        }
        if ($this->session->get('id_user') == 1) {
            $total_manasuka = $this->db->query('SELECT sum(sm.nominal) as total FROM simpanan_manasuka sm, users u where sm.id_user=u.id_user and sm.status = 1 and u.is_active = 1')->getRowArray();
        } else {
            $total_manasuka = $this->db->query('SELECT sum(nominal) as total FROM simpanan_manasuka where id_user = ' . $this->session->get('id_user') . ' and status = 1')->getRowArray();
        }

        $d = ['data' => 'Dashboard', 'total_pokok' => $total_pokok, 'total_simpanan' => $total_simpanan, 'total_manasuka' => $total_manasuka];
        return view('dashboard/index', $d);
    }
    public function insertSimpananWajib()
    {
        $hari_ini = date("Y-m-d");
        $tahun = date('Y');
        // $bulan = "February 2023";

        $data['users'] =
            $this->db->query("select * from users where role = 2 and is_active = 1")->getResult();
        foreach ($data['users'] as $us) {

            $data = [
                'id_user' => $us->id_user,
                'tahun' => $tahun,
                'created_at' => date('Y-m-d H:i:s'),

            ];
            $cek = $this->db->query("select * from simpanan_wajib where id_user = '$us->id_user' and tahun = '$tahun' ")->getResult();
            // dead($cek);
            if ($cek != true) {
                $this->db->table('simpanan_wajib')->set($data)->insert();
            }
        }
    }
}
