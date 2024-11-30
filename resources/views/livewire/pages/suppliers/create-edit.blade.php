<div>
    <x-primary-button x-on:click="$dispatch('open-modal')">Crear proveedor</x-primary-button>
    <x-modal name="create-edit-provider" focusable>
        <form wire:submit="save" class="p-6">

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 justify-self-start">
                {{ $supplierId ? 'Editar proveedor' : 'Crear proveedor' }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400  justify-self-start">
                {{ $supplierId ? 'Edita los datos del proveedor' : 'Ingresa los datos del proveedor' }}
            </p>

            <div class="w-full grid grid-cols-2 gap-2 m-2">
                <div class="">
                    <x-input-label for="name" value="Proveedor" />

                    <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 w-full"
                        placeholder="Nombre de proveedor" />

                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="">
                    <x-input-label for="email" value="Correo electrónico" />

                    <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 w-full"
                        placeholder="Correo electrónico" />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="">
                    <x-input-label for="phone" value="Teléfono" />

                    <x-text-input wire:model="phone" id="phone" name="phone" type="text" class="mt-1 w-full"
                        placeholder="Teléfono" />

                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
                <div class="">
                    <x-input-label for="address" value="Dirección" />

                    <x-text-input wire:model="address" id="address" name="address" type="text" class="mt-1 w-full"
                        placeholder="Dirección" />

                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
                <div class="col-span-2">
                    <x-input-label for="observations" value="Observaciones" />

                    <x-text-input wire:model="observations" id="observations" name="observations" type="text"
                        class="mt-1 w-full" placeholder="Observaciones" />

                    <x-input-error :messages="$errors->get('observations')" class="mt-2" />
                </div>

            </div>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ms-3">
                    {{ __('Guardar') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>

</div>
