<?php

namespace App\Http\Livewire;
use App\Models\Kas;
use Carbon\Carbon;
use App\Helpers\AutoNumber;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Auth;

class Kasin extends Component
{
    //variabel kas masuk
    public $idkas;
    public $kodekas;
    public $jeniskas;
    public $tglkas;
    public $keterangan;
    public $jumlah;
    public $user;

    //pagination
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //search
    public $search;
    public $perpage = 10;

    //sumkasmasuk
    public $sumkasmasuk;

    //form create update
    public $editKas = false;

     //delete
    protected $listeners = [ 'deleteconfirm' => 'deletedata' ];

    public function mount()
    {
        $this->kodekas = $this->kodeKas();
        $this->jeniskas = 'Masuk';
        $this->tglkas = Carbon::now()->format( 'm/d/Y' );
        $this->sumkasmasuk();
    }
    
    public function render()
    {
        $kasin = Kas::where('jeniskas','Masuk')
                    ->orderby('id','desc')
                    ->search(trim( $this->search ) )
                    ->paginate($this->perpage);

        return view('livewire.kasin', compact('kasin'));
    }

    public function store() {

        $this->validate( [
            'kodekas' => 'required',
            'jeniskas' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required',
        ] );

        Kas::create( [
            'kodekas' => $this->kodeKas(),
            'jeniskas' => $this->jeniskas,
            'tglkas' => date( 'Y-m-d', strtotime( $this->tglkas ) ),
            'keterangan' => Str::ucfirst( $this->keterangan ),
            'qty' => '',
            'harga' => currencyIDRToNumeric( 0 ),
            'jumlah' => currencyIDRToNumeric( $this->jumlah ),
            'user' => $this->operator(),
        ] );
        $this->emit( 'success', [ 'pesan'=>'Sudah Tersimpan' ] );
        $this->kosong();
        $this->sumkasmasuk();
        $this->focus();
    }

    public function edit( $id ) {

        $data = Kas::findOrFail( $id );
        $this->idkas = $data->id;
        $this->kodekas = $data->kodekas;
        $this->jeniskas = $data->jeniskas;
        $this->tglkas = date( 'm/d/Y', strtotime( $data->tglkas ) );
        $this->keterangan = $data->keterangan;
        $this->jumlah = currency_IDR( $data->jumlah );
        $this->editKas = true;
    }
    
    public function update() {
        $this->validate( [
            'kodekas' => 'required',
            'jeniskas' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required',
        ] );

        $data = Kas::findOrFail( $this->idkas );
        $data->update( [
            'kodekas' => $this->kodekas,
            'jeniskas' => $this->jeniskas,
            'tglkas' => date( 'Y-m-d', strtotime( $this->tglkas ) ),
            'keterangan' => Str::ucfirst( $this->keterangan ),
            'qty' => '',
            'harga' => currencyIDRToNumeric( 0 ),
            'jumlah' => currencyIDRToNumeric( $this->jumlah ),
            'user' => $this->operator(),
        ] );
        $this->emit( 'success', [ 'pesan'=>'Sudah Terubah' ] );
        $this->kosong();
        $this->sumkasmasuk();
        $this->editKas = false;
        $this->focus();
    }


    public function destroypesan( $id ) {
        $this->idkas = $id;
        $this->emit( 'hapus', [ 'pesan'=>'Yakin Hapus?', 'text'=>'suud hapus nak ilang', 'icon'=>'warning' ] );

    }

    public function deletedata() {
        Kas::find( $this->idkas )->delete();
        $this->kodekas = $this->kodeKas();
        $this->sumkasmasuk();
    }


    public function kodeKas() {
        $table = 'kas';
        $primary = 'kodekas';
        $prefix = 'KIN';
        $temp = 'jeniskas';
        $temps = 'Masuk';
        $kodeKasin = Autonumber::autonumber( $table, $primary, $prefix, $temp, $temps );
        return $kodeKasin;
    }

    public function sumkasmasuk() {
        $sum = Kas::where( 'jeniskas', 'Masuk' )->sum( 'jumlah' );
        $this->sumkasmasuk = currency_IDR( $sum );
    }

    public function operator() {
        $operator = Auth::user()->name;
        return $operator;
    }

    public function kosong() {
        $this->kodekas = $this->kodeKas();
        $this->tglkas = Carbon::now()->format( 'm/d/Y' );
        $this->keterangan = NULL;
        $this->jumlah = NULL;
    }

    public function focus() {
        $this->emit( 'focuss' );
    }
}
