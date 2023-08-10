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

        $data = $this->arusKas->get_cash_flow($periode_req);


        $res = [
            'status'         => true,
            'title'         => 'Laporan Arus Kas',
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
