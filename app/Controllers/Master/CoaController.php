<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use Config\MyConfig;
use App\Models\Master\Coa;
use CodeIgniter\Validation\Exceptions\ValidationException;

class CoaController extends BaseController
{
    private $coa;
    protected $myConfig;

    public function __construct()
    {
        $this->myConfig = new MyConfig;
        $this->coa = new Coa();
    }

    public function index()
    {
        $data = [
            'title'     => 'Data Chart Of Account'
        ];
        return view('master/coa', $data);
    }

    public function get_data()
    {
        $data  = $this->coa->get_data();

        return $this->response->setJSON($data);
    }

    public function show()
    {
        $kode = $this->request->getVar('kode');

        $data = $this->coa->find($kode);

        return $this->response->setJSON($data);
    }

    public function get_coa_subhead()
    {
        $data  = $this->coa->get_coa_subhead();

        return $this->response->setJSON($data);
    }

    public function get_coa_activity()
    {
        $data  = $this->coa->get_coa_activity();

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
                    'dc'       => [
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
                    'posted'       => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus diisi'
                        ]
                    ],

                ]);

                $activity_id = $this->request->getPost('activity_id');

                if ($activity_id == null || $activity_id == '') {
                    $activity = null;
                } else {
                    $activity = $activity_id;
                }

                $data = [
                    'kode'          => $this->request->getPost('kode'),
                    'nama'          => $this->request->getPost('nama'),
                    'sub_id'        => $this->request->getPost('sub_id'),
                    'activity_id'   => $activity,
                    'dc'            => $this->request->getPost('dc'),
                    'posted'        => $this->request->getPost('posted')
                ];

                $check = $this->coa->where('kode', $data['kode'])->findAll();

                if (count($check) > 0) {
                    return $this->response->setJSON([
                        'status'      => false,
                        'message'       => 'duplicate data',
                        'results'       => [
                            'notif' => [
                                'title' => 'Oops...',
                                'message'   => 'Data Akun dengan Kode ' . $data['kode'] . ' dan dengan nama akun ' . $data['nama'] . ' telah digunakan!',
                                'icon'      => 'warning'
                            ]
                        ],
                        'errors'        => []
                    ]);
                }

                $insert = $this->coa->insert($data);

                return $this->response->setJSON([
                    'status'         => true,
                    'message'       => 'Added Data Successfully',
                    'results'       => [
                        'data'  => $data,
                        'notif' => [
                            'title' => 'Berhasil',
                            'message'   => 'Data Akun berhasil di tambahkan dengan Kode ' . $data['kode'],
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
                    'dc'       => [
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
                    'posted'       => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => '{field} Harus diisi'
                        ]
                    ],

                ]);

                $activity_id = $this->request->getPost('activity_id');

                if ($activity_id == null || $activity_id == '') {
                    $activity = null;
                } else {
                    $activity = $activity_id;
                }

                $data = [
                    'kode'          => $this->request->getPost('kode'),
                    'nama'          => $this->request->getPost('nama'),
                    'sub_id'        => $this->request->getPost('sub_id'),
                    'activity_id'   => $activity,
                    'dc'            => $this->request->getPost('dc'),
                    'posted'        => $this->request->getPost('posted')
                ];

                $check = $this->coa->where('kode', $data['kode'])->findAll();

                if (count($check) <= 0) {
                    return $this->response->setJSON([
                        'status'      => false,
                        'message'       => 'duplicate data',
                        'results'       => [
                            'notif' => [
                                'title' => 'Oops...',
                                'message'   => 'Data Akun dengan Kode ' . $data['kode'] . ' dan dengan nama akun ' . $data['nama'] . ' tidak ditemukan!',
                                'icon'      => 'warning'
                            ]
                        ],
                        'errors'        => []
                    ]);
                }

                $insert = $this->coa->update($this->request->getPost('kode'), $data);

                return $this->response->setJSON([
                    'status'         => true,
                    'message'       => 'Updated Data Successfully',
                    'results'       => [
                        'data'  => $data,
                        'notif' => [
                            'title' => 'Berhasil',
                            'message'   => 'Data Akun dengan Kode ' . $data['kode'] . ' berhasil di update!',
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
