<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TabelKegiatan;
use Illuminate\Support\Str;
use Auth;
use Carbon\Carbon;
use App\Models\Anggota;
use App\Models\Absensi as Presensis;
use Illuminate\Support\Facades\DB;

class Absensi extends Component
{
    public $tanggal_kegiatan;
    public $nama_kegiatan;
    public $jenis_kegiatan;
    public $denda;
    public $keterangan;

    public $dataanggota = [];

    public $idkegiatan = [];
    public $idanggota  = [];
    public $presensi   = [];

    public $totalAnggota = 0;
    public $totalHadir = 0;
    public $totalTidakHadir = 0;
    public $totalDenda = 0;

    public $isLoading = false;


    //wizard
    public $currentStep = 1;

    public function mount()
    {
        $this->dataanggota = Anggota::all(); // Ambil data anggota
        foreach ($this->dataanggota as $index => $anggota) {
            $this->presensi[$index] = 'Hadir'; // Set default value to 'Hadir'
        }
    }

    public function render()
    {
        $this->dataanggota = Anggota::all();
        return view('livewire.absensi',['dataanggota'=> $this->dataanggota]);
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'tanggal_kegiatan' => 'required',
            'nama_kegiatan' => 'required|string|max:255',
            'jenis_kegiatan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);
        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->validate([
            'presensi' => 'required|array',
        ]);

        // Reset hitungan sebelum mulai menghitung
        $this->totalAnggota = 0;
        $this->totalHadir = 0;
        $this->totalTidakHadir = 0;
        $this->totalDenda = 0;

        // Hitung total anggota, hadir, tidak hadir, dan total denda
        foreach ($this->presensi as $index => $status) {
            $this->totalAnggota++;
            if ($status == 'Hadir') {
                $this->totalHadir++;
            } else {
                $this->totalTidakHadir++;
            }
            // Anggap denda yang terkait dengan presensi yang tidak hadir
            $this->totalDenda += ($status == 'Hadir') ? 0 : currencyIDRToNumeric($this->denda);
        }

        $this->currentStep = 3;
    }

    public function submitForm()
    {
        $this->isLoading = true;

        $tabelkegiatan = TabelKegiatan::create( [
            'tanggal_kegiatan' => $this->tanggal_kegiatan ,
            'nama_kegiatan' => $this->nama_kegiatan,
            'jenis_kegiatan' => $this->jenis_kegiatan,
            'denda' => currencyIDRToNumeric( $this->denda ),
            'total_denda' =>currencyIDRToNumeric($this->totalDenda),
            'total_anggota' => $this->totalAnggota,
            'total_hadir' => $this->totalHadir,
            'total_tidak_hadir' => $this->totalTidakHadir,
            'keterangan' => Str::ucfirst( $this->keterangan ),
            'user' => $this->operator(),
        ] );
        

        foreach ($this->dataanggota as $index => $value) {
            // Tentukan denda berdasarkan pilihan presensi
            $denda = ($this->presensi[$index] == 'Hadir') ? 0 : currencyIDRToNumeric($this->denda);

            // Tentukan status berdasarkan pilihan presensi
            $status = ($this->presensi[$index] == 'Hadir') ? '-' : 'Belum Bayar';

            // Simpan data ke Presensis
            Presensis::create([
                'idanggota' => $value['idanggota'],
                'idkegiatan' => $tabelkegiatan->idkegiatan,
                'presensi' => $this->presensi[$index],
                'denda' => $denda, // Gunakan nilai denda yang sudah dihitung
                'status' => $status, // Menyimpan status berdasarkan presensi
            ]);
        }
        $this->isLoading = false;
        $this->emit( 'successabsensi', [ 'pesan'=>'Absensi Sudah Tersimpan' ] );
        $this->clearForm();
        $this->denda  = str_replace(['Rp', '.', ' '], '', $this->denda);
    }

    public function printAbsensi()
    {
        // Format tanggal yang diinput
    $this->tanggal_kegiatan = date('Y-m-d', strtotime($this->tanggal_kegiatan));

    // Ambil data absensi berdasarkan tanggal yang diinput
    $dataanggota = DB::table('absensis')
                ->join('anggota', 'absensis.idanggota', '=', 'anggota.idanggota')
                ->join('tabel_kegiatans', 'absensis.idkegiatan', '=', 'tabel_kegiatans.idkegiatan')
                ->where('tabel_kegiatans.tanggal_kegiatan', $this->tanggal_kegiatan)
                ->select(
                    'tabel_kegiatans.tanggal_kegiatan',
                    'anggota.nama',
                    'anggota.tempek',
                    'anggota.status',
                    'absensis.presensi',
                    'tabel_kegiatans.denda'
                )
                ->get();
                dd($this->tanggal_kegiatan);

                // Simpan data absensi dan informasi lainnya ke session
                // session()->put('absensi_data', [
                //     'tanggal_kegiatan' => $tanggal_kegiatan,
                //     'nama_kegiatan' => $this->nama_kegiatan,
                //     'jenis_kegiatan' => $this->jenis_kegiatan,
                //     'denda' => $this->denda,
                //     'keterangan' => $this->keterangan,
                // ]);

                // Redirect ke route yang sesuai setelah menyimpan data di session
                return redirect()->route('print.absensi');
    }



    public function back($step)
    {
        $this->currentStep = $step;
    }

  


    






















    
   

    public function clearForm() {
        $this->tanggal_kegiatan = '';
        $this->nama_kegiatan = '';
        $this->jenis_kegiatan = '';
        $this->denda = '';
        $this->keterangan = '';
    }

    public function operator() {
        $operator = Auth::user()->name;
        return $operator;
    }
    
}
