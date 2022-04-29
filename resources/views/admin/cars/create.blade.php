@extends('admin.master')

@section('content')
    <div class="bg-white mb-4 py-4 md:py-7 px-4 md:px-8 xl:px-10">
        <div class="sm:flex items-center justify-between mb-10">
            <div class="flex items-center">
                <h1 class="text-3xl font-extrabold leading-10 tracking-tight text-left text-gray-900 md:text-center sm:leading-none lg:text-4xl">Cadastrar Carro</h1>
            </div>

            <a href="{{ route('admin.cars.index') }}" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded text-sm font-medium leading-none text-white">Listar Carros</a>
        </div>

        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">

                        @if($errors->all())
                            @foreach($errors->all() as $error)
                                <div class="flex bg-red-100 rounded-lg p-4 mb-4 text-sm text-red-700" role="alert">
                                    <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                    <div>
                                        <span class="font-medium">Erro!</span> {{ $error }}
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="mx-auto max-w-md shadow-md hover:shadow-lg transition duration-300">
                            <form method="POST" action="{{ route('admin.cars.store') }}" class="py-12 p-10 bg-gray-200 rounded-xl">
                                @csrf
                                <div class="mb-6">
                                    <label class="mr-4 text-gray-700 font-bold inline-block mb-2" for="automaker">Montadora</label>
                                    <input list="automakers" name="automaker_id" id="automaker" class="w-full border bg-white py-2 px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded" placeholder="Selecione um produto">
                                    <datalist id="automakers">
                                        @foreach ($automakers as $automaker)
                                            <option value="{{ $automaker->id }}">
                                                {{ $automaker->name }}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                                <div class="mb-6">
                                    <label class="mr-4 text-gray-700 font-bold inline-block mb-2" for="name">Nome veículo</label>
                                    <input type="text" name="name" id="name" class="w-full border bg-white py-2 px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded" placeholder="Nome do veículo" />
                                </div>
                                <div class="mb-6">
                                    <label class="mr-4 text-gray-700 font-bold inline-block mb-2" for="model">Modelo do veículo</label>
                                    <input type="text" name="model" id="model" class="w-full border bg-white py-2 px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded" placeholder="Modelo do veículo" />
                                </div>
                                <div class="mb-6">
                                    <label class="mr-4 text-gray-700 font-bold inline-block mb-2" for="engine">Motor do veículo</label>
                                    <input type="text" name="engine" id="engine" class="w-full border bg-white py-2 px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded" placeholder="Motor do veículo" />
                                </div>
                                <div class="mb-6">
                                    <label class="mr-4 text-gray-700 font-bold inline-block mb-2" for="initial_year">Ano inicial</label>
                                    <input type="number" name="initial_year" id="initial_year" class="w-full border bg-white py-2 px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded" placeholder="Ano inicial de fabricação" />
                                </div>
                                <div class="mb-6">
                                    <label class="mr-4 text-gray-700 font-bold inline-block mb-2" for="final_year">Ano final</label>
                                    <input type="number" name="final_year" id="final_year" class="w-full border bg-white py-2 px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded" placeholder="Ano final de fabricação" />
                                </div>

                                <div class="mb-6">
                                    <label class="mr-4 text-gray-700 font-bold inline-block mb-2" for="product">Produtos</label>
                                    <input list="products" name="product" id="product" class="w-full border bg-white py-2 px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded" placeholder="Selecione um produto">
                                    <datalist id="products">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">
                                                {{ $product->internal_code }} - {{ $product->name }}</option>
                                        @endforeach
                                    </datalist>
                                </div>

                                <button type="submit" class="w-full text-white font-bold bg-indigo-700 py-3 rounded-md hover:bg-indigo-500 transition duration-300">Cadastrar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
