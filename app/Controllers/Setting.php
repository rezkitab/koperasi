<?php

namespace App\Controllers;

use App\Models\SettingModel;
use Config\MyConfig;

class Setting extends BaseController
{
    protected $session;
    protected $db, $aplikasi, $myConfig, $upload;
    // protected $helpers = ['MyHelpers'];


    function __construct()
    {

        $this->session = \Config\Services::session();
        $this->session->start();
        $this->myConfig = new MyConfig;
        $this->db = \Config\Database::connect();
        $this->aplikasi = $this->db->table('aplikasi');
        $this->setting = new SettingModel();
        date_default_timezone_set("Asia/jakarta");
    }
    public function aplikasi()
    {
        $data['aplikasi'] = $this->db->query('SELECT * FROM aplikasi')->getRowArray();
        // var_dump($data['aplikasi']);
        // die;
        $d = ['title' => 'Aplikasi', 'aplikasi' => $data];
        return view('setting/aplikasi', $d);
    }
    public function edit_aplikasi($id)
    {
        $data = $this->db->query('SELECT * FROM aplikasi where id = ' . $id . '')->getRowArray();
        // var_dump($data['aplikasi']);
        // die;
        $d = ['title' => 'Aplikasi', 'data' => $data];
        return view('setting/edit_aplikasi', $d);
    }

    public function update()
    {
        helper(['form', 'url']);
        var_dump($this->request->getFile('file'));
        die;
        if ($this->request->getFile('file') == true) {
            $this->_validate();
            $id = $this->request->getPost('id');
            $validateImage = $this->validate([
                'file' => [
                    'uploaded[file]',
                    'mime_in[file, image/png, image/jpg,image/jpeg, image/gif]',
                    'max_size[file, 4096]',
                ],
            ]);

            $response = [
                'success' => false,
                'data' => '',
                'msg' => "Image could not upload"
            ];
            if ($validateImage) {
                $imageFile = $this->request->getFile('file');
                $imageFile->move(WRITEPATH . 'foto/logo');
                $data = [
                    // 'img_name' => $imageFile->getClientName(),
                    'logo'  => $imageFile->getClientMimeType()
                ];

                $save = $this->aplikasi->insert($data);
                $response = [
                    'success' => true,
                    'data' => $save,
                    'msg' => "Image successfully uploaded"
                ];
            }

            if ($response) {
                // $gambar = $this->upload->data();
                $save  = array(
                    'nama_owner' => $this->request->getPost('nama_owner'),
                    'title' => $this->request->getPost('title'),
                    'nama_aplikasi'  => $this->request->getPost('nama_aplikasi'),
                    'copy_right'  => $this->request->getPost('copy_right'),
                    'tahun' => $this->request->getPost('tahun'),
                    'versi' => $this->request->getPost('versi'),
                    // 'logo' => $gambar['file_name']
                );
                // dead($save);
                $g = $this->setting->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/logo/' . $g['logo']);
                }

                $this->setting->updateAplikasi($id, $save);
                echo json_encode(array("status" => TRUE));
                redirect('setting/aplikasi');
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'nama_owner' => $this->request->getPost('nama_owner'),
                    'title' => $this->request->getPost('title'),
                    'nama_aplikasi'  => $this->request->getPost('nama_aplikasi'),
                    'copy_right'  => $this->request->getPost('copy_right'),
                    'tahun' => $this->request->getPost('tahun'),
                    'versi' => $this->request->getPost('versi')
                );
                $this->setting->updateAplikasi($id, $save);
                echo json_encode(array("status" => TRUE));
                redirect('setting/aplikasi');
            }
        } else {
            $this->_validate();
            $id = $this->request->getPost('id');
            $save  = array(
                'nama_owner' => $this->request->getPost('nama_owner'),
                'alamat'    => $this->request->getPost('alamat'),
                'tlp'       => $this->request->getPost('tlp'),
                'title' => $this->request->getPost('title'),
                'nama_aplikasi'  => $this->request->getPost('nama_aplikasi'),
                'copy_right'  => $this->request->getPost('copy_right'),
                'tahun' => $this->request->getPost('tahun'),
                'versi' => $this->request->getPost('versi')
            );

            $success =
                $success = $this->aplikasi->where('id', $id)->set($save)->update();
            // echo json_encode(array("status" => TRUE));
            // var_dump($id);
            // die;
            if ($success) {
                session()->setFlashdata('msg', 'diubah');
                return redirect()->to(base_url('/setting/aplikasi'));
            }
            // redirect('setting/aplikasi');
        }
    }
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->request->getPost('nama_owner') == '') {
            $data['inputerror'][] = 'nama_owner';
            $data['error_string'][] = 'Nama PT Tidak Boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->request->getPost('nama_aplikasi') == '') {
            $data['inputerror'][] = 'nama_aplikasi';
            $data['error_string'][] = 'Nama Aplikasi Tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->request->getPost('alamat') == '') {
            $data['inputerror'][] = 'alamat';
            $data['error_string'][] = 'Alamat Tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->request->getPost('tlp') == '') {
            $data['inputerror'][] = 'tlp';
            $data['error_string'][] = 'No Telpon Tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->request->getPost('title') == '') {
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Title Tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->request->getPost('copy_right') == '') {
            $data['inputerror'][] = 'copy_right';
            $data['error_string'][] = 'Copy Right tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if ($this->request->getPost('tahun') == '') {
            $data['inputerror'][] = 'tahun';
            $data['error_string'][] = 'Tahun tidak boleh kosong';
            $data['status'] = FALSE;
        }


        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
