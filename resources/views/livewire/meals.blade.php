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
            <input type="search" wire:model="search" name="search" id="search" class="block flex-1 rounded-none rounded-r-md rounded-l-md border-gray-300 focus:border-orange-500 focus:ring-orange-500 sm:text-sm mr-4" placeholder="Buscar">
            <button wire:click="confirmMealAdd" class="text-blue-500 hover:text-blue-700 mr-4 transition ease-in-out duration-150">{{ __('Agregar') }}</button>
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
                    @role('super-admin')
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
                    @role('super-admin')
                        @if ($meal->meal_time_id !== 1 && $meal->meal_time_id !== 2)
                        <td class="px-6 py-3">
                            <a wire:click="confirmMealEdit({{ $meal->id }})" class="text-blue-500 hover:text-blue-700 mr-4 transition ease-in-out duration-150" href="#">{{ __('Actualizar') }}</a>
                            <x-danger-button wire:click="confirmMealDeletion({{ $meal->id }})" wire:loading.attr="disabled">
                                {{ __('Eliminar') }}
                            </x-danger-button>
                        </td>
                        @endif
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
    <!-- Add Meal Confirmation Modal -->
    <x-dialog-modal wire:model="confirmingMealAdd">
        <x-slot name="title">
            {{ isset($this->meal->id) ? 'Editar comida' : 'Agregar comida' }}
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Nombre') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="meal.name" />
                <x-input-error for="name" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="ingredients" value="{{ __('Ingredientes') }}" />
                <x-input id="ingredients" type="text" class="mt-1 block w-full" wire:model.defer="meal.ingredients" />
                <x-input-error for="ingredients" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="meal_time_id" value="{{ __('Tiempo de comida') }}" />
                <select wire:model.defer="meal.meal_time_id" id="meal_time_id" class="mt-1 block w-full border-gray-300 focus:border-orange-500 focus:ring-orange-500 rounded-md shadow-sm">
                    <option value="">{{ __('Selecciona un opción') }}</option>
                    @if(count($meal_times) > 0)
                        @foreach ($meal_times as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    @endif
                </select>
                <x-input-error for="meal_time_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="price" value="{{ __('Precio') }}" />
                <x-input id="price" type="text" class="mt-1 block w-full" wire:model.defer="meal.price" />
                <x-input-error for="price" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingMealAdd', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="saveMeal({{ $confirmingMealAdd }})" wire:loading.attr="disabled">
                {{ __('Guardar') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>