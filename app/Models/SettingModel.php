<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{

    function getAll()
    {
        return $this->db->table("aplikasi");
    }
    function getAplikasi($id)
    {
        return $this->db->table("aplikasi")->where("id", $id);
    }

    function updateAplikasi($id, $data)
    {
        $this->db->table('aplikasi')->where('id', $id)->set($data)->update();
    }

    function getImage($id)
    {
        return $this->db->table('aplikasi')->select('logo')->where('id', $id);
    }
}
