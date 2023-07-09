<?php

namespace App\Models;

use CodeIgniter\Model;

class PengurusModel extends Model
{
    protected $table      = 'pengurus';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'nama_pengurus', 'fakultas', 'jabatan', 'no_hp', 'email', 'alamat', 'image'];

    public function rules()
    {
        return
            [
                'nama_pengurus' =>
                [
                    'label'  => 'Nama Pengurus',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => ' {field} mohon diisi',
                    ],
                ],
                'fakultas' =>
                [
                    'label'  => 'Fakultas',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => ' {field} mohon diisi',
                    ],
                ],
                'jabatan' =>
                [
                    'label'  => 'Jabatan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => ' {field} mohon diisi',
                    ],
                ],
                'no_hp' =>
                [
                    'label'  => 'No Hp',
                    'rules'  => 'required|min_length[10]|max_length[13]',
                    'errors' => [
                        'required' => ' {field} mohon diisi',
                        'min_length' => ' {field} minimal 10 karakter angka',
                        'max_length' => ' {field}  maksimal 13 karakter angka',
                    ],
                ],
                'email' =>
                [
                    'label'  => 'Email',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => ' {field} mohon diisi',
                    ],
                ],
                'alamat' =>
                [
                    'label'  => 'Alamat',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => ' {field} mohon diisi',
                    ],
                ],

            ];
    }

    public function getpengurus()
    {
        return $this->findAll();
    }

    public function getById($id)
    {
        return $this->where(['id' => $id])->first();
    }

    public function createPengurus($data)
    {
        $query = $this->db->table('pengurus')->insert($data);
        return $query;
    }

    public function updatePengurus($data, $id)
    {
        $query = $this->db->table('pengurus')->update($data, array('id' => $id));
        return $query;
    }

    public function deletePengurus($id)
    {
        $query = $this->db->table('pengurus')->delete(array('id' => $id));
        return $query;
    }
}
