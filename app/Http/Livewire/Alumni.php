<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Alumni as AL;

class Alumni extends Component
{
    /// Pagination and search properties
    public $search = '';
    public $perPage = 10;
    public $dataid;
    public $tanggapid;

    protected $listeners = [ 'setujuconfirm' => 'setuju', 'yakindestoyconfirm' => 'destoy' ];

    public function render()
    {
        $alumni = AL::where('nama', 'like', '%' . $this->search . '%')
                    ->orderBy('created_at', 'desc')
                    ->paginate($this->perPage);

        return view('livewire.alumni', ['alumni' => $alumni]);
    }

    public function dstroyconfirm($anggotaId)
    {
        $this->dataid = $anggotaId;
        $this->tanggapid = AL::where('idanggota', $this->dataid)->first();
        $this->emit( 'hapus', [ 'pesan'=>'Yakin hapus?', 'text'=>'data tidak berpengaruh ke Alumni', 'icon'=>'warning' ] );
    }

    public function destoy()
    {
        $this->tanggapid->delete();
    }
}
