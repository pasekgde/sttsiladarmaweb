<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class FormController extends Controller
{
    public function index()
    {
        return view('pages.kegiatan.form');
    }
}
