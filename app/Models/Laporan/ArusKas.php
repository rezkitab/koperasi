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


	// NEW ARUS KAS
	public function getSaldoAwalKas($periode)
	{
		$saldo_awal = $this->db->query("select g.kode_akun, g.nama_akun,g.saldo_normal ,g.saldo_awal_debet, g.saldo_awal_kredit, if(g.saldo_normal='d', g.saldo_awal_debet-g.saldo_awal_kredit,g.saldo_awal_kredit-g.saldo_awal_debet) as saldo_awal from
        (
            select aa.kode as kode_akun, aa.nama as nama_akun, aa.dc as saldo_normal,
                   sum(if(aa.dc = 'd',ifnull(ab.debet,0)-ifnull(ab.kredit,0),0)) as saldo_awal_debet,
                   sum(if(aa.dc = 'c',ifnull(ab.kredit,0)-ifnull(ab.debet,0),0)) as saldo_awal_kredit
            from coa_items aa left join (
                select a.no_bukti as nomor,a.periode,a.deskripsi as keterangan,a.tanggal,a.kode_akun as kode_akun,b.nama as nama_akun,
                       sum(if(a.dc = 'd',a.nominal,0)) as debet,
                       sum(if(a.dc = 'c',a.nominal,0)) as kredit
                from coa_items b
                         join jurnal_umum a on a.kode_akun=b.kode
                where a.periode < ? and a.kode_akun in ('1101', '1102')  group by a.kode_akun
            ) as ab on aa.kode=ab.kode_akun where aa.kode in ('1101', '1102') group by aa.kode order by aa.kode
        ) as g", [$periode])->getResultObject();

		return $saldo_awal;
	}

	public function getSaldoAkhirBank($periode)
	{
		$saldo_awal = $this->db->query("select g.kode_akun, g.nama_akun,g.saldo_normal ,g.saldo_awal_debet, g.saldo_awal_kredit, if(g.saldo_normal='d', g.saldo_awal_debet-g.saldo_awal_kredit,g.saldo_awal_kredit-g.saldo_awal_debet) as saldo_awal from
        (
            select aa.kode as kode_akun, aa.nama as nama_akun, aa.dc as saldo_normal,
                   sum(if(aa.dc = 'd',ifnull(ab.debet,0)-ifnull(ab.kredit,0),0)) as saldo_awal_debet,
                   sum(if(aa.dc = 'c',ifnull(ab.kredit,0)-ifnull(ab.debet,0),0)) as saldo_awal_kredit
            from coa_items aa left join (
                select a.no_bukti as nomor,a.periode,a.deskripsi as keterangan,a.tanggal,a.kode_akun as kode_akun,b.nama as nama_akun,
                       sum(if(a.dc = 'd',a.nominal,0)) as debet,
                       sum(if(a.dc = 'c',a.nominal,0)) as kredit
                from coa_items b
                         join jurnal_umum a on a.kode_akun=b.kode
                where a.periode <= ? and a.kode_akun = '1102'  group by a.kode_akun
            ) as ab on aa.kode=ab.kode_akun where aa.kode = '1102' group by aa.kode order by aa.kode
        ) as g", [$periode])->getResultObject();

		return $saldo_awal;
	}


	public function get_operating_activity($periode)
	{
		$header = $this->db->query("select a.kode, a.nama from coa_aktivitas a")->getResultObject();
		$results = [];
		$kenaikan_penurunan_kas = 0;
		foreach ($header as $h) {
			$subheader = $this->db->query("select a.jurnal_id,a.no_bukti,a.kode_akun as kode_akun,b.dc as saldo_normal,b.nama as nama_akun,
			ifnull(sum(if(k.poisis_jurnal = 'd', a.nominal, 0)),0) as debet_kas,
            ifnull(sum(if(k.poisis_jurnal = 'c', k.kredit_kas, 0)),0) as kredit_kas
            from jurnal_umum a
            join coa_items b on a.kode_akun=b.kode
            left join
            (
                select a.jurnal_id,a.no_bukti,a.kode_akun as kode_akun,a.dc as poisis_jurnal,b.dc as saldo_normal,b.nama as nama_akun,
                if(a.dc = 'd',a.nominal,0) as debet_kas,
                if(a.dc = 'c',a.nominal,0) as kredit_kas
                from jurnal_umum a
                join coa_items b on a.kode_akun=b.kode
                where a.periode = ? and a.kode_akun in ('1101', '1102')
            ) as k on a.no_bukti=k.no_bukti
            where a.periode = ? and b.activity_id is not null and b.activity_id = ?
            group by a.kode_akun ", [$periode, $periode, $h->kode])->getResultObject();
			$subheader_results = [];
			$total_saldo_pos = 0;
			foreach ($subheader as $sh) {
				$saldo_pos = $sh->debet_kas - $sh->kredit_kas;
				$subheader_results_push = [
					'kode_akun'     => $sh->kode_akun,
					'nama_akun'     => $sh->nama_akun,
					'saldo_normal'  => $sh->saldo_normal,
					'saldo_tambah'  => $sh->debet_kas,
					'saldo_kurang'  => $sh->kredit_kas,
					'saldo'         => $saldo_pos > 0 ? number_format($saldo_pos, 2, ',', '.') : '(' . number_format(abs($saldo_pos), 2, ',', '.') . ')'
				];
				$total_saldo_pos = $total_saldo_pos + $saldo_pos;
				array_push($subheader_results, $subheader_results_push);
			}

			$results_push = [
				'kode'      => $h->kode,
				'nama'      => $h->nama,
				'label'     => 'Kas bersih yang diperoleh dari ' . $h->nama,
				'saldo'     => $total_saldo_pos > 0 ? number_format($total_saldo_pos, 2, ',', '.') : '(' . number_format(abs($total_saldo_pos), 2, ',', '.') . ')',
				'subheader' => $subheader_results
			];

			$kenaikan_penurunan_kas = $kenaikan_penurunan_kas + $total_saldo_pos;

			array_push($results, $results_push);
		}

		$saldo_awal_data = $this->getSaldoAwalKas($periode);
		$saldo_akhir_bank_data = $this->getSaldoAkhirBank($periode);

		$saldo_awal = 0; //saldo awal kas
		if (count($saldo_awal_data) > 0) {
			foreach ($saldo_awal_data as $key => $value) {
				$saldo_awal = $saldo_awal + $value->saldo_awal;
			}
		}



		$saldo_akhir_kas = $saldo_awal + $kenaikan_penurunan_kas;

		$summary = [
			'kenaikan_penuruan_kas'     => $kenaikan_penurunan_kas > 0 ? number_format($kenaikan_penurunan_kas, 2, ',', '.') : '(' . number_format(abs($kenaikan_penurunan_kas), 2, ',', '.') . ')',
			'saldo_awal_kas'            => number_format($saldo_awal, 2, ',', '.'),

			'saldo_akhir_kas'           => number_format($saldo_akhir_kas, 2, ',', '.')
		];

		$cashFlowResults = [
			'cf'        => $results,
			'summary'   => $summary
		];

		return $cashFlowResults;
	}
	// END NEW ARUS KAS
}
