<?php

namespace App\Controllers;

class Snap_simpanan extends BaseController
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
    protected $db, $builder;
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

        date_default_timezone_set("Asia/jakarta");
    }

    public function index()
    {
        $this->load->view('chekout_snap');
    }

    public function token()
    {


        $fullname = $this->session->get('username');

        $bulan = $this->request->getPost('bulan');
        $total = $this->request->getPost('total');
        // Required
        // Required
        $transaction_details = [
            'order_id' => rand(),
            'gross_amount' => $total, // no decimal allowed for creditcard
        ];

        // Optional
        $item1_details = [
            'id' => rand(000, 999),
            'price' => $total,
            'quantity' => 1,
            'name' => 'Pembayaran Simpanan Wajib Bulan' . $bulan . '',
        ];

        // Optional

        // Optional
        $item_details = [$item1_details];

        // Optional
        $billing_address = [
            'first_name' => $fullname,
            'last_name' => 'a',
            'address' => 'a',
            'city' => 'a',
            'postal_code' => 'a',
            'phone' => 'a',
            'country_code' => 'IDN',
        ];

        // Optional
        $shipping_address = [
            'first_name' => $fullname,
            'last_name' => 'Supriadi',
            'address' => 'Manggis 90',
            'city' => 'Jakarta',
            'postal_code' => '16601',
            'phone' => '08113366345',
            'country_code' => 'IDN',
        ];

        // Optional
        $customer_details = [
            'first_name' => $fullname,
            'last_name' => '',
            'email' => 'andri@litani.com',
            'phone' => '081122334455',
            'billing_address' => $billing_address,
            'shipping_address' => $shipping_address,
        ];

        // Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = [
            'start_time' => date('Y-m-d H:i:s O', $time),
            'unit' => 'minute',
            'duration' => 60,
        ];

        $transaction_data = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
            'credit_card' => $credit_card,
            'expiry' => $custom_expiry,
        ];

        error_log(json_encode($transaction_data));
        $snapToken = \Midtrans\Snap::getSnapToken($transaction_data);
        error_log($snapToken);
        echo $snapToken;
    }

    public function finish()
    {
        $result = json_decode($this->request->getPost('result_data'));
        echo 'RESULT <br><pre>';
        var_dump($result);
        echo '</pre>';
    }
}
