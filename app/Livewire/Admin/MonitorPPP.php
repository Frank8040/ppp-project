<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\User;
use Livewire\Component;

class MonitorPPP extends Component
{
    public function render()
    {
        $users = User::all();
        $categories = Category::all();
        return view('livewire.admin.dashboard', compact('users', 'categories'));
    }
}
