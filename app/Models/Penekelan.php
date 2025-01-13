<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penekelan extends Model
{
    use HasFactory;
    
    protected $table = 'penekelan';
    protected $fillable = [
        'id',
        'idanggota',
        'bayarpenekelan',
        'tanggalbayar'
    ];
}