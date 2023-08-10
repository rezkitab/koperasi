<?php

namespace App\Controllers\Laporan;

use App\Controllers\BaseController;
use App\Models\Laporan\LabaRugi;
use Config\MyConfig;

class LabaRugiController extends BaseController
{
    private $labaRugi;
    protected $myConfig;

    public function __construct()
    {
        $this->myConfig = new MyConfig;
        $this->labaRugi = new LabaRugi();
    }

    public function index()
    {
        $data = [
            'title' => 'Laba Rugi'
        ];

        return view('laporan/laba_rugi', $data);
    }

    public function getData()
    {
        $periode = $this->request->getVar('periode');

        $periode_req = str_replace('-', '', $periode);

        $data = $this->labaRugi->get_profit_loss_report($periode_req);


        $data = [
            'title'     => 'Laporan Laba Rugi',
            'periode' => periode_to_string($periode_req),
            'values'  => $data
        ];

        return $this->response->setJSON([
            'status'        => true,
            'message'       => 'Get Data Successfully',
            'results'       => $data,
            'errors'        => [],
        ], 200);
    }
}
