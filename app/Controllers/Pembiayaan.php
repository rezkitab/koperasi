<?php

namespace App\Controllers;

use App\Models\Laporan\JurnalUmum;
use Config\MyConfig;
use App\Models\PembiayaanModel;
use App\Models\UserModel;

class Pembiayaan extends BaseController
{
    protected $validation;
    protected $session;
    protected $pembiayaanModel;
    protected $userModel;
    protected $jurnal_umum;
    protected $db;

    public function __construct()
    {
        $this->myConfig                 = new MyConfig;
        $this->validation               = \Config\Services::validation();
        $this->session                  = \Config\Services::session();
        $this->pembiayaanModel          = new PembiayaanModel();
        $this->userModel                = new UserModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title'                     => 'Data Pembiayaan',
            'pembiayaan'                => $this->pembiayaanModel->getPembiayaan(),
        ];

        return view('pembiayaan/view_data_pembiayaan', $data);
    }

    public function add()
    {
        $data = [
            'title'                     => 'Tambah Data Pembiayaan',
            'kode_pembiayaan'           => 'PMB' . rand(000, 999),
            'anggota'                   => $this->userModel->getAnggotaPembiayaan(),
        ];

        return view('pembiayaan/add_data_pembiayaan', $data);
    }

    public function create()
    {
        $data_pembiayaan = array(
            'kode_pembiayaan'           => $this->request->getPost('kode_pembiayaan'),
            'user_id'                   => $this->request->getPost('user_id'),
            'tgl_pembiayaan'            => date('Y-m-d'),
            'jenis_pembiayaan'          => $this->request->getPost('jenis_pembiayaan'),
            'jumlah_pembiayaan'         => replace_nominal($this->request->getPost('jumlah_pembiayaan')),
            'angsuran'                  => $this->request->getPost('angsuran'),
            'margin'                    => 10,
            'biaya_administrasi'        => 340000,
            'total_angsuran'            => replace_nominal($this->request->getPost('total_angsuran')),
            'total_pembiayaan'          => replace_nominal($this->request->getPost('total_pembiayaan')),
            'status'                    => 'Belum Lunas',
        );

        $this->pembiayaanModel->createPembiayaan($data_pembiayaan);

        $pembiayaan_id                   =  $this->pembiayaanModel->get()->getLastRow()->id;
        $data_detail_pembiayaan          = [];

        for ($i = 1; $i <= $this->request->getPost('angsuran'); $i++) :
            $data_detail_pembiayaan[] = [
                'pembiayaan_id'         => $pembiayaan_id,
                'angsuran_ke'           => $i,
                'jumlah_angsuran'       => replace_nominal($this->request->getPost('total_angsuran')),
                'status'                => 'Belum Dibayar',
            ];
        endfor;

        $this->pembiayaanModel->createDetailPembiayaan($data_detail_pembiayaan);

        session()->setFlashdata('success', 'Data Pembiayaan Berhasil Ditambahkan');
        return redirect()->to('pembiayaan');
    }

    public function update()
    {
        $id_pembiayaan                  = $this->request->getPost('id');
        $pembiayaan                     = $this->pembiayaanModel->getDetailBayar($id_pembiayaan);

        $update = array(
            'tgl_pembayaran'            => date('Y-m-d'),
            'status'                    => 'Sudah Dibayar',
        );

        $check = $this->pembiayaanModel->updateDetailPembiayaan($update, $pembiayaan->id);

        if ($check) {

            $check_status = $this->pembiayaanModel->getDetailBayar($id_pembiayaan);

            if ($check_status !== null) {

                session()->setFlashdata('success', 'Data Pembayaran Berhasil Disimpan');
                return redirect()->back();
            } else {

                $update_status = array(
                    'tgl_pelunasan'     => date('Y-m-d'),
                    'status'            => 'Lunas',
                );
                $this->pembiayaanModel->updatePembiayaan($update_status, $id_pembiayaan);

                session()->setFlashdata('success', 'Data Pembayaran Berhasil Disimpan');
                return redirect()->back();
            }
        }
    }

    public function detail($id)
    {
        $data = [
            'title'                 => 'Data Detail Pembiayaan',
            'pembiayaan'             => $this->pembiayaanModel->where('id', $id)->join('users', 'users.id_user=pembiayaan.user_id')->first(),
            'detail_pembiayaan'      => $this->pembiayaanModel->getDetailPembiayaan($id)
        ];

        $detail_pembiayaan = $this->pembiayaanModel->getStatusPembiayaan();

        if (isset($detail_pembiayaan)) {
            $this->update_status();
        }

        return view('pembiayaan/view_data_detail_pembiayaan', $data);
    }

    public function print_angsuran($id)
    {
        $data = [
            'title'                 => 'Print Angsuran',
            'pembiayaan'            => $this->pembiayaanModel->getPrintAngsuran($id)
        ];
        // dd($data);
        return view('pembiayaan/print_angsuran', $data);
    }


    public function fetch_anggota()
    {
        $user_id                = $this->request->getPost('user_id');
        $simpanan               = $this->pembiayaanModel->getTotalSimpanan($user_id);

        echo json_encode($simpanan);
    }

    public function setujui()
    {
        $id_pembiayaan                  = $this->request->getPost('id');

        $update = array(
            'status_pembiayaan'         => 'Disetujui',
        );


        $this->pembiayaanModel->updatePembiayaan($update, $id_pembiayaan);

        session()->setFlashdata('success', 'Data Pengajuan Pembiayaan Disetujui');
        return redirect('pembiayaan');
    }

    public function tolak()
    {
        $id_pembiayaan                  = $this->request->getPost('id');

        $update = array(
            'status_pembiayaan'         => 'Ditolak',
        );

        $this->pembiayaanModel->updatePembiayaan($update, $id_pembiayaan);

        session()->setFlashdata('success', 'Data Pengajuan Pembiayaan Ditolak');
        return redirect('pembiayaan');
    }

    public function payment()
    {
        if ($this->request->isAJAX()) {
            $pembiayaan_id                  = $this->request->getPost('pembiayaan_id');
            $pembiayaan                     = $this->pembiayaanModel->getDetailPembiayaanBayar($pembiayaan_id);

            if ($pembiayaan->angsuran_ke == 1) {
                $pembayaran = (int)$pembiayaan->jumlah_angsuran + (int)$pembiayaan->biaya_administrasi;
            } else {
                $pembayaran = (int)$pembiayaan->jumlah_angsuran;
            }

            if (!$pembiayaan) {
                $json = [
                    'error'                 => 'Pembayaran Gagal!'
                ];
            } else {
                // $this->load->helper('url');
                \Midtrans\Config::$serverKey = 'SB-Mid-server-x52m3Hgw9QDHurl-vmm0fgVF';
                // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
                \Midtrans\Config::$isProduction = false;
                // Set sanitization on (default)
                \Midtrans\Config::$isSanitized = true;
                // Set 3DS transaction for credit card to true
                \Midtrans\Config::$is3ds = true;

                // Populate customer's info
                $customer_details = array(
                    'first_name'            => $pembiayaan->full_name,
                    'phone'                 => $pembiayaan->no_hp,
                );

                // Populate items
                $detail_items[] = [ // detail pembiayaan
                    'id'                => $pembiayaan->id,
                    'price'             => $pembayaran,
                    'quantity'          => 1,
                    'name'              => $pembiayaan->angsuran
                ];


                $params = [
                    'transaction_details'   => array(
                        'order_id'          => rand(),
                        'gross_amount'      => $pembayaran,
                    ),
                    'item_details'          => $detail_items,
                    'customer_details'      => $customer_details,
                ];

                $json = [
                    'snapToken'              => \Midtrans\Snap::getSnapToken($params),
                    'pembiayaan_id'          => $pembiayaan->pembiayaan_id,
                    'pembiayaan_detail_id'   => $pembiayaan->id,
                ];
            }

            echo json_encode($json);
        }
    }


    public function finishPayment()
    {
        if ($this->request->isAJAX()) {

            $pembiayaan_id                  = $this->request->getPost('pembiayaan_id');
            $pembiayaan                     = $this->pembiayaanModel->getDetailPembiayaanBayar($pembiayaan_id);

            $data_pembiayaan = array(
                'tgl_pembayaran'            => date('Y-m-d'),
                'order_id'                  => $this->request->getPost('order_id'),
                'payment_type'              => $this->request->getPost('payment_type'),
                'status_message'            => $this->request->getPost('status_message'),
                'transaction_id'            => $this->request->getPost('transaction_id'),
                'transaction_status'        => $this->request->getPost('transaction_status'),
                'transaction_time'          => $this->request->getPost('transaction_time'),
                'bank'                      => $this->request->getPost('bank'),
                'va_number'                 => $this->request->getPost('va_number'),
                'pdf_url'                   => $this->request->getPost('pdf_url'),
                'status'                    => $this->request->getPost('transaction_status'),
            );

            $this->pembiayaanModel->updateDetailPembiayaan($data_pembiayaan, $pembiayaan->id);

            $json = [
                'success'                   => 'Data Berhasil Disimpan',
                'pembiayaan_id'             => $pembiayaan_id,
                'pembiayaan_detail_id'      => $pembiayaan->id,
            ];
            echo json_encode($json);
        }
    }



    // ANGGOTA 
    public function anggota()
    {
        $data = [
            'title'                     => 'Data Pembiayaan',
            'pembiayaan'                => $this->pembiayaanModel->getPembiayaanAnggota($this->session->get('id_user')),
            'simpanan'                  => $this->pembiayaanModel->getStatusSimpanan($this->session->get('id_user')),
            'simpanan_wajib'            => $this->db->query('SELECT * FROM riwayat_simpanan sm left join users u on sm.id_user=u.id_user where sm.id_user = ' . $this->session->get('id_user') . '')->getRowArray(),
        ];

        return view('pembiayaan/anggota_view_data_pembiayaan', $data);
    }

    public function anggota_detail($id)
    {
        $data = [
            'title'                     => 'Data Detail Pembiayaan',
            'pembiayaan'                => $this->pembiayaanModel->where('id', $id)->join('users', 'users.id_user=pembiayaan.user_id')->first(),
            'detail_pembiayaan'         => $this->pembiayaanModel->getDetailPembiayaan($id),
        ];

        $detail_pembiayaan = $this->pembiayaanModel->getStatusPembiayaan();
        if (isset($detail_pembiayaan)) {
            $this->update_status();
        }

        return view('pembiayaan/anggota_view_data_detail_pembiayaan', $data);
    }

    public function anggota_add()
    {
        $data = [
            'title'                     => 'Tambah Data Pengajuan Pembiayaan',
            'kode_pembiayaan'           => 'PMB' . rand(000, 999),
            'anggota'                   => $this->pembiayaanModel->getAnggotaPembiayaan($this->session->get('id_user')),
            'user_id'                   => $this->session->get('id_user'),
        ];

        return view('pembiayaan/anggota_add_data_pembiayaan', $data);
    }

    public function anggota_create()
    {
        $check_status = $this->pembiayaanModel->where('user_id', $this->session->get('id_user'))->where('status_pembiayaan', 'Menunggu Persetujuan')->get()->getFirstRow();

        if (!$check_status) {
            $data_pembiayaan = array(
                'kode_pembiayaan'           => $this->request->getPost('kode_pembiayaan'),
                'user_id'                   => $this->session->get('id_user'),
                'tgl_pembiayaan'            => date('Y-m-d'),
                'jenis_pembiayaan'          => $this->request->getPost('jenis_pembiayaan'),
                'jumlah_pembiayaan'         => replace_nominal($this->request->getPost('jumlah_pembiayaan')),
                'angsuran'                  => $this->request->getPost('angsuran'),
                'margin'                    => 10,
                'biaya_administrasi'        => 340000,
                'total_angsuran'            => replace_nominal($this->request->getPost('total_angsuran')),
                'total_pembiayaan'          => replace_nominal($this->request->getPost('total_pembiayaan')),
                'status'                    => 'Belum Lunas',
                'status_pembiayaan'         => 'Menunggu Persetujuan'

            );

            $this->pembiayaanModel->createPembiayaan($data_pembiayaan);

            $pembiayaan_id                   =  $this->pembiayaanModel->get()->getLastRow()->id;
            $data_detail_pembiayaan          = [];

            for ($i = 1; $i <= $this->request->getPost('angsuran'); $i++) :
                $data_detail_pembiayaan[] = [
                    'pembiayaan_id'         => $pembiayaan_id,
                    'angsuran_ke'           => $i,
                    'jumlah_angsuran'       => replace_nominal($this->request->getPost('total_angsuran')),
                    'status'                => 'Belum Dibayar',
                ];
            endfor;

            $this->pembiayaanModel->createDetailPembiayaan($data_detail_pembiayaan);

            session()->setFlashdata('success', 'Data Pembiayaan Berhasil Diajukan');
            return redirect()->to('pembiayaan/anggota');
        } else {
            session()->setFlashdata('error', 'Gagal, Pembiayaan Sebelumnya Belum Disetujui');
            return redirect()->to('pembiayaan/anggota');
        }
    }

    public function update_status()
    {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-x52m3Hgw9QDHurl-vmm0fgVF';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $detail_pembiayaan = $this->pembiayaanModel->getStatusPembiayaan();
        for ($i = 0; $i < sizeof($detail_pembiayaan); $i++) :
            $status = \Midtrans\Transaction::status($detail_pembiayaan[$i]['order_id']);
            if ($status->transaction_status == 'cancel') {
                $update_status = [
                    'order_id'                  => NULL,
                    'payment_type'              => NULL,
                    'status_message'            => NULL,
                    'transaction_id'            => NULL,
                    'transaction_status'        => NULL,
                    'transaction_time'          => NULL,
                    'bank'                      => NULL,
                    'va_number'                 => NULL,
                    'pdf_url'                   => NULL,
                ];
            } else {
                $update_status = [
                    'transaction_status'        => $status->transaction_status,
                    'status'                    => $status->transaction_status,
                    'status_message'            => $status->status_message
                ];
            }

            $this->pembiayaanModel->updateDataAngsuran($update_status, $detail_pembiayaan[$i]['order_id']);

        endfor;
    }
}
