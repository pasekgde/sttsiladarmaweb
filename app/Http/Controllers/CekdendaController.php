<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CekdendaController extends Controller
{
    public function index()
    {
        return view('pages.pencariandenda.cek-denda');
    }
}
