<?php

namespace App\Livewire\Pages\Purchases;

use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateEdit extends Component
{

    public $openModal = false;

    #[Validate('nullable', onUpdate: 'required')]
    public $purchaseId;

    #[Validate('required|date', as: 'fecha de compra', message: 'El campo fecha de compra es obligatorio')]
    public $purchaseDate;


    #[Validate('required', as: 'método de pago', message: 'El campo método de pago es obligatorio')]
    public $paymentMethodId;

    #[Validate('required', as: 'proveedor', message: 'El campo proveedor es obligatorio')]
    public $supplierId;

    // un producto

    public $productId;
    public $quantity;
    public $purchase_price;

    public $products = [];
    public $productsToBuy = [];
    public $purchaseMethods = [];
    public $suppliers = [];

    public function mount()
    {
        $this->purchaseMethods = cache()->remember('payment-methods', now()->addMinutes(5), function () {
            return PaymentMethod::pluck('name', 'id');
        });
        $this->suppliers = cache()->remember('suppliers', now()->addMinutes(5), function () {
            return Supplier::pluck('name', 'id');
        });

        $this->products = cache()->remember('products', now()->addMinutes(5), function () {
            return Product::all();
        });
    }

    public function addProduct()
    {
        $product = Product::find($this->productId);

        if (!$product) {
            return;
        }

        $this->productsToBuy[] = [
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => $this->quantity,
            'purchase_price' => $this->purchase_price,
            'image' => $product->image,
            'total' => $this->quantity * $this->purchase_price
        ];

        $this->productId = '';
        $this->quantity = '';
        $this->purchase_price = '';

        $this->products = $this->products instanceof object ? $this->products->filter(function ($product) {
            return $product->id != $this->productId;
        }) : $this->products;
    }

    public function quitProduct($productId)
    {
        $this->productsToBuy = array_filter($this->productsToBuy, function ($product) use ($productId) {
            return $product['id'] != $productId;
        });
    }

    public function save()
    {

        $this->validate();

        $this->validate([
            'productsToBuy' => 'required|array|min:1'
        ]);

        try {
            $purchase = Purchase::create([
                'date_purchase' => $this->purchaseDate,
                'payment_method_id' => $this->paymentMethodId,
                'supplier_id' => $this->supplierId
            ]);

            foreach ($this->productsToBuy as $product) {
                $purchase->products()->attach($product['id'], [
                    'quantity' => $product['quantity'],
                    'purchase_price' => $product['purchase_price']
                ]);
                $productFounded = Product::findOrFail($product['id']);
                
                $productFounded->stock = $productFounded->stock + $product['quantity'];
                $productFounded->save();

                
            }

            
            
            $this->dispatch('notify', variant: 'success', message: 'Compra creada correctamente.');
            $this->dispatch('refresh');
            $this->productsToBuy = [];
            $this->openModal = false;
        } catch (\Throwable $th) {
            Log::error($th);
            $this->dispatch('notify', variant: 'danger', message: 'Error al crear la compra. Comunícate con el administrador del sistema.');
        }
    }

    public function render()
    {
        return view('livewire.pages.purchases.create-edit');
    }
}
