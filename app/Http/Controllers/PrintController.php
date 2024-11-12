<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function show()
    {
        $data = session()->get('absensi_data');

        return view('livewire.print-absensi', $data);
    }
}
