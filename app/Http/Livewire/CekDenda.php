<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\Validation;
use App\Models\Anggota;
use App\Models\Absensi;
use App\Models\Penikelan;
use App\Models\bayariuran;
use App\Models\Iuran;

class CekDenda extends Component
{
    public $nama;
    public $denda;
    public $loading = false;
    public $absensi = [];
    public $anjing = false;
    public $bangsat = true;
    public $statusLunas = false; // Menambahkan properti untuk status lunas
    public $tidakAdaDenda = false;
    public $anggota;
    public $totalDendaanggota;
    public $nikelanggota;
    public $totaldendaawal;

    public $dataiuran;

    public function cekDenda()
    {
        // Set loading menjadi true
        $this->loading = true;
        $this->denda = null; // Reset denda sebelum pencarian dimulai
        $this->totalDenda = 0;
        $this->statusLunas = false;  // Reset status lunas
        $this->tidakAdaDenda = false; // Reset flag tidak ada denda

        // Simulasi delay untuk loading
        sleep(2); // Simulasikan proses pencarian atau query database

        // Validasi input
        $this->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Mencari anggota berdasarkan nama
        $inputNama = strtoupper($this->nama); // Mengubah input nama menjadi huruf besar
        $this->anggota = Anggota::where('nama', 'like', '%' . $inputNama . '%')->first();

        if ($this->anggota) {
            // Ambil data absensi anggota yang tidak hadir
            $this->absensi = Absensi::with('kegiatan')
                ->where('idanggota', $this->anggota->idanggota)
                ->where('status', 'Belum Bayar')
                ->get();
            $this->totalDenda = $this->absensi->sum('denda');
            $jumlahBelumBayar =$this->absensi->count();

            if ($this->absensi->isEmpty()) {
                $this->tidakAdaDenda = true; // Menandakan tidak ada denda
            } else {
                // Menghitung total denda
                $totalDenda = $this->absensi->sum('denda'); // Menjumlahkan semua denda
                $this->totaldendaawal = $this->totalDenda;

                $datapenikelan = Penikelan::first();
                if (isset($datapenikelan->penikelan_denda) && $jumlahBelumBayar != 1 && $this->penikelandata > 1) {
                    // Jika jumlah absensi yang belum bayar adalah kelipatan dari $this->penikelandata
                    if ($jumlahBelumBayar >= $datapenikelan->penikelan_denda) {
                        // Hitung berapa kali kelipatan dari $penikelandata
                        $nikel = floor($jumlahBelumBayar / $datapenikelan->penikelan_denda);
                        // Kalikan total denda dengan kelipatan 2 per kelipatan
                        $this->totalDendaanggota = $totalDenda * (pow(2, $nikel));
                    }
                }else {
                    $nikel = 0;  // Reset nikel jika kondisi tidak dipenuhi
                    $this->totalDendaanggota = $totalDenda;
                }

                $this->nikelanggota = $nikel;

                // Periksa apakah anggota sudah lunas
                $this->statusLunas = $this->absensi->every(function($absen) {
                    return $absen->is_lunas;  // Cek apakah semua absensi sudah lunas
                });
            }

        } else {
            // Jika anggota tidak ditemukan
            $this->absensi = collect(); // Kosongkan hasil jika anggota tidak ditemukan
        }
        
        $this->anjing =true;
        $this->bangsat =false;
        // Set loading menjadi false setelah pencarian selesai
        $this->loading = false;
    }


    public function resetForm()
    {
        $this->anjing = false;
        $this->nama = '';
        $this->absensi = collect();  // Mengatur menjadi koleksi kosong
        $this->totalDenda = 0;
        $this->statusLunas = false;  // Reset status lunas
        $this->tidakAdaDenda = false; 
    }

    public function render()
    {
        return view('livewire.cek-denda');
    }
    public function redirectToLogin()
    {
        return redirect()->route('login');
    }
}

