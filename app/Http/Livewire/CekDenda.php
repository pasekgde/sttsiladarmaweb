<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\Validation;
use App\Models\Anggota;
use App\Models\Absensi;

class CekDenda extends Component
{
    public $nama;
    public $denda;
    public $loading = false;
    public $absensi = [];
    public $anjing = false;
    public $statusLunas = false; // Menambahkan properti untuk status lunas
    public $tidakAdaDenda = false;
    public $anggota;

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

        if ($this->absensi->isEmpty()) {
            $this->tidakAdaDenda = true; // Menandakan tidak ada denda
        } else {
            // Menghitung total denda
            $this->totalDenda = $this->absensi->sum('denda'); // Menjumlahkan semua denda

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

