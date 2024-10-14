<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PilihkegiatanController extends Controller
{
    public function index()
    {
        return view('pages.kegiatan.pilihkegiatan');
    }
}
