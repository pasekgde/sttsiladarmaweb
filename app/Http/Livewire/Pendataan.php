<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pendataan as Pen;
use App\Models\Anggota;

class Pendataan extends Component
{
    public $datapen;
    protected $listeners = [ 'deleteconfirm' => 'tolak' ];

    public function render()
    {
        $datapendataan = Pen::all();
        return view('livewire.pendataan',['datapendataan'=>$datapendataan]);
    }

    public function yakintolak($id)
    {
        $this->datapen = Pen::find($id);
        $this->emit( 'hapus', [ 'pesan'=>'Yakin hapus?', 'text'=>'data tidak berpengaruh ke Angota', 'icon'=>'warning' ] );
    }

    public function tolak()
    {
        if ($this->datapen) {
            // Hapus data pendataan
            $this->datapen->delete();
            
            // Setelah data dihapus, refresh data
            $this->datapen = null;
        }
    }

    public function setujui($id)
    {
        $confirmanggota = Pen::find($id);
        
        Anggota::create([
            'nama' => strtoupper($confirmanggota->nama),
            'tgllahir' => $confirmanggota->tglLahir,
            'umur' => $confirmanggota->umur,
            'pekerjaan' => $confirmanggota->pekerjaan,
            'tempek' => ucwords(strtolower($confirmanggota->tempek)),
            'status' => $confirmanggota->status
        ]);

        $confirmanggota->delete();
        $this->emit( 'success', [ 'pesan'=>'Berhasil Diinput ke Anggota', 'text'=>'', 'icon'=>'success' ] );

    }

    




}
