<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kas;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Pengurus;

class Lkas extends Component
{
    //pagination
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //search
    public $search;
    public $perpage = 10;

    //sumkas laporan
    public $sumkasmasuk;
    public $sumkaskeluar;
    public $saldo;
    public $tglawal, $tglakhir, $tipekas;

    

    public function mount()
    {
        $this->sumkasmasuk();
        $this->sumkaskeluar();
        $this->saldo();
    }

    public function render()
    {
        if ($this->tglawal || $this->tglakhir && $this->tipekas) {
            $datakas = Kas::whereBetween('tglkas', [$this->tglawal, $this->tglakhir])
                            ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                            ->where('keterangan', 'like', '%'. $this->search .'%')
                            ->latest()->paginate($this->perpage);
            $this->sumkasmasuk();
            $this->sumkaskeluar();
            $this->saldo();
        } elseif ($this->tipekas) {
            $datakas = Kas::where('jeniskas', 'like', '%'. $this->tipekas .'%')
                            ->where('keterangan', 'like', '%'. $this->search .'%')
                            ->latest()->paginate($this->perpage);
            
            $summasuk = Kas::where( 'jeniskas', 'Masuk' )->sum( 'jumlah' );
                    $this->sumkasmasuk = currency_IDR( $summasuk );
            
            $sumkeluar = Kas::where( 'jeniskas', 'Keluar' )->sum( 'jumlah' );
                    $this->sumkaskeluar = currency_IDR( $sumkeluar );
            $this->saldo();
            
        }else{
            $datakas = Kas::latest()->search( trim( $this->search ) )->paginate($this->perpage);

            $summasuk = Kas::where( 'jeniskas', 'Masuk' )->sum( 'jumlah' );
                    $this->sumkasmasuk = currency_IDR( $summasuk );
            
            $sumkeluar = Kas::where( 'jeniskas', 'Keluar' )->sum( 'jumlah' );
                    $this->sumkaskeluar = currency_IDR( $sumkeluar );
            $this->saldo();
        }

        return view('livewire.lkas',compact('datakas'));
    }

    public function sumkasmasuk() {
        $sum = Kas::whereBetween('tglkas', [$this->tglawal, $this->tglakhir])
                    ->where( 'jeniskas', 'Masuk' )->sum( 'jumlah' );
        $this->sumkasmasuk = currency_IDR( $sum );
    }

    public function sumkaskeluar() {
        $sum = Kas::whereBetween('tglkas', [$this->tglawal, $this->tglakhir])
                    ->where( 'jeniskas', 'Keluar' )->sum( 'jumlah' );
        $this->sumkaskeluar = currency_IDR( $sum );
    }

    public function saldo() {
        $data1 = currencyIDRToNumeric($this->sumkasmasuk);
        $data2 = currencyIDRToNumeric($this->sumkaskeluar);
        $saldo = $data1-$data2;
        if ($saldo==0) {
            $this->saldo = currency_IDR(0);
        }else {
            $this->saldo = currency_IDR( $saldo );
        }
        
    }

    public function semua()
    {
        $this->tglakhir = null;
        $this->tglawal = null;
        $this->tipekas ='';
    }

    public function printkas()
    {
        $namattd =$this->pengurus = Pengurus::first();
        if ($this->tglawal || $this->tglakhir && $this->tipekas) {
            $data = Kas::whereBetween('tglkas', [$this->tglawal, $this->tglakhir])
                            ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                            ->where('keterangan', 'like', '%'. $this->search .'%')->get();
            $this->sumkasmasuk();
            $this->sumkaskeluar();
            $this->saldo();
        } elseif ($this->tipekas=="Masuk") {
            $data = Kas::where('jeniskas', 'like', '%'. $this->tipekas .'%')
                            ->where('keterangan', 'like', '%'. $this->search .'%')->get();
            
            $summasuk = Kas::where( 'jeniskas', 'Masuk' )->sum( 'jumlah' );
                    $this->sumkasmasuk = currency_IDR( $summasuk );
            
            $sumkeluar = 0;
                    $this->sumkaskeluar = currency_IDR( $sumkeluar );
            
        }elseif ($this->tipekas=="Keluar") {
            $data = Kas::where('jeniskas', 'like', '%'. $this->tipekas .'%')
                            ->where('keterangan', 'like', '%'. $this->search .'%')->get();
            
            $summasuk = 0;
                    $this->sumkasmasuk = currency_IDR( $summasuk );
            
            $sumkeluar = Kas::where( 'jeniskas', 'Keluar' )->sum( 'jumlah' );
                    $this->sumkaskeluar = currency_IDR( $sumkeluar );
        }else
        {
            $data = Kas::latest()->search( trim( $this->search ) )->get();

            $summasuk = Kas::where( 'jeniskas', 'Masuk' )->sum( 'jumlah' );
                    $this->sumkasmasuk = currency_IDR( $summasuk );
            
            $sumkeluar = Kas::where( 'jeniskas', 'Keluar' )->sum( 'jumlah' );
                    $this->sumkaskeluar = currency_IDR( $sumkeluar );
            $this->saldo();
        }
        
        $pdf = PDF::loadView('livewire.pdfkas', ['pengurus'=>$namattd,'data'=>$data,'summasuk'=>$this->sumkasmasuk,'sumkeluar'=>$this->sumkaskeluar,'saldo'=>$this->saldo, 'tipekas'=>$this->tipekas])->output();
 
        return response()->streamDownload(
            fn () => print($pdf),
            "Data Kas STT.pdf"
        );
    }

}
