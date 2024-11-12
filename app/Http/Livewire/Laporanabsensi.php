<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TabelKegiatan;
use App\Models\Absensi;
use Livewire\WithPagination;

class Laporanabsensi extends Component
{
    use WithPagination;

    public $perpage =10;
    public $selectedKegiatanId = null; // Untuk menyimpan ID kegiatan yang dipilih
    public $deleteKegiatanId = null; // Menyimpan ID kegiatan untuk dihapus
    
    public function render()
    {
        $tabelkegiatan = TabelKegiatan::orderBy('created_at', 'desc')->paginate($this->perpage);

        $detailPresensi = $this->getDetailPresensi();

        // Menampilkan view dengan data
        return view('livewire.laporanabsensi', [
            'tabelkegiatan' => $tabelkegiatan,
            'detailPresensi' => $this->getDetailPresensi(),
        ]);
    }

    public function getDetailPresensi()
    {
        if (!$this->selectedKegiatanId) {
            return null;
        }

        $kegiatan = TabelKegiatan::with(['absensis.anggota'])->find($this->selectedKegiatanId);

        return $kegiatan ? $kegiatan->absensis->map(function($absensi) {
            return [
                'nama_anggota' => $absensi->anggota->nama,
                'tempek' => $absensi->anggota->tempek,
                'status' => $absensi->anggota->status,
                'presensi' => $absensi->presensi,
                'denda' => $absensi->denda,
            ];
        }) : [];
    }

    
}
