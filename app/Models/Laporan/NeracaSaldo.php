<?php

namespace App\Models\Laporan;

use CodeIgniter\Model;

class NeracaSaldo extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jurnal_umum';
    protected $primaryKey       = 'id';
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // LAPORAN NERACA SALDO
    public function get_trial_balance_report($periode)
    {
        $data = $this->db->query("select A.kode_akun, A.nama_akun, A.saldo_normal, if(A.saldo_normal = 'D', A.debet - A.kredit,0) as saldo_debet, if(A.saldo_normal = 'C', A.kredit - A.debet,0) as saldo_kredit from (
			select a.kode as kode_akun, a.nama as nama_akun,a.dc as saldo_normal ,ifnull(b.debet,0) as debet, ifnull(b.kredit,0) as kredit from coa_items a left join 
			(
			select a.kode_akun as kode_akun,b.nama as nama_akun,
			sum(if(a.dc = 'D',a.nominal,0)) as debet,
			sum(if(a.dc = 'C',a.nominal,0)) as kredit, b.dc as saldo_normal,a.dc 
			from jurnal_umum a 
			join coa_items b on a.kode_akun=b.kode
			where  a.periode <= ? group by a.kode_akun order by a.kode_akun asc
			) b on a.kode = b.kode_akun
		) A order by A.kode_akun asc", [$periode])->getResultArray();

        return $data;
    }
    // END LAPORAN NERACA SALDO
}
