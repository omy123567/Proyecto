<?php

namespace App\Livewire\Pages\Sales;

use App\Models\Sale;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $sales = Sale::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.pages.sales.index', compact('sales'));
    }
}
