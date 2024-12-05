<div class="overflow-hidden w-full overflow-x-auto rounded-md border border-neutral-300 dark:border-neutral-700">
    <table class="w-full text-left text-sm text-neutral-600 dark:text-neutral-300">
        <caption>
            <div class="flex justify-between items-center p-4">
                <h1 class="text-lg font-semibold text-neutral-900 dark:text-white">Listado de ventas a clientes</h1>
                <a href="{{ route('sales.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Nueva
                    venta</a>

            </div>
        </caption>
        <thead
            class="border-b border-neutral-300 bg-neutral-50 text-sm text-neutral-900 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white">
            <tr>
                <th scope="col" class="p-4">Fecha</th>
                <th scope="col" class="p-4">Productos</th>
                <th scope="col" class="p-4">Método de pago</th>
                <th scope="col" class="p-4">Total Venta</th>
                <th scope="col" class="p-4">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-neutral-300 dark:divide-neutral-700">
            @forelse ($sales as $sale)
                <tr wire:key='{{ $sale->id }}'>
                    <td class="p-4">
                        <div class="flex w-max items-center gap-2">

                            <div class="flex flex-col">
                                <span class="text-neutral-900 dark:text-white">{{ $sale->datetime_sale }}</span>

                            </div>
                        </div>
                    </td>
                    <td>
                        @foreach ($sale->products as $product)
                            <div class="p-4 flex flex-col">
                                <span class="text-neutral-900 dark:text-white">{{ $product->name }}</span>
                                <small class="text-sm text-neutral-600 opacity-85 dark:text-neutral-300">precio venta:
                                    ${{ $product->pivot->sale_price }}</small>
                                <small class="text-sm text-neutral-600 opacity-85 dark:text-neutral-300">cantidad:
                                    {{ $product->pivot->quantity }}</small>                                    
                            </div>
                        @endforeach
                    </td>
                    <td class="p-4"> {{ $sale->paymentMethod->name }} </td>
                    <td class="p-4"> ${{ $sale->total }} </td>

                </tr>
            @empty
                <tr>
                    <td class="p-4" colspan="4">
                        <div class="flex items
                        -center justify-center">
                            <span class="text-sm text-neutral-500 dark:text-neutral-400">No se encontraron
                                ventas</span>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
