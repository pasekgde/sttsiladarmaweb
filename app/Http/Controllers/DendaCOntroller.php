<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DendaCOntroller extends Controller
{
    public function index()
    {
        return view('pages.formdenda.denda');
    }
}
