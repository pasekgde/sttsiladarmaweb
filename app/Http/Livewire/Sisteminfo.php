<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sisteminfo as SI;
use Livewire\WithFileUploads; // Untuk menangani upload file
use Illuminate\Support\Facades\Storage;

class Sisteminfo extends Component
{    
    use WithFileUploads; // Trait untuk menangani upload file

    public $modalOpen = false;
    public $newName, $newSubtitle, $newLogo, $newDescription1, $newDescription2, $newOrganisasi, $newBackground, $data;


    public function openModal()
    {
        $this->modalOpen = true;
        // Mengambil data untuk di-edit (misalnya dengan ID)
        $this->data = SI::first(); // Atau bisa sesuaikan dengan ID jika lebih dari satu data
        // Mengisi field input dengan data yang ada
        $this->newName = $this->data->nama_sistem ?? '';
        $this->newSubtitle = $this->data->subjudul ?? '';
        $this->newDescription1 = $this->data->deskripsi1 ?? '';
        $this->newDescription2 = $this->data->deskripsi2 ?? '';
        $this->newOrganisasi = $this->data->organisasi ?? '';
    }

    public function closeModal()
    {
        $this->kosong();
        $this->modalOpen = false;
    }

     public function save()
    {
        // Validasi input
        $this->validate([
            'newName' => 'required|string|max:255',
            'newSubtitle' => 'required|string|max:255',
            'newDescription1' => 'required|string',
            'newDescription2' => 'nullable|string',
            'newOrganisasi'    => 'nullable|string',
            'newLogo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Validasi file logo
            'newBackground' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5048', // Validasi file logo
        ]);

        // Jika ada logo yang diupload, simpan file dan ambil nama file-nya
        $logoPath = null;
        if ($this->newLogo) {
            if ($this->data->logo) {
                Storage::disk('public')->delete($this->data->logo);
            }
            $logoPath = $this->newLogo->store('logos', 'public'); // Direktori penyimpanan file (dalam storage/app/public/logos)
        }else {
            // Jika tidak ada gambar baru, gunakan gambar lama yang sudah ada
            $logoPath = $this->data->logo; // Ambil logo yang sudah ada
        }

        $logoPathBackground = null;
        if ($this->newBackground) {
            if ($this->data->background) {
                Storage::disk('public')->delete($this->data->background);
            }
            $logoPathBackground = $this->newBackground->store('logos', 'public'); // Direktori penyimpanan file (dalam storage/app/public/logos)
        }else {
            // Jika tidak ada gambar baru, gunakan gambar lama yang sudah ada
            $logoPathBackground = $this->data->background; // Ambil logo yang sudah ada
        }

        // Menyimpan data ke database
        SI::updateOrCreate(
            ['id' => $this->data->id ?? null], // Jika data baru, ID tidak ada, jika update pakai ID yang ada
            [
                'nama_sistem' => $this->newName,
                'subjudul' => $this->newSubtitle,
                'logo' => $logoPath,
                'deskripsi1' => $this->newDescription1,
                'deskripsi2' => $this->newDescription2,
                'organisasi' => $this->newOrganisasi,
                'background' => $logoPathBackground
            ]
        );

        // Tutup modal setelah simpan data
        $this->modalOpen = false;
        $this->emit( 'success', [ 'pesan'=>'Lakukan Refres Halaman' ] );
        $this->kosong();

        // Refresh data
        $this->data = SI::first(); // Refresh data yang ditampilkan
    }


    public function render()
    {
        $this->data = SI::first();
        return view('livewire.sisteminfo');
    }

    public function kosong()
    {
        $this->newName = '';
        $this->newSubtitle = '';
        $this->newDescription1 = '';
        $this->newDescription2 = '';
        $this->newOrganisasi = '';
        $this->newLogo = null;
        $this->newBackground = null;
    }
}
