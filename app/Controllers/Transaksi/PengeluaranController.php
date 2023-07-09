<?php

namespace App\Controllers\Transaksi;

use App\Controllers\BaseController;
use Config\MyConfig;
use App\Models\Master\KategoriPengeluaran;
use App\Models\Transaksi\Pengeluaran;
use CodeIgniter\Validation\Exceptions\ValidationException;

class PengeluaranController extends BaseController
{

    private $pengeluaran;
    private $kategoriPengeluaran;
    protected $myConfig;

    public function __construct()
    {
        $this->myConfig = new MyConfig;
        $this->pengeluaran = new Pengeluaran();
        $this->kategoriPengeluaran = new KategoriPengeluaran();
    }

    public function index()
    {
        $data = [
            'title' => 'Pengeluaran Kas'
        ];

        return view('transaksi/pengeluaran', $data);
    }

    public function getData()
    {
        $data = $this->pengeluaran->getData();

        return $this->response->setJSON([
            'status'        => true,
            'message'       => 'Get Data Successfully',
            'results'       => $data,
            'errors'        => [],
        ], 200);
    }

    public function show()
    {
        $kode = $this->request->getVar('kode');
        $data = $this->pengeluaran->findData($kode);

        return $this->response->setJSON([
            'status'        => true,
            'message'       => 'Get Data Successfully',
            'results'       => $data,
            'errors'        => [],
        ], 200);
    }



