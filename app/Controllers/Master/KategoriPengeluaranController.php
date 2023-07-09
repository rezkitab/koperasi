<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use Config\MyConfig;
use App\Models\Master\KategoriPengeluaran;
use CodeIgniter\Validation\Exceptions\ValidationException;

class KategoriPengeluaranController extends BaseController
{
    private $kategoriPengeluaran;

    protected $myConfig;

    public function __construct()
    {
        $this->myConfig = new MyConfig;
        $this->kategoriPengeluaran = new KategoriPengeluaran();
    }

    public function index()
    {
        $data = [
            'title'     => 'Data Kategori Pengeluaran'
        ];
        return view('master/kategori_pengeluaran', $data);
    }

    public function get_data()
    {
        $data = $this->kategoriPengeluaran->get_data();

        return $this->response->setJSON($data);
    }

    public function filterOption()
    {
        $nama = $this->request->getVar('search');

        if ($nama == null || $nama == '') {
            $data = $this->kategoriPengeluaran->findAll();
        } else {
            $data = $this->kategoriPengeluaran->like('nama', $nama)->findAll();
        }

        if (count($data) > 0) {
            foreach ($data as $row) {
                $res[] = [
                    'id'    => $row['kode'],
                    'text'  => $row['kode'] . '-' . $row['nama']
                ];
            }
        } else {
            $res = [];
        }

        return $this->response->setJSON([
            'query'     => [
                'search'        => $nama
            ],
            'results' => $res
        ], 200);
    }

    public function show()
    {
        $kode = $this->request->getVar('kode');

        $data = $this->kategoriPengeluaran->find($kode);

        return $this->response->setJSON($data);
    }

    public function getAkun()
    {
        $data = $this->kategoriPengeluaran->getAkunPengeluaran();

        return $this->response->setJSON($data);
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
                    'nama'       => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus diisi'
                        ]
                    ],
                    'sub_id'       => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus diisi'
                        ]
                    ],

                ]);


                $kode = $this->kategoriPengeluaran->kode();

                $data = [
                    'kode'              => $kode,
                    'nama'              => $this->request->getPost('nama'),
                    'akun_pengeluaran'  => $this->request->getPost('sub_id'),
                ];

                $insert = $this->kategoriPengeluaran->insert($data);

                return $this->response->setJSON([
                    'status'         => true,
                    'message'       => 'Added Data Successfully',
                    'results'       => [
                        'data'  => $data,
                        'notif' => [
                            'title' => 'Berhasil',
                            'message'   => 'Data Kategori Pengeluaran berhasil di tambahkan dengan Kode ' . $data['kode'],
                            'icon'      => 'success'
                        ]
                    ],
                    'errors'        => [],
                ], 201);
            } catch (ValidationException $e) {
                return $this->response->setJSON([
                    'succcess'      => false,
                    'message'       => 'Validation Error',
                    'results'       => [],
                    'errors'        => $this->validator->getErrors(),
                ], 422);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'succcess'      => false,
                'message'       => 'Validation Error',
                'results'       => [],
                'errors'        => $e->getMessage(),
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
                    'nama'       => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus diisi'
                        ]
                    ],
                    'sub_id'       => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus diisi'
                        ]
                    ],

                ]);


                $kode = $this->request->getPost('kode');

                $data = [
                    'kode'              => $kode,
                    'nama'              => $this->request->getPost('nama'),
                    'akun_pengeluaran'  => $this->request->getPost('sub_id'),
                ];

                $insert = $this->kategoriPengeluaran->update($kode, $data);

                return $this->response->setJSON([
                    'status'         => true,
                    'message'       => 'Updated Data Successfully',
                    'results'       => [
                        'data'  => $data,
                        'notif' => [
                            'title' => 'Berhasil',
                            'message'   => 'Data Kategori Pengeluaran Kode ' . $data['kode'] . ' berhasil di update',
                            'icon'      => 'success'
                        ]
                    ],
                    'errors'        => [],
                ], 201);
            } catch (ValidationException $e) {
                return $this->response->setJSON([
                    'succcess'      => false,
                    'message'       => 'Validation Error',
                    'results'       => [],
                    'errors'        => $this->validator->getErrors(),
                ], 422);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'succcess'      => false,
                'message'       => 'Validation Error',
                'results'       => [],
                'errors'        => $e->getMessage(),
            ], 500);
        }
    }
}
