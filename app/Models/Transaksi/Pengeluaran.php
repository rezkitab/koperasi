<?php

namespace App\Models\Transaksi;

use CodeIgniter\Model;

class Pengeluaran extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pengeluaran';
    protected $primaryKey       = 'kode';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode','kode_kategori' ,'tanggal', 'periode', 'keterangan', 'nominal'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    public function kode($periode)
    {
        $sql =  $this->db->table('pengeluaran')
            ->select('RIGHT(kode,4) as kode', false)
            ->where('periode', $periode)
            ->orderBy('kode', 'DESC')
            ->limit(1)
            ->get();

        if ($sql->getNumRows() <> 0) {
            $data = $sql->getRow();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $prefix = "TRX-KK-".$periode.'.';
        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kode_final = $prefix . '' . $batas;

        return $kode_final;
    }

    public function getData()
    {
        $data = $this->db->query("select a.kode as no_bukti, a.kode_kategori, b.nama as nama_kategori, date_format(a.tanggal, '%d/%m/%Y') as tanggal, a.periode, a.deskripsi, a.nominal from pengeluaran a join kategori_pengeluaran b on a.kode_kategori=b.kode")->getResultArray();

        return $data;
    }

    public function findData($kode)
    {
        $data = $this->db->query("select a.kode as no_bukti, a.kode_kategori, b.nama as nama_kategori, a.tanggal, a.periode, a.deskripsi, a.nominal from pengeluaran a join kategori_pengeluaran b on a.kode_kategori=b.kode where a.kode = ?", [$kode])->getRowObject();

        return $data;
    }

    public function check_saldo($periode, $kode_akun)
    {

        $data = $this->db->query("select aa.kode_akun, (aa.debet-aa.kredit) as total_saldo from (
			select a.kode as kode_akun, ifnull(b.debet,0) as debet, ifnull(b.kredit,0) as kredit from coa_items a left join (
			select a.kode_akun, sum(if(a.dc='d',a.nominal,0)) as debet,sum(if(a.dc='c',a.nominal,0)) as kredit  from jurnal_umum a where  a.periode <= ?  group by a.kode_akun
			) b on a.kode=b.kode_akun 
			where a.kode = ?
			) aa", [$periode, $kode_akun])->getRowObject();

        return $data;
    }

    public function insertData($data)
    {
        $this->db->transStart();
        $this->db->table('pengeluaran')->insert($data['pengeluaran']);
        $this->db->table('jurnal_umum')->insertBatch($data['jurnal']);
        $this->db->transComplete();

        if($this->db->transStatus() == false){
            $this->db->transRollback();
            return false;
        }else{
            $this->db->transCommit();
            return true;
        }
    }

    public function updateData($data, $kode)
    {
        $this->db->transStart();
        $this->db->table('jurnal_umum')->where('no_bukti', $kode)->delete();
        $this->db->table('pengeluaran')->where('kode', $kode)->set($data['pengeluaran'])->update();
        $this->db->table('jurnal_umum')->insertBatch($data['jurnal']);
        $this->db->transComplete();

        if($this->db->transStatus() == false){
            $this->db->transRollback();
            return false;
        }else{
            $this->db->transCommit();
            return true;
        }
    }
}
