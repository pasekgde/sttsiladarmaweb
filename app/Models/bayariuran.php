<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bayariuran extends Model
{
    use HasFactory;
    protected $primaryKey = 'idbayariuran';

    protected $table = 'bayariuran';
    protected $fillable = [
        'idbayariuran',
        'idanggota',
        'idiuran',
        'jumlahbayar',
        'tanggalbayar',
        'statusbayar'
    ];
}
