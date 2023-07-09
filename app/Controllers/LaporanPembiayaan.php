<?php

namespace App\Controllers;

use Config\MyConfig;
use App\Controllers\BaseController;
use \App\Models\PembiayaanModel;
use Dompdf\Dompdf;

class LaporanPembiayaan extends BaseController
{
    protected $pembiayaanModel;

    public function __construct()
    {
        $this->myConfig         = new MyConfig;
        $this->pembiayaanModel  = new PembiayaanModel();
        $this->session          = \Config\Services::session();
    }

    public function index()
    {
        $data = [
            'title'             => 'Laporan Pembiayaan',
            'lap_pembiayaan'    => [],
            'month'             => '',
            'year'              => ''
        ];

        return view('laporan/view_data_laporan_pembiayaan', $data);
    }

    public function show_data_laporan_pembiayaan()
    {
        $month                  = $this->request->getPost('month');
        $year                   = $this->request->getPost('year');
        $bulan                  = format_bulan($month);

        $data = [
            'title'             => 'Laporan Pembiayaan',
            'lap_pembiayaan'    => $this->pembiayaanModel->getLapPembiayaan($month, $year),
            'month'             => $bulan,
            'year'              => $year
        ];

        $data_session       = array(
            'month'         => $this->request->getPost('month'),
            'year'          => $this->request->getPost('year'),
        );

        $this->session->set($data_session);
        // dd($data);
        return view('laporan/view_data_laporan_pembiayaan', $data);
    }

    public function laporan_pembiayaan_pdf()
    {
        $month                  = $this->session->get("month");
        $year                   = $this->session->get("year");
        $bulan                  = format_bulan($month);

        $data = [
            'title'             => 'Laporan Pembiayaan',
            'lap_pembiayaan'    => $this->pembiayaanModel->getLapPembiayaan($month, $year),
            'month'             => $bulan,
            'year'              => $year
        ];

        $filename = 'Laporan-Pembiayaan';
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('laporan/pdf_laporan_pembiayaan', $data));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream($filename, array("Attachment" => false));
    }
}
