<div class="overflow-hidden w-full overflow-x-auto rounded-md border border-neutral-300 dark:border-neutral-700">
    <table class="w-full text-left text-sm text-neutral-600 dark:text-neutral-300">
        <caption>
            <div class="flex justify-between items-center p-4">
                <h1 class="text-lg font-semibold text-neutral-900 dark:text-white">Listado de proveedores</h1>
                <livewire:pages.suppliers.create-edit />
            </div>
        </caption>
        <thead
            class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">
            <tr>
                <th scope="col" class="p-4">Proveedor</th>
                <th scope="col" class="p-4">Teléfono</th>
                <th scope="col" class="p-4">Dirección</th>
                <th scope="col" class="p-4">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
            @forelse ($suppliers as $supplier)
                <tr wire:key='{{ $supplier->id }}'>
                    <td class="p-4">
                        <div class="flex w-max items-center gap-2">

                            <div class="flex flex-col">
                                <span class="text-neutral-900 dark:text-white">{{ $supplier->name }}</span>
                                <span
                                    class="text-sm text-neutral-600 opacity-85 dark:text-neutral-300">{{ $supplier->email }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">{{ $supplier->phone }}</td>
                    <td class="p-4">{{ $supplier->address }}</td>
                    <td class="p-4">
                        <x-secondary-button>Editar</x-secondary-button>
                        <x-primary-button>Ver</x-primary-button>
                    </td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</div>
