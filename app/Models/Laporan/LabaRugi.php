<?php

namespace App\Models\Laporan;

use CodeIgniter\Model;

class LabaRugi extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jurnal_umum';
    protected $primaryKey       = 'id';
    protected $protectFields    = true;
    protected $allowedFields    = [];

    public function get_data($periode, $modul)
    {
        if ($modul !== 'ALL') {
            $where = " and a.trans_ref = '$modul'";
        } else {
            $where = "";
        }

        $data = $this->db->query("select date_format(a.tanggal,'%d/%m/%Y') as tanggal, a.no_bukti ,a.periode, a.keterangan from jurnal_umum a where a.periode = ? $where group by a.no_bukti, date_format(a.tanggal,'%d/%m/%Y'), a.periode, a.keterangan order by a.tanggal, a.created_at asc", [$periode])->getResultArray();

        if (count($data) > 0) {
            foreach ($data as $row) {
                $detail = $this->db->query("select concat(a.kode_akun, ' ' ,b.nama) as keterangan, a.no_bukti,if(a.dc='d', a.nominal, 0) as debet,if(a.dc='c', a.nominal, 0) as kredit from jurnal_umum a join coa b on a.kode_akun=b.kode where a.no_bukti = ? order by a.created_at asc", [$row['no_bukti']])->getResultArray();
                $results[] = [
                    'tanggal'       => $row['tanggal'],
                    'keterangan'    => $row['keterangan'],
                    'detail'        => $detail
                ];
            }
        } else {
            $results = [];
        }

        return $results;
    }



    public function get_profit_loss_report($periode)
    {
        $pendapatan = $this->db->query("select a.kode as kode_akun,a.nama as nama_akun,a.dc as saldo_normal,c.head_id as header ,ifnull(b.debet,0) as debet,ifnull(b.kredit,0) as kredit from coa_items a 
		left join 
		(
			select a.kode_akun, sum(if(a.dc='d',a.nominal,0)) as debet, sum(if(a.dc='c',a.nominal,0)) as kredit from jurnal_umum a where  a.periode = '$periode' group by a.kode_akun
		) b on a.kode=b.kode_akun
		join coa_subhead c on a.sub_id=c.kode
		where a.posted='l/r' and c.head_id = '4'  order by a.kode asc")->getResultArray();

        $beban_operasional = $this->db->query("select a.kode as kode_akun,a.nama as nama_akun,a.dc as saldo_normal,c.head_id as header ,ifnull(b.debet,0) as debet,ifnull(b.kredit,0) as kredit from coa_items a 
		left join 
		(
			select a.kode_akun, sum(if(a.dc='d',a.nominal,0)) as debet, sum(if(a.dc='c',a.nominal,0)) as kredit from jurnal_umum a  where  a.periode = '$periode' group by a.kode_akun
		) b on a.kode=b.kode_akun
		join coa_subhead c on a.sub_id=c.kode
		where a.posted='l/r' and a.sub_id = '61'  order by a.kode asc;")->getResultArray();

        $beban_non_operasional = $this->db->query("select a.kode as kode_akun,a.nama as nama_akun,a.dc as saldo_normal,c.head_id as header ,ifnull(b.debet,0) as debet,ifnull(b.kredit,0) as kredit from coa_items a 
		left join 
		(
			select a.kode_akun, sum(if(a.dc='d',a.nominal,0)) as debet, sum(if(a.dc='c',a.nominal,0)) as kredit from jurnal_umum a where a.periode = '$periode' group by a.kode_akun
		) b on a.kode=b.kode_akun
		join coa_subhead c on a.sub_id=c.kode
		where a.posted='l/r' and a.sub_id = '62' order by a.kode asc;")->getResultArray();

        $res = [
            'pendapatan'                => $pendapatan,
            'beban_operasional'         => $beban_operasional,
            'beban_non_operasional'     => $beban_non_operasional
        ];

        return $res;
    }
}
