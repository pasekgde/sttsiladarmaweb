<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Kegiatan;
Use Alert;

class DatauserController extends Controller
{

    public function index()
    {
        $datauser = User::all();
        return view('pages.datamaster.datauser',compact('datauser'));
    }

    public function create()
    {
        $datakegiatan = Kegiatan::all();
        return view('pages.datamaster.createdatauser',compact('datakegiatan'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8',
            'status' => 'required',
        ]);
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'status' =>$request['status']
            ]);
            Alert::success('Success', 'Sube Mesimpen'); 
            return redirect()->route('datauser');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $dataedit = User::find($id);
        return view('pages.datamaster.editdatauser', compact(['dataedit']));
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8',
            'status' => 'required',
        ]);   
        $data = User::find($id);
        $data->update($request->all());
        Alert::success('Success', 'Sube Meubah'); 
            return redirect()->route('datauser');
    }

    public function destroy($id)
    {
        $hapususer = User::findOrFail($id);
        $hapususer->delete();
        return redirect()->route('datauser');
    }
}
