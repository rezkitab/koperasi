<?php

namespace App\Models\Laporan;

use CodeIgniter\Model;

class ArusKas extends Model
{
	protected $DBGroup          = 'default';
	protected $table            = 'jurnal_umum';
	protected $primaryKey       = 'id';
	protected $protectFields    = true;
	protected $allowedFields    = [];

	// ARUS KAS
	public function get_cash_flow($periode)
	{

		$pendapatan = $this->db->query("select a.kode as kode_akun, a.nama as nama_akun,c.head_id as header,a.sub_id as subheader,a.dc as saldo_normal,ifnull(b.debet,0) as debet, ifnull(b.kredit,0) as kredit   
		from coa_items a 
		left join 
		(
			select a.kode_akun, sum(if(a.dc='d',a.nominal,0)) as debet, sum(if(a.dc='c', a.nominal,0)) as kredit  from jurnal_umum a where  a.periode='$periode' group by a.kode_akun
		) b on a.kode=b.kode_akun
		join coa_subhead c on a.sub_id=c.kode 
		where a.activity_id is not null and a.activity_id = 'AC.01' and c.head_id = '4' order by a.kode asc")->getResultArray();

		$beban = $this->db->query("select a.kode as kode_akun, a.nama as nama_akun,c.head_id as header,a.sub_id as subheader,a.dc as saldo_normal,ifnull(b.debet,0) as debet, ifnull(b.kredit,0) as kredit   
		from coa_items a 
		left join 
		(
			select a.kode_akun, sum(if(a.dc='d',a.nominal,0)) as debet, sum(if(a.dc='c', a.nominal,0)) as kredit  from jurnal_umum a where  a.periode='$periode' group by a.kode_akun
		) b on a.kode=b.kode_akun
		join coa_subhead c on a.sub_id=c.kode 
		where a.activity_id is not null and a.activity_id = 'AC.01' and c.head_id = '6' order by a.kode asc")->getResultArray();

		$investing = $this->db->query("select a.kode as kode_akun, a.nama as nama_akun,c.head_id as header,a.sub_id as subheader,a.dc as saldo_normal,ifnull(b.debet,0) as debet, ifnull(b.kredit,0) as kredit   
		from coa_items a 
		left join 
		(
			select a.kode_akun, sum(if(a.dc='d',a.nominal,0)) as debet, sum(if(a.dc='c', a.nominal,0)) as kredit  from jurnal_umum a where  a.periode='$periode' group by a.kode_akun
		) b on a.kode=b.kode_akun
		join coa_subhead c on a.sub_id=c.kode 
		where a.activity_id is not null and a.activity_id = 'AC.02'  order by a.kode asc")->getResultArray();

		$financing = $this->db->query("select a.kode as kode_akun, a.nama as nama_akun,c.head_id as header,a.sub_id as subheader,a.dc as saldo_normal,ifnull(b.debet,0) as debet, ifnull(b.kredit,0) as kredit   
		from coa_items a 
		left join 
		(
			select a.kode_akun, sum(if(a.dc='d',a.nominal,0)) as debet, sum(if(a.dc='c', a.nominal,0)) as kredit  from jurnal_umum a where  a.periode='$periode' group by a.kode_akun
		) b on a.kode=b.kode_akun
		join coa_subhead c on a.sub_id=c.kode 
		where a.activity_id is not null and a.activity_id = 'AC.03'  order by a.kode asc")->getResultArray();


		$bs = $this->db->query("select
		sum(if(a.dc = 'd',a.nominal,0)) as debet,
		sum(if(a.dc = 'c',a.nominal,0)) as kredit
		from jurnal_umum a 
		join coa_items b on a.kode_akun=b.kode
		where  a.periode < ? and b.kode in ('1101','1102')", [$periode])->getRow();
		$saldo = 0;
		$kredit = 0;
		$debet = 0;

		if ($bs !== null) {
			$saldo_awal = $bs->debet - $bs->kredit;
		} else {
			$saldo_awal = 0;
		}

		$res = [
			'pendapatan'            => $pendapatan,
			'beban'                 => $beban,
			'investing'             => $investing,
			'financing'             => $financing,
			'saldo_awal'            => $saldo_awal
		];
		return $res;
	}
	// END ARUS KAS
}
