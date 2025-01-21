<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Iuran;
use App\Models\Anggota;
use App\Models\bayariuran;
use App\Models\Kas;
use App\Helpers\AutoNumber;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Auth;
use App\Models\Pengurus;
use App\Models\Sisteminfo as SI;
use Illuminate\Support\Facades\Storage;

class Iuranwajib extends Component
{
    public $perihal;
    public $jumlah;
    public $status = 'Belum Lengkap'; // default status
    public $tanggal_buat;
    public $iuran_id; // Untuk update
    public $paymentAmount; // Jumlah pembayaran yang dimasukkan
    public $anggota = []; // Data anggota yang terkait dengan iuran
    public $jumlahbayar;
    public $bayariuran =[];
    public $modal_title;
    public $data;
    public $tombolbatal;
    public $isLoading = false;

     /// Pagination and search properties
     public $search = '';
     public $perPage = 10;
    
    //delete
    protected $listeners = [ 'deleteconfirm' => 'deletedata', 'kirimkekasinconfirm' => 'kirimkekasin' ];


    public function render()
    {
        $iurans = Iuran::where('perihal', 'like', '%' . $this->search . '%') // Search functionality
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage); // Ambil semua data iuran
        return view('livewire.iuranwajib', compact('iurans'));
    }

    public function store()
    {
        $this->validate([
            'perihal' => 'required|string|max:255',
            'jumlah' => 'required|min:1',
        ]);

        $jmlanggota = Anggota::count();

        $jumlah = str_replace([',', '.'], '', $this->jumlah);

        $iuran = Iuran::create([
            'perihal' => $this->perihal,
            'jumlah' => $jumlah,
            'total_iuran' => $jumlah * $jmlanggota,
            'total_anggota' => $jmlanggota,
            'total_yangsudahbayar' => 0,
            'total_yangbelumbayar' => $jmlanggota,
            'status' => $this->status,
            'tanggal_buat' => $this->tanggal_buat,
            'total_bayar' => 0
        ]);

        // Insert data untuk setiap anggota dengan status 'Belum Bayar'
        $anggotaList = Anggota::all();
        foreach ($anggotaList as $anggota) {
            // Simpan record iuran untuk masing-masing anggota
            bayariuran::create([
                'idanggota' => $anggota->idanggota,
                'idiuran' => $iuran->idiuran, // id iuran yang baru saja dibuat
                'statusbayar' => 'Belum Bayar',
                'jumlahbayar' => 0,
            ]);
        }

        $this->kembalikan();
        $this->emit('closeModal');
        $this->emit( 'successiuran', [ 'pesan'=>'Iuran Berhasil Dibuat' ] );
    }

    public function destroypesan( $id ) {
        $this->iuran_id = $id;
        $this->emit( 'hapus', [ 'pesan'=>'Yakin Hapus?', 'text'=>'suud hapus nak ilang', 'icon'=>'warning' ] );

    }

    public function deletedata() {
        $iuran = Iuran::find($this->iuran_id);
        if ($iuran) {
            // Hapus data bayariuran yang terkait dengan idiuran ini
            bayariuran::where('idiuran', $this->iuran_id)->delete();
            
            // Hapus data Iuran
            $iuran->delete();
        } else {
            // Emit event jika data tidak ditemukan
            $this->emit('error', ['pesan' => 'Data Iuran tidak ditemukan']);
        }
    }

    // Method untuk menampilkan modal pembayaran
    public function showPaymentModal($iuran_id)
    {
        $this->iuran_id = $iuran_id;
        
        // Ambil data iuran yang dipilih
        $iuran = Iuran::find($this->iuran_id);

        //data untuk tombol
        $this->tombolbatal = $iuran;

        $this->jumlahbayar = $iuran->jumlah;

        $this->modal_title = $iuran->perihal;

        // Ambil data anggota yang harus membayar iuran ini
        $this->bayariuran = bayariuran::where('bayariuran.idiuran', $this->iuran_id)
            ->join('anggota', 'bayariuran.idanggota', '=', 'anggota.idanggota') // Menghubungkan dengan tabel anggota
            ->select('anggota.idanggota','anggota.nama', 'iuran.jumlah as jumlah_iuran', 'bayariuran.jumlahbayar', 'bayariuran.tanggalbayar', 'bayariuran.statusbayar') // Pilih data yang ingin ditampilkan
            ->join('iuran', 'bayariuran.idiuran', '=', 'iuran.idiuran') // Menghubungkan dengan tabel iuran
            ->get();
    

        // Emit event untuk membuka modal pembayaran
        $this->emit('openPaymentModal');
    }

    public function pay($anggota_id)
    {
        // Ambil data anggota berdasarkan ID
        $anggota = Anggota::find($anggota_id);

        // Cek apakah anggota ada
        if (!$anggota) {
            // Jika anggota tidak ditemukan, kirim error atau lakukan penanganan lainnya
            return;
        }

        // Cari record Bayariuran berdasarkan idiuran dan idanggota
        $bayariuran = bayariuran::where('idiuran', $this->iuran_id)
                                ->where('idanggota', $anggota_id)
                                ->first();

        // Pastikan record Bayariuran ditemukan
        if (!$bayariuran) {
            // Jika tidak ada record, kirim error atau penanganan lainnya
            return;
        }

        // Update status dan data pembayaran pada Bayariuran
        $bayariuran->jumlahbayar = $this->jumlahbayar;
        $bayariuran->tanggalbayar = Now();
        $bayariuran->statusbayar = "Terbayar";
        $bayariuran->save();  // Simpan perubahan

        // Ambil data Iuran berdasarkan ID
        $dataiuran = Iuran::find($this->iuran_id);
        
        // Pastikan data Iuran ada
        if (!$dataiuran) {
            // Jika data Iuran tidak ditemukan, kirim error atau penanganan lainnya
            return;
        }

        // Perbarui jumlah yang sudah dibayar
        $dataiuran->total_yangsudahbayar += 1;

        // Kurangi jumlah anggota yang belum membayar
        $dataiuran->total_yangbelumbayar -= 1;

        // Cek apakah semua anggota sudah membayar
        if ($dataiuran->total_yangbelumbayar == 0) {
            // Update status menjadi 'Lengkap' jika semua anggota sudah membayar
            $dataiuran->status = 'Lengkap';
        }

        // Tambahkan jumlah bayar ke total yang sudah dibayar
        $dataiuran->total_bayar += $this->jumlahbayar;

        // Simpan perubahan pada data Iuran
        $dataiuran->save();
        $this->showPaymentModal($this->iuran_id);
        
    }

    public function cancelPayment($anggota_id)
    {
        // Ambil data anggota berdasarkan ID
        $anggota = Anggota::find($anggota_id);

        // Cek apakah anggota ada
        if (!$anggota) {
            // Jika anggota tidak ditemukan, kirim error atau lakukan penanganan lainnya
            return;
        }

        // Cari record Bayariuran berdasarkan idiuran dan idanggota
        $bayariuran = bayariuran::where('idiuran', $this->iuran_id)
                                ->where('idanggota', $anggota_id)
                                ->first();

        // Pastikan record Bayariuran ditemukan
        if (!$bayariuran) {
            // Jika tidak ada record, kirim error atau penanganan lainnya
            return;
        }

        // Update status dan data pembayaran pada Bayariuran
        $bayariuran->jumlahbayar = 0;
        $bayariuran->tanggalbayar = null;
        $bayariuran->statusbayar = "Belum Bayar";
        $bayariuran->save();  // Simpan perubahan

        // Ambil data Iuran berdasarkan ID
        $dataiuran = Iuran::find($this->iuran_id);
        
        // Pastikan data Iuran ada
        if (!$dataiuran) {
            // Jika data Iuran tidak ditemukan, kirim error atau penanganan lainnya
            return;
        }

        // Perbarui jumlah yang sudah dibayar
        $dataiuran->total_yangsudahbayar -= 1;

        // Kurangi jumlah anggota yang belum membayar
        $dataiuran->total_yangbelumbayar += 1;

            // Update status menjadi 'Lengkap' jika semua anggota sudah membayar
            $dataiuran->status = ($dataiuran->total_yangbelumbayar > 0) ? 'Belum Lengkap' : 'Lengkap';


        // Tambahkan jumlah bayar ke total yang sudah dibayar
        $dataiuran->total_bayar -= $this->jumlahbayar;

        // Simpan perubahan pada data Iuran
        $dataiuran->save();
        $this->showPaymentModal($this->iuran_id);
        
    }

    public function yakinkirimkekasin($iuran_id)
    {
        // Mencari data iuran berdasarkan ID yang diberikan
        $this->data = Iuran::find($iuran_id);

        // Jika data iuran tidak ditemukan, emit error dan return
        if (!$this->data) {
            $this->emit('error', ['pesan' => 'Data Iuran tidak ditemukan.']);
            return;
        }

        if ($this->data->status == 'Terkirim ke Kas') {
            $this->emit('error', ['pesan' => 'Iuran sudah Terkirim sebelumnya, tidak bisa dikirim ke kas.']);
            return;
        }

        // Emit konfirmasi untuk kirim data ke kas
        $this->emit('kasin', [
            'pesan' => 'Yakin Kirim Ke KASIN?',
            'text' => 'Setelah kirim data, anda tidak bisa melakukan pembayaran pada Iuran ini',
            'icon' => 'warning'
        ]);
    }

    public function kirimkekasin()
    {
        // Pastikan bahwa data iuran valid sebelum diproses
        if (!$this->data) {
            $this->emit('error', ['pesan' => 'Data Iuran tidak ditemukan.']);
            return;
        }

        // Validasi bahwa total pembayaran sudah sesuai dengan yang harus dikirim ke kas
        if ($this->data->total_bayar <= 0) {
            $this->emit('error', ['pesan' => 'Tidak ada pembayaran yang dilakukan, tidak dapat mengirim ke kas.']);
            return;
        }

        // Membuat transaksi kas
        Kas::create([
            'kodekas' => $this->kodeKas(),
            'jeniskas' => 'Masuk',  // Jenis kas adalah 'Masuk'
            'tglkas' => date('Y-m-d', strtotime(now())), // Tanggal transaksi kas
            'keterangan' => Str::ucfirst(
                ($this->data->perihal ?? '') . ' Sebanyak : ' . ($this->data->total_yangsudahbayar ?? 0) . ' Anggota'
            ),
            'qty' => '-',  // Tidak ada kuantitas
            'harga' => 0,  // Tidak ada harga
            'jumlah' => $this->data->total_bayar, // Jumlah pembayaran yang masuk
            'user' => $this->operator(), // Operator yang melakukan transaksi
        ]);

        // Update status iuran menjadi 'Terkirim ke Kas' atau 'Terbayar' jika semua anggota sudah membayar
        $this->data->status = 'Terkirim ke Kas'; // Update status
        $this->data->save();

        // Emit konfirmasi bahwa pengiriman data ke kas berhasil
        $this->emit('successiuran', ['pesan' => 'Data iuran berhasil dikirim ke kas.']);
    }

    public function printiuran($iuran_id)
    {
        $this->isLoading = true;
        // Get the iuran record
        $namattd =$this->pengurus = Pengurus::first();
        $iuran = Iuran::find($iuran_id);

        // Get all bayariuran records for the specified iuran_id
        $bayariuran = bayariuran::where('idiuran', $iuran_id)->get();

        // Initialize an empty array to store anggota data
        $anggota = [];

        // Loop through the bayariuran collection to get associated anggota data
        foreach ($bayariuran as $item) {
            // Retrieve the anggota associated with each bayariuran record
            $anggota[] = Anggota::find($item->idanggota);
        }

        $data =SI::all();


        // Load the PDF view with the necessary data
        $pdf = PDF::loadView('livewire.pdfiuran', [
            'iuran' => $iuran,
            'bayariuran' => $bayariuran,
            'anggota' => $anggota,
            'pengurus' => $namattd
        ])->output();

        $filename = 'Data Iuran STT - ' . str_replace(' ', '_', $iuran->perihal) . '.pdf';
        $this->isLoading = false;
        // Return the PDF as a downloadable file
        return response()->streamDownload(
            fn() => print($pdf),
            $filename
        );
    }


    public function kembalikan()
    {
        $this->perihal="";
        $this->jumlah="";

        // Mengirim event untuk memfokuskan input
        $this->dispatchBrowserEvent('focusInput');
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
