<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Absensi;
use App\Models\Anggota;
use App\Models\bayariuran;
use App\Models\Event;
use App\Models\Iuran;
use App\Models\Kas;
use App\Models\Kegiatan;
use App\Models\TabelKegiatan;
use App\Models\Penekelan;
use App\Models\OutStt;
use App\Models\Alumni;

class Truncatedata extends Component
{
    protected $listeners = [ 'truncateabsensiconfirm' => 'truncateabsensidata',
                             'truncateanggotaconfirm' => 'truncateanggotadata',
                             'truncatekasconfirm' => 'truncatekasdata',
                             'truncatekegiatanconfirm' => 'truncatekegiatandata',
                             'truncatebayariuranconfirm' => 'truncatebayariurandata',
                             'truncatebayarpenekelanconfirm' => 'truncatebayarpenekelandata',
                             'truncateoutsttconfirm' => 'truncateoutsttdata',
                             'truncatealumniconfirm' => 'truncatealumnidata' ];
                             

    public function render()
    {
        return view('livewire.truncatedata');
    }

    public function truncateabsensi()
    {
        Absensi::truncate();
        TabelKegiatan::truncate();

        $this->emit('truncateabsensi', [
            'pesan' => 'Ingin Memformat Data Absensi?',
            'text' => 'Apakah Anda yakin ingin menghapus data absensi?',
            'icon' => 'warning'
        ]);
    }

    public function truncateabsensidata()
    {
        Absensi::truncate();
        TabelKegiatan::truncate();
    }



    public function truncateanggota()
    {
        Anggota::truncate();
        $this->emit('truncateanggota', [
            'pesan' => 'Ingin Memformat Data Anggota?',
            'text' => 'Apakah Anda yakin ingin menghapus data anggota?',
            'icon' => 'warning'
        ]);
    }

    public function truncateanggotadata()
    {
        Anggota::truncate();
    }

    public function truncatekas()
    {
        Kas::truncate();
        $this->emit('truncatekas', [
            'pesan' => 'Ingin Memformat Data Kas?',
            'text' => 'Apakah Anda yakin ingin menghapus data kas?',
            'icon' => 'warning'
        ]);
    }

    public function truncatekasdata()
    {
        Kas::truncate();
    }

    public function truncatekegiatan()
    {
        Kegiatan::truncate();
        Event::truncate();
        $this->emit('truncatekegiatan', [
            'pesan' => 'Ingin Memformat Data Kegiatan?',
            'text' => 'Apakah Anda yakin ingin menghapus data kegiatan?',
            'icon' => 'warning'
        ]);
    }

    public function truncatekegiatandata()
    {
        Kegiatan::truncate();
        Event::truncate();
    }

    public function truncatebayariuran()
    {
        bayariuran::truncate();
        Iuran::truncate();
        $this->emit('truncatebayariuran', [
            'pesan' => 'Ingin Memformat Data Iuran?',
            'text' => 'Apakah Anda yakin ingin menghapus data iuran?',
            'icon' => 'warning'
        ]);
    }

    public function truncatebayariurandata()
    {
        bayariuran::truncate();
        Iuran::truncate();
    }

    public function truncatepenekelan()
    {
        $this->emit('truncatepenekelan', [
            'pesan' => 'Ingin Memformat Data Penekelan?',
            'text' => 'Apakah Anda yakin ingin menghapus data Penekelan?',
            'icon' => 'warning'
        ]);
    }

    public function truncatebayarpenekelandata()
    {
        Penekelan::truncate();
    }

    public function truncateoutstt()
    {
        $this->emit('truncateoutstt', [
            'pesan' => 'Ingin Memformat Data Pengajuan?',
            'text' => 'Apakah Anda yakin ingin menghapus data Pengajuan?',
            'icon' => 'warning'
        ]);
    }

    public function truncateoutsttdata()
    {
        OutStt::truncate();
    }

    public function truncatealumni()
    {
        $this->emit('truncatealumni', [
            'pesan' => 'Ingin Memformat Data Alumni?',
            'text' => 'Apakah Anda yakin ingin menghapus data Alumni?',
            'icon' => 'warning'
        ]);
    }

    public function truncatealumnidata()
    {
        Alumni::truncate();
    }

}
