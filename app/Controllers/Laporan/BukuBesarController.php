<?php

namespace App\Controllers\Laporan;

use App\Controllers\BaseController;
use Config\MyConfig;
use App\Models\Laporan\BukuBesar;
use App\Models\Master\Coa;

class BukuBesarController extends BaseController
{
    private $bukuBesar;
    private $coa;
    protected $myConfig;

    public function __construct()
    {
        $this->myConfig = new MyConfig;
        $this->bukuBesar = new BukuBesar();
        $this->coa = new Coa();
    }

    public function index()
    {
        $akun = $this->coa->findAll();;
        $data = [
            'title' => 'Buku Besar',
            'akun'   => $akun
        ];

        return view('laporan/buku_besar', $data);
    }

    public function filterOption()
    {
        $nama = $this->request->getVar('search');

        if ($nama == null || $nama == '') {
            $data = $this->coa->findAll();
        } else {
            $data = $this->coa->ike('nama', $nama)->findAll();
        }

        if (count($data) > 0) {
            foreach ($data as $row) {
                $res[] = [
                    'id' => $row['kode'],
                    'text' => $row['kode'] . '-' . $row['nama']
                ];
            }
        } else {
            $res = [];
        }

        $result = [
            'id' => 'all',
            'text'  => '0-Tampilkan Semua Akun'
        ];
        array_push($res, $result);

        return $this->response->setJSON([
            'status'        => true,
            'message'       => 'Get Data Successfully',
            'results'       => $res,
            'errors'        => [],
        ], 200);
    }

    public function getData()
    {
        $periode = $periode_req = str_replace('-', '', $this->request->getVar('periode'));
        $kode_akun = $this->request->getVar('kode_akun');

        if ($periode == null) {
            $periode = date('Y') . '' . date('m');
        }

        $bb = $this->bukuBesar->getData($periode, $kode_akun);

        $resData = [];
        if (count($bb) > 0) {
            foreach ($bb as $item) {

                $detail = [];
                $saldo = 0;
                $saldo_akhir = 0;
                $kredit = 0;
                $debet = 0;
                $countDetail = count($item['detail']) - 1;
                if (count($item['detail']) > 0) {
                    foreach ($item['detail'] as $datum) {

                        $debet  = $datum['debet'];
                        $kredit = $datum['kredit'];
                        if ($datum['saldo_normal'] == 'd') {
                            $saldo = ($saldo + $debet) - $kredit;
                        } else {
                            $saldo = ($saldo + $kredit) - $debet;
                        }

                        $push_detail = [
                            'tanggal'           => $datum['tanggal'],
                            'transaksi'         => $datum['transaksi'],
                            'nomor'             => $datum['nomor'],
                            'keterangan'        => $datum['deskripsi'],
                            'debet'             => nominal3($datum['debet']),
                            'kredit'            => nominal3($datum['kredit']),
                            'saldo_normal'      => $datum['saldo_normal'],
                            'saldo'             => nominal3($saldo +  $item['saldo_awal']->saldo_awal)
                        ];

                        $saldo_akhir = ($saldo +  $item['saldo_awal']->saldo_awal);

                        array_push($detail, $push_detail);
                    }
                } else {
                    $saldo_akhir = $saldo_akhir + $item['saldo_awal']->saldo_awal;
                }


                $data_saldo_akhir = [
                    'saldo_akhir'       => nominal3($saldo_akhir)
                ];

                $push_data = [
                    'kode_akun'     => $item['kode_akun'],
                    'nama_akun'     => $item['nama_akun'],
                    'saldo_normal'  => $item['saldo_normal'],
                    'saldo_awal'    => nominal3($item['saldo_awal']->saldo_awal),
                    'detail'        => $detail,
                    'akhir'         => $data_saldo_akhir
                ];

                array_push($resData, $push_data);
            }
        }

        $data = [
            'query' => [
                'periode'   => $periode,
                'kode_akun' => $kode_akun
            ],
            'info'  => [
                'periode' => periode_to_string($periode),
            ],
            'data'  => $resData
        ];

        return $this->response->setJSON([
            'status'        => true,
            'message'       => 'Get Data Successfully',
            'results'       => $data,
            'errors'        => [],
        ], 200);
    }
}
