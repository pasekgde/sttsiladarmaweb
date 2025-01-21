<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Alumni extends Controller
{
    public function index()
    {
        return view('pages.out.alumni');
    }
}
