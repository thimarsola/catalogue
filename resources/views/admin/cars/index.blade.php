@extends('admin.master')

@section('content')
    <div class="bg-white mb-4 py-4 md:py-7 px-4 md:px-8 xl:px-10">
        <div class="sm:flex items-center justify-between mb-10">
            <div class="flex items-center">
                <h1 class="text-3xl font-extrabold leading-10 tracking-tight text-left text-gray-900 md:text-center sm:leading-none lg:text-4xl">Carros Cadastrados</h1>
            </div>

            <a href="{{ route('admin.cars.create') }}" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded text-sm font-medium leading-none text-white">Cadastrar Carro</a>
        </div>

        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full">
                            <thead class="border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    #
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Montadora
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Nome
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Modelo
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Motor
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Ano (Inicial/Final)
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Edição
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($cars as $car)

                                <tr class="border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <a href="{{ route('admin.automakers.edit', $car->automaker_id) }}">{{ $automakers->find($car->automaker_id)->name }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $car->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ ($car->model == null ? 'N/A' : $car->model) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $car->engine }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $car->initial_year }} / {{ $car->final_year }}
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.cars.edit', $car->id) }}"
                                               class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg  text-white">Edit</a>
                                            <form
                                                class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                                method="POST"
                                                action="{{ route('admin.cars.destroy', $car->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
