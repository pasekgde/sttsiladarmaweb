<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelKegiatan extends Model
{
    use HasFactory;

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'idkegiatan');
    }

    // Relasi dengan Anggota
    public function anggota()
    {
        return $this->hasManyThrough(Anggota::class, Absensi::class, 'idkegiatan', 'idanggota');
    }


    protected $table = 'tabel_kegiatans';
    protected $primaryKey = 'idkegiatan'; // Pastikan primary key benar
    public $incrementing = true; // Pastikan incrementing diatur true
    protected $fillable = [
        'idkegiatan',
        'tanggal_kegiatan',
        'nama_kegiatan',
        'jenis_kegiatan',
        'denda',
        'total_denda',
        'total_anggota',
        'total_hadir',
        'total_tidak_hadir',
        'keterangan',
        'user',
    ];
}
