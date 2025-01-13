<?php

namespace App\Http\Livewire;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Livewire\Component;
use App\Models\TabelKegiatan;
use App\Models\Absensi;
use App\Models\Pengurus;
use Livewire\WithPagination;

class Laporanabsensi extends Component
{
    use WithPagination;
    public $pengurus;

    protected $listeners = [ 'deleteconfirm' => 'deletedata'];

    public $selectedKegiatanId = null; // Untuk menyimpan ID kegiatan yang dipilih
    public $deleteKegiatanId = null; // Menyimpan ID kegiatan untuk dihapus
    public $isLoading = false;
    
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
                'nama_anggota' => $absensi->anggota->nama ?? 'Data tidak ditemukan',
                'tempek' => $absensi->anggota->tempek ?? 'Data tidak ditemukan',
                'status' => $absensi->anggota->status ?? 'Data tidak ditemukan',
                'presensi' => $absensi->presensi ?? 'Data tidak ditemukan',
                'denda' => $absensi->denda ?? 'Data tidak ditemukan',
                'statusaksi' => $absensi->status ?? 'Data tidak ditemukan',
                'tanggal_bayar' => $absensi->tanggal_bayar ?? 'Data tidak ditemukan'
            ];
        }) : [];
    }
    
    public function tes()
    {

    }
    public function updatedSelectedKegiatanId()
    {
        if ($this->selectedKegiatanId) {
            // Emit event untuk memicu tampilan modal di frontend
            $this->emit('showModal');
        }
    }

    public function destroydenda( $id ) {
        $this->kegiatan_id = $id;
        $this->emit( 'hapus', [ 'pesan'=>'Yakin Hapus?', 'text'=>'suud hapus nak ilang', 'icon'=>'warning' ] );

    }

    public function deletedata() {
        $kegiatan = TabelKegiatan::find($this->kegiatan_id);
        if ($kegiatan) {
            // Hapus data bayariuran yang terkait dengan idiuran ini
            Absensi::where('idkegiatan', $this->kegiatan_id)->delete();
            
            // Hapus data Iuran
            $kegiatan->delete();
        } else {
            // Emit event jika data tidak ditemukan
            $this->emit('error', ['pesan' => 'Data Iuran tidak ditemukan']);
        }
    }

    public function printabsensi($iuran_id)
        {        
            $namattd =$this->pengurus = Pengurus::first();

            $this->isLoading = true;
            // Find the selected kegiatan by its ID
            $kegiatan = TabelKegiatan::with(['absensis.anggota'])->find($iuran_id);
            
            // Cek jika kegiatan ditemukan
            if (!$kegiatan) {
                return response()->json(['error' => 'Kegiatan tidak ditemukan'], 404);
            }
        
            // Proses data absensi
            $absensiData = $kegiatan->absensis->map(function($absensi) {
                return [
                    'nama_anggota' => $absensi->anggota->nama ?? 'Data tidak ditemukan',
                    'tempek' => $absensi->anggota->tempek ?? 'Data tidak ditemukan',
                    'status' => $absensi->anggota->status ?? 'Data tidak ditemukan',
                    'presensi' => $absensi->presensi ?? 'Data tidak ditemukan',
                    'denda' => $absensi->denda ?? 'Data tidak ditemukan',
                    'statusaksi' => $absensi->status ?? 'Data tidak ditemukan',
                    'tanggal_bayar' => $absensi->tanggal_bayar
                ];
            });
        
            // Generate PDF
            $pdf = PDF::loadView('livewire.pdfabsensi', [
                'kegiatan' => $kegiatan,
                'absensiData' => $absensiData, // Pastikan data absensi dikirim ke view PDF
                'pengurus' => $namattd
            ])->output();
        
            $filename = 'Data_Absensi_STT_' . str_replace(' ', '_', $kegiatan->nama_kegiatan) . '.pdf';
            $this->isLoading = false;
            // Return the PDF as a downloadable file
            return response()->streamDownload(
                fn() => print($pdf),
                $filename
            );
            
        }
    
    
    

}
