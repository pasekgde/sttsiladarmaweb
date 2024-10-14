<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LevenController extends Controller
{
    public function index()
    {
        return view('pages.kegiatan.levent');
    }
}
