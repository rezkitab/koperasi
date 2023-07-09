<?php

namespace App\Controllers;

use Config\MyConfig;
use \App\Models\PengurusModel;

class Pengurus extends BaseController
{
    protected $validation;
    protected $pengurusModel;

    public function __construct()
    {
        $this->myConfig         = new MyConfig;
        $this->validation       =  \Config\Services::validation();
        $this->pengurusModel    = new PengurusModel();
    }

    public function index()
    {
        $data = [
            'title'             => 'Data Pengurus',
            'pengurus'          => $this->pengurusModel->findAll(),
        ];

        return view('pengurus/view_data_pengurus', $data);
    }

    public function add()
    {
        $data = [
            'title'             => 'Tambah Data Pengurus',
            'validation'        => $this->validation->setRules($this->pengurusModel->rules())
        ];
        return view('pengurus/add_data_pengurus', $data);
    }

    public function create()
    {
        $data = [
            'title'             => 'Tambah Data Pengurus',
        ];

        $this->validation->setRules($this->pengurusModel->rules());
        $isDataValid = $this->validation->withRequest($this->request)->run();
        $file = $this->request->getFile('pengurus_image');

        if ($isDataValid) {
            if ($file->getError() == 4) {
                $data = array(
                    'nama_pengurus'     => $this->request->getPost('nama_pengurus'),
                    'fakultas'          => $this->request->getPost('fakultas'),
                    'jabatan'           => $this->request->getPost('jabatan'),
                    'no_hp'             => $this->request->getPost('no_hp'),
                    'email'             => $this->request->getPost('email'),
                    'alamat'            => $this->request->getPost('alamat'),
                );
            } else {
                $filePengurus = $this->request->getFile('pengurus_image');
                $ProductName = $filePengurus->getName();
                $filePengurus->move('upload/pengurus', $ProductName);

                $data = array(
                    'nama_pengurus'     => $this->request->getPost('nama_pengurus'),
                    'fakultas'          => $this->request->getPost('fakultas'),
                    'jabatan'           => $this->request->getPost('jabatan'),
                    'no_hp'             => $this->request->getPost('no_hp'),
                    'email'             => $this->request->getPost('email'),
                    'alamat'            => $this->request->getPost('alamat'),
                    'image'             => $ProductName,
                );
            }

            $this->pengurusModel->createPengurus($data);

            session()->setFlashdata('success', 'Data Pengurus Berhasil Ditambahkan');
            return redirect()->to('pengurus');
        } else {
            $data['validation'] = $this->validation->listErrors();
            // dd(
            //     $data
            // );
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $data = [
            'title'                     => 'Edit Data Pengurus',
            'pengurus'                  => $this->pengurusModel->where('id', $id)->first(),
            'validation'                => $this->validation->setRules($this->pengurusModel->rules())
        ];
        return view('pengurus/edit_data_pengurus', $data);
    }

    public function update($id)
    {
        $data = [
            'title'                     => 'Edit Data Pengurus',
            'pengurus'                  => $this->pengurusModel->where('id', $id)->first(),
        ];
        $this->validation->setRules($this->pengurusModel->rules());
        $isDataValid = $this->validation->withRequest($this->request)->run();
        $file = $this->request->getFile('pengurus_image');
        if ($isDataValid) {
            if ($file->getError() == 4) {
                $data = array(
                    'nama_pengurus'     => $this->request->getPost('nama_pengurus'),
                    'fakultas'          => $this->request->getPost('fakultas'),
                    'jabatan'           => $this->request->getPost('jabatan'),
                    'no_hp'             => $this->request->getPost('no_hp'),
                    'email'             => $this->request->getPost('email'),
                    'alamat'            => $this->request->getPost('alamat'),
                );
            } else {
                $filePengurus = $this->request->getFile('pengurus_image');
                $PengurusName = $filePengurus->getRandomName();
                $filePengurus->move('upload/pengurus', $PengurusName);

                $data = array(
                    'nama_pengurus'     => $this->request->getPost('nama_pengurus'),
                    'fakultas'          => $this->request->getPost('fakultas'),
                    'jabatan'           => $this->request->getPost('jabatan'),
                    'no_hp'             => $this->request->getPost('no_hp'),
                    'email'             => $this->request->getPost('email'),
                    'alamat'            => $this->request->getPost('alamat'),
                    'image'             => $PengurusName,
                );
            }

            $this->pengurusModel->updatePengurus($data, $id);
            session()->setFlashdata('success', 'Data Pengurus Berhasil Diubah');

            return redirect()->to('pengurus');
        } else {
            $data['validation'] = $this->validation;
            return redirect()->back()->withInput();
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $this->pengurusModel->deletePengurus($id);
        session()->setFlashdata('success', 'Data Pengurus Berhasil Dihapus');

        return redirect()->to('pengurus');
    }
}
