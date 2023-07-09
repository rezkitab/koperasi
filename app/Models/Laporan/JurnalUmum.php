<?php

namespace App\Models\Laporan;

use CodeIgniter\Model;

class JurnalUmum extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jurnal_umum';
    protected $primaryKey       = 'id';

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function store($data)
    {
        return $this->db->table('jurnal_umum')->insertBatch($data);
    }

    public function get_data($periode)
    {

        $data = $this->db->query("select date_format(a.tanggal,'%d/%m/%Y') as tanggal, a.no_bukti ,a.periode, a.deskripsi from jurnal_umum a where a.periode = ? group by a.no_bukti, date_format(a.tanggal,'%d/%m/%Y'), a.periode order by a.tanggal, a.created_at asc", [$periode])->getResultArray();

        if (count($data) > 0) {
            foreach ($data as $row) {
                $detail = $this->db->query("select concat(a.kode_akun, ' ' ,b.nama) as keterangan, a.no_bukti,if(a.dc='d', a.nominal, 0) as debet,if(a.dc='c', a.nominal, 0) as kredit from jurnal_umum a join coa_items b on a.kode_akun=b.kode where a.no_bukti = ? order by a.created_at asc", [$row['no_bukti']])->getResultArray();
                $results[] = [
                    'tanggal'       => $row['tanggal'],
                    'keterangan'    => $row['deskripsi'],
                    'detail'        => $detail
                ];
            }
        } else {
            $results = [];
        }

        return $results;
    }
}
