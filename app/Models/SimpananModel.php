<?php

namespace App\Models;

use CodeIgniter\Model;

class SimpananModel extends Model
{
    protected $table = 'riwayat_manasuka';
    protected $allowedFields = ['nama_penerima', 'nama_bank', 'no_rekening', 'nominal', 'tgl_penarikan', 'status', 'image'];
    protected $useTimestamps = true;
}
