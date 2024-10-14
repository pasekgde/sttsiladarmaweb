<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Event as Ev;
use App\Models\Kegiatan as Keg;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use Auth;

class Levent extends Component
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
    public $postId;
    public $namaevent;

    

    public function mount()
    {
        $this->namaevent = Keg::find($this->postId);
        $this->sumkasmasuk();
        $this->sumkaskeluar();
        $this->saldo();
    }

    public function render()
    {
        if (Auth::user()->status == "Panitia") {
            if ($this->tglawal || $this->tglakhir && $this->tipekas) {
            $datakas = Ev::where('kodekegiatan',$this->postId)
                            ->whereBetween('tglkas', [$this->tglawal, $this->tglakhir])
                            ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                            ->where('keterangan', 'like', '%'. $this->search .'%')
                            ->where('user', Auth::user()->name)
                            ->orderby( 'tglkas', 'desc' )->paginate($this->perpage);
            $this->sumkasmasuk();
            $this->sumkaskeluar();
            $this->saldo();
            }
             elseif ($this->tipekas) {
                $datakas = Ev::where('kodekegiatan',$this->postId)
                                ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                                ->where('keterangan', 'like', '%'. $this->search .'%')
                                ->where('user', Auth::user()->name)
                                ->orderby( 'tglkas', 'desc' )->paginate($this->perpage);

                $summasuk = Ev::where( 'jeniskas', 'Masuk' )->where('user', Auth::user()->name)->sum( 'jumlah' );
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = Ev::where( 'jeniskas', 'Keluar' )->where('user', Auth::user()->name)->sum( 'jumlah' );
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
            } else
            {
                $datakas = Ev::where('keterangan', 'like', '%'. $this->search .'%')
                                        ->where('kodekegiatan',$this->postId)
                                        ->where('user', Auth::user()->name)
                                        ->orderby( 'tglkas', 'desc' )->paginate($this->perpage);

                $summasuk = Ev::where('kodekegiatan',$this->postId)->where( 'jeniskas', 'Masuk' )->where('user', Auth::user()->name)->sum( 'jumlah' );
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = Ev::where('kodekegiatan',$this->postId)->where( 'jeniskas', 'Keluar' )->where('user', Auth::user()->name)->sum( 'jumlah' );
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
            }
        } else {
            if ($this->tglawal || $this->tglakhir && $this->tipekas) {
            $datakas = Ev::where('kodekegiatan',$this->postId)
                            ->whereBetween('tglkas', [$this->tglawal, $this->tglakhir])
                            ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                            ->where('keterangan', 'like', '%'. $this->search .'%')
                            ->orderby( 'tglkas', 'desc' )->paginate($this->perpage);
            $this->sumkasmasuk();
            $this->sumkaskeluar();
            $this->saldo();
            }
             elseif ($this->tipekas) {
                $datakas = Ev::where('kodekegiatan',$this->postId)
                                ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                                ->where('keterangan', 'like', '%'. $this->search .'%')
                                ->orderby( 'tglkas', 'desc' )->paginate($this->perpage);

                $summasuk = Ev::where( 'jeniskas', 'Masuk' )->sum( 'jumlah' );
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = Ev::where( 'jeniskas', 'Keluar' )->sum( 'jumlah' );
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
            } else
            {
                $datakas = Ev::where('keterangan', 'like', '%'. $this->search .'%')
                                        ->where('kodekegiatan',$this->postId)
                                        ->orderby( 'tglkas', 'desc' )
                                        ->paginate($this->perpage);

                $summasuk = Ev::where('kodekegiatan',$this->postId)->where( 'jeniskas', 'Masuk' )->sum( 'jumlah' );
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = Ev::where('kodekegiatan',$this->postId)->where( 'jeniskas', 'Keluar' )->sum( 'jumlah' );
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
            }
        }
        
        return view('livewire.levent',compact('datakas'));
    }

    public function sumkasmasuk() {
        if (Auth::user()->status == "Panitia") {
            $sum = Ev::where('kodekegiatan',$this->postId)->whereBetween('tglkas', [$this->tglawal, $this->tglakhir])
                    ->where( 'jeniskas', 'Masuk' )->where('user', Auth::user()->name)->sum( 'jumlah' );
            $this->sumkasmasuk = currency_IDR( $sum );
        } else {
            $sum = Ev::where('kodekegiatan',$this->postId)->whereBetween('tglkas', [$this->tglawal, $this->tglakhir])
                        ->where( 'jeniskas', 'Masuk' )->sum( 'jumlah' );
            $this->sumkasmasuk = currency_IDR( $sum );
        }
        
    }

    public function sumkaskeluar() {
        if (Auth::user()->status == "Panitia") {
            $sum = Ev::where('kodekegiatan',$this->postId)->whereBetween('tglkas', [$this->tglawal, $this->tglakhir])
                        ->where( 'jeniskas', 'Keluar' )->where('user', Auth::user()->name)->sum( 'jumlah' );
            $this->sumkaskeluar = currency_IDR( $sum );
        } else {
            $sum = Ev::where('kodekegiatan',$this->postId)->whereBetween('tglkas', [$this->tglawal, $this->tglakhir])
                        ->where( 'jeniskas', 'Keluar' )->sum( 'jumlah' );
            $this->sumkaskeluar = currency_IDR( $sum );
        }
        
        
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
        if (Auth::user()->status == "Panitia") {
            if ($this->tglawal || $this->tglakhir && $this->tipekas) {
            $data = Ev::where('kodekegiatan',$this->postId)
                            ->whereBetween('tglkas', [$this->tglawal, $this->tglakhir])
                            ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                            ->where('keterangan', 'like', '%'. $this->search .'%')
                            ->where('user', Auth::user()->name)
                            ->orderby( 'tglkas', 'desc' )
                            ->paginate($this->perpage);
            $this->sumkasmasuk();
            $this->sumkaskeluar();
            $this->saldo();
            } elseif ($this->tipekas=="Masuk") {
                $data = Ev::where('kodekegiatan',$this->postId)
                                ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                                ->where('keterangan', 'like', '%'. $this->search .'%')
                                ->where('user', Auth::user()->name)
                                ->orderby( 'tglkas', 'desc' )
                                ->paginate($this->perpage);

                $summasuk = Ev::where( 'jeniskas', 'Masuk' )->where('user', Auth::user()->name)->sum( 'jumlah' );
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = 0;
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
            }elseif ($this->tipekas=="Keluar") {
                $data = Ev::where('kodekegiatan',$this->postId)
                                ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                                ->where('keterangan', 'like', '%'. $this->search .'%')
                                ->where('user', Auth::user()->name)
                                ->orderby( 'tglkas', 'desc' )
                                ->paginate($this->perpage);

                $summasuk = 0;
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = Ev::where( 'jeniskas', 'Keluar' )->where('user', Auth::user()->name)->sum( 'jumlah' );
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
            }else
            {
                $data = Ev::latest()->where('keterangan', 'like', '%'. $this->search .'%')
                                        ->where('kodekegiatan',$this->postId)
                                        ->where('user', Auth::user()->name)
                                        ->orderby( 'tglkas', 'desc' )
                                        ->paginate($this->perpage);

                $summasuk = Ev::where('kodekegiatan',$this->postId)->where( 'jeniskas', 'Masuk' )->where('user', Auth::user()->name)->sum( 'jumlah' );
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = Ev::where('kodekegiatan',$this->postId)->where( 'jeniskas', 'Keluar' )->where('user', Auth::user()->name)->sum( 'jumlah' );
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
            }
        } else {
                if ($this->tglawal || $this->tglakhir && $this->tipekas) {
                $data = Ev::where('kodekegiatan',$this->postId)
                                ->whereBetween('tglkas', [$this->tglawal, $this->tglakhir])
                                ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                                ->where('keterangan', 'like', '%'. $this->search .'%')
                                ->orderby( 'tglkas', 'desc' )
                                ->paginate($this->perpage);
                $this->sumkasmasuk();
                $this->sumkaskeluar();
                $this->saldo();
            } elseif ($this->tipekas=="Masuk") {
                $data = Ev::where('kodekegiatan',$this->postId)
                                ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                                ->where('keterangan', 'like', '%'. $this->search .'%')
                                ->orderby( 'tglkas', 'desc' )
                                ->paginate($this->perpage);

                $summasuk = Ev::where( 'jeniskas', 'Masuk' )->sum( 'jumlah' );
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = 0;
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
            }elseif ($this->tipekas=="Keluar") {
                $data = Ev::where('kodekegiatan',$this->postId)
                                ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                                ->where('keterangan', 'like', '%'. $this->search .'%')
                                ->orderby( 'tglkas', 'desc' )
                                ->paginate($this->perpage);

                $summasuk = 0;
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = Ev::where( 'jeniskas', 'Keluar' )->sum( 'jumlah' );
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
            }else
            {
                $data = Ev::latest()->where('keterangan', 'like', '%'. $this->search .'%')
                                        ->where('kodekegiatan',$this->postId)
                                        ->orderby( 'tglkas', 'desc' )
                                        ->paginate($this->perpage);

                $summasuk = Ev::where('kodekegiatan',$this->postId)->where( 'jeniskas', 'Masuk' )->sum( 'jumlah' );
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = Ev::where('kodekegiatan',$this->postId)->where( 'jeniskas', 'Keluar' )->sum( 'jumlah' );
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
            }
        }
        


        
        
        $pdf = PDF::loadView('livewire.pdfkegiatan', ['data'=>$data,'summasuk'=>$this->sumkasmasuk,'sumkeluar'=>$this->sumkaskeluar,'saldo'=>$this->saldo, 'tipekas'=>$this->tipekas, 'namaevent'=>$this->namaevent])->output();
 
        return response()->streamDownload(
            fn () => print($pdf),
            "Laporan Kegiatan STT.pdf"
        );
    }
}
