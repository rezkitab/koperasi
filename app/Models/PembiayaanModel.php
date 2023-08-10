<?php

namespace App\Models;

use CodeIgniter\Model;

class PembiayaanModel extends Model
{
    protected $table      = 'pembiayaan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 'kode_pembiayaan', 'tgl_pembiayaan', 'jenis_pembiayaan', 'nama_barang', 'margin', 'biaya_administrasi', 'total', 'status', 'status_pembiayaan'
    ];

    public function rules()
    {
        return [];
    }

    public function getById($id)
    {
        return $this->where(['id' => $id])->first();
    }

    public function getStatusSimpanan($id_user)
    {
        $builder = $this->db->table('simpanan_wajib');
        $builder->where('id_user', $id_user);
        $query = $builder->get()->getFirstRow();
        return $query;
    }

    public function getAnggotaPembiayaan($user_id)
    {
        $builder = $this->db->table('users');
        $builder->select('users.*,simpanan_pokok.status');
        $builder->join('simpanan_pokok', 'simpanan_pokok.id_user=users.id_user');
        $builder->where('simpanan_pokok.status', '1');
        $builder->where('users.id_user', $user_id);
        $query   = $builder->get()->getFirstRow();
        return $query;
    }

    public function getPembiayaan()
    {
        $builder = $this->db->table('pembiayaan');
        $builder->select('pembiayaan.*,users.full_name');
        $builder->join('users', 'users.id_user=pembiayaan.user_id');
        $builder->orderBy('pembiayaan.kode_pembiayaan', 'DESC');
        $query = $builder->get()->getResultArray();

        if (count($query) > 0) {
            foreach ($query as $list) {

                //detail
                $detail_pembiayaan = $this->db->table('detail_pembiayaan');
                $detail_pembiayaan->where('pembiayaan_id', $list['id']);
                $detail = $detail_pembiayaan->get()->getResultArray();

                $res[] = [
                    'id'                    => $list['id'],
                    'user_id'               => $list['user_id'],
                    'kode_pembiayaan'       => $list['kode_pembiayaan'],
                    'tgl_pembiayaan'        => $list['tgl_pembiayaan'],
                    'tgl_pelunasan'         => $list['tgl_pelunasan'],
                    'nama_barang'           => $list['nama_barang'],
                    'jenis_pembiayaan'      => $list['jenis_pembiayaan'],
                    'jumlah_pembiayaan'     => $list['jumlah_pembiayaan'],
                    'angsuran'              => $list['angsuran'],
                    'margin'                => $list['margin'],
                    'biaya_administrasi'    => $list['biaya_administrasi'],
                    'total_angsuran'        => $list['total_angsuran'],
                    'total_pembiayaan'      => $list['total_pembiayaan'],
                    'status'                => $list['status'],
                    'status_pembiayaan'     => $list['status_pembiayaan'],
                    'full_name'             => $list['full_name'],
                    'detail'                => $detail,
                ];
            }
        } else {
            $res = [];
        }

        return $res;
    }

    public function getPembiayaanAnggota($id)
    {
        $builder = $this->db->table('pembiayaan');
        $builder->select('pembiayaan.*,users.full_name');
        $builder->join('users', 'users.id_user=pembiayaan.user_id');
        $builder->orderBy('pembiayaan.kode_pembiayaan', 'DESC');
        $builder->where('pembiayaan.user_id', $id);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getDetailPembiayaan($id)
    {
        $builder = $this->db->table('detail_pembiayaan');
        $builder->where('pembiayaan_id', $id);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getDetailPembiayaanBayar($id)
    {
        $builder = $this->db->table('detail_pembiayaan');
        $builder->select('
        detail_pembiayaan.*,
        pembiayaan.kode_pembiayaan,pembiayaan.jumlah_pembiayaan,pembiayaan.angsuran,pembiayaan.total_pembiayaan,pembiayaan.biaya_administrasi,
        users.full_name,users.no_hp');
        $builder->join('pembiayaan', 'detail_pembiayaan.pembiayaan_id=pembiayaan.id');
        $builder->join('users', 'users.id_user=pembiayaan.user_id');
        $builder->where('detail_pembiayaan.pembiayaan_id', $id);
        $builder->where('detail_pembiayaan.status !=', 'settlement');
        $builder->where('detail_pembiayaan.status', 'Belum Dibayar');
        $builder->orWhere('detail_pembiayaan.status', 'cancel');
        $builder->orderBy('detail_pembiayaan.id', 'ASC');
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function getDetailBayar($id)
    {
        $builder = $this->db->table('detail_pembiayaan');
        $builder->where('pembiayaan_id', $id);
        $builder->where('status', 'Belum Dibayar');
        $builder->orderBy('detail_pembiayaan.id', 'ASC');
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function getStatusPembiayaan()
    {
        $builder = $this->db->table('detail_pembiayaan');
        $builder->where('order_id !=', '');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getTotalSimpanan($user_id)
    {
        $builder = $this->db->table('simpanan_pokok');
        $builder->select('nominal');
        $builder->where('status', 1);
        $builder->where('id_user', $user_id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function getLapPembiayaan($month = '', $year = '')
    {
        $builder = $this->db->table('detail_pembiayaan');
        $builder->select('
        detail_pembiayaan.*,
        pembiayaan.jumlah_pembiayaan,pembiayaan.angsuran,pembiayaan.total_pembiayaan,pembiayaan.nama_barang,
        users.full_name,');
        $builder->join('pembiayaan', 'detail_pembiayaan.pembiayaan_id=pembiayaan.id');
        $builder->join('users', 'users.id_user=pembiayaan.user_id');
        $builder->where('month(detail_pembiayaan.tgl_pembayaran)', $month);
        $builder->where('year(detail_pembiayaan.tgl_pembayaran)', $year);
        $builder->where('detail_pembiayaan.status', 'Sudah Dibayar');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getPrintAngsuran($id)
    {
        $builder = $this->db->table('detail_pembiayaan');
        $builder->select('detail_pembiayaan.*,pembiayaan.kode_pembiayaan,pembiayaan.total_angsuran,users.*');
        $builder->join('pembiayaan', 'pembiayaan.id=detail_pembiayaan.pembiayaan_id');
        $builder->join('users', 'users.id_user=pembiayaan.user_id');
        $builder->where('detail_pembiayaan.id', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function createPembiayaan($data)
    {
        $query = $this->db->table('pembiayaan')->insert($data);
        return $query;
    }

    public function createDetailPembiayaan($data)
    {
        $query = $this->db->table('detail_pembiayaan')->insertBatch($data);
        return $query;
    }

    public function updatePembiayaan($data, $id)
    {
        $query = $this->db->table('pembiayaan')->update($data, array('id' => $id));
        return $query;
    }

    public function updateDetailPembiayaan($data, $id)
    {
        $query = $this->db->table('detail_pembiayaan')->update($data, array('id' => $id));
        return $query;
    }

    public function updateDataAngsuran($data, $id)
    {
        $query = $this->db->table('detail_pembiayaan')->update($data, array('order_id' => $id));
        return $query;
    }

    public function deletePembiayaan($id)
    {
        $query = $this->db->table('pembiayaan')->delete(array('id' => $id));
        return $query;
    }

    public function deleteDetailPembiayaan($id)
    {
        $query = $this->db->table('detail_pembiayaan')->delete(array('pembiayaan_id' => $id));
        return $query;
    }
}
