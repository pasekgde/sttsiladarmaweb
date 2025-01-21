<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendataan;
use Carbon\Carbon;

class PendataanController extends Controller
{
    public function index()
    {
        return view('pages.pendataan.pendataan');
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nama' => 'required|string|max:255',
            'tglLahir' => 'required|date',
            'pekerjaan' => 'required|string|max:50',
            'tempek' => 'required|string',
            'status' => 'required|string',
        ]);

        // Menghitung umur berdasarkan tanggal lahir
        $birthDate = Carbon::parse($request->tglLahir);
        $age = $birthDate->age;

        // Simpan data anggota
        Pendataan::create([
            'nama' => $request->nama,
            'tglLahir' => $request->tglLahir,
            'umur' => $age,
            'pekerjaan' => $request->pekerjaan,
            'tempek' => $request->tempek,
            'status' => $request->status,
        ]);

        // Redirect atau response sukses
        return redirect()->route('pendataan')->with('success', 'Pendaftaran Anggota berhasil!');
    }

    public function confirmpendataan()
    {
        return view('pages.pendataan.confirmpendataan');
    }
}