    public function store()
    {
        try {
            try {
                $this->validate([
                    'kode'       => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus diisi'
                        ]
                    ],
                    'tanggal'       => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus diisi'
                        ]
                    ],
                    'keterangan'       => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus diisi'
                        ]
                    ],
                    'kode_kategori'   => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus diisi'
                        ]
                    ],
                    'nominal'       => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus diisi'
                        ]
                    ],
                ]);

                $tanggal = $this->request->getPost('tanggal');
                $periode = set_periode($tanggal);
                $kode = $this->pengeluaran->kode($periode);
                $keterangan = $this->request->getPost('keterangan');
                $nominal = set_number($this->request->getPost('nominal'));
                $kode_kategori = $this->request->getPost('kode_kategori');

                $data = [
                    'kode'          => $kode,
                    'kode_kategori'    => $kode_kategori,
                    'tanggal'       => $tanggal,
                    'periode'       => $periode,
                    'deskripsi'    => $keterangan,
                    'nominal'       => $nominal
                ];

                $check_jenis = $this->kategoriPengeluaran->find($kode_kategori);

                //                print_r($check_jenis); die;

                if ($check_jenis !== null) {
                    $kode_akun_debet = $check_jenis['akun_pengeluaran'];
                } else {
                    return $this->response->setJSON([
                        'status'         => true,
                        'message'       => 'Invalid Jenis Pengeluaran',
                        'results'       => [
                            'notif' => [
                                'title' => 'Error',
                                'message'   => 'Invalid Jenis Pengeluaran',
                                'icon'      => 'error'
                            ]
                        ],
                        'errors'        => [],
                    ], 201);
                }

                $check_saldo = $this->pengeluaran->check_saldo($periode, '1101');

                if ($check_saldo->total_saldo >= $nominal) {
                    $gl = [
                        [
                            'tanggal'       => $tanggal,
                            'periode'       => $periode,
                            'kode_akun'     => $kode_akun_debet,
                            'deskripsi'     => $keterangan,
                            'no_bukti'      => $kode,
                            'dc'            => 'd',
                            'nominal'       => $nominal,
                            'trans_ref'     => 'PENGELUARAN'
                        ],
                        [
                            'tanggal'       => $tanggal,
                            'periode'       => $periode,
                            'kode_akun'     => '1101',
                            'deskripsi'     => $keterangan,
                            'no_bukti'      => $kode,
                            'dc'            => 'c',
                            'nominal'       => $nominal,
                            'trans_ref'     => 'PENGELUARAN'
                        ]
                    ];

                    $dataToInsert = [
                        'pengeluaran'       => $data,
                        'jurnal'            => $gl
                    ];

                    $insert  = $this->pengeluaran->insertData($dataToInsert);

                    return $this->response->setJSON([
                        'status'         => true,
                        'message'       => 'Added Data Successfully',
                        'results'       => [
                            'notif' => [
                                'title' => 'Berhasil',
                                'message'   => 'Data Pengeluaran Berhasil di Simpan dengan No Bukti ' . $data['kode'],
                                'icon'      => 'success'
                            ],
                            'data'  => [
                                '_pengeluaran'  => $data,
                                'gl'            => $gl
                            ]
                        ],
                        'errors'        => [],
                    ], 201);
                }

                return $this->response->setJSON([
                    'status'         => false,
                    'message'       => 'Added Data UnSuccessfully',
                    'results'       => [
                        'notif' => [
                            'title' => 'Saldo Kas Tidak Cukup',
                            'message'   => 'Sisa Saldo Kas Saat ini Adalah ' . nominal1($check_saldo->total_saldo),
                            'icon'      => 'error'
                        ],
                    ],
                    'errors'        => [],
                ], 200);
            } catch (ValidationException $e) {
                return $this->response->setJSON([
                    'succcess'      => false,
                    'message'       => 'Internal Server Error',
                    'results'       => [],
                    'errors'        => $this->validator->getErrors(),
                ], 500);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status'    => false,
                'meesage'   => 'Internal Server Error',
                'resutls'   => [],
                'errors'    => $e->getMessage() . ' line ' . $e->getLine()
            ], 500);
        }
    }

    public function update()
    {
        try {
            try {
                $this->validate([
                    'kode'       => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus diisi'
                        ]
                    ],
                    'tanggal'       => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus diisi'
                        ]
                    ],
                    'keterangan'       => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus diisi'
                        ]
                    ],
                    'kode_kategori'   => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus diisi'
                        ]
                    ],
                    'nominal'       => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus diisi'
                        ]
                    ],
                ]);

                $tanggal = $this->request->getPost('tanggal');
                $periode = set_periode($tanggal);
                $kode = $this->request->getPost('kode');
                $keterangan = $this->request->getPost('keterangan');
                $nominal = set_number($this->request->getPost('nominal'));
                $kode_kategori = $this->request->getPost('kode_kategori');

                $data = [
                    'kode'          => $kode,
                    'kode_kategori'    => $kode_kategori,
                    'tanggal'       => $tanggal,
                    'periode'       => $periode,
                    'deskripsi'    => $keterangan,
                    'nominal'       => $nominal
                ];

                $check_jenis = $this->kategoriPengeluaran->find($kode_kategori);

                //                print_r($check_jenis); die;

                if ($check_jenis !== null) {
                    $kode_akun_debet = $check_jenis['akun_pengeluaran'];
                } else {
                    return $this->response->setJSON([
                        'status'         => true,
                        'message'       => 'Invalid Jenis Pengeluaran',
                        'results'       => [
                            'notif' => [
                                'title' => 'Error',
                                'message'   => 'Invalid Jenis Pengeluaran',
                                'icon'      => 'error'
                            ]
                        ],
                        'errors'        => [],
                    ], 201);
                }

                $check_saldo = $this->pengeluaran->check_saldo($periode, '1101');
                $transaksi_pengeluaran = $this->pengeluaran->find($kode);

                $gl = [
                    [
                        'tanggal'       => $tanggal,
                        'periode'       => $periode,
                        'kode_akun'     => $kode_akun_debet,
                        'deskripsi'     => $keterangan,
                        'no_bukti'      => $kode,
                        'dc'            => 'd',
                        'nominal'       => $nominal,
                        'trans_ref'     => 'PENGELUARAN'
                    ],
                    [
                        'tanggal'       => $tanggal,
                        'periode'       => $periode,
                        'kode_akun'     => '1101',
                        'deskripsi'     => $keterangan,
                        'no_bukti'      => $kode,
                        'dc'            => 'c',
                        'nominal'       => $nominal,
                        'trans_ref'     => 'PENGELUARAN'
                    ]
                ];
                if ($transaksi_pengeluaran['nominal'] != $nominal) {

                    $saldo_kas = $check_saldo->total_saldo + $transaksi_pengeluaran['nominal'];

                    if ($saldo_kas >= $nominal) {


                        $dataToInsert = [
                            'pengeluaran'       => $data,
                            'jurnal'            => $gl
                        ];

                        $insert  = $this->pengeluaran->updateData($dataToInsert, $kode);

                        return $this->response->setJSON([
                            'status'         => true,
                            'message'       => 'Added Data Successfully',
                            'results'       => [
                                'notif' => [
                                    'title' => 'Berhasil',
                                    'message'   => 'Data Pengeluaran Berhasil No Bukti ' . $data['kode'] . ' berhasil di update',
                                    'icon'      => 'success'
                                ],
                                'data'  => [
                                    '_pengeluaran'  => $data,
                                    'gl'            => $gl
                                ]
                            ],
                            'errors'        => [],
                        ], 201);
                    }

                    return $this->response->setJSON([
                        'status'         => false,
                        'message'       => 'Added Data UnSuccessfully',
                        'results'       => [
                            'notif' => [
                                'title' => 'Saldo Kas Tidak Cukup',
                                'message'   => 'Sisa Saldo Kas Saat ini Adalah ' . nominal1($saldo_kas),
                                'icon'      => 'error'
                            ],
                        ],
                        'errors'        => [],
                    ], 200);
                }

                $gl = [
                    [
                        'tanggal'       => $tanggal,
                        'periode'       => $periode,
                        'kode_akun'     => $kode_akun_debet,
                        'deskripsi'     => $keterangan,
                        'no_bukti'      => $kode,
                        'dc'            => 'd',
                        'nominal'       => $nominal,
                        'trans_ref'     => 'PENGELUARAN'
                    ],
                    [
                        'tanggal'       => $tanggal,
                        'periode'       => $periode,
                        'kode_akun'     => '1101',
                        'deskripsi'     => $keterangan,
                        'no_bukti'      => $kode,
                        'dc'            => 'c',
                        'nominal'       => $nominal,
                        'trans_ref'     => 'PENGELUARAN'
                    ]
                ];

                $dataToInsert = [
                    'pengeluaran'       => $data,
                    'jurnal'            => $gl
                ];

                $insert  = $this->pengeluaran->updateData($dataToInsert, $kode);

                return $this->response->setJSON([
                    'status'         => true,
                    'message'       => 'Added Data Successfully',
                    'results'       => [
                        'notif' => [
                            'title' => 'Berhasil',
                            'message'   => 'Data Pengeluaran Berhasil No Bukti ' . $data['kode'] . ' berhasil di update',
                            'icon'      => 'success'
                        ],
                        'data'  => [
                            '_pengeluaran'  => $data,
                            'gl'            => $gl
                        ]
                    ],
                    'errors'        => [],
                ], 201);
            } catch (ValidationException $e) {
                return $this->response->setJSON([
                    'succcess'      => false,
                    'message'       => 'Internal Server Error',
                    'results'       => [],
                    'errors'        => $this->validator->getErrors(),
                ], 500);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status'    => false,
                'meesage'   => 'Internal Server Error',
                'resutls'   => [],
                'errors'    => $e->getMessage() . ' line ' . $e->getLine()
            ], 500);
        }
    }
}
