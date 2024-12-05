<div class="w-full">
    <form wire:submit="save" class="p-6">
        <div class="w-full flex items-center gap-3 m-2">
            <div class="">
                <x-input-label for="datetimeSale" value="Fecha de Venta" />

                <x-text-input wire:model="datetimeSale" id="datetimeSale" name="datetimeSale" type="datetime-local"
                    class="mt-1 w-full" placeholder="Fecha de venta" />

                <x-input-error :messages="$errors->get('datetimeSale')" class="mt-2" />
            </div>
            <div class="">
                <x-input-label for="paymentMethodId" value="Método de pago" />

                <x-select wire:model="paymentMethodId" id="paymentMethodId" name="paymentMethodId" class="mt-1 w-full"
                    :options="$purchaseMethods">
                </x-select>

                <x-input-error :messages="$errors->get('paymentMethodId')" class="mt-2" />
            </div>
            <div class="">
                <x-input-label for="customerName" value="Cliente" />

                <x-text-input wire:model="customerName" id="customerName" name="customerName"
                    class="mt-1 w-full" placeholder="Cliente" />

                <x-input-error :messages="$errors->get('customerName')" class="mt-2" />
            </div>
        </div>
        <div class="flex w-full justify-between items-center gap-2">
            <div class="w-full flex-col">
                <x-input-label for="product" value="Productos" />

                <div class="mt-1 w-full">
                    <select id="product" name="product" wire:model="productId"
                        class='w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm'>
                        <option value="">Seleccione un producto</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <x-input-error :messages="$errors->get('products')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="quantity" value="Cantidad" />

                <x-text-input wire:model="quantity" id="quantity" name="quantity" type="number" min="1"
                    class="mt-1 w-full" placeholder="Cantidad" />

                <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
            </div>
            <div>
                <x-secondary-button wire:click="addProduct">Agregar</x-secondary-button>
            </div>
        </div>
        <table class="w-full m-2">
            <thead
                class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">
                <tr>
                    <th scope="col" class="p-4">Imagen</th>
                    <th scope="col" class="p-4">Producto</th>
                    <th scope="col" class="p-4">Cantidad</th>
                    <th scope="col" class="p-4">Precio Venta</th>
                    <th scope="col" class="p-4">Subtotal</th>
                    <th scope="col" class="p-4">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
                @forelse ($productsToSell as $product)
                    <tr wire:key='{{ $product['id'] }}'>
                        <td class="p-4 self-center">
                            @if ($product['image'])
                                <img src="{{ Storage::url($product['image']) }}" alt="{{ $product['name'] }}"
                                    class="w-12 h-12 object-cover">
                            @else
                                <div class="w-10 h-10 bg-neutral-200 dark:bg-neutral-800 rounded-full">
                                </div>
                            @endif
                        </td>
                        <td class="p-4 self-center">
                            <div class="flex w-max items-center gap-2">
                                <div class="flex flex-col">
                                    <span class="text-neutral-900 dark:text-white">{{ $product['name'] }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 self-center">{{ $product['quantity'] }}</td>
                        <td class="p-4 self-center">{{ $product['sale_price'] }}</td>
                        <td class="p-4 self-center">{{ $product['subtotal'] }}</td>
                        <td class="p-4 self-center">
                            <x-secondary-button
                                wire:click="quitProduct('{{ $product['id'] }}')">Quitar</x-secondary-button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-4" colspan="6">
                            <div class="flex items
                        -center justify-center">
                                <span class="text-sm text-neutral-500 dark:text-neutral-400">No hay productos
                                    agregados</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="w-full flex justify-end items-center gap-3 m-2">
            <div class="">
                {{ __('Total Venta') }}: ${{ $total }}
            </div>
        </div>
        <a href="{{ route('sales.index') }}"
            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Cancelar</a>

        <x-primary-button class="ms-3">
            {{ __('Vender') }}
        </x-primary-button>
    </form>
</div>
