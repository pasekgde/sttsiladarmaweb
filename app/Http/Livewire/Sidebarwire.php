<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kegiatan;
use Illuminate\Contracts\View\View;

class Sidebarwire extends Component
{
    public $kegiatan;
    
    public function render(): View
    {
        $this->kegiatan = Kegiatan::all();
        return view('livewire.sidebarwire');
    }
}
