<?php

namespace App\Livewire\Pages\Categories;

use App\Models\ProductCategory;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $categories = [];

    #[On('refresh')]
    public function render()
    {
        $this->categories = ProductCategory::all();
        return view('livewire.pages.categories.index');
    }
}
