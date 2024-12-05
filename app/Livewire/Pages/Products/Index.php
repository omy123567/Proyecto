<?php

namespace App\Livewire\Pages\Products;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    

    #[On('refresh')]
    public function render()
    {
        $products = Product::paginate(10);
        return view('livewire.pages.products.index', compact('products'));
    }
}
