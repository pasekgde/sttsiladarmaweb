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
    public $tglawal= null;
    public $tglakhir = null;
    public  $tipekas;
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
        $kegiatan = Keg::where('id', $this->postId)->first();

        if (Auth::user()->status == "Panitia") {
            if (($this->tglawal || $this->tglakhir) && $this->tipekas) {
            $datakas = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)
                            ->whereBetween('tglkas', [$this->tglawal, $this->tglakhir])
                            ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                            ->where('keterangan', 'like', '%'. $this->search .'%')
                            ->orderby( 'tglkas', 'desc' )->paginate($this->perpage);
            $this->sumkasmasuk();
            $this->sumkaskeluar();
            $this->saldo();
            //dd('kondisi 1');
            }
             elseif ($this->tipekas) {
                $datakas = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                                ->where('keterangan', 'like', '%'. $this->search .'%')
                                ->orderby( 'tglkas', 'desc' )->paginate($this->perpage);

                $summasuk = Ev::where( 'jeniskas', 'Masuk' )
                                ->where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->sum( 'jumlah' );
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = Ev::where( 'jeniskas', 'Keluar' )
                                ->where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->sum( 'jumlah' );
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
                //dd('kondisi 2');
            } else
            {
                $datakas = Ev::where('keterangan', 'like', '%'. $this->search .'%')
                                        ->where('kodekegiatan',$kegiatan->kodekegiatan)
                                        ->orderby( 'tglkas', 'desc' )->paginate($this->perpage);

                $summasuk = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->where( 'jeniskas', 'Masuk' )
                                ->where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->sum( 'jumlah' );
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->where( 'jeniskas', 'Keluar' )
                                ->where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->sum( 'jumlah' );
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
                //dd('kondisi 3');
            }
        } else {
            if ($this->tglawal || $this->tglakhir && $this->tipekas) {
            $datakas = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)
                            ->whereBetween('tglkas', [$this->tglawal, $this->tglakhir])
                            ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                            ->where('keterangan', 'like', '%'. $this->search .'%')
                            ->orderby( 'tglkas', 'desc' )->paginate($this->perpage);
            $this->sumkasmasuk();
            $this->sumkaskeluar();
            $this->saldo();
            //dd('kondisi 4');
            }
             elseif ($this->tipekas) {
                $datakas = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                                ->where('keterangan', 'like', '%'. $this->search .'%')
                                ->orderby( 'tglkas', 'desc' )->paginate($this->perpage);

                $summasuk = Ev::where( 'jeniskas', 'Masuk' )->sum( 'jumlah' )
                                ->where('kodekegiatan',$kegiatan->kodekegiatan);
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = Ev::where( 'jeniskas', 'Keluar' )->sum( 'jumlah' )
                                ->where('kodekegiatan',$kegiatan->kodekegiatan);
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
                //dd('kondisi 5');
            } else
            {
                $datakas = Ev::where('keterangan', 'like', '%'. $this->search .'%')
                                        ->where('kodekegiatan',$kegiatan->kodekegiatan)
                                        ->orderby( 'tglkas', 'desc' )
                                        ->paginate($this->perpage);

                $summasuk = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)->where( 'jeniskas', 'Masuk' )->sum( 'jumlah' );
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)->where( 'jeniskas', 'Keluar' )->sum( 'jumlah' );
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
                //dd('kondisi 6');
            }
        }
        
        return view('livewire.levent',compact('datakas'));
    }

    public function sumkasmasuk() {
        $kegiatan = Keg::where('id', $this->postId)->first();
            $sum = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)->whereBetween('tglkas', [$this->tglawal, $this->tglakhir])
                        ->where( 'jeniskas', 'Masuk' )->sum( 'jumlah' );
            $this->sumkasmasuk = currency_IDR( $sum );
        
        
    }

    public function sumkaskeluar() {
        $kegiatan = Keg::where('id', $this->postId)->first();
            $sum = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)->whereBetween('tglkas', [$this->tglawal, $this->tglakhir])
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
        $kegiatan = Keg::where('id', $this->postId)->first();
        
        if (Auth::user()->status == "Panitia") {
            if ($this->tglawal || $this->tglakhir && $this->tipekas) {
            $data = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)
                            ->whereBetween('tglkas', [$this->tglawal, $this->tglakhir])
                            ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                            ->where('keterangan', 'like', '%'. $this->search .'%')
                            ->orderby( 'updated_at', 'desc' )->get();
            $this->sumkasmasuk();
            $this->sumkaskeluar();
            $this->saldo();
            //dd('1');
            } elseif ($this->tipekas=="Masuk") {
                $data = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                                ->where('keterangan', 'like', '%'. $this->search .'%')
                                ->orderby( 'updated_at', 'desc' )->get();

                $summasuk = Ev::where( 'jeniskas', 'Masuk' )
                                ->where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->sum( 'jumlah' );
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = 0;
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
                //dd('2');
            }elseif ($this->tipekas=="Keluar") {
                $data = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                                ->where('keterangan', 'like', '%'. $this->search .'%')
                                ->orderby( 'updated_at', 'desc' )->get();

                $summasuk = 0;
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = Ev::where( 'jeniskas', 'Keluar' )
                                ->where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->sum( 'jumlah' );
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
                //dd('3');
            }else
            {
                $data = Ev::latest()->where('keterangan', 'like', '%'. $this->search .'%')
                                        ->where('kodekegiatan',$kegiatan->kodekegiatan)
                                        ->orderby( 'updated_at', 'desc' )->get();

                $summasuk = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)
                            ->where( 'jeniskas', 'Masuk' )
                            ->where('kodekegiatan',$kegiatan->kodekegiatan)
                            ->sum( 'jumlah' );
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->where( 'jeniskas', 'Keluar' )
                                ->where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->sum( 'jumlah' );
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
                //dd('4');
            }
        } else {
                if ($this->tglawal || $this->tglakhir && $this->tipekas) {
                $data = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->whereBetween('tglkas', [$this->tglawal, $this->tglakhir])
                                ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                                ->where('keterangan', 'like', '%'. $this->search .'%')
                                ->orderby( 'updated_at', 'desc' )->get();
                $this->sumkasmasuk();
                $this->sumkaskeluar();
                $this->saldo();
                //dd('5');
            } elseif ($this->tipekas=="Masuk") {
                $data = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                                ->where('keterangan', 'like', '%'. $this->search .'%')
                                ->orderby( 'updated_at', 'desc' )->get();

                $summasuk = Ev::where( 'jeniskas', 'Masuk' )
                                ->where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->sum( 'jumlah' );
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = 0;
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
                //dd('6');
            }elseif ($this->tipekas=="Keluar") {
                $data = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->where('jeniskas', 'like', '%'. $this->tipekas .'%')
                                ->where('keterangan', 'like', '%'. $this->search .'%')
                                ->orderby( 'updated_at', 'desc' )->get();

                $summasuk = 0;
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = Ev::where( 'jeniskas', 'Keluar' )
                                ->where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->sum( 'jumlah' );
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
                //dd('7');
            }else
            {
                $data = Ev::latest()->where('keterangan', 'like', '%'. $this->search .'%')
                                        ->where('kodekegiatan',$kegiatan->kodekegiatan)
                                        ->orderby( 'updated_at', 'desc' )->get();

                $summasuk = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->where( 'jeniskas', 'Masuk' )
                                ->where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->sum( 'jumlah' );
                        $this->sumkasmasuk = currency_IDR( $summasuk );
                
                $sumkeluar = Ev::where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->where('kodekegiatan',$kegiatan->kodekegiatan)
                                ->where( 'jeniskas', 'Keluar' )->sum( 'jumlah' );
                        $this->sumkaskeluar = currency_IDR( $sumkeluar );
                $this->saldo();
                //dd('8');
            }
        }
        


        
        
        $pdf = PDF::loadView('livewire.pdfkegiatan', ['pengurus' => $kegiatan,'data'=>$data,'summasuk'=>$this->sumkasmasuk,'sumkeluar'=>$this->sumkaskeluar,'saldo'=>$this->saldo, 'tipekas'=>$this->tipekas, 'namaevent'=>$this->namaevent])->output();
        $filename = 'Panitia Kegiatan  - ' . str_replace(' ', '_', $kegiatan->namakegiatan) . '.pdf';
        return response()->streamDownload(
            fn () => print($pdf),
            $filename
        );
    }
}
