<?php

namespace App\Models\Laporan;

use CodeIgniter\Model;

class BukuBesar extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jurnal_umum';
    protected $primaryKey       = 'id';

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getData($periode, $kode_akun)
    {
        $where = "where a.sub_id != '' ";
        if ($kode_akun == 'all' || $kode_akun == null) {
            $where .= "";
        } else {
            $where .= " and a.kode = '$kode_akun'";
        }
        $akun =  $this->db->query("select a.kode as kode_akun, a.nama as nama_akun, a.dc as saldo_normal from coa_items a $where")->getResultArray();

        if (count($akun) > 0) {
            foreach ($akun as $item) {
                $detail = $this->db->query("select aa.tanggal,aa.transaksi, aa.nomor, aa.deskripsi,aa.kode_akun,aa.nama_akun,aa.saldo_normal,aa.debet,aa.kredit, if(aa.saldo_normal='d',aa.debet-aa.kredit ,0) as saldo_debet,
                if(aa.saldo_normal='c',aa.kredit-aa.debet ,0) as saldo_kredit from
                (
                    select date_format(a.tanggal,'%d/%m/%Y') as tanggal, a.trans_ref as transaksi, a.no_bukti as nomor,a.deskripsi,b.dc as saldo_normal,a.kode_akun as kode_akun,b.nama as nama_akun,
                           if(a.dc = 'd',a.nominal,0) as debet,
                           if(a.dc = 'c',a.nominal,0) as kredit
                    from jurnal_umum a
                    join coa_items b on a.kode_akun=b.kode
                    where a.periode = ? and a.kode_akun = ?  order by a.tanggal, a.created_at asc
                ) as aa", [$periode, $item['kode_akun']])->getResultArray();

                $saldo_awal = $this->db->query("select g.kode_akun, g.nama_akun,g.saldo_normal ,g.saldo_awal_debet, g.saldo_awal_kredit, if(g.saldo_normal='d', g.saldo_awal_debet-g.saldo_awal_kredit,g.saldo_awal_kredit-g.saldo_awal_debet) as saldo_awal from
                (
                    select aa.kode as kode_akun, aa.nama as nama_akun, aa.dc as saldo_normal,
                           sum(if(aa.dc = 'd',ifnull(ab.debet,0)-ifnull(ab.kredit,0),0)) as saldo_awal_debet,
                           sum(if(aa.dc = 'c',ifnull(ab.kredit,0)-ifnull(ab.debet,0),0)) as saldo_awal_kredit
                    from coa_items aa left join (
                        select a.no_bukti as nomor,a.periode,a.deskripsi,a.tanggal,a.kode_akun as kode_akun,b.nama as nama_akun,
                               sum(if(a.dc = 'd',a.nominal,0)) as debet,
                               sum(if(a.dc = 'c',a.nominal,0)) as kredit
                        from coa_items b
                                 join jurnal_umum a on a.kode_akun=b.kode
                        where a.periode < ? and a.kode_akun = ?  group by a.kode_akun
                    ) as ab on aa.kode=ab.kode_akun where  aa.kode = ? group by aa.kode order by aa.kode
                ) as g", [$periode, $item['kode_akun'], $item['kode_akun']])->getRowObject();

                $res[] = [
                    'kode_akun'     => $item['kode_akun'],
                    'nama_akun'     => $item['nama_akun'],
                    'saldo_normal'  => $item['saldo_normal'],
                    'saldo_awal'    => $saldo_awal,
                    'detail'        => $detail
                ];
            }
        } else {
            $res = [];
        }
        return $res;
    }
}
