<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kas;
use App\Models\Anggota;
use App\Models\Absensi;
use App\Models\Iuran;
use App\Models\Pendataan;
use App\Models\Penikelan;
use App\Models\OutStt;
use App\Models\Kegiatan;
use Auth;


class Dashboard extends Component
{
    public $kasmasuk;
    public $kaskeluar;
    public $saldokas;
    public $anggota;
    public $tabelkegiatan;
    public $iuran;
    public $pendataan;
    public $penikelan;
    public $outstt;

    public $datateskegiatan;

    public $namakeg, $kegmasuk, $kegkeluar, $kegsaldo, $penitia, $bendahara, $sekretaris;

    public $newPendataanNotification = false;

    public function render()
    {
        //data kas
        $this->kasmasuk = Kas::where('jeniskas','=','masuk')->sum('jumlah');
        $this->kaskeluar = Kas::where('jeniskas','=','keluar')->sum('jumlah');
        $this->saldokas = $this->kasmasuk- $this->kaskeluar;
        
        //data anggota
        $this->anggota = Anggota::count();
        $this->pendataan = Pendataan::count();

        // Cek apakah ada data baru di Pendataan
        // $lastPendataan = Pendataan::latest()->first();
        // if ($lastPendataan) {
        //     // Periksa apakah data terbaru lebih baru dari yang sudah ada sebelumnya
        //     if (session()->has('lastPendataanTime') && session('lastPendataanTime') < $lastPendataan->created_at) {
        //         // Jika ada data baru, set notifikasi
        //         $this->newPendataanNotification = true;
        //         session(['lastPendataanTime' => $lastPendataan->created_at]);
        //     } else {
        //         // Set waktu terakhir data Pendataan jika belum ada
        //         session(['lastPendataanTime' => $lastPendataan->created_at]);
        //     }
        // }

        //Denda
        $this->tabelkegiatan = Absensi::where('status','=', 'Belum Bayar')->sum('denda');

        //iuran
        $this->iuran = Iuran::where('status','=','Belum Lengkap')->sum('total_bayar');

        //peniklan
        $datanikel = Penikelan::first();
        if($datanikel->penikelan_denda != 1)
        {
            $this->penikelan = $datanikel->penikelan_denda . ' Kali Tidak Hadir';
        }else
        {
            $this->penikelan = 'Tidak Ada penikelan';
        }

        //out
        $dataoutstt = OutStt::count();
        if($dataoutstt > 0)
        {
            $this->outstt = $dataoutstt. ' Pengajuan';
        }else
        {
            $this->outstt = 'Tidak Ada Data';
        }  
        $user = Auth::user();
        $this->datateskegiatan = Kegiatan::where('status', 'Belum')->get();

        $this->datateskegiatan = $this->datateskegiatan->filter(function ($kegiatan) use ($user) {
            $userIds = json_decode($kegiatan->pengguna, true); // Decode JSON ke array
            return is_array($userIds) && in_array($user->id, $userIds); // Cek apakah ID pengguna ada dalam array
        });
      
        return view('livewire.dashboard');
    }

}
