<?php

namespace App\Models\Master;

use CodeIgniter\Model;

class KategoriPengeluaran extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kategori_pengeluaran';
    protected $primaryKey       = 'kode';
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['kode', 'nama', 'akun_pengeluaran'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function kode()
    {
        $sql =  $this->db->table('kategori_pengeluaran')
            ->select('RIGHT(kode,4) as kode', false)
            ->orderBy('kode', 'DESC')
            ->limit(1)
            ->get();

        if ($sql->getNumRows() <> 0) {
            $data = $sql->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $prefix = "KK-";
        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kode_final = $prefix . '' . $batas;

        return $kode_final;
    }

    public function get_data()
    {
        $data = $this->db->query('select a.kode, a.nama, a.akun_pengeluaran, concat(a.akun_pengeluaran, "-", b.nama) as akun from kategori_pengeluaran a join coa_items b on a.akun_pengeluaran=b.kode order by a.kode asc')->getResultArray();

        return $data;
    }

    public function getAkunPengeluaran()
    {
        $data = $this->db->query('select kode, nama from coa_items')->getResultArray();

        return $data;
    }
}
