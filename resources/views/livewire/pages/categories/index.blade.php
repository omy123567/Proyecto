<div class="overflow-hidden w-full overflow-x-auto rounded-md border border-neutral-300 dark:border-neutral-700">
    <table class="w-full text-left text-sm text-neutral-600 dark:text-neutral-300">
        <caption>
            <div class="flex justify-between items-center p-4">
                <h1 class="text-lg font-semibold text-neutral-900 dark:text-white">Listado de categorías</h1>
                <livewire:pages.categories.create-edit />
            </div>
        </caption>
        <thead
            class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">
            <tr>
                <th scope="col" class="p-4">Categorías de producto</th>
                <th scope="col" class="p-4">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
            @forelse ($categories as $category)
                <tr wire:key='{{ $category->id }}'>
                    <td class="p-4">
                        <div class="flex w-max items-center gap-2">

                            <div class="flex flex-col">
                                <span class="text-neutral-900 dark:text-white">{{ $category->name }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">
                        <x-secondary-button
                            wire:click="$dispatchTo('pages.categories.create-edit','open-modal', { categoryId: '{{ $category->id }}' })">Editar</x-secondary-button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="p-4" colspan="4">
                        <div class="flex items
                        -center justify-center">
                            <span class="text-sm text-neutral-500 dark:text-neutral-400">No se encontraron
                                categorías</span>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
