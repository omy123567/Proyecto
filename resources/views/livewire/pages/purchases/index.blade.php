<div class="overflow-hidden w-full overflow-x-auto rounded-md border border-neutral-300 dark:border-neutral-700">
    <table class="w-full text-left text-sm text-neutral-600 dark:text-neutral-300">
        <caption>
            <div class="flex justify-between items-center p-4">
                <h1 class="text-lg font-semibold text-neutral-900 dark:text-white">Listado de compras de insumos</h1>
                <livewire:pages.purchases.create-edit />
            </div>
        </caption>
        <thead
            class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">
            <tr>
                <th scope="col" class="p-4">Fecha</th>
                <th scope="col" class="p-4">Productos</th>
                <th scope="col" class="p-4">Proveedor</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
            @forelse ($purchases as $purchase)
                <tr wire:key='{{ $purchase->id }}'>
                    <td class="p-4">
                        <div class="flex w-max items-center gap-2">

                            <div class="flex flex-col">
                                <span class="text-neutral-900 dark:text-white">{{ $purchase->date_purchase->format('d-m-Y') }}</span>

                            </div>
                        </div>
                    </td>
                    <td class="p-4">
                        @foreach ($purchase->products as $product)
                            <span class="text-neutral-900 dark:text-white">{{ $product->name }}</span>
                        @endforeach
                    </td>
                    <td class="p-4"> {{ $purchase->supplier->name }} </td>
                    
                </tr>
            @empty
                <tr>
                    <td class="p-4" colspan="4">
                        <div class="flex items
                        -center justify-center">
                            <span class="text-sm text-neutral-500 dark:text-neutral-400">No se encontraron
                                compras</span>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
