<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TabelKegiatan;
use Illuminate\Support\Str;
use Auth;
use Carbon\Carbon;
use App\Models\Anggota;
use App\Models\Absensi as Presensis;
use Illuminate\Support\Facades\DB;

class Absensi extends Component
{
    public $tanggal_kegiatan;
    public $nama_kegiatan;
    public $jenis_kegiatan;
    public $denda;
    public $keterangan;

    public $dataanggota = [];

    public $idkegiatan = [];
    public $idanggota  = [];
    public $presensi   = [];

    //wizard
    public $currentStep = 1;
    
    public function render()
    {
        $this->dataanggota = Anggota::all();
        return view('livewire.absensi',['dataanggota'=> $this->dataanggota]);
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'tanggal_kegiatan' => 'required|date',
            'nama_kegiatan' => 'required|string|max:255',
            'jenis_kegiatan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);
        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->validate([
            'presensi' => 'required|array',
        ]);
        $this->currentStep = 3;
    }

    public function submitForm()
    {
        $tabelkegiatan = TabelKegiatan::create( [
            'tanggal_kegiatan' => date( 'Y-m-d', strtotime( $this->tanggal_kegiatan ) ),
            'nama_kegiatan' => $this->nama_kegiatan,
            'jenis_kegiatan' => $this->jenis_kegiatan,
            'denda' => currencyIDRToNumeric( $this->denda ),
            'keterangan' => Str::ucfirst( $this->keterangan ),
            'user' => $this->operator(),
        ] );
        foreach ( $this->dataanggota as $index => $value ) {
            Presensis::create([
                'idanggota' => $value['idanggota'],
                'idkegiatan' => $tabelkegiatan->idkegiatan,
                'presensi' => $this->presensi[$index],
            ]);
        }

        $this->emit( 'success', [ 'pesan'=>'Absensi Sudah Tersimpan' ] );
        $this->clearForm();
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }
    






















    
   

    public function clearForm() {
        $this->tanggal_kegiatan = '';
        $this->nama_kegiatan = '';
        $this->jenis_kegiatan = '';
        $this->denda = '';
        $this->keterangan = '';
    }

    public function operator() {
        $operator = Auth::user()->name;
        return $operator;
    }
    
}
