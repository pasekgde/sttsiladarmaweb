<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengurusController extends Controller
{
    public function index()
    {
        return view('pages.superadmin.pengurusinfo');
    }
}
