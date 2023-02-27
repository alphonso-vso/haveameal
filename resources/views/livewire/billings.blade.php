<div class="max-w-7xl mx-auto p-6 lg:p-8">
    @if (session()->has('message'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative transition ease-in-out duration-150" role="alert" x-data="{ show: true }" x-show="show">
        <strong class="font-bold">Información!</strong>
        <span class="block sm:inline">{{ session('message') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Cerrar</title>
                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
            </svg>
        </span>
    </div>
    @endif
    <div>
        <div class="mt-1 mb-2 flex rounded-md shadow-sm">
            <input type="search" wire:model="search" name="search" id="search" class="block flex-1 rounded-none rounded-r-md rounded-l-md border-gray-300 focus:border-orange-500 focus:ring-orange-500 sm:text-sm" placeholder="Buscar">
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 uppercase">
                        {{ __('Cliente') }}
                    </th>
                    <th scope="col" class="px-6 py-3 uppercase">
                        {{ __('Orden') }}
                    </th>
                    <th scope="col" class="px-6 py-3 uppercase">
                        {{ __('Precio') }}
                    </th>
                    <th scope="col" class="px-6 py-3 uppercase">
                        {{ __('Adicionales') }}
                    </th>
                    <th scope="col" class="px-6 py-3 uppercase">
                        {{ __('Total') }}
                    </th>
                    @role('super-admin')
                    <th scope="col" class="px-6 py-3 uppercase">
                        {{ __('Acciones') }}
                    </th>
                    @endrole
                </tr>
            </thead>
            <tbody>
                @foreach($billings as $billing)
                <tr class="odd:bg-white even:bg-gray-100 bg-white border-b hover:bg-gray-100">
                    <td class="px-6 py-3">{{ $billing->costumer }}</td>
                    <td class="px-6 py-3">{{ $billing->meal }}</td>
                    <td class="px-6 py-3">₡{{ $billing->price * $billing->quantity }}</td>
                    <td class="px-6 py-3">₡{{ $billing->additional * $additionalPrice->price }}</td>
                    <td class="px-6 py-3">₡{{ ($billing->price * $billing->quantity) + ($billing->additional * $additionalPrice->price) }}</td>
                    <td class="px-6 py-3">
                        <x-danger-button  wire:loading.attr="disabled">
                            {{ __('Eliminar') }}
                        </x-danger-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $billings->links() }}
        </div>
    </div>
    <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
        <div class="text-center text-sm text-gray-500 sm:text-left">
            <div class="flex items-center gap-4">
                <a href="https://www.instagram.com/alphonso_vso/" class="group inline-flex items-center hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-orange-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="-mt-px mr-1 w-5 h-5 stroke-gray-400 group-hover:stroke-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>
                    Dev
                </a>
            </div>
        </div>
        <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">

        </div>
    </div>
  
    
</div>