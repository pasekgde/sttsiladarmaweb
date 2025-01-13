<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Alert;

class AnggotaController extends Controller
{
    public function index()
    {
        $dataanggota = Anggota::all();
        foreach ($dataanggota as $anggota) {
            // Menghitung umur berdasarkan tgllahir
            $anggota->umur_sekarang = Carbon::parse($anggota->tgllahir)->age;
        }
        return view('pages.datamaster.anggota', compact('dataanggota'));
    }

    public function create()
    {
        return view('pages.datamaster.createanggota');
    }

   
    public function store(Request $request)
    {
        $validator = $request->validate([
            'nama' => 'required', 'string', 'max:255',
            'tgllahir' => 'required',
            'umur' => 'required', 'string', 'min:8',
            'pekerjaan' => 'required',
            'tempek' => 'required',
            'status' => 'required',
        ]);
        Anggota::create([
            'nama' => Str::Upper($request['nama']),
            'tgllahir' =>$request['tgllahir'],
            'umur' =>$request['umur'],
            'pekerjaan' =>$request['pekerjaan'],
            'tempek' =>$request['tempek'],
            'status' =>$request['status'],
        ]);
        Alert::success('Success', 'Aman Sube Mesimpen'); 
        return redirect()->route('dataanggota');
    }
    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $datas = DB::table('anggota')->where('idanggota',$id)->first();
        return view('pages.datamaster.editanggota', compact(['datas']));
        
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'nama' => 'required', 'string', 'max:255',
            'tgllahir' => 'required',
            'umur' => 'required', 'string', 'min:8',
            'pekerjaan' => 'required',
            'tempek' => 'required',
            'status' => 'required',
        ]);

        $data = DB::table('anggota')->where('idanggota',$id)->update([
            'nama' => Str::Upper($request->nama),
            'tgllahir' => $request->tgllahir,
            'umur' => $request->umur,
            'pekerjaan' => $request->pekerjaan,
            'tempek' => $request->tempek,
            'status' => $request->status
        ]);
        Alert::success('Success', 'Sube Meubah'); 
        return redirect()->route('dataanggota');
    }

    public function destroy($id)
    {
        $data = DB::table('anggota')->where('idanggota', $id)->delete();
        return redirect()->route('dataanggota');
    }
    
}
