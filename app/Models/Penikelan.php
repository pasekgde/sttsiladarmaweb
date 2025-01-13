<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penikelan extends Model
{
    use HasFactory;
    protected $table = 'penikelan';

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'idanggota');
    }

    protected $fillable = [
        'id',
        'penikelan_denda',
        'created_at',
        'updated_at'
    ];
}
