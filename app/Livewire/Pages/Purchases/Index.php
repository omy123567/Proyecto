<?php

namespace App\Livewire\Pages\Purchases;

use App\Models\Purchase;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{



    #[On('refresh')]
    public function render()
    {
        $purchases = Purchase::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.pages.purchases.index', compact('purchases'));
    }
}
