<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;

    protected $table = 'pengurus';
    protected $fillable = [
        'id',
        'ketua',
        'sekretaris',
        'bendahara',
        'created_at',
        'updated_at'
    ];
}
