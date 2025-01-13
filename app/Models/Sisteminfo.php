<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Sisteminfo extends Model
{
    use HasFactory;
    
    protected $table = 'sisteminfo';
    protected $primaryKey = 'id';
    protected $fillable = [
       'id',
       'nama_sistem',
       'subjudul',
       'logo',
       'deskripsi1',
       'deskripsi2',
       'organisasi',
       'background'
    ];
}
