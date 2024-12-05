<?php

namespace App\Livewire\Pages\Sales;

use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{


    #[Validate('nullable', onUpdate: 'required')]
    public $purchaseId;

    #[Validate('required', as: 'fecha de venta', message: 'El campo fecha de compra es obligatorio')]
    public $datetimeSale;

    #[Validate('required', as: 'método de pago', message: 'El campo método de pago es obligatorio')]
    public $paymentMethodId;

    #[Validate('required', as: 'cliente', message: 'El campo cliente es obligatorio')]
    public $customerName;

    // un producto
    public $productId;
    public $quantity;

    public $total = 0;


    public $products = [];
    public $productsToSell = [];
    public $purchaseMethods = [];
    public $suppliers = [];

    public function mount()
    {
        $this->purchaseMethods = cache()->remember('payment-methods', now()->addMinutes(5), function () {
            return PaymentMethod::pluck('name', 'id');
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

        if ($product->stock < $this->quantity) {
            DB::rollBack();
            $this->dispatch('notify', variant: 'danger', message: 'No hay suficiente stock para el producto ' . $product->name . '. Stock actual: ' . $product->stock);
            return;
        }

        $exists = collect($this->productsToSell)->contains(function ($productToSell) {
            return $productToSell['id'] == $this->productId;
        });

        if ($exists) {
            // modificar existente
            $this->productsToSell = array_map(function ($productToSell) use ($product) {
                if ($productToSell['id'] == $this->productId) {
                    $productToSell['quantity'] += $this->quantity;
                    $productToSell['subtotal'] = $productToSell['quantity'] * $product->price;
                }
                return $productToSell;
            }, $this->productsToSell);
        } else {
            $this->productsToSell[] = [
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => $this->quantity,
                'sale_price' => $product->price,
                'image' => $product->image,
                'discount' => 0,
                'subtotal' => $this->quantity * $product->price
            ];
        }

        $this->total = collect($this->productsToSell)->sum(function ($product) {
            return $product['subtotal'];
        });


        $this->productId = '';
        $this->quantity = '';

        $this->products = $this->products instanceof object ? $this->products->filter(function ($product) {
            return $product->id != $this->productId;
        }) : $this->products;
    }

    public function quitProduct($productId)
    {
        $this->productsToSell = array_filter($this->productsToSell, function ($product) use ($productId) {
            return $product['id'] != $productId;
        });

        $this->total = collect($this->productsToSell)->sum(function ($product) {
            return $product['subtotal'];
        });
    }

    public function save()
    {

        $this->validate();

        $this->validate([
            'productsToSell' => 'required|array|min:1'
        ]);

        try {

            DB::beginTransaction();

            $sale = Sale::create([
                'datetime_sale' => $this->datetimeSale,
                'payment_method_id' => $this->paymentMethodId,
                'customer_name' => $this->customerName,
                'total' => $this->total
            ]);

            $total = 0;

            foreach ($this->productsToSell as $product) {

                $sale->products()->attach($product['id'], [
                    'quantity' => $product['quantity'],
                    'sale_price' => $product['sale_price'],
                    'discount' => $product['discount'],
                    'subtotal' => $product['quantity'] * $product['sale_price'],
                ]);

                $total += $product['quantity'] * $product['sale_price'];

                $productFounded = Product::findOrFail($product['id']);               

                $productFounded->stock = $productFounded->stock - $product['quantity'];
                $productFounded->save();
            }

            DB::commit();

            $this->dispatch('notify', variant: 'success', message: 'Venta creada correctamente.');
            $this->productsToSell = [];
            redirect()->route('sales.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            $this->dispatch('notify', variant: 'danger', message: 'Error al crear la compra. Comunícate con el administrador del sistema.');
        }
    }

    public function render()
    {
        return view('livewire.pages.sales.create');
    }
}
