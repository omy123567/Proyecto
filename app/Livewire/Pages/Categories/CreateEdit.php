<?php

namespace App\Livewire\Pages\Categories;

use App\Models\ProductCategory;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateEdit extends Component
{
    public $openModal = false;

    #[Validate('nullable', onUpdate: 'required')]
    public $categoryId;


    #[Validate('required|min:3', as: 'categoría')]
    public $name = "";

    #[On('open-modal')]
    public function openModal(ProductCategory $categoryId)
    {
        if ($categoryId) {
            $this->categoryId = $categoryId->id;
            $this->name = $categoryId->name;
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
            if ($this->categoryId) {
                ProductCategory::find($this->categoryId)->update($validated);
            } else {
                ProductCategory::create($validated);
            }
            $this->dispatch('refresh');
            $this->openModal = false;
            $message = $this->categoryId ? 'Categoría editado correctamente.' : `Categoría creado correctamente.`;
            $this->dispatch('notify', variant: 'success', message: $message);
            $this->reset();
            cache()->forget('product_categories');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $this->dispatch('notify', variant: 'danger', message: 'Error al crear Categoría. Comunícate con el administrador del sistema.');
        }
    }

    public function render()
    {
        return view('livewire.pages.categories.create-edit');
    }
}
