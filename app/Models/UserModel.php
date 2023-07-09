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
        $builder->select('users.*,simpanan_pokok.status');
        $builder->join('simpanan_pokok', 'simpanan_pokok.id_user=users.id_user');
        $builder->where('simpanan_pokok.status', '1');
        $query   = $builder->get();
        return $query->getResultArray();
    }
}
