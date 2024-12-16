<?php

namespace App\Http\Livewire;
use App\Models\Kas;
use Carbon\Carbon;
use App\Helpers\AutoNumber;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Auth;

class Kasout extends Component {
    //Variabel KAs
    public $idkas;
    public $kodekas;
    public $jeniskas;
    public $tglkas;
    public $keterangan;
    public $qty;
    public $harga;
    public $jumlah;
    public $user;

    //pagination
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //search
    public $search;
    public $perpage = 10;

    //form create update
    public $editKas = false;

    //delete
    protected $listeners = [ 'deleteconfirm' => 'deletedata' ];

    //sumkaskeluar
    public $sumkaskeluar;

    public function mount() {
        $this->kodekas = $this->kodeKas();
        $this->jeniskas = 'Keluar';
        $this->tglkas = Carbon::now()->format('Y-m-d');
        $this->sumkaskeluar();
    }

    public function render() {
        $kasout = Kas::where( 'jeniskas', 'Keluar' )
        ->orderby( 'id', 'desc' )
        ->search( trim( $this->search ) )
        ->paginate( $this->perpage );
        return view( 'livewire.kasout', compact( 'kasout' ) );
    }

    public function store() {

        $this->validate( [
            'kodekas' => 'required',
            'tglkas' => 'required',
            'jeniskas' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required',
        ] );
        $qtys = $this->qty;
        if ($qtys == null || $qtys == 0) {
            $qtys = '';
        }

        $hargas = $this->harga;
        if ( $hargas == '' ) {
            $hargas = 0;
        }
        Kas::create( [
            'kodekas' => $this->kodeKas(),
            'jeniskas' => $this->jeniskas,
            'tglkas' => date( 'Y-m-d', strtotime( $this->tglkas ) ),
            'keterangan' => Str::ucfirst( $this->keterangan ),
            'qty' => $qtys,
            'harga' => currencyIDRToNumeric( $hargas ),
            'jumlah' => currencyIDRToNumeric( $this->jumlah ),
            'user' => $this->operator(),
        ] );
        $this->emit( 'success', [ 'pesan'=>'Sudah Tersimpan' ] );
        $this->kosong();
        $this->sumkaskeluar();

    }

    public function edit( $id ) {

        $data = Kas::findOrFail( $id );
        $this->idkas = $data->id;
        $this->kodekas = $data->kodekas;
        $this->jeniskas = $data->jeniskas;
        $this->tglkas = Carbon::parse($data->tglkas)->format('Y-m-d');
        $this->keterangan = $data->keterangan;
        $this->qty = $data->qty;
        $this->harga = currency_IDR( $data->harga );
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
        $qtys = $this->qty;
        if ($qtys === null || $qtys == 0) {
            $qtys = '-';
        }

        $hargas = $this->harga;
        if ( $hargas == '' ) {
            $hargas = 0;
        }

        $data = Kas::findOrFail( $this->idkas );
        $data->update( [
            'kodekas' => $this->kodekas,
            'jeniskas' => $this->jeniskas,
            'tglkas' => date( 'Y-m-d', strtotime( $this->tglkas ) ),
            'keterangan' => Str::ucfirst( $this->keterangan ),
            'qty' => $qtys,
            'harga' => currencyIDRToNumeric( $hargas ),
            'jumlah' => currencyIDRToNumeric( $this->jumlah ),
            'user' => $this->operator(),
        ] );
        $this->emit( 'success', [ 'pesan'=>'Sudah Terubah' ] );
        $this->kosong();

        $this->sumkaskeluar();
        $this->editKas = false;

    }

    public function destroypesan( $id ) {
        $this->idkas = $id;
        $this->emit( 'hapus', [ 'pesan'=>'Yakin Hapus?', 'text'=>'suud hapus nak ilang', 'icon'=>'warning' ] );

    }

    public function deletedata() {
        Kas::find( $this->idkas )->delete();
        $this->kodekas = $this->kodeKas();
        $this->sumkaskeluar();
    }

    public function keyupjumlah() {
        // Mengubah harga menjadi angka (numeric)
        $data1 = currencyIDRToNumeric($this->harga);
    
        // Mengecek jika harga kosong
        if ($data1 === null || $data1 === 0) {
            $this->jumlah = currency_IDR(0); // Jika harga kosong, set jumlah menjadi 0
            return;
        }
    
        // Mengecek jika qty kosong
        if (empty($this->qty) || $this->qty == 0) {
            $this->jumlah = currency_IDR($data1); // Jika qty kosong, set jumlah menjadi harga * 1
        } else {
            // Jika qty terisi, hitung jumlah (harga * qty)
            $data2 = (int) $data1 * (int) $this->qty;
            $this->jumlah = currency_IDR($data2); 
        }
    }
    

    public function sumkaskeluar() {
        $sum = Kas::where( 'jeniskas', 'Keluar' )->sum( 'jumlah' );
        $this->sumkaskeluar = currency_IDR( $sum );
    }

    public function operator() {
        $operator = Auth::user()->name;
        return $operator;
    }

    public function kodeKas() {
        $table = 'kas';
        $primary = 'kodekas';
        $prefix = 'OUT';
        $temp = 'jeniskas';
        $temps = 'Keluar';
        $kodeKasin = Autonumber::autonumber( $table, $primary, $prefix, $temp, $temps );
        return $kodeKasin;
    }

    public function cancel() {
        $this->kosong();
        $this->editKas = false;

    }

    public function kosong() {
        $this->kodekas = $this->kodeKas();
        $this->tglkas = Carbon::now()->format( 'm/d/Y' );
        $this->keterangan = NULL;
        $this->qty = NULL;
        $this->harga = NULL;
        $this->jumlah = NULL;
    }

    public function focus() {
        $this->emit( 'focuss' );
    }

}