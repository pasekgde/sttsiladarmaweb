<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kegiatan as Keg;
use Livewire\WithPagination;

class Pilihkegiatan extends Component
{
    public $kodekegiatan;
    public $postId;

    //pagination
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perpage = 5;

    public function render()
    {
        $data = Keg::orderby('id', 'desc')->paginate($this->perpage);
        return view('livewire.pilihkegiatan', compact('data'));
    }

    public function pilih($id)
    {
        $ayam = $id;
        return view('pages.kegiatan.form',['ayam'=>$id]);
    }
}
