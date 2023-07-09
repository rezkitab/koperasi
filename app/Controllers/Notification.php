<?php

namespace App\Controllers;

class Notification extends BaseController
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    protected $session;
    protected $db, $builder, $simpanan_wajib, $simpanan_pokok, $simpanan_manasuka;
    public function __construct()
    {

        // $this->load->helper('url');
        \Midtrans\Config::$serverKey = 'SB-Mid-server-z5T9WhivZDuXrJxC7w-civ_k';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        // return $this->midtrans->config($serverKey);
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->db = \Config\Database::connect();
        $this->simpanan_pokok = $this->db->table('simpanan_pokok');
        $this->simpanan_wajib = $this->db->table('riwayat_simpanan');
        $this->simpanan_manasuka = $this->db->table('simpanan_manasuka');

        date_default_timezone_set("Asia/jakarta");
    }

    public function cektransaksi()
    {
        $getorderid = $this->db->query('SELECT order_id FROM simpanan_pokok where id_user = ' . $this->session->get('id_user') . '')->getRowArray();

        $status = \Midtrans\Transaction::status($getorderid['order_id']);
        // var_dump($status);
        // die;
        if ($status->status_code == 200) {
            $data = [
                'status' => 1
            ];
        } elseif ($status->status_code == 201) {
            $data = [
                'status' => 2
            ];
        } else {
            $data = [
                'status' => 3
            ];
        }

        $success = $this->simpanan_pokok->where('order_id', $getorderid['order_id'])->set($data)->update();
        if ($success) {
            session()->setFlashdata('pesan', 'diupdate');
            return redirect()->to(base_url('/auth'));
        }
    }
    public function cektransaksiwajib()
    {
        $data['simpanan_wajib'] =
            $this->db->query("select * from riwayat_simpanan where status = 201")->getResult();
        foreach ($data['simpanan_wajib'] as $sw) {

            $status = \Midtrans\Transaction::status($sw->order_id);
            // var_dump($status);
            // die;
            if ($status->status_code == 200) {
                $data = [
                    'status' => 200
                ];
            } elseif ($status->status_code == 201) {
                $data = [
                    'status' => 201
                ];
            } else {
                $data = [
                    'status' => 404
                ];
            }


            $success = $this->simpanan_wajib->where('order_id', $sw->order_id)->set($data)->update();
            if ($success) {
                session()->setFlashdata('pesan', 'diupdate');
                return redirect()->to(base_url('/auth'));
            }
        }
    }
    public function cektransaksimanasuka()
    {
        $data['simpanan_manasuka'] =
            $this->db->query("select * from simpanan_manasuka where status = 2")->getResult();
        foreach ($data['simpanan_manasuka'] as $sw) {

            $status = \Midtrans\Transaction::status($sw->order_id);
            // var_dump($status);
            // die;
            if ($status->status_code == 200) {
                $data = [
                    'status' => 1
                ];
            } elseif ($status->status_code == 201) {
                $data = [
                    'status' => 2
                ];
            } else {
                $data = [
                    'status' => 3
                ];
            }


            $success = $this->simpanan_manasuka->where('order_id', $sw->order_id)->set($data)->update();
            if ($success) {
                session()->setFlashdata('pesan', 'diupdate');
                return redirect()->to(base_url('/auth'));
            }
        }
    }
}
