<?php

namespace App\Livewire\Pages\Suppliers;

use App\Models\Supplier;
use Livewire\Component;

class Index extends Component
{
    
    public $suppliers = [];

    public function render()
    {
        $this->suppliers = Supplier::all();

        return view('livewire.pages.suppliers.index');
    }
}
