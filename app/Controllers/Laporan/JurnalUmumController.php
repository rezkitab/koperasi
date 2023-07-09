<?php

namespace App\Controllers\Laporan;

use App\Controllers\BaseController;
use Config\MyConfig;
use App\Models\Laporan\JurnalUmum;

class JurnalUmumController extends BaseController
{
    private $jurnalUmum;

    protected $myConfig;

    public function __construct()
    {
        $this->myConfig = new MyConfig;
        $this->jurnalUmum = new JurnalUmum();
    }

    public function index()
    {
        $data = [
            'title'   => 'Jurnal Umum'
        ];

        return view('laporan/jurnal_umum', $data);
    }

    public function getData()
    {
        $periode = $this->request->getVar('periode');

        $periode_req = str_replace('-', '', $periode);

        $info = [
            'periode'       => periode_to_string($periode_req)
        ];

        $data = $this->jurnalUmum->get_data($periode_req);

        $res = [
            'info'  => $info,
            'data'  => $data
        ];

        return $this->response->setJSON($res);
    }
}
