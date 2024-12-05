<?php

namespace App\Livewire\Pages\PaymentMethods;

use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateEdit extends Component
{

    public $openModal = false;

    #[Validate('nullable', onUpdate: 'required')]
    public $paymentMethodId;


    #[Validate('required|min:3', as: 'método de pago')]
    public $name = "";

    #[On('open-modal')]
    public function openModal(PaymentMethod $paymentMethodId)
    {
        if ($paymentMethodId) {
            $this->paymentMethodId = $paymentMethodId->id;
            $this->name = $paymentMethodId->name;
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
            if ($this->paymentMethodId) {
                PaymentMethod::find($this->paymentMethodId)->update($validated);
            } else {
                PaymentMethod::create($validated);
            }
            $this->dispatch('refresh');
            $this->openModal = false;
            $message = $this->paymentMethodId ? 'Método de pago editado correctamente.' : `Método de pago creado correctamente.`;
            $this->dispatch('notify', variant: 'success', message: $message);
            $this->reset();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $this->dispatch('notify', variant: 'danger', message: 'Error al crear método de pago. Comunícate con el administrador del sistema.');
        }
    }

    public function render()
    {
        return view('livewire.pages.payment-methods.create-edit');
    }
}
