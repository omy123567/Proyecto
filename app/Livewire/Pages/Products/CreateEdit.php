<?php

namespace App\Livewire\Pages\Products;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateEdit extends Component
{

    use WithFileUploads;

    public $openModal = false;

    #[Validate('nullable', onUpdate: 'required')]
    public $productId;


    #[Validate('required|min:3', as: 'nombre de producto')]
    public $name = "";

    #[Validate('required|min:3', as: 'descripción')]
    public $description = "";

    #[Validate('required|numeric', as: 'precio')]
    public $price = "";

    #[Validate('nullable|numeric', as: 'stock')]
    public $stock = 0;

    #[Validate('required|numeric', as: 'stock mínimo')]
    public $min_stock = 0;

    #[Validate('required|string', as: 'categoría')]
    public $product_category_id = "";

    #[Validate('nullable|image|max:10240')]
    public $image;

    public $categories = [];
    public $suppliers= [];

    public function mount()
    {
        $this->categories = cache()->remember('product_categories', now()->addMinutes(60), function () {
            return ProductCategory::pluck('name', 'id');
        });
        $this->suppliers = cache()->remember('suppliers', now()->addMinutes(60), function () {
            return Supplier::pluck('name', 'id');
        });
    }


    #[On('open-modal')]
    public function openModal(Product $product)
    {
        if ($product) {
            $this->productId = $product->id;
            $this->name = $product->name;
            $this->description = $product->description;
            $this->price = $product->price;
            $this->stock = $product->stock;
            $this->product_category_id = $product->product_category_id;
            $this->min_stock = $product->min_stock;
            if ($product->image) {
                $this->image = Storage::url($product->image);
            }
        }

        $this->openModal = true;
    }

    public function updatedOpenModal($value)
    {
        if (!$value) {
            $this->reset(
                'productId',
                'name',
                'description',
                'price',
                'stock',
                'min_stock',
                'product_category_id',
                'image'
            );
        }
    }


    public function save()
    {

        $validated = $this->validate();

        try {

            if ($this->image && $this->image->isValid()) {
                $validated['image'] = $this->image->store('products', 'public');
            }

            if ($this->productId) {
                $product = Product::find($this->productId);

                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }
                $product->update($validated);
            } else {
                Product::create($validated);
            }

            $this->dispatch('refresh');
            $this->openModal = false;
            $message = $this->productId ? 'Producto editado correctamente.' : `Producto creado correctamente.`;
            $this->dispatch('notify', variant: 'success', message: $message);
            $this->reset();
            cache()->forget('products');
        } catch (\Throwable $th) {
            Log::error($th);
            $this->dispatch('notify', variant: 'danger', message: 'Error al crear el proveedor. Comunícate con el administrador del sistema.');
        }
    }


    public function render()
    {
        return view('livewire.pages.products.create-edit');
    }
}
