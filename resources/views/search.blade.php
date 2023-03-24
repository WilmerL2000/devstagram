@extends('layouts.app')

@section('title')
    Buscar usuario
@endsection

@section('content')
    <div class="md:flex md:items-center">
        <div class="md:w-6/12 px-10">
            <form action="{{ route('search.show') }}" method="post" class="flex items-center">
                @csrf
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" id="simple-search" name="search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:placeholder-gray-400"
                        placeholder="Buscar usuario" required>
                </div>
                <button type="submit"
                    class="p-2.5 ml-2 text-sm font-medium text-white bg-sky-600 hover:bg-sky-700 transition-colors rounded-lg border border-blue-700 ">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>
        </div>
        <div class="md:w-6/12 mt-10 md:mt-0 px-2 ">
            <div class="shadow bg-white p-5 mb-5 rounded-md md:mt-10">
                <div class="flex flex-col">
                    @if (!empty($users))
                        @foreach ($users as $user)
                            <a href="{{ route('posts.index', $user->username) }}">
                                <img src="{{ $user->image ? asset('profiles') . '/' . $user->image : asset('img/usuario.svg') }}"
                                    alt="User image {{ $user->username }}"
                                    class="rounded-full max-h-11 w-12 transition ease-in hover:scale-125 delay-130 duration-250" />
                                {{ $user->username }}
                            </a>
                        @endforeach
                    @else
                        <p class=" text-center">No hay resultados</p>
                    @endif
                </div>
            </div>
        </div>


    </div>
@endsection
