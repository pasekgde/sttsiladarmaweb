<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kegiatan;
use App\Models\Event;
use App\Helpers\AutoKegiatan;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Auth;

class Formkegiatan extends Component
{
    public $formedit = false;

    public $idev;
    public $kodeevent;
    public $kodekegiatan;
    public $namakegiatan;
    public $jeniskas;
    public $tglkas;
    public $keterangan;
    public $qty;
    public $harga;
    public $jumlah;
    public $user;

    public $postId;

    //pagination
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //search
    public $search;
    protected $queryString = ['search'];
    public $perpage = 15;

    //delete
    protected $listeners = [ 'deleteconfirm' => 'deletedata' ];

    public $sumkaskeluar;
    public $sumkasmasuk;
    public $saldo;

    public function mount()
    {
        $data = Kegiatan::find($this->postId);
        $this->kodekegiatan = $data->id;
        $this->namakegiatan = $data->namakegiatan;
        $this->kodeevent = $this->kode();
        $this->sumkaskeluar();
        $this->sumkasmasuk();
        $this->saldo();
    }

    public function render()
    {
        if (Auth::user()->status == "Panitia") {
            $datakegiatan = Event::where('kodekegiatan',$this->postId)
                                ->orderby( 'tglkas', 'desc' )
                                ->where('user', Auth::user()->name)
                                ->where('keterangan', 'like', '%'.$this->search.'%')
                                ->paginate( $this->perpage );
        } else {
            $datakegiatan = Event::where('kodekegiatan',$this->postId)
                                ->orderby( 'tglkas', 'desc' )
                                ->where('keterangan', 'like', '%'.$this->search.'%')
                                ->paginate( $this->perpage );
        }

        return view('livewire.formkegiatan',compact('datakegiatan'));
    }

    public function store() {

        $this->validate( [
            'kodeevent' => 'required',
            'tglkas' => 'required',
            'jeniskas' => 'required',
            'keterangan' => 'required',
            
            'jumlah' => 'required',
        ] );

        $qtys = $this->qty;
        if ( $qtys == '' ) {
            $qtys = '-';
        }

        $hargas = $this->harga;
        if ( $hargas == '' ) {
            $hargas = 0;
        }

        Event::create( [
            'kodeevent' => $this->kode(),
            'kodekegiatan' => $this->kodekegiatan,
            'jeniskas'=>$this->jeniskas,
            'tglkas' => date( 'Y-m-d', strtotime( $this->tglkas ) ),
            'keterangan' => Str::ucfirst( $this->keterangan ),
            'qty' => $qtys,
            'harga' => currencyIDRToNumeric( $hargas ),
            'jumlah' => currencyIDRToNumeric( $this->jumlah ),
            'user' => $this->operator(),
        ] );
        $this->emit( 'success', [ 'pesan'=>'Sudah Tersimpan' ] );
        $this->sumkaskeluar();
        $this->sumkasmasuk();
        $this->saldo();
        $this->kosong();
        $this->focus();
    }

    public function edit( $id ) {

        $data = Event::findOrFail( $id );
        $this->idev = $data->id;
        $this->kodeevent = $data->kodeevent;
        $this->kodekegiatan = $data->kodekegiatan;
        $this->jeniskas = $data->jeniskas;
        $this->tglkas = date( 'm/d/Y', strtotime( $data->tglkas ) );
        $this->keterangan = $data->keterangan;
        $this->qty = $data->qty;
        $this->harga = currency_IDR( $data->harga );
        $this->jumlah = currency_IDR( $data->jumlah );
        $this->formedit = true;

    }

    public function update() {
        $this->validate( [
            'kodeevent' => 'required',
            'jeniskas' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required',
        ] );
        $qtys = $this->qty;
        if ( $qtys == '' ) {
            $qtys = '-';
        }

        $hargas = $this->harga;
        if ( $hargas == '' ) {
            $hargas = 0;
        }

        $data = Event::findOrFail( $this->idev );
        $data->update( [
            'kodeevent' => $this->kodeevent,
            'kodekegiatan' => $this->kodekegiatan,
            'jeniskas' => $this->jeniskas,
            'tglkas' => date( 'Y-m-d', strtotime( $this->tglkas ) ),
            'keterangan' => Str::ucfirst( $this->keterangan ),
            'qty' => $qtys,
            'harga' => currencyIDRToNumeric( $hargas ),
            'jumlah' => currencyIDRToNumeric( $this->jumlah ),
            'user' => $this->operator(),
        ] );
        $this->emit( 'success', [ 'pesan'=>'Sudah Terubah' ] );
        $this->sumkaskeluar();
        $this->sumkasmasuk();
        $this->saldo();
        $this->kosong();

        //$this->sumkaskeluar();
        $this->formedit = false;

    }

    public function destroypesan( $id ) {
        $this->idev = $id;
        $this->emit( 'hapus', [ 'pesan'=>'Yakin Hapus?', 'text'=>'suud hapus nak ilang', 'icon'=>'warning' ] );

    }

    public function deletedata() {
        Event::find( $this->idev )->delete();
        $this->sumkaskeluar();
        $this->sumkasmasuk();
        $this->saldo();
        $this->kodeevent = $this->kode();
        //$this->sumkaskeluar();
    }

    public function sumkaskeluar() {
        if (Auth::user()->status == "Panitia") {
             $sum = Event::where( 'jeniskas', 'Keluar' )->where('user', Auth::user()->name)->sum( 'jumlah' );
                            
             $this->sumkaskeluar = currency_IDR( $sum );
        } else {
             $sum = Event::where( 'jeniskas', 'Keluar' )->sum( 'jumlah' );
             $this->sumkaskeluar = currency_IDR( $sum );
        }
    }
    public function sumkasmasuk() {
        if (Auth::user()->status == "Panitia") {
            $sum = Event::where( 'jeniskas', 'Masuk' )->where('user', Auth::user()->name)->sum( 'jumlah' );
                        
            $this->sumkasmasuk = currency_IDR( $sum );
        } else {
            $sum = Event::where( 'jeniskas', 'Masuk' )->sum( 'jumlah' );
            $this->sumkasmasuk = currency_IDR( $sum );
        }
    }
    public function saldo() {
        $data1 = currencyIDRToNumeric($this->sumkasmasuk);
        $data2 = currencyIDRToNumeric($this->sumkaskeluar);
        $saldo = $data1-$data2;
        $this->saldo = currency_IDR( $saldo );
    }

    public function keyupjumlah() {
        $data1 = currencyIDRToNumeric( $this->harga );

        if ( $this->harga == null ) {
            $this->$data1 = 0;
        }
        $data2 = ( int )$data1*( int )$this->qty;
        $this->jumlah = currency_IDR( $data2 );
    }

    public function kode() {
        $table = 'events';
        $primary = 'kodeevent';
        $prefix = 'EVN';
        $kodeevents = AutoKegiatan::autonumber( $table, $primary, $prefix);
        return $kodeevents;
    }

    public function operator() {
        $operator = Auth::user()->name;
        return $operator;
    }

    public function kosong()
    {
        $this->kodeevent = $this->kode();
        $this->keterangan = NULL;
        $this->qty = NULL;
        $this->harga = NULL;
        $this->jumlah = NULL;
    }

    public function focus() {
        $this->emit( 'focuss' );
    }

}
