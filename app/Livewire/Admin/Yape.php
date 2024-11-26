<?php

namespace App\Livewire\Admin;

use App\Models\Yape as ModelsYape;
use Livewire\Component;

class Yape extends Component
{
    public function render()
    {
        $yape = ModelsYape::first();
        return view('livewire.admin.yape', compact('yape'));
    }
}
