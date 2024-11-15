<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kegiatan;

class Sidebarwire extends Component
{
    public $kegiatan;
    
    public function render()
    {
        $this->kegiatan = Kegiatan::all();
        return view('livewire.sidebarwire');
    }
}

