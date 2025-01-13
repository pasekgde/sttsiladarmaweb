<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'idanggota');
    }
    
    public function penekelan()
    {
        return $this->hasMany(Penekelan::class, 'idanggota');
    }
    
    protected $table = 'anggota';
    protected $primaryKey = 'idanggota';
    protected $fillable = [
        'idanggota',
        'nama',
        'tgllahir',
        'umur',
        'pekerjaan',
        'tempek',
        'status',
    ];

}
