<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kegiatan as Keg;
use Livewire\WithPagination;
use Auth;

class Pilihevent extends Component
{
    public $kodekegiatan;
    public $postId;
     //pagination
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perpage = 10;

    public function render()
    {
        // Ambil data berdasarkan status pengguna
        $user = Auth::user();

        // Jika pengguna adalah 'pengurus', tampilkan seluruh data
        if ($user->status === 'Pengurus' || $user->status === 'Superadmin' || $user->status === 'Ketua') {
            // Menampilkan seluruh data tanpa filter berdasarkan pengguna
            $data = Keg::orderby('id', 'desc')->get();
        } else {
            // Jika pengguna adalah 'panitia', hanya tampilkan kegiatan yang terkait dengan pengguna
            $data = Keg::orderby('id', 'desc')->get()
            ->filter(function ($kegiatan) use ($user) {
                $userIds = json_decode($kegiatan->pengguna, true); // Decode JSON ke array
                return is_array($userIds) && in_array($user->id, $userIds); // Cek apakah ID pengguna ada dalam array
            });
        }

        return view('livewire.pilihevent',compact('data'));
    }

    public function pilih($id)
    {
        $ayam = $id;
        return view('pages.kegiatan.levent',['ayam'=>$id]);
    }
}
