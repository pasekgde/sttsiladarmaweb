<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutStt extends Model
{
    use HasFactory;
    protected $table = 'out_stt';
    protected $fillable = [
        'id',
        'idanggota',
        'nama',
        'tgllahir',
        'pekerjaan',
        'tempek',
        'status',
        'alasankeluar',
        'statusanggota'
    ];
}
