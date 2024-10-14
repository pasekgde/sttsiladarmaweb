<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kas;
use Alert;
use Carbon\Carbon;
use Auth;
use App\Helpers\AutoNumber;
use Illuminate\Support\Facades\DB;

class KasinController extends Controller
{

    public function index()
    {
        $form = 0;
        $sumkas = $this->sumkas();
        $kasmasuk = Kas::orderBy('kodekas', 'DESC')->get();
        return view('pages.datakas.kasmasuk', compact(['kasmasuk','form','sumkas']));
    }


    public function create()
    {
        return view('pages.datakas.createkasmasuk');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
        'tglkas' => 'required',
        'keterangan' => 'required|max:255',
        'jumlah' => 'required'
        ]);

        if ($request->qty==null) {
            $temp_qty ='0';
        } else {
            $temp_qty = $request->qty;
        }

        if ($request->harga==null) {
            $temp_harga ='0';
        } else {
            $temp_harga = $request->harga;
        }

        $harga = str_replace(".", "", $temp_harga); 
        $jumlah = str_replace(".", "", $request->jumlah);
        $tgl = date("Y-m-d", strtotime($request->tglkas));

        Kas::create([
            'kodekas' => $this->kodeKasin(),
            'jeniskas' => $request['jeniskas'],
            'tglkas' => $tgl,
            'keterangan' => $request['keterangan'],
            'qty' => $temp_qty,
            'harga' => $harga,
            'jumlah' => $jumlah,
            'user' => $this->operator(),
        ]);
        Alert::success('Success', 'Aman Sube Mesimpen'); 
        return redirect()->route('kasmasuk');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $form = 1;
        $sumkas = $this->sumkas();
        $datakas = Kas::findOrFail($id);
        $kasmasuk = Kas::orderBy('id', 'DESC')->get();
        return view('pages.datakas.kasmasuk', compact(['kasmasuk','datakas','form','sumkas']));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tglkas' => 'required',
            'keterangan' => 'required|max:255',
            'jumlah' => 'required',
            ]);
    
            $temp_jumlah = str_replace(".","", $request->jumlah);
            $temp_tgl = date("Y-m-d", strtotime($request->input('tglkas')));
            $tempkode = $request->kodekas;

            
            Kas::find($id)->update([
                'kodekas' => $request->kodekas,
                'jeniskas' => $request->jeniskas,
                'tglkas' => $temp_tgl,
                'keterangan' => $request->keterangan,
                'qty' => 0,
                'harga' => 0,
                'jumlah' => $temp_jumlah,
                'user' => $this->operator(),
            ]);
            $form =0;
            Alert::success('Success', 'Sube Meubah');
            return redirect()->route('kasmasuk');
    }


    public function destroy($id)
    {
        $datakas = Kas::find($id);
        $datakas->delete();
        return back();
    }

    //tambahan function
    public function operator(){
        $operator = Auth::user()->name;
        return $operator;
    }

    public function kodeKasin(){
        $table="kas";
        $primary="kodekas";
        $prefix="KIN";
        $temp="jeniskas";
        $temps="Masuk";
        $kodeKasin=Autonumber::autonumber($table,$primary,$prefix, $temp, $temps);
      }

    public function sumkas(){
        $data = DB::table('kas')->sum('jumlah');
        return $data;
    }
}
