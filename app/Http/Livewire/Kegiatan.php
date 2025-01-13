<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kegiatan as KEG;
use App\Models\Event;
use App\Helpers\AutoKegiatan;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Kas;
use App\Helpers\AutoNumber;
use Auth;

class Kegiatan extends Component
{
    public $idkeg;
    public $kodekegiatan;
    public $tglpembuatan;
    public $namakegiatan;
    public $deskripsi;
    public $ketuapanitia;
    public $sekretarispanitia;
    public $bendaharapanitia;
    public $formedit = false;

    public $userid = [];
    public $selectedUsers = [];

    //pagination
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    //search
    public $searchTerm;
    public $perpage = 10;

    //delete
    protected $listeners = [ 'deleteconfirm' => 'deletedata', 'kegiatankirimkekasinconfirm' => 'kegiatankirimkekasin'];
    public $selectedOptions = [];
    public $users = [];

    //yakinkirim
    public $dataselesai;
    
    public function mount()
    {
        $this->users = User::all()->toArray();
        $this->kodekegiatan = $this->kodekegiatan();
    }

    public function render()
    {
        $searchTerm = '%'.$this->searchTerm.'%';
        $datakegiatan = KEG::where('namakegiatan','like', $searchTerm)
                            ->orderby('id','desc')
                            ->paginate($this->perpage);
        
        foreach ($datakegiatan as $kegiatan) {
            // Cek jika field pengguna ada isinya (tidak null atau kosong)
            if (!empty($kegiatan->pengguna)) {
                $userIds = json_decode($kegiatan->pengguna); // Decode JSON menjadi array ID pengguna
                if (is_array($userIds) && !empty($userIds)) {
                    // Ambil nama berdasarkan ID jika array pengguna ada isinya
                    $userNames = User::whereIn('id', $userIds)->get(['name', 'status']);
                } else {
                    $userNames = collect(); // Jika tidak ada ID yang valid, kosongkan hasil
                }
            } else {
                $userNames = collect(); // Jika pengguna kosong, beri hasil kosong
            }
            
            // Menambahkan nama pengguna ke masing-masing kegiatan
            $kegiatan->user_names = $userNames;

        }
                    
        return view('livewire.kegiatan', compact('datakegiatan'));
    }

    public function store() {

        $this->validate( [
            'kodekegiatan' => 'required',
            'tglpembuatan' => 'required',
            'namakegiatan' => 'required',
            'deskripsi' => 'required',
            'ketuapanitia' => 'required',
            'sekretarispanitia' => 'required',
            'bendaharapanitia' => 'required',
            'selectedOptions' => 'array|min:1'
        ] );

        KEG::create( [
            'kodekegiatan' => $this->kodekegiatan(),
            'tglpembuatan' => date( 'Y-m-d', strtotime( $this->tglpembuatan ) ),
            'namakegiatan' => Str::ucfirst( $this->namakegiatan ),
            'deskripsi' => Str::ucfirst( $this->deskripsi ),
            'ketuapanitia' => Str::ucfirst( $this->ketuapanitia ),
            'sekretarispanitia' => Str::ucfirst( $this->sekretarispanitia ),
            'bendaharapanitia' => Str::ucfirst( $this->bendaharapanitia ),
            'pengguna' => json_encode($this->selectedOptions),
            'user' => $this->operator(),
            'status' => 'Belum'
        ] );
        $this->emit('closeModal');
        $this->emit( 'success', [ 'pesan'=>'Sudah Tersimpan' ] );
        $this->kosong();
        $this->focus();
    }

    public function edit( $id ) {

        $data = KEG::findOrFail( $id );
        $this->idkeg = $data->id;
        $this->kodekegiatan = $data->kodekegiatan;
        $this->namakegiatan = $data->namakegiatan;
        $this->tglpembuatan = date('d/m/Y', strtotime($data->tglpembuatan));
        $this->deskripsi = $data->deskripsi;
        $this->selectedOptions = json_decode($data->pengguna, true);
        $this->formedit = true;
    }

    public function update() {
        $this->validate( [
            'kodekegiatan' => 'required',
            'tglpembuatan' => 'required',
            'namakegiatan' => 'required',
            'deskripsi' => 'required',
            'ketuapanitia' => 'required',
            'sekretarispanitia' => 'required',
            'bendaharapanitia' => 'required',
            'selectedOptions' => 'array|min:1'
        ] );

        $data = KEG::findOrFail( $this->idkeg);
        $data->update( [
            'kodekegiatan' => $this->kodekegiatan,
            'tglpembuatan' => date( 'Y-m-d', strtotime( $this->tglpembuatan ) ),
            'namakegiatan' => Str::ucfirst( $this->namakegiatan ),
            'deskripsi' => Str::ucfirst( $this->deskripsi ),
            'ketuapanitia' => Str::ucfirst( $this->ketuapanitia ),
            'sekretarispanitia' => Str::ucfirst( $this->sekretarispanitia ),
            'bendaharapanitia' => Str::ucfirst( $this->bendaharapanitia ),
            'pengguna' => json_encode($this->selectedOptions),
            'user' => $this->operator(),
            'status' => 'Belum'
        ] );
        $this->emit('closeModal');
        $this->emit( 'success', [ 'pesan'=>'Sudah Terubah' ] );
        $this->kosong();
        $this->formedit = false;

    }

