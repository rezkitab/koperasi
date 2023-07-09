<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class Coa extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'coa_items';
    protected $primaryKey       = 'kode';
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['kode', 'nama','dc','posted','sub_id','activity_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function get_data()
    {
        $data = $this->db->query('select a.kode, a.nama, concat(a.sub_id, "-", b.nama) as header, concat(a.activity_id, "-", c.nama) as activity, a.posted, a.dc from coa_items a join coa_subhead b on a.sub_id=b.kode left join coa_aktivitas c on a.activity_id=c.kode order by a.kode asc')->getResultArray();

        return $data;
    }
    public function get_coa_subhead()
    {
        $data = $this->db->query('select kode, nama from coa_subhead')->getResultArray();

        return $data;
    }

    public function get_coa_activity()
    {
        $data = $this->db->query('select kode, nama from coa_aktivitas')->getResultArray();

        return $data;
    }

}
