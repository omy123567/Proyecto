<div>
    <div x-data="{ modalIsOpen: $wire.entangle('openModal').live }">
        <x-primary-button x-on:click="modalIsOpen = true">Crear producto</x-primary-button>

        <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
            @keydown.esc.window="modalIsOpen = false" @click.self="modalIsOpen = false"
            class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
            role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
            <!-- Modal Dialog -->
            <div x-show="modalIsOpen"
                x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
                class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-md border border-neutral-300 bg-white text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
                <!-- Dialog Header -->
                <div
                    class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20">
                    <div class="flex flex-col items-start">
                        <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-neutral-900 dark:text-white">
                            {{ $productId ? 'Editar producto' : 'Crear producto' }}</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400  justify-self-start">
                            {{ $productId ? 'Edita los datos del producto' : 'Ingresa los datos del producto' }}
                        </p>
                    </div>
                    <button @click="modalIsOpen = false" aria-label="close modal">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                            stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Dialog Body -->
                <div class="overflow-y-auto m-2">
                    <form wire:submit="save" class="p-2">

                        <div class="w-full grid grid-cols-2 gap-2 m-2">
                            <div class="">
                                <x-input-label for="name" value="Producto" />

                                <x-text-input wire:model="name" id="name" name="name" type="text"
                                    class="mt-1 w-full" placeholder="Nombre de producto" />

                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="">
                                <x-input-label for="description" value="Descripción" />

                                <x-text-input wire:model="description" id="description" name="description"
                                    type="text" class="mt-1 w-full" placeholder="Descripción" />

                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                            <div class="">
                                <x-input-label for="price" value="Precio" />

                                <x-text-input wire:model="price" id="price" name="price" type="text"
                                    class="mt-1 w-full" placeholder="Precio" />

                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                            <div class="">
                                <x-input-label for="min_stock" value="Stock mínimo" />

                                <x-text-input wire:model="min_stock" id="min_stock" name="min_stock" type="number"
                                    class="mt-1 w-full" placeholder="Stock mínimo" />
                                @if ($stock)
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Stock actual
                                        {{ $stock }}</span>
                                @endif
                                <x-input-error :messages="$errors->get('min_stock')" class="mt-2" />
                            </div>
                            <div class="">
                                <x-input-label for="product_category_id" value="Categoría" />

                                <x-select wire:model="product_category_id" id="product_category_id"
                                    name="product_category_id" class="mt-1 w-full" :options="$categories">
                                </x-select>

                                <x-input-error :messages="$errors->get('product_category_id')" class="mt-2" />
                            </div>
                            <div class="">
                                <x-input-label for="supplier_id" value="Proveedor" />

                                <x-select wire:model="supplier_id" id="supplier_id" name="supplier_id" :options="$suppliers"
                                    class="mt-1 w-full">
                                </x-select>

                                <x-input-error :messages="$errors->get('supplier_id')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="image" value="Imagen" />

                                <x-text-input wire:model="image" id="image" type="file" name="image"
                                    class="mt-1 w-full" />

                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                        </div>
                        <x-secondary-button x-on:click="modalIsOpen = false">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-primary-button class="ms-3" wire:loading.attr="disabled">
                            {{ __('Guardar') }}
                        </x-primary-button>
                    </form>

                    @if ($image)
                        @if (!is_string($image))
                            <img src="{{ $image->temporaryUrl() }}" class="h-96 object-contain">
                        @else
                            <img src="{{ $image }}" class="h-96 object-contain">
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
