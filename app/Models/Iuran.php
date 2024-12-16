<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iuran extends Model
{
    use HasFactory;
    protected $primaryKey = 'idiuran';


    protected $table = 'iuran';
    protected $fillable = [
        'idiuran',
        'perihal',
        'jumlah',
        'total_iuran',
        'total_anggota',
        'total_yangsudahbayar',
        'total_yangbelumbayar',
        'total_bayar',
        'status'
    ];
}
