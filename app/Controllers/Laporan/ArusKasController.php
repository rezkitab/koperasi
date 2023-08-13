<?php

namespace App\Controllers\Laporan;

use App\Controllers\BaseController;
use App\Models\Laporan\ArusKas;
use Config\MyConfig;

class ArusKasController extends BaseController
{
    private $arusKas;
    protected $myConfig;

    public function __construct()
    {
        $this->myConfig = new MyConfig;
        $this->arusKas = new ArusKas();
    }

    public function index()
    {
        $data = [
            'title' => 'Arus Kas'
        ];

        return view('laporan/arus_kas', $data);
    }

    public function getData()
    {
        $periode = $this->request->getVar('periode');
        $periode_req = str_replace('-', '', $periode);

        $resultData = $this->arusKas->get_operating_activity($periode_req);
        // $resultData = $this->arusKas->getSaldoAwalKas($periode_req);
        $data = [
            'query' => [
                'periode'   => $periode_req,
            ],
            'info'  => [
                'periode' => periode_to_string($periode_req),
            ],
            'data'  => $resultData
        ];

        return $this->response->setJSON([
            'status'        => true,
            'message'       => 'Get Data Successfully',
            'results'       => $data,
            'errors'        => [],
        ], 200);
    }
}
