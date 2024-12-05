<div class="overflow-hidden w-full overflow-x-auto rounded-md border border-neutral-300 dark:border-neutral-700">
    <table class="w-full text-left text-sm text-neutral-600 dark:text-neutral-300">
        <caption>
            <div class="flex justify-between items-center p-4">
                <h1 class="text-lg font-semibold text-neutral-900 dark:text-white">Listado de productos</h1>
                <livewire:pages.products.create-edit />
            </div>
        </caption>
        <thead
            class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">
            <tr>
                <th scope="col" class="p-4">Imagen</th>
                <th scope="col" class="p-4">Nombre</th>
                <th scope="col" class="p-4">Stock</th>
                <th scope="col" class="p-4">Stock Mínimo</th>
                <th scope="col" class="p-4">Descripción</th>
                <th scope="col" class="p-4">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
            @forelse ($products as $product)
                <tr wire:key='{{ $product->id }}'>
                    <td class="p-4">
                        @if ($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover">
                        @else
                            <div class="w-10 h-10 bg-neutral-200 dark:bg-neutral-800 rounded-full"></div>
                        @endif
                    </td>                    
                    <td class="p-4">
                        <div class="flex w-max items-center gap-2">
                            <div class="flex flex-col">
                                <span class="text-neutral-900 dark:text-white">{{ $product->name }}</span>
                                <span
                                    class="text-sm text-neutral-600 opacity-85 dark:text-neutral-300">${{ $product->price }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">{{ $product->stock }}</td>
                    <td class="p-4">{{ $product->min_stock }}</td>
                    <td class="p-4">{{ $product->description }}</td>
                    <td class="p-4">
                        <x-secondary-button
                            wire:click="$dispatchTo('pages.products.create-edit','open-modal', { product: '{{ $product->id }}' })">Editar</x-secondary-button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="p-4" colspan="4">
                        <div class="flex items
                        -center justify-center">
                            <span class="text-sm text-neutral-500 dark:text-neutral-400">No se encontraron
                                productos</span>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $products->links() }}
    
</div>
