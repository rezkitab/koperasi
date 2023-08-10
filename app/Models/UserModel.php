<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['full_name', 'username', 'password', 'role', 'image', 'is_active'];
    protected $useTimestamps = true;

    public function getUser($username = false)
    {
        if ($username == false) {
            return $this->orderBy('role', 'ASC')->findAll();
        }

        return $this->where('username', $username)->first();
    }

    public function getAnggotaPembiayaan()
    {
        $builder = $this->db->table('users');
        $builder->select('users.*');
        $builder->join('simpanan_wajib', 'simpanan_wajib.id_user=users.id_user');
        $builder->groupBy('simpanan_wajib.id_user');
        $query   = $builder->get();
        return $query->getResultArray();
    }
}
