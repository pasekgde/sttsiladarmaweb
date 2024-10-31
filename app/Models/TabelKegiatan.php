<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelKegiatan extends Model
{
    use HasFactory;
    protected $table = 'tabel_kegiatans';
    protected $primaryKey = 'idkegiatan'; // Pastikan primary key benar
    public $incrementing = true; // Pastikan incrementing diatur true
    protected $fillable = [
        'idkegiatan',
        'tanggal_kegiatan',
        'nama_kegiatan',
        'jenis_kegiatan',
        'denda',
        'keterangan',
        'user',
    ];
}
