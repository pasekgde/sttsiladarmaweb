<?php

namespace App\Http\Livewire;
use App\Models\Anggota;
use App\Models\TabelKegiatan;
use App\Models\Absensi;
use App\Helpers\AutoNumber;
use App\Models\Kas;
use App\Models\Penikelan;
use Alert;
use Auth;

use Livewire\Component;

class Denda extends Component
{
    protected $listeners = ['bayar', 'pesanhitungconfirm' => 'simpanPenikelan'];
    public $selectedAnggotaId = null;
    public $anggota;
    public $anggotaData;
    public $totalDendaanggota;
    public $penikelandata;
    public $showHitungButton = false;
    public $datapenikelan;
    public $totaldendaawal;
    public $nikelanggota;

    public function mount()
    {
        // Ambil data dari tabel Penikelan, misalnya hanya mengambil data dengan id = 1
        $this->datapenikelan = Penikelan::first(); // Ambil data pertama atau ganti dengan kondisi yang tepat

        // Jika ada data, set nilai penikelandata
        if ($this->datapenikelan) {
            $this->penikelandata = $this->datapenikelan->penikelan_denda;
        }
    }

    public function render()
    {
        // // Ambil data anggota dan hitung absensi yang belum bayar
        // $this->anggotaData = Anggota::with(['absensis' => function($query) {
        //     $query->where('status', 'Belum Bayar'); // Hanya absensi dengan status Belum Bayar
        // }])->get()->map(function($anggota) {
        //     // Hitung jumlah absensi yang belum bayar
        //     $jumlahBelumBayar = $anggota->absensis->count();
        //     // Hitung total denda untuk absensi yang belum bayar
        //     $totalDenda = $anggota->absensis->sum('denda');

        //     return [
        //         'idanggota' => $anggota->idanggota,
        //         'nama_anggota' => $anggota->nama,
        //         'tempek' => $anggota->tempek,
        //         'status' => $anggota->status,
        //         'jumlah_belum_bayar' => $jumlahBelumBayar,
        //         'total_denda' => $totalDenda,
        //     ];
        // });

        //     // Hitung total denda keseluruhan
        // $totalDendaKeseluruhan = $this->anggotaData->sum('total_denda');
        
        // Inisialisasi variabel $nikel di luar map
        
        $nikel = 0;

        // Ambil data anggota dan hitung absensi yang belum bayar
        $this->anggotaData = Anggota::with(['absensis' => function($query) {
            $query->where('status', 'Belum Bayar'); // Hanya absensi dengan status Belum Bayar
        }])->get()->map(function($anggota) use (&$nikel) {
            // Hitung jumlah absensi yang belum bayar
            $jumlahBelumBayar = $anggota->absensis->count();
            
            // Hitung total denda untuk absensi yang belum bayar
            $totalDenda = $anggota->absensis->sum('denda');
            
            // Periksa jika $this->penikelandata sudah terdefinisi dan valid
            if (isset($this->penikelandata) && $jumlahBelumBayar >= $this->penikelandata && $this->penikelandata > 1) {
                // Jika jumlah absensi yang belum bayar adalah kelipatan dari $this->penikelandata
                if ($jumlahBelumBayar >= $this->penikelandata) {
                    // Hitung berapa kali kelipatan dari $penikelandata
                    $nikel = floor($jumlahBelumBayar / $this->penikelandata);
                    // Kalikan total denda dengan kelipatan 2 per kelipatan
                    $totalDenda = $totalDenda * (pow(2, $nikel));
                }
            }else {
                $nikel = 0;  // Reset nikel jika kondisi tidak dipenuhi
            }
            
            // Kembalikan data yang sudah dihitung
            return [
                'idanggota' => $anggota->idanggota,
                'nama_anggota' => $anggota->nama,
                'tempek' => $anggota->tempek,
                'status' => $anggota->status,
                'jumlah_belum_bayar' => $jumlahBelumBayar,
                'nikel' => $nikel,
                'total_denda' => $totalDenda,
            ];
        });

        // Hitung total denda keseluruhan
        $totalDendaKeseluruhan = $this->anggotaData->sum('total_denda');

        // Return view dengan data yang sudah dihitung
        return view('livewire.denda', [
            'anggotaData' => $this->anggotaData,
            'totalDendaKeseluruhan' => $totalDendaKeseluruhan, // Pass total denda keseluruhan ke view
        ]);
    }

    public function pesanhitung() {
        $this->emit( 'pesanhitung', [ 'pesan'=>'Yakin Rubah Penikelan?', 'text'=>'Data akan dihitung ulang', 'icon'=>'warning' ] );

    }

    public function showHitungButton()
    {
        $this->datapenikelan = Penikelan::first();
        // Tombol Hitung muncul jika penikelandata berubah
        $this->showHitungButton = $this->penikelandata != null && $this->penikelandata != $this->datapenikelan->penikelan_denda;
    }

    public function simpanPenikelan()
    {
        // Update atau buat entri baru dengan id = 1
        $penikelan = Penikelan::updateOrCreate(
            ['id' => 1],
            ['penikelan_denda' => $this->penikelandata]
        );

        $this->datapenikelan = Penikelan::first();

        // Menyembunyikan tombol Hitung setelah penyimpanan
        $this->showHitungButton = false;

        // Emit success message
        //$this->emit('success', ['pesan' => 'Data Berhasil Diupdate']);
    }


    // Metode untuk menampilkan detail absensi
    public function viewModal($anggotaId)
    {
        $nikel = 0;
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
        $this->totaldendaawal = $totalDenda;

        $jumlahBelumBayar = $this->anggota->absensis->where('status', 'Belum Bayar')->count();
        
        // Menyimpan total denda ke dalam variabel atau properti kelas   
        if (isset($this->penikelandata) && $jumlahBelumBayar != 1 && $this->penikelandata > 1) {
            // Jika jumlah absensi yang belum bayar adalah kelipatan dari $this->penikelandata
            if ($jumlahBelumBayar >= $this->penikelandata) {
                // Hitung berapa kali kelipatan dari $penikelandata
                $nikel = floor($jumlahBelumBayar / $this->penikelandata);
                // Kalikan total denda dengan kelipatan 2 per kelipatan
                $this->totalDendaanggota = $totalDenda * (pow(2, $nikel));
            }
        }else {
            $nikel = 0;  // Reset nikel jika kondisi tidak dipenuhi
            $this->totalDendaanggota = $totalDenda;
        }

        $this->nikelanggota = $nikel;


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
