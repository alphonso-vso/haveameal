<div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-white selection:bg-orange-500 selection:text-white">
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="border rounded-lg overflow-hidden">
            <table class="table-fixed w-full">
                <thead class="bg-white rounded-t-sm">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            <div class="flex items-center">{{ __('Nombre') }}</div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            <div class="flex items-center">{{ __('Ingredientes') }}</div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            <div class="flex items-center">{{ __('Precio') }}</div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            <div class="flex items-center">{{ __('Tiempo') }}</div>
                        </th>
                        @role('Super Admin')<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                            <div class="flex items-center">{{ __('Acciones') }}</div>
                        </th>@endrole
                    </tr>
                </thead>
                <tbody class="rounded-b-sm">
                    @foreach($meals as $meal)
                    <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $meal->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $meal->ingredients }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">₡{{ $meal->price }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $meal->meal_time }}</td>
                        @role('Super Admin')
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a class="text-blue-500 hover:text-blue-700 mr-4" href="#">{{ __('Eliminar') }}</a>
                            <a class="text-blue-500 hover:text-blue-700" href="#">{{ __('Actualizar') }}</a>
                        </td>
                        @endrole
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $meals->links() }}
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
</div>