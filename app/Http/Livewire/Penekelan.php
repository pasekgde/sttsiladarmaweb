<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Anggota;
use App\Models\Penekelan as Nekel;
use App\Helpers\AutoNumber;
use App\Models\Kas;
use Illuminate\Support\Str;
use Auth;

class Penekelan extends Component
{
    public $showBayarModal = false;
    public $showHistoriModal = false;
    public $bayarpenekelan;
    public $tanggalbayar;
    public $anggotaId;
    public $namaAnggota;
    public $historiPembayaran = [];

    public $search = '';
    public $perPage = 10;

    public function render()
    {
        $anggotaNekel = Anggota::where('status', 'Nekel')
                                ->where('nama', 'like', '%' . $this->search . '%') // Search functionality
                                ->orderBy('created_at', 'desc')
                                ->paginate($this->perPage); // Ambil semua data iuran

        return view('livewire.penekelan', ['anggotaNekel' => $anggotaNekel]);
    }

    public function showBayarModal($anggotaId)
    {
        $this->anggotaId = $anggotaId;

        $this->namaAnggota = Anggota::find($anggotaId)->nama;

        $this->emit('openPaymentModal');  

    }

    public function closeBayarModal()
    {
        $this->emit('closeModal');
    }

    public function bayarPenekelan()
    {
        // Validasi data
        $this->validate([
            'bayarpenekelan' => 'required|numeric|min:1',
            'tanggalbayar' => 'required|date',
        ]);

        // Simpan data pembayaran ke tabel penekelan
        Nekel::create([
            'idanggota' => $this->anggotaId,
            'bayarpenekelan' => str_replace([',', '.'], '', $this->bayarpenekelan),
            'tanggalbayar' => $this->tanggalbayar,
        ]);

        Kas::create([
            'kodekas' => $this->kodeKas(),
            'jeniskas' => 'Masuk',  // Jenis kas adalah 'Masuk'
            'tglkas' => date('Y-m-d', strtotime($this->tanggalbayar)), // Tanggal transaksi kas
            'keterangan' => Str::ucfirst('Pembayaran Penekelan Atas Nama ' . $this->namaAnggota),
            'qty' => '-',  // Tidak ada kuantitas
            'harga' => 0,  // Tidak ada harga
            'jumlah' => str_replace([',', '.'], '', $this->bayarpenekelan), // Jumlah pembayaran yang masuk
            'user' => $this->operator(), // Operator yang melakukan transaksi
        ]);

        // Tutup modal dan reset form
        $this->emit('closeModal');;
        $this->bayarpenekelan = null;
        $this->tanggalbayar = null;

        $this->emit('successpenekelan', ['pesan' => 'Tersimpan']);
    }

    public function showHistori($anggotaId)
    {
        $this->historiPembayaran = Nekel::where('idanggota', $anggotaId)
                                    ->orderBy('tanggalbayar', 'desc')->get();

        $this->namaAnggota = Anggota::find($anggotaId)->nama;
                                        
        $this->emit('openHistoryModal'); 
    }

    public function closeHistoriModal()
    {
        $this->showHistoriModal = false;
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
