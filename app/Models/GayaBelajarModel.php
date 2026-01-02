<?php

namespace App\Models;

use CodeIgniter\Model;

class GayaBelajarModel extends Model
{
    protected $table = 'gaya_belajar';
    protected $primaryKey = 'id_gaya';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['kode_gaya', 'nama_gaya', 'definisi', 'solusi'];
}
