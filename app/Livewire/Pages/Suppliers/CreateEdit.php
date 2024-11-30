<?php

namespace App\Livewire\Pages\Suppliers;

use App\Models\Supplier;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateEdit extends Component
{

    public $openModal = false;

    #[Validate('required', onUpdate: false)]
    public $supplierId;


    #[Validate('required|min:3', as: 'proveedor')]
    public $name = "";

    #[Validate('required|email|min:3', as: 'correo electrónico')]
    public $email = "";

    #[Validate('required|min:3', as: 'teléfono')]
    public $phone = "";

    #[Validate('nullable|min:3', as: 'dirección')]
    public $address = "";

    #[Validate('nullable|min:3', as: 'observaciones')]
    public $observations = "";

    public function save()
    {
        
        $validated = $this->validate();

        $this->dispatch('notify', variant: 'success', message: 'Proveedor creado correctamente.');

        Supplier::create($validated);
    }


    public function render()
    {
        return view('livewire.pages.suppliers.create-edit');
    }
}
