<section class="text-gray-600 body-font overflow-hidden">
    <div class="container px-5 py-12 mx-auto">
        <div class="flex flex-col text-center w-full mb-20">
            <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">{{ __('Otros') }}</h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base text-gray-500">{{ __('Para calmar un poco los antojos ') }}&#127852;</p>
            <div class="flex mx-auto border-2 border-sky-500 rounded overflow-hidden mt-6">                
                <button class="py-1 px-4 focus:outline-none hover:bg-sky-500 hover:text-white transition ease-in-out duration-150">{{ __('Desayuno') }}</button>
                <button class="py-1 px-4 focus:outline-none hover:text-white transition ease-in-out duration-150">{{ __('Almuerzo') }}</button>
                <button class="py-1 px-4 focus:outline-none hover:text-white transition ease-in-out duration-150">{{ __('Merienda') }}</button>
                <button class="py-1 px-4 bg-sky-500 text-white focus:outline-none hover:text-white transition ease-in-out duration-150">{{ __('Otros') }}</button> 
            </div>

            <div>
                @if (session()->has('message'))
                <div class="mt-4 bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative transition ease-in-out duration-150" role="alert" x-data="{ show: true }" x-show="show">
                    <strong class="font-bold">Información!</strong>
                    <span class="block sm:inline">{{ session('message') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="show = false">
                        <svg class="fill-current h-6 w-6 text-emerald-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Cerrar</title>
                            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </span>
                </div>
                @endif
            </div>

        </div>

        <div class="flex flex-wrap -m-4">
            @foreach($otherss as $other)
            <div class="p-4 xl:w-1/4 md:w-1/2 w-full">
                <div class="h-full p-6 rounded-lg border-2 border-sky-500 flex flex-col relative overflow-hidden">
                    <span class="bg-sky-500 text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl uppercase">{{ $other->day }}</span>
                    <h2 class="text-sm tracking-widest title-font mb-1 font-medium uppercase">{{ $other->meal }}</h2>
                    <h1 class="text-5xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                        <span>₡{{ $other->price }}</span>
                    </h1>
                    @role('super-admin')
                    <button wire:click="confirmMealEdit({{ $other->id }})" class="flex items-center mt-auto text-white bg-rose-500 border-0 py-2 px-4 w-full focus:outline-none hover:bg-rose-600 rounded transition ease-in-out duration-150">{{ __('Editar') }}
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    @else
                    <button wire:click="confirmMealOrdering({{ $other->id }})" class="flex items-center mt-auto text-white bg-emerald-500 border-0 py-2 px-4 w-full focus:outline-none hover:bg-emerald-600 rounded transition ease-in-out duration-150">{{ __('Ordenar') }}
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-auto" viewBox="0 0 24 24">
                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                        </svg>
                    </button>
                    @endrole
                    <p class="text-xs text-gray-500 mt-3">{{ __('Cada adicional tiene un costo extra') }}.</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Add Meal Confirmation Modal -->
    <x-dialog-modal wire:model="confirmingMealAdd">
        <x-slot name="title">
            'Editar plato del día'
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="meal_id" value="{{ __('Plato') }}" />
                <select wire:model.defer="other.meal_id" id="meal_id" class="mt-1 block w-full border-gray-300 focus:border-sky-500 focus:ring-sky-500 rounded-md shadow-sm">
                    <option value="">{{ __('Selecciona un opción') }}</option>
                    @if(count($meals) > 0)
                    @foreach ($meals as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                    @endif
                </select>
                <x-input-error for="meal_id" class="mt-2" />
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
    <!-- Order Meal Confirmation Modal -->
    <x-dialog-modal wire:model="confirmingMealOrder">
        <x-slot name="title">
            'Ordenar'
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4" hidden>
                <x-label for="meal_id" value="{{ __('ID Comida') }}" />
                <x-input id="meal_id" type="number" class="mt-1 block w-full" wire:model.defer="other.meal_id" />
                <x-input-error for="meal_id" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="quantity" value="{{ __('Cantidad') }}" />
                <x-input id="quantity" type="number" class="mt-1 block w-full" wire:model.defer="order.quantity" />
                <x-input-error for="quantity" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="additional" value="{{ __('Adicionales') }}" />
                <x-input id="additional" type="number" class="mt-1 block w-full" wire:model.defer="order.additional" />
                <x-input-error for="additional" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('confirmingMealOrder', false)" wire:loading.attr="disabled">
                {{ __('Cancelar') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="orderMeal({{ $confirmingMealOrder }})" wire:loading.attr="disabled">
                {{ __('Ordenar') }}
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</section>