<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Alert;
use App\Models\Sisteminfo as SI;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = SI::first();
        return view('pages.dasboard',compact('data'));
    }
}
