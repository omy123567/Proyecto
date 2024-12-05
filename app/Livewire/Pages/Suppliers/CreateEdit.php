<?php

namespace App\Livewire\Pages\Suppliers;

use App\Models\Supplier;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateEdit extends Component
{

    public $openModal = false;

    #[Validate('nullable', onUpdate: 'required')]
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


    #[On('open-modal')]
    public function openModal(Supplier $supplierId)
    {

        if ($supplierId) {
            $this->supplierId = $supplierId->id;
            $this->name = $supplierId->name;
            $this->email = $supplierId->email;
            $this->phone = $supplierId->phone;
            $this->address = $supplierId->address;
            $this->observations = $supplierId->observations;
        }

        $this->openModal = true;
    }

    public function updatedOpenModal($value)
    {
        if (!$value) {
            $this->reset();
        }
    }


    public function save()
    {

        $validated = $this->validate();
        try {
            if ($this->supplierId) {
                Supplier::find($this->supplierId)->update($validated);
            } else {
                Supplier::create($validated);
            }

            $this->dispatch('refresh');
            $this->openModal = false;
            $message = $this->supplierId ? 'Proveedor editado correctamente.' : `Proveedor creado correctamente.`;
            $this->dispatch('notify', variant: 'success', message: $message);
            $this->reset();
        } catch (\Throwable $th) {
            Log::error($th);
            $this->dispatch('notify', variant: 'danger', message: 'Error al crear el proveedor. Comunícate con el administrador del sistema.');
        }
    }


    public function render()
    {
        return view('livewire.pages.suppliers.create-edit');
    }
}