    public function destroypesan( $id ) {
        $this->idkeg = $id;
        $this->emit( 'hapus', [ 'pesan'=>'Yakin Hapus?', 'text'=>'suud hapus nak ilang', 'icon'=>'warning' ] );

    }

    public function deletedata() {
        $kodekeg = KEG::find( $this->idkeg )->kodekegiatan;
        Event::where('kodekegiatan', '=', $kodekeg)->delete();
        KEG::find( $this->idkeg )->delete();

        $this->kodekegiatan = $this->kodekegiatan();
    }

    public function kodekegiatan() {
        $table = 'kegiatan';
        $primary = 'kodekegiatan';
        $prefix = 'KEG';
        $kodekegiatan = AutoKegiatan::autonumber( $table, $primary, $prefix);
        return $kodekegiatan;
    }

    public function operator() {
        $operator = Auth::user()->name;
        return $operator;
    }

    public function kosong()
    {
        $this->kodekegiatan = $this->kodekegiatan();
        $this->tglpembuatan = Carbon::now()->format('d/m/Y');
        $this->namakegiatan = "";
        $this->deskripsi = "";
        $this->ketuapanitia = "";
        $this->sekretarispanitia = "";
        $this->bendaharapanitia = "";
        $this->selectedOptions =[];
    }

    public function focus() {
        $this->emit( 'focuss' );
    }

    public function cancel()
    {
        $this->kosong(); // Reset form
        $this->formedit = false; // Kembali ke mode default
        $this->emit('closeModal'); // Emit event untuk menutup modal
    }

    public function yakinselesai ($kodekegiatan)
    {
        $this->dataselesai = KEG::find($kodekegiatan);

        // Jika data iuran tidak ditemukan, emit error dan return
        if (!$this->dataselesai) {
            $this->emit('error', ['pesan' => 'Data Kegiatan tidak ditemukan.']);
            return;
        }
    
        if ($this->dataselesai->status == 'Sudah') {
            $this->emit('error', ['pesan' => 'Kegiatan sudah Terkirim sebelumnya, tidak bisa dikirim ke kas.']);
            return;
        }
    
        // Emit konfirmasi untuk kirim data ke kas
        $this->emit('kegiatan', [
            'pesan' => 'Yakin Kirim Ke KASIN?',
            'text' => 'Setelah kirim data, anda tidak bisa melakukan penginputan pada Kegiatan ini',
            'icon' => 'warning'
        ]);
    }

    public function kegiatankirimkekasin()
    {
        // Pastikan bahwa data iuran valid sebelum diproses
        if (!$this->dataselesai) {
            $this->emit('error', ['pesan' => 'Data Iuran tidak ditemukan.']);
            return;
        }

        // Validasi bahwa total pembayaran sudah sesuai dengan yang harus dikirim ke kas
        if ($this->dataselesai->saldo <= 0) {
            $this->emit('error', ['pesan' => 'Tidak ada pembayaran yang dilakukan, tidak dapat mengirim ke kas.']);
            return;
        }

        // Membuat transaksi kas
        Kas::create([
            'kodekas' => $this->kodeKas(),
            'jeniskas' => 'Masuk',  // Jenis kas adalah 'Masuk'
            'tglkas' => date('Y-m-d', strtotime(now())), // Tanggal transaksi kas
            'keterangan' => Str::ucfirst('Saldo Kegiatan : '.
                ($this->dataselesai->namakegiatan ?? '')
            ),
            'qty' => '',  // Tidak ada kuantitas
            'harga' => 0,  // Tidak ada harga
            'jumlah' => $this->dataselesai->saldo, // Jumlah pembayaran yang masuk
            'user' => $this->operator(), // Operator yang melakukan transaksi
        ]);

        // Update status iuran menjadi 'Terkirim ke Kas' atau 'Terbayar' jika semua anggota sudah membayar
        $this->dataselesai->status = 'Sudah'; // Update status
        $this->dataselesai->save();

        // Emit konfirmasi bahwa pengiriman data ke kas berhasil
        $this->emit('success', ['pesan' => 'Data Kegiatan berhasil dikirim ke kas.']);
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

}
