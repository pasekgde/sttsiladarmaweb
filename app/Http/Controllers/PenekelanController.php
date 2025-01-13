<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenekelanController extends Controller
{
    public function index()
    {
        return view('pages.penekelan.penekelan');
    }
}
