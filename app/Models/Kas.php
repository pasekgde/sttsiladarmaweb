<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function scopeSearch($query, $term){
    $term = "%$term%";
    $query->where(function($query) use ($term){
        $query->where('keterangan','like',$term)
              ->orWhere('user','like', $term);
    });
   }
}
