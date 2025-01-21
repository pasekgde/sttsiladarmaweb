<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'kegiatan';
    protected $fillable = [
        'idkeg',
        'kodekegiatan',
        'tglpembuatan',
        'namakegiatan',
        'deskripsi',
        'ketuapanitia',
        'sekretarispanitia',
        'bendaharapanitia',
        'kasmasuk',
        'kaskeluar',
        'saldo',
        'user',
        'created_at',
        'updated_at',
        'pengguna',
        'status'
    ];
}
