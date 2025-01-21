<?php

namespace App\Http\Livewire;
use App\Models\Anggota;
use App\Models\OutStt as Dataout;
use App\Models\bayariuran;
use App\Models\Absensi;
Use App\Models\Pengurus;
use App\Models\Sisteminfo as SI;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Alumni;


use Livewire\Component;

class Outstt extends Component
{
    public $anggotaId;
    public $anggotaName;
    public $tanggalLahir;
    public $pekerjaan;
    public $tempek;  // Tambahkan properti ini
    public $status;
    public $alasanKeluar;
    public $bayarIuran;
    public $bayarDenda;
    public $tangkapid;
    public $dataid;

    protected $listeners = [ 'setujuconfirm' => 'setuju', 'yakindestoyconfirm' => 'destoy' ];

    /// Pagination and search properties
    public $search = '';
    public $perPage = 10;

    public function updatedAnggotaId($anggotaId)
    {
        // Mengambil data anggota berdasarkan ID
        $anggota = Anggota::find($anggotaId);

        // Mengisi form dengan data anggota yang dipilih
        $this->anggotaName = $anggota->nama;
        $this->tanggalLahir = $anggota->tgllahir;
        $this->pekerjaan = $anggota->pekerjaan;
        $this->tempek = $anggota->tempek;  // Pastikan tempek juga di-set
        $this->status = $anggota->status;
    }

    public function store()
    {
        $this->validate([
            'anggotaId' => 'required',
            'anggotaName' => 'required',
            'tanggalLahir' => 'required',
            'pekerjaan' => 'required',
            'tempek' => 'required',  // Pastikan validasi ini ada
            'status' => 'required',
            'alasanKeluar' => 'required'
        ]);

        Dataout::create([
            'idanggota' => $this->anggotaId,
            'nama' => $this->anggotaName,
            'tgllahir' => $this->tanggalLahir,
            'pekerjaan' => $this->pekerjaan,
            'tempek' => $this->tempek,  // Menyimpan tempek ke database
            'status' => $this->status,
            'alasankeluar' => $this->alasanKeluar
        ]);

        $this->emit('berhasil');
    }

    public function render()
{
    $anggotaList = Anggota::all();
    $out = Dataout::where('nama', 'like', '%' . $this->search . '%')
                    ->orderBy('created_at', 'desc')
                    ->paginate($this->perPage); // Ambil semua data iuran

    foreach ($out as $outItem) {
        // Cek status iuran dan denda
        $outItem->dendaStatus = $this->checkDendaStatus($outItem->idanggota);
        $outItem->iuranStatus = $this->checkiuranStatus($outItem->idanggota);

        // Logika yang Anda inginkan:
        if ($outItem->dendaStatus == 'true' && $outItem->iuranStatus == 'true') {
            // Jika keduanya statusnya 'true', maka statusKeluar menjadi 'true'
            $outItem->statusKeluar = 'true';
        } else {
            // Jika salah satu atau keduanya statusnya bukan 'true', maka statusKeluar menjadi 'false'
            $outItem->statusKeluar = 'false';
        }
    }

    return view('livewire.outstt', [
        'anggotaList' => $anggotaList,
        'out' => $out
    ]);
}

    public function checkiuranStatus($anggotaId)
    {
        // Cek apakah ada iuran yang statusnya 'belum' untuk anggota ini
        $this->bayarIuran = bayariuran::where('idanggota', $anggotaId)->where('statusbayar', 'Belum Bayar')->first();

        if ($this->bayarIuran) {
            return 'false';
        }

        return 'true';
    }


    public function checkDendaStatus($anggotaId)
    {
        // Cek apakah ada iuran yang statusnya 'belum' untuk anggota ini
        $this->bayarDenda = Absensi::where('idanggota', $anggotaId)->where('status', 'Belum Bayar')->first();

        if ($this->bayarDenda) {
            return 'false';
        }

        return 'true';
    }

