<?php

namespace App\Http\Livewire;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Livewire\Component;
use App\Models\TabelKegiatan;
use App\Models\Absensi;


use Livewire\WithPagination;

class Laporanabsensi extends Component
{
    use WithPagination;

    public $selectedKegiatanId = null; // Untuk menyimpan ID kegiatan yang dipilih
    public $deleteKegiatanId = null; // Menyimpan ID kegiatan untuk dihapus
    
    public function render()
    {
        $tabelkegiatan = TabelKegiatan::orderBy('created_at', 'desc')->get();

        $detailPresensi = $this->getDetailPresensi();

        $belumBayarCounts = $tabelkegiatan->mapWithKeys(function ($kegiatan) {
            $belumBayarCount = $kegiatan->absensis->filter(function($absensi) {
                return $absensi->status === 'Belum Bayar';
            })->count();
            
            return [$kegiatan->idkegiatan => $belumBayarCount];
        });
    
        return view('livewire.laporanabsensi', [
            'tabelkegiatan' => $tabelkegiatan,
            'detailPresensi' => $this->getDetailPresensi(),
            'belumBayarCounts' => $belumBayarCounts, // Menambahkan data jumlah yang belum bayar
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
                'statusaksi' => $absensi->status,
                'tanggal_bayar' => $absensi->tanggal_bayar
            ];
        }) : [];
    }
    
}
