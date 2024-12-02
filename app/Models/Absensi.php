<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    public function kegiatan()
    {
        return $this->belongsTo(TabelKegiatan::class, 'idkegiatan');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'idanggota');
    }

    protected $primaryKey = 'idabsensi';


    protected $table = 'absensis';
    protected $fillable = [
        'idabsensi',
        'idkegiatan',
        'idanggota',
        'presensi',
        'denda',
        'status',
        'tanggal_bayar'
    ];
}
