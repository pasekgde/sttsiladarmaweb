<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LkasController extends Controller
{
    public function index(){
        return view("pages.datakas.lkas");
    }
}
