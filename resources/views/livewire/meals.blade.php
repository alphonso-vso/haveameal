<div class="max-w-7xl mx-auto p-6 lg:p-8">
    <div>
        <div class="mt-1 mb-2 flex rounded-md shadow-sm">
            <input type="search" wire:model="search" name="search" id="search" class="block flex-1 rounded-none rounded-r-md rounded-l-md border-gray-300 focus:border-orange-500 focus:ring-orange-500 sm:text-sm mr-4" placeholder="Buscar">
            <button class="text-blue-500 hover:text-blue-700 mr-4 transition ease-in-out duration-150">{{ __('Agregar') }}</button>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 uppercase">
                        {{ __('Nombre') }}
                    </th>
                    <th scope="col" class="px-6 py-3 uppercase">
                        {{ __('Ingredientes') }}
                    </th>
                    <th scope="col" class="px-6 py-3 uppercase">
                        {{ __('Precio') }}
                    </th>
                    <th scope="col" class="px-6 py-3 uppercase">
                        {{ __('Tiempo') }}
                    </th>
                    @role('Super Admin')
                    <th scope="col" class="px-6 py-3 uppercase">
                        {{ __('Acciones') }}
                    </th>
                    @endrole
                </tr>
            </thead>
            <tbody>
                @foreach($meals as $meal)
                <tr class="odd:bg-white even:bg-gray-100 bg-white border-b hover:bg-gray-100">
                    <td class="px-6 py-3">{{ $meal->name }}</td>
                    <td class="px-6 py-3">{{ $meal->ingredients }}</td>
                    <td class="px-6 py-3">₡{{ $meal->price }}</td>
                    <td class="px-6 py-3">{{ $meal->meal_time }}</td>
                    @role('Super Admin')
                    <td class="px-6 py-3">
                        <a class="text-blue-500 hover:text-blue-700 mr-4 transition ease-in-out duration-150" href="#">{{ __('Actualizar') }}</a>
                        <x-danger-button wire:click="confirmMealDeletion({{ $meal->id }})" wire:loading.attr="disabled">
                            {{ __('Eliminar') }}
                        </x-danger-button>
                    </td>
                    @endrole
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $meals->links() }}
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
    <!-- Delete Meal Confirmation Modal -->
    <x-dialog-modal wire:model="confirmingMealDeletion">
        <x-slot name="title">
            {{ __('Eliminar comida') }}
        </x-slot>

        <x-slot name="content">
            {{ __('¿Estás seguro de eliminar esta comida? Una vez elimines esta comida todos sus datos se perderan.') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingMealDeletion', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="deleteMeal({{ $confirmingMealDeletion }})" wire:loading.attr="disabled">
                {{ __('Eliminar') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>