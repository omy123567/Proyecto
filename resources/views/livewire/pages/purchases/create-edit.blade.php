<div x-data="{ modalIsOpen: $wire.entangle('openModal').live }">
    <x-primary-button x-on:click="modalIsOpen = true">Ingresar Compra</x-primary-button>

    <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
        @keydown.esc.window="modalIsOpen = false" @click.self="modalIsOpen = false"
        class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
        role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
        <!-- Modal Dialog -->
        <div x-show="modalIsOpen"
            x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
            x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
            class="flex w-2/3 min-w-min flex-col gap-4 overflow-hidden rounded-md border border-neutral-300 bg-white text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
            <!-- Dialog Header -->
            <div
                class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20">
                <div class="flex flex-col items-start">
                    <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-neutral-900 dark:text-white">
                        Ingresar una compra nueva</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400  justify-self-start">
                        Completa los datos de tu compra
                    </p>
                </div>
                <button @click="modalIsOpen = false" aria-label="close modal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor"
                        fill="none" stroke-width="1.4" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Dialog Body -->
            <div class="w-full">
                <form wire:submit="save" class="p-6">
                    <div class="w-full flex items-center gap-3 m-2">
                        <div class="">
                            <x-input-label for="purchaseDate" value="Fecha de compra" />

                            <x-text-input wire:model="purchaseDate" id="purchaseDate" name="purchaseDate" type="date"
                                class="mt-1 w-full" placeholder="Fecha de compra" />

                            <x-input-error :messages="$errors->get('purchaseDate')" class="mt-2" />
                        </div>
                        <div class="">
                            <x-input-label for="paymentMethodId" value="Método de pago" />

                            <x-select wire:model="paymentMethodId" id="paymentMethodId" name="paymentMethodId"
                                class="mt-1 w-full" :options="$purchaseMethods">
                            </x-select>

                            <x-input-error :messages="$errors->get('paymentMethodId')" class="mt-2" />
                        </div>
                        <div class="">
                            <x-input-label for="supplierId" value="Proveedor" />

                            <x-select wire:model="supplierId" id="supplierId" name="supplierId" :options="$suppliers"
                                class="mt-1 w-full">
                            </x-select>

                            <x-input-error :messages="$errors->get('supplierId')" class="mt-2" />
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

                            <x-text-input wire:model="quantity" id="quantity" name="quantity" type="number"
                                min="1" class="mt-1 w-full" placeholder="Cantidad" />

                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="purchase_price" value="Precio" />

                            <x-text-input wire:model="purchase_price" id="purchase_price" name="purchase_price"
                                type="number" min="1" class="mt-1 w-full" placeholder="Precio" />

                            <x-input-error :messages="$errors->get('purchase_price')" class="mt-2" />
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
                                <th scope="col" class="p-4">Precio Compra</th>
                                <th scope="col" class="p-4">Total</th>
                                <th scope="col" class="p-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
                            @forelse ($productsToBuy as $product)
                                <tr wire:key='{{ $product['id'] }}'>
                                    <td class="p-4 self-center">
                                        @if ($product['image'])
                                            <img src="{{ Storage::url($product['image']) }}"
                                                alt="{{ $product['name'] }}" class="w-12 h-12 object-cover">
                                        @else
                                            <div class="w-10 h-10 bg-neutral-200 dark:bg-neutral-800 rounded-full">
                                            </div>
                                        @endif
                                    </td>
                                    <td class="p-4 self-center">
                                        <div class="flex w-max items-center gap-2">
                                            <div class="flex flex-col">
                                                <span
                                                    class="text-neutral-900 dark:text-white">{{ $product['name'] }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 self-center">{{ $product['quantity'] }}</td>
                                    <td class="p-4 self-center">{{ $product['purchase_price'] }}</td>
                                    <td class="p-4 self-center">{{ $product['total'] }}</td>
                                    <td class="p-4 self-center">
                                        <x-secondary-button
                                            wire:click="quitProduct('{{ $product['id'] }}')">Quitar</x-secondary-button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="p-4" colspan="6">
                                        <div
                                            class="flex items
                                    -center justify-center">
                                            <span class="text-sm text-neutral-500 dark:text-neutral-400">No hay productos agregados</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <x-danger-button x-on:click="modalIsOpen = false">
                        {{ __('Cancel') }}
                    </x-danger-button>

                    <x-primary-button class="ms-3">
                        {{ __('Guardar') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</div>
