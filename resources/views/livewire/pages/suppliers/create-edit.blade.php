<div>
    <div x-data="{ modalIsOpen: $wire.entangle('openModal').live }">
        <x-primary-button x-on:click="modalIsOpen = true">Crear proveedor</x-primary-button>

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
                            {{ $supplierId ? 'Editar proveedor' : 'Crear proveedor' }}</h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400  justify-self-start">
                            {{ $supplierId ? 'Edita los datos del proveedor' : 'Ingresa los datos del proveedor' }}
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
                <div class="">
                    <form wire:submit="save" class="p-6">

                        <div class="w-full grid grid-cols-2 gap-2 m-2">
                            <div class="">
                                <x-input-label for="name" value="Proveedor" />

                                <x-text-input wire:model="name" id="name" name="name" type="text"
                                    class="mt-1 w-full" placeholder="Nombre de proveedor" />

                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="">
                                <x-input-label for="email" value="Correo electrónico" />

                                <x-text-input wire:model="email" id="email" name="email" type="email"
                                    class="mt-1 w-full" placeholder="Correo electrónico" />

                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="">
                                <x-input-label for="phone" value="Teléfono" />

                                <x-text-input wire:model="phone" id="phone" name="phone" type="text"
                                    class="mt-1 w-full" placeholder="Teléfono" />

                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                            </div>
                            <div class="">
                                <x-input-label for="address" value="Dirección" />

                                <x-text-input wire:model="address" id="address" name="address" type="text"
                                    class="mt-1 w-full" placeholder="Dirección" />

                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>
                            <div class="col-span-2">
                                <x-input-label for="observations" value="Observaciones" />

                                <x-text-input wire:model="observations" id="observations" name="observations"
                                    type="text" class="mt-1 w-full" placeholder="Observaciones" />

                                <x-input-error :messages="$errors->get('observations')" class="mt-2" />
                            </div>

                        </div>
                        <x-secondary-button x-on:click="modalIsOpen = false">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-primary-button class="ms-3">
                            {{ __('Guardar') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
