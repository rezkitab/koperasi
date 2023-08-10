<?php

namespace App\Controllers\Laporan;

use App\Controllers\BaseController;
use App\Models\Laporan\ArusKas;
use App\Models\Laporan\NeracaSaldo;
use Config\MyConfig;

class NeracaSaldoController extends BaseController
{
    private $neracaSaldo;
    protected $myConfig;

    public function __construct()
    {
        $this->myConfig = new MyConfig;
        $this->neracaSaldo = new NeracaSaldo();
    }

    public function index()
    {
        $data = [
            'title' => 'Arus Kas'
        ];

        return view('laporan/neraca_saldo', $data);
    }

    public function getData()
    {
        $periode = $this->request->getVar('periode');

        $periode_req = str_replace('-', '', $periode);

        $data = $this->neracaSaldo->get_trial_balance_report($periode_req);


        $res = [
            'status'         => true,
            'title'         => 'Laporan Neraca Saldo',
            'periode'       => periode_to_string($periode_req),
            'values'         => $data
        ];

        return $this->response->setJSON([
            'status'        => true,
            'message'       => 'Get Data Successfully',
            'results'       => $res,
            'errors'        => [],
        ], 200);
    }
}