    public function printout($anggotaId)
    {
        $this->isLoading = true;

        // Get the iuran record
        $namattd =$this->pengurus = Pengurus::first();

        $iuran = bayariuran::where('idanggota', $anggotaId)
                    ->join('iuran', 'bayariuran.idiuran', '=', 'iuran.idiuran')
                   ->where('statusbayar', 'Belum Bayar')
                   ->get();
        $sumiuran = $iuran->sum('jumlah'); 
        
        $denda = Absensi::where('idanggota', $anggotaId)
                    ->join('tabel_kegiatans', 'absensis.idkegiatan', '=', 'tabel_kegiatans.idkegiatan')
                   ->where('status', 'Belum Bayar')
                   ->get();
        $sumdenda = $denda->sum('denda'); 

        $anggota = Anggota::find($anggotaId);


        $data =SI::all();


        // Load the PDF view with the necessary data
        $pdf = PDF::loadView('livewire.pdfout', [
            'iuran' => $iuran,
            'denda' => $denda,
            'anggota' => $anggota,
            'pengurus' => $namattd,
            'sumdenda' => $sumdenda,
            'sumiuran' => $sumiuran
        ])->output();

        $filename = 'Surat Tunggakan- ' . str_replace(' ', '_', $anggota->nama) . '.pdf';
        $this->isLoading = false;
        // Return the PDF as a downloadable file
        return response()->streamDownload(
            fn() => print($pdf),
            $filename
        );
    }

    public function prinpengajuan($anggotaId)
    {
        $this->isLoading = true;

        // Get the iuran record
        $namattd =$this->pengurus = Pengurus::first();

        $dataout = Dataout::where('idanggota', $anggotaId)->first();

        $data =SI::all();

        $iuran = bayariuran::where('idanggota', $anggotaId)
                    ->join('iuran', 'bayariuran.idiuran', '=', 'iuran.idiuran')
                   ->where('statusbayar', 'Belum Bayar')
                   ->get();
        $sumiuran = $iuran->sum('jumlah'); 
        
        $denda = Absensi::where('idanggota', $anggotaId)
                    ->join('tabel_kegiatans', 'absensis.idkegiatan', '=', 'tabel_kegiatans.idkegiatan')
                   ->where('status', 'Belum Bayar')
                   ->get();
        $sumdenda = $denda->sum('denda'); 


        // Load the PDF view with the necessary data
        $pdf = PDF::loadView('livewire.pdfpengajuan', [
            'anggota' => $dataout,
            'pengurus' => $namattd,
            'dataout' => $dataout,
            'iuran' => $iuran,
            'denda' => $denda,
            'sumdenda' => $sumdenda,
            'sumiuran' => $sumiuran
        ])->output();

        $filename = 'Surat Keluar Anggota- ' . str_replace(' ', '_', $dataout->nama) . '.pdf';
        $this->isLoading = false;
        // Return the PDF as a downloadable file
        return response()->streamDownload(
            fn() => print($pdf),
            $filename
        );
    }

    public function yakinsetuju($anggotaId)
    {
        $this->dataid = $anggotaId;
        $this->tanggapid =Anggota::find($anggotaId);
        $this->emit( 'yakinsetuju', [ 'pesan'=>'Apakah Yakin?', 'text'=>'data akan dipindahkan ke alumni', 'icon'=>'warning' ] );
    }

    public function setuju()
    {
        // Gunakan $this->dataid untuk mengakses ID anggota
        $dataout = Dataout::where('idanggota', $this->dataid)->first();

        Alumni::create([
            'idanggota' => $this->tanggapid->idanggota,
            'nama' => $this->tanggapid->nama,
            'tgllahir' => $this->tanggapid->tgllahir,
            'tempek' => $this->tanggapid->tempek,
            'alasan' => $dataout->alasankeluar,
        ]);

        // Update status anggota menjadi 'Alumni'
        $dataout->statusanggota = 'Alumni';
        $dataout->update();

        // Hapus data anggota yang sudah keluar
        Anggota::find($this->dataid)->delete();

        // Emit success message
        $this->emit('success', ['pesan' => 'Data Tersimpan']);
    }

    public function dstroyconfirm($anggotaId)
    {
        $this->dataid = $anggotaId;
        $this->tanggapid = Dataout::where('idanggota', $this->dataid)->first();
        $this->emit( 'hapus', [ 'pesan'=>'Yakin hapus?', 'text'=>'data tidak berpengaruh ke Alumni', 'icon'=>'warning' ] );
    }

    public function destoy()
    {
        $this->tanggapid->delete();
    }


}
