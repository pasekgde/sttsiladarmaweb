<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kegiatan as KEG;
use App\Helpers\AutoKegiatan;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Livewire\WithPagination;
use Auth;

class Kegiatan extends Component
{
    public $idkeg;
    public $kodekegiatan;
    public $tglpembuatan;
    public $namakegiatan;
    public $deskripsi;
    public $formedit = false;

    //pagination
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //search
    public $searchTerm;
    public $perpage = 10;

    //delete
    protected $listeners = [ 'deleteconfirm' => 'deletedata' ];
    
    public function mount()
    {
        $this->kodekegiatan = $this->kodekegiatan();
    }

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $datakegiatan = KEG::where('namakegiatan','like', $searchTerm)->orderby('id','desc')
                    ->paginate($this->perpage);
                    
        return view('livewire.kegiatan', compact('datakegiatan'));
    }

    public function store() {

        $this->validate( [
            'kodekegiatan' => 'required',
            'tglpembuatan' => 'required',
            'namakegiatan' => 'required',
            'deskripsi' => 'required',
        ] );

        KEG::create( [
            'kodekegiatan' => $this->kodekegiatan(),
            'tglpembuatan' => date( 'Y-m-d', strtotime( $this->tglpembuatan ) ),
            'namakegiatan' => Str::ucfirst( $this->namakegiatan ),
            'deskripsi' => Str::ucfirst( $this->deskripsi ),
            'user' => $this->operator(),
        ] );
        $this->emit( 'success', [ 'pesan'=>'Sudah Tersimpan' ] );
        $this->kosong();
        $this->focus();
    }

    public function edit( $id ) {

        $data = KEG::findOrFail( $id );
        $this->idkeg = $data->id;
        $this->kodekegiatan = $data->kodekegiatan;
        $this->namakegiatan = $data->namakegiatan;
        $this->tglpembuatan = date( 'm/d/Y', strtotime( $data->tglpembuatan ) );
        $this->deskripsi = $data->deskripsi;
        $this->formedit = true;
    }

    public function update() {
        $this->validate( [
            'kodekegiatan' => 'required',
            'tglpembuatan' => 'required',
            'namakegiatan' => 'required',
            'deskripsi' => 'required',
        ] );

        $data = KEG::findOrFail( $this->idkeg);
        $data->update( [
            'kodekegiatan' => $this->kodekegiatan,
            'tglpembuatan' => date( 'Y-m-d', strtotime( $this->tglpembuatan ) ),
            'namakegiatan' => Str::ucfirst( $this->namakegiatan ),
            'deskripsi' => Str::ucfirst( $this->deskripsi ),
            'user' => $this->operator(),
        ] );
        $this->emit( 'success', [ 'pesan'=>'Sudah Terubah' ] );
        $this->kosong();
        $this->formedit = false;

    }

    public function destroypesan( $id ) {
        $this->idkeg = $id;
        $this->emit( 'hapus', [ 'pesan'=>'Yakin Hapus?', 'text'=>'suud hapus nak ilang', 'icon'=>'warning' ] );

    }

    public function deletedata() {
        KEG::find( $this->idkeg )->delete();
        $this->kodekegiatan = $this->kodekegiatan();
    }

    public function kodekegiatan() {
        $table = 'kegiatan';
        $primary = 'kodekegiatan';
        $prefix = 'KEG';
        $kodekegiatan = AutoKegiatan::autonumber( $table, $primary, $prefix);
        return $kodekegiatan;
    }

    public function operator() {
        $operator = Auth::user()->name;
        return $operator;
    }

    public function kosong()
    {
        $this->kodekegiatan = $this->kodekegiatan();
        $this->tglpembuatan = Carbon::now();
        $this->namakegiatan = "";
        $this->deskripsi = "";
    }

    public function focus() {
        $this->emit( 'focuss' );
    }
}
