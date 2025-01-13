<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pengurus as Penguruses;

class Pengurus extends Component
{
    public $modalOpen = false;
    public $data, $ketua, $sekretaris, $bendahara;

    public function render()
    {
        // Ambil data pengurus pertama kali jika ada
        $this->data = Penguruses::first();

        return view('livewire.pengurus');
    }

    public function openModal()
{
    $this->ketua = $this->data->ketua;
    $this->sekretaris = $this->data->sekretaris;
    $this->bendahara = $this->data->bendahara;
    $this->emit('openModal');
}


    public function store()
    {
        // Validasi input
        $this->validate([
            'ketua' => 'required|string|max:255',
            'sekretaris' => 'required|string|max:255',
            'bendahara' => 'required|string|max:255'
        ]);

        // Periksa apakah sudah ada data, jika ada update, jika tidak buat data baru
        $pengurus = Penguruses::first();  // Ambil data pertama

        if ($pengurus) {
            // Update data yang ada
            $pengurus->update([
                'ketua' => $this->ketua,
                'sekretaris' => $this->sekretaris,
                'bendahara' => $this->bendahara,
            ]);
        } else {
            // Jika tidak ada, buat data baru
            Penguruses::create([
                'ketua' => $this->ketua,
                'sekretaris' => $this->sekretaris,
                'bendahara' => $this->bendahara,
            ]);
        }

        // Emit event untuk menutup modal dan menunjukkan pesan sukses
        $this->emit('closeModal');
        $this->emit('success', ['pesan' => 'Data Tersimpan']);
    }
}
