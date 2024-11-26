<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class Categories extends Component
{
    use WithPagination;
    use WireToast;

    public $search;

    public function render()
    {
        $categories = Category::where('name', 'like', '%' . $this->search . '%')->latest('id')->paginate(10);
        return view('livewire.admin.categories', compact('categories'));
    }

    public function changeStatus($id){
        $category = Category::find($id);
        $category->update(['status' => !$category->status]);
        toast()->success('Registro actualizado correctamente', 'Mensaje de éxito')->push();
    }
}
