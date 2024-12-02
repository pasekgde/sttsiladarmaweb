<?php

namespace App\Http\Livewire;
use App\Models\Anggota;
use App\Models\TabelKegiatan;
use App\Models\Absensi;
use App\Helpers\AutoNumber;
use App\Models\Kas;
use Alert;
use Auth;

use Livewire\Component;

class Denda extends Component
{
    protected $listeners = ['bayar'];
    public $selectedAnggotaId = null;
    public $anggota;
    public $anggotaData;
    public $totaldendaanggota;

    public function render()
    {
        // Ambil data anggota dan hitung absensi yang belum bayar
        $this->anggotaData = Anggota::with(['absensis' => function($query) {
            $query->where('status', 'Belum Bayar'); // Hanya absensi dengan status Belum Bayar
        }])->get()->map(function($anggota) {
            // Hitung jumlah absensi yang belum bayar
            $jumlahBelumBayar = $anggota->absensis->count();
            // Hitung total denda untuk absensi yang belum bayar
            $totalDenda = $anggota->absensis->sum('denda');

            return [
                'idanggota' => $anggota->idanggota,
                'nama_anggota' => $anggota->nama,
                'tempek' => $anggota->tempek,
                'status' => $anggota->status,
                'jumlah_belum_bayar' => $jumlahBelumBayar,
                'total_denda' => $totalDenda,
            ];
        });

            // Hitung total denda keseluruhan
        $totalDendaKeseluruhan = $this->anggotaData->sum('total_denda');

        return view('livewire.denda', [
            'anggotaData' => $this->anggotaData,
            'totalDendaKeseluruhan' => $totalDendaKeseluruhan, // Pass total denda keseluruhan ke view
        ]);
    }

    // Metode untuk menampilkan detail absensi
    public function viewModal($anggotaId)
    {
        $this->selectedAnggotaId = $anggotaId;

        $this->anggota = Anggota::with(['absensis' => function($query) {
            $query->select('absensis.*')
                  ->join('tabel_kegiatans', 'absensis.idkegiatan', '=', 'tabel_kegiatans.idkegiatan')
                  ->orderBy('tabel_kegiatans.created_at', 'desc');
                  //->where('absensis.status', 'Belum Bayar');
        }])->find($this->selectedAnggotaId);

        $totalDenda = $this->anggota->absensis->filter(function ($absensi) {
            return $absensi->status === 'Belum Bayar'; // Memfilter absensi yang statusnya 'Belum Bayar'
        })->sum('denda'); // Menjumlahkan denda dari absensi yang terfilter

        // Menyimpan total denda ke dalam variabel atau properti kelas
        $this->totaldendaanggota = $totalDenda;

        // Emit event untuk menampilkan modal
        $this->emit('showModal');
    }

    public function bayar($anggotaId)
    {
        // Proses pembayaran (update status absensi menjadi Lunas)
        Absensi::where('idanggota', $anggotaId)
            ->where('status', 'Belum Bayar')
            ->update(['status' => 'Lunas', 'tanggal_bayar' => now()]);

        $namaanggota = Anggota::findOrFail($anggotaId)->nama;

        $totalDenda = $this->anggotaData->sum('total_denda');

        //proses menyimpan ke kas masuk
        Kas::create( [
            'kodekas' => $this->kodeKas(),
            'jeniskas' => 'Masuk',
            'tglkas' => date( 'Y-m-d', strtotime( now() ) ),
            'keterangan' => 'Pembayaran Denda ' . $namaanggota,
            'qty' => '-',
            'harga' => currencyIDRToNumeric( 0 ),
            'jumlah' => currencyIDRToNumeric( $totalDenda ),
            'user' => $this->operator(),
        ] );
        Alert::success('Success', 'PEMBAYARAN DENDA BERHASIL');
        return redirect()->route('formdenda');

    }  

    public function kodeKas() {
        $table = 'kas';
        $primary = 'kodekas';
        $prefix = 'KIN';
        $temp = 'jeniskas';
        $temps = 'Masuk';
        $kodeKasin = Autonumber::autonumber( $table, $primary, $prefix, $temp, $temps );
        return $kodeKasin;
    }

    public function operator() {
        $operator = Auth::user()->name;
        return $operator;
    }
    
}
