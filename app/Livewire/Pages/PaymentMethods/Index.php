<?php

namespace App\Livewire\Pages\PaymentMethods;

use App\Models\PaymentMethod;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $payment_methods = [];

    #[On('refresh')]
    public function render()
    {
        $this->payment_methods = PaymentMethod::all();
        return view('livewire.pages.payment-methods.index');
    }
}
