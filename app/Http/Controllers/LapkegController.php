<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LapkegController extends Controller
{
    public function index()
    {
        return view('pages.kegiatan.pilihlaporan');
    }
}
