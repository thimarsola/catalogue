@extends('admin.master')

@section('content')
    <div class="bg-white mb-4 py-4 md:py-7 px-4 md:px-8 xl:px-10">
        <div class="sm:flex items-center justify-between mb-10">
            <div class="flex items-center">
                <h1 class="text-3xl font-extrabold leading-10 tracking-tight text-left text-gray-900 md:text-center sm:leading-none lg:text-4xl">Editar Montadora</h1>
            </div>

            <a href="{{ route('admin.automakers.index') }}" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-indigo-700 hover:bg-indigo-600 focus:outline-none rounded text-sm font-medium leading-none text-white">Listar Montadoras</a>
        </div>

        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <div class="mx-auto max-w-md shadow-md hover:shadow-lg transition duration-300">
                            <form method="POST" action="{{ route('admin.automakers.update', $automaker->id) }}" class="py-12 p-10 bg-gray-200 rounded-xl" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-6">
                                    <label class="mr-4 text-gray-700 font-bold inline-block mb-2" for="name">Nome</label>
                                    <input type="text" name="name" id="name" value="{{ $automaker->name }}" class="w-full border bg-white py-2 px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded" placeholder="Nome da montadora" />
                                </div>
                                <div class="mb-6">
                                    <div class="p-1 bg-white flex justify-center">
                                        <img class="w-32 h-32" src="{{ Storage::url($automaker->logo) }}" alt="Logo {{ $automaker->name }}">
                                    </div>
                                    <label class="mr-4 text-gray-700 font-bold inline-block mb-2 mt-2" for="logo">Logo</label>
                                    <input type="file" id="logo" name="logo" class="w-full border bg-white py-2 px-4 outline-none focus:ring-2 focus:ring-indigo-400 rounded" />
                                </div>
                                <button type="submit" class="w-full text-white font-bold bg-indigo-700 py-3 rounded-md hover:bg-indigo-500 transition duration-300">Atualizar montadora</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
