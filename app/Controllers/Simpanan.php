<?php

namespace App\Controllers;

use Config\MyConfig;
use app\Models\SimpananModel;

class Simpanan extends BaseController
{
    protected $allowedFields = ['image'];
    protected $session;
    protected $db, $simpanan, $myConfig, $simpanan_manasuka, $riwayat_simpanan, $jurnal_umum;
    function __construct()
    {


        $this->session = \Config\Services::session();
        $this->session->start();
        $this->myConfig = new MyConfig;
        $this->db = \Config\Database::connect();
        $this->simpanan = $this->db->table('simpanan_pokok');
        $this->jurnal_umum = $this->db->table('jurnal_umum');

        $this->simpanan_manasuka = $this->db->table('simpanan_manasuka');
        $this->riwayat_simpanan = $this->db->table('riwayat_simpanan');
        if ($this->session->get('role') != 1) {


            $data['simpanan_pokok'] =
                $this->db->query('SELECT order_id FROM simpanan_pokok where id_user = ' . $this->session->get('id_user') . ' and status = 2')->getResult();

            if (isset($data['simpanan_pokok'][0]->order_id)) {
                $this->cektransaksi();
            }
            $data['riwayat_simpanan'] =
                $this->db->query('SELECT order_id FROM riwayat_simpanan where id_user = ' . $this->session->get('id_user') . ' and status = 201')->getResult();
            if (isset($data['riwayat_simpanan'][0]->order_id)) {
                // var_dump("asd");
                // die;
                $this->cektransaksisimwajib();
            }
            $data['simpanan_manasuka'] =
                $this->db->query('SELECT order_id FROM simpanan_manasuka where id_user = ' . $this->session->get('id_user') . ' and status = 2')->getResult();
            if (isset($data['simpanan_manasuka'][0]->order_id)) {
                $this->cektransaksimanasuka();
            }
        }
        date_default_timezone_set("Asia/jakarta");
    }
    public function cektransaksi()
    {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-z5T9WhivZDuXrJxC7w-civ_k';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        // $getorderid = $this->db->query('SELECT order_id FROM simpanan_pokok where id_user = ' . $this->session->get('id_user') . '')->getRowArray();
        $data['simpanan_pokok'] =
            $this->db->query('SELECT order_id FROM simpanan_pokok where id_user = ' . $this->session->get('id_user') . '')->getResult();
        foreach ($data['simpanan_pokok'] as $sw) {

            $status = \Midtrans\Transaction::status($sw->order_id);

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
            // var_dump($data);
            // die;
            $success = $this->simpanan->where('order_id', $sw->order_id)->set($data)->update();
        }
    }
    public function cektransaksisimwajib()
    {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-z5T9WhivZDuXrJxC7w-civ_k';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        // $getorderid = $this->db->query('SELECT order_id FROM simpanan_pokok where id_user = ' . $this->session->get('id_user') . '')->getRowArray();
        $data['simpanan_wajib'] =
            $this->db->query('SELECT order_id FROM riwayat_simpanan where id_user = ' . $this->session->get('id_user') . '')->getResult();

        foreach ($data['simpanan_wajib'] as $sw) {

            $status = \Midtrans\Transaction::status($sw->order_id);

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
                    'status' => 500
                ];
            }
            // var_dump($data);
            // die;
            $success = $this->riwayat_simpanan->where('order_id', $sw->order_id)->set($data)->update();
        }
    }
    public function cektransaksimanasuka()
    {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-z5T9WhivZDuXrJxC7w-civ_k';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        // $getorderid = $this->db->query('SELECT order_id FROM simpanan_pokok where id_user = ' . $this->session->get('id_user') . '')->getRowArray();
        $data['simpanan_manasuka'] =
            $this->db->query('SELECT order_id FROM simpanan_manasuka where id_user = ' . $this->session->get('id_user') . '')->getResult();
        foreach ($data['simpanan_manasuka'] as $sw) {

            $status = \Midtrans\Transaction::status($sw->order_id);

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
            // var_dump($data);
            // die;
            $success = $this->simpanan_manasuka->where('order_id', $sw->order_id)->set($data)->update();
        }
    }
    public function simpanan_pokok()
    {
        $title = ['title' => 'Simpanan Pokok'];
        $username = $this->session->get('username');
        $id_user = $this->session->get('id_user');
        // $cekSimpananpokok = $this->db->query('SELECT * FROM simpanan_pokok where id_user = ' . $this->session->get('id_user') . '')->getResult();
        $getsimpanan = $this->db->query('SELECT * FROM simpanan_pokok where id_user = ' . $this->session->get('id_user') . '')->getRowArray();
        // var_dump($getsimpanan['order_id']);
        // die;

        $d = ['data' => 'Simpanan Pokok', 'username' => $username, 'id_user' => $id_user, 'getsimpanan' => $getsimpanan, 'title' => $title];
        return view('simpanan/simpanan_pokok', $d);
    }

    public function pay()
    {
        $id = $this->request->getPost('id_user');
        $statustype = $this->request->getPost('result_type');
        $statusdata = $this->request->getPost('result_data');

        $json = json_decode($statusdata);
        // var_dump($json);
        // die;
        $pdf_url = $json->pdf_url;
        $status =
            $statustype == 'success'
            ? '1'
            : ($statustype == 'pending'
                ? '2'
                : '3');
        $orderid = $json->order_id;

        $index = 0;
        for ($i = 0; $i < sizeof($id); $i++) {
            $data = array(
                'id' => $id[$i],
                'pdf_url' => $pdf_url,
                'tgl_bayar' => date('Y-m-d H:i:s'),
                'metode_pembayaran' => 'Online',
                'Status' => $status,
                'order_id' => $orderid,
            );

            $tanggal = date('Y-m-d');
            $periode = set_periode($tanggal);
            $nominal = $json->gross_amount;
            $kode = 'TRX-POKOK-' . $json->order_id;
            $keterangan = 'Pembayaran Simpanan Pokok Anggota - ' . $id[$i];
            $kode_akun_debet = "1102"; //bank
            $kode_akun_kredit = "3201"; //simpanan pokok
            $gl = [
                [
                    'tanggal'       => $tanggal,
                    'periode'       => $periode,
                    'kode_akun'     => $kode_akun_debet,
                    'deskripsi'     => $keterangan,
                    'no_bukti'      => $kode,
                    'dc'            => 'd',
                    'nominal'       => $nominal,
                    'trans_ref'     => 'SIMPANAN POKOK'
                ],
                [
                    'tanggal'       => $tanggal,
                    'periode'       => $periode,
                    'kode_akun'     => $kode_akun_kredit,
                    'deskripsi'     => $keterangan,
                    'no_bukti'      => $kode,
                    'dc'            => 'c',
                    'nominal'       => $nominal,
                    'trans_ref'     => 'SIMPANAN POKOK'
                ],
            ];
            $this->jurnal_umum->insertBatch($gl);

            $this->simpanan->where('id_user', $id[$i])->set($data)->update();
        }
        return redirect()->to('/simpanan/simpanan_pokok');
    }
    public function simpanan_wajib()
    {
        $simpanan_wajib  = $this->db->query('SELECT * FROM simpanan_wajib sm left join users u on sm.id_user=u.id_user where sm.id_user = ' . $this->session->get('id_user') . '')->getResult();
        $d = ['title' => 'Simpanan Wajib', 'simpanan_wajib' => $simpanan_wajib];
        return view('simpanan/simpanan_wajib', $d);
    }
    public function simpanan_manasuka()
    {
        $simpanan_manasuka  = $this->db->query('SELECT  sm.*, u.full_name FROM simpanan_manasuka sm left join users u on sm.id_user=u.id_user where sm.id_user = ' . $this->session->get('id_user') . '')->getResult();
        $saldo  = $this->db->query('SELECT ((SELECT SUM(sk.nominal) FROM simpanan_manasuka sk WHERE sk.id_user = ' . $this->session->get('id_user') . ' and sk.status = 1) - 
        (SELECT SUM(su.nominal_tarik) FROM simpanan_manasuka su WHERE su.id_user = ' . $this->session->get('id_user') . ')) as total FROM simpanan_manasuka sm 
        left join users u on sm.id_user=u.id_user where sm.id_user = ' . $this->session->get('id_user') . ' and status = 1 GROUP BY sm.id_user')->getResult();
        // var_dump($simpanan_manasuka);
        // die;
        $d = ['title' => 'Simpanan Manasuka', 'simpanan_manasuka' => $simpanan_manasuka, 'saldo' => $saldo];
        return view('simpanan/simpanan_manasuka', $d);
    }
    public function add_manasuka()
    {
        $d = ['title' => 'Tambah Simpanan Manasuka'];
        return view('simpanan/add_manasuka', $d);
    }
    public function pay_manasuka()
    {
        $statustype = $this->request->getPost('result_type');
        $statusdata = $this->request->getPost('result_data');
        // var_dump($statusdata);
        // die;
        $json = json_decode($statusdata);
        $pdf_url = $json->pdf_url;
        $status =
            $statustype == 'success'
            ? '1'
            : ($statustype == 'pending'
                ? '2'
                : '3');
        $orderid = $json->order_id;

        $data = array(
            'id_user' => $this->session->get('id_user'),
            'nominal' => $this->request->getPost('nominal'),
            'pdf_url' => $pdf_url,
            'tgl_bayar' => date('Y-m-d H:i:s'),
            'metode_pembayaran' => 'Online',
            'jenis' => 'Masuk',
            'Status' => $status,
            'order_id' => $orderid,
        );

        $tanggal = date('Y-m-d');
        $periode = set_periode($tanggal);
        $nominal = $json->gross_amount;
        $kode = 'TRX-MANASUKA-' . $json->order_id;
        $keterangan = 'Pembayaran Simpanan Manasuka Anggota - ' . $this->session->get('id_user');
        $kode_akun_debet = "1102"; //bank
        $kode_akun_kredit = "3203"; //simpanan manasuka
        $gl = [
            [
                'tanggal'       => $tanggal,
                'periode'       => $periode,
                'kode_akun'     => $kode_akun_debet,
                'deskripsi'     => $keterangan,
                'no_bukti'      => $kode,
                'dc'            => 'd',
                'nominal'       => $nominal,
                'trans_ref'     => 'SIMPANAN MANASUKA'
            ],
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
        $this->jurnal_umum->insertBatch($gl);

        $this->simpanan_manasuka->insert($data);

        return redirect()->to('/simpanan/simpanan_manasuka');
    }
    public function add_riwayat_manasuka()
    {
        $cekNominal = $this->db->query('select sum(nominal) as total from simpanan_manasuka where status = 1 and id_user = ' . $this->session->get('id_user') . '')->getRowArray();
        $nominal = $this->request->getPost('nominal_tarik');
        // var_dump($nominal);
        // die;
        if ($nominal > $cekNominal['total']) {
            return redirect()->to('/simpanan/simpanan_manasuka')->withInput()->with('message', 'Nominal tidak boleh lebih besar dari Saldo');
        } else {
            $data = [
                'id_user' => $this->session->get('id_user'),
                'nama_penerima' => $this->request->getPost('nama_pemilik'),
                'nama_bank' => $this->request->getPost('nama_bank'),
                'no_rekening' => $this->request->getPost('no_rekening'),
                'nominal_tarik' => $this->request->getPost('nominal_tarik'),
                'status' => 2,
                'jenis' => "Keluar",
                'metode_pembayaran' => "Transfer",
                'tgl_penarikan' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            
            // $this->db->table('simpanan_manasuka')->where('id', $this->request->getPost('id_manasuka'))->set($data_nominal)->update();
            $this->db->table('simpanan_manasuka')->set($data)->insert();
            return redirect()->to('/simpanan/simpanan_manasuka')->withInput()->with('message', 'Penarikan Berhasil. Silahkan menunggu 1X 24jam untuk di PROSES admin');
        }
    }
    public function detail_manasuka($id_manasuka)
    {
        $detail_manasuka  = $this->db->query('SELECT u.full_name, rm.* FROM riwayat_manasuka rm left join users u on rm.id_user=u.id_user where rm.id_user = ' . $this->session->get('id_user') . ' and rm.id_manasuka = ' . $id_manasuka . '')->getResult();


        $d = ['title' => 'Detail Simpanan Manasuka', 'detail_manasuka' => $detail_manasuka];
        return view('simpanan/detail_manasuka', $d);
    }
    public function edit_riwayat_manasuka($id)
    {
        $id_manasuka = $this->request->getPost('id_manasuka');
        $cekNominal = $this->db->query('select nominal from simpanan_manasuka where id = ' . $id_manasuka . ' and id_user = ' . $this->session->get('id_user') . '')->getRowArray();
        $nominal = $this->request->getPost('nominal');
        $id_manasuka = $this->request->getPost('id_manasuka');
        // var_dump($cekNominal['nominal']);
        // die;
        if ($nominal > $cekNominal['nominal']) {
            return redirect()->to('/simpanan_manasuka')->withInput()->with('message', 'Nominal tidak boleh lebih besar dari simpanan');
        } else {
            $data = [
                'id_user' => $this->session->get('id_user'),
                'id_manasuka' => $this->request->getPost('id_manasuka'),
                'nama_penerima' => $this->request->getPost('nama_pemilik'),
                'nama_bank' => $this->request->getPost('nama_bank'),
                'no_rekening' => $this->request->getPost('no_rekening'),
                'nominal' => $this->request->getPost('nominal'),
                'status' => 2,
                'tgl_penarikan' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $this->db->table('riwayat_manasuka')->where('id', $id)->set($data)->update();
            return redirect()->to('simpanan/detail_manasuka/' . $id_manasuka . '')->withInput()->with('message', 'Penarikan Berhasil. Silahkan menunggu 1X 24jam untuk di PROSES admin');
        }
    }
    public function verifikasi_manasuka()
    {
        $verifikasi_manasuka  = $this->db->query('SELECT u.full_name, rm.* FROM simpanan_manasuka rm left join users u on rm.id_user=u.id_user where rm.jenis = "Keluar" order by rm.status DESC')->getResult();

        $d = ['title' => 'Verifikasi Simpanan Manasuka', 'verifikasi_manasuka' => $verifikasi_manasuka];
        return view('simpanan/verifikasi_manasuka', $d);
    }
    public function acc_manasuka($id)
    {
        $data = [
            'status' => 3,
            'id_admin' => $this->session->get('id_user'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->table('simpanan_manasuka')->where('id', $id)->set($data)->update();
        return redirect()->to('simpanan/verifikasi_manasuka')->withInput()->with('message', 'Verifikasi Berhasil, Silahkan Transfer uang ke anggota dengan jumlah yang di tentukan');
    }
    public function upload_image($id)
    {
        $dataimage = $this->request->getFile('image');

        $fileName = $dataimage->getClientName();
        $data = [
            'image' => $fileName,
            'status' => 1,
            'id_admin' => $this->session->get('id_user'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->table('simpanan_manasuka')->where('id', $id)->set($data)->update();
        $dataimage->move('assets/foto/bukti_transfer/', $fileName);
        session()->setFlashdata('success', 'image Berhasil diupload');
        return redirect()->to(base_url('simpanan/verifikasi_manasuka'));
    }
    public function add_simpanan_wajib($id)
    {

        $riwayat_simpanan  = $this->db->query('SELECT u.full_name, rs.*, b.nama_bulan FROM riwayat_simpanan rs left join users u on rs.id_user=u.id_user left join bulan b on rs.id_bulan=b.id_bulan where rs.id_sim_wajib = ' . $id . ' order by rs.id_bulan ASC')->getResult();
        $simpanan_wajib  = $this->db->query('SELECT * FROM simpanan_wajib where id = ' . $id . '')->getRowArray();
        $bulan
            = $this->db->query('SELECT * FROM bulan')->getResult();
        $jml_bulan
            = $this->db->query('SELECT id_bulan as total FROM riwayat_simpanan where id_sim_wajib = ' . $id . '')->getResult();

        // var_dump($jml_bulan);
        // die;
        $d = ['title' => 'Simpanan', 'riwayat_simpanan' => $riwayat_simpanan, 'bulan' => $bulan, 'id_sim_wajib' => $id, 'tahun' => $simpanan_wajib['tahun'], 'jml_bulan' => $jml_bulan];
        return view('simpanan/add_simpanan_wajib', $d);
    }

    public function pay_simpanan()
    {
        $statustype = $this->request->getPost('result_type');
        $statusdata = $this->request->getPost('result_data');
        // var_dump($statusdata);
        // die;
        $json = json_decode($statusdata);
        $pdf_url = $json->pdf_url;
        $status =
            $statustype == 'success'
            ? '200'
            : ($statustype == 'pending'
                ? '201'
                : '203');
        $orderid = $json->order_id;

        $data = array(
            'id_sim_wajib' => $this->request->getPost('id_sim_wajib'),
            'id_user' => $this->session->get('id_user'),
            'id_bulan' => $this->request->getPost('bulan'),
            'tahun' => $this->request->getPost('tahun'),
            'nominal' => $this->request->getPost('nominal'),
            'tgl_bayar' => date('Y-m-d H:i:s'),
            'order_id' => $orderid,
            'pdf_url' => $pdf_url,
            'Status' => $status,
            'created_at' => date('Y-m-d H:i:s'),

        );

        $tanggal = date('Y-m-d');
        $periode = set_periode($tanggal);
        $nominal = $json->gross_amount;
        $kode = 'TRX-WAJIB-' . $json->order_id;
        $keterangan = 'Pembayaran Simpanan Wajib Anggota - ' . $this->session->get('id_user');
        $kode_akun_debet = "1102"; //bank
        $kode_akun_kredit = "3202"; //simpanan wajib
        $gl = [
            [
                'tanggal'       => $tanggal,
                'periode'       => $periode,
                'kode_akun'     => $kode_akun_debet,
                'deskripsi'     => $keterangan,
                'no_bukti'      => $kode,
                'dc'            => 'd',
                'nominal'       => $nominal,
                'trans_ref'     => 'SIMPANAN WAJIB'
            ],
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
        $this->jurnal_umum->insertBatch($gl);

        $this->riwayat_simpanan->insert($data);

        return redirect()->to('simpanan/add_simpanan_wajib/' . $this->request->getPost('id_sim_wajib') . '');
    }
    public function simpanan_pokok_view()
    {
        $simpanan_pokok = $this->db->query('SELECT sp.*, u.full_name FROM simpanan_pokok sp left join users u on u.id_user=sp.id_user where u.role = 2')->getResult();
        $users = $this->db->query('SELECT * FROM users where role = 2')->getResult();
        // var_dump($simpanan_pokok);
        // die;
        $d = ['title' => 'Simpanan Pokok', 'simpanan_pokok' => $simpanan_pokok, 'users' => $users];
        return view('simpanan/simpanan_pokok_view', $d);
    }
    public function simpanan_wajib_view()
    {
        $simpanan_wajib = $this->db->query('SELECT sw.*, u.full_name, b.nama_bulan FROM riwayat_simpanan sw left join users u on u.id_user=sw.id_user left join bulan b on sw.id_bulan=b.id_bulan where u.role = 2')->getResult();
        $users = $this->db->query('SELECT * FROM users where role = 2')->getResult();
        // var_dump($simpanan_pokok);
        // die;
        $d = ['title' => 'Simpanan Wajib', 'simpanan_wajib' => $simpanan_wajib, 'users' => $users];
        return view('simpanan/simpanan_wajib_view', $d);
    }
}
