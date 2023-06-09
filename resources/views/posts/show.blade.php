@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto md:flex px-3 md:px-0">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Post image {{ $post->title }}" class="rounded-lg" />
            <div class="p-2 flex gap-3 items-center">
                @auth
                    @if ($post->checkLike(auth()->user()))
                        <form action="{{ route('posts.likes.destroy', $post) }}" method="post">
                            @method('delete')
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @else
                        <form action="{{ route('posts.likes.store', $post) }}" method="post">
                            @csrf
                            <div class="my-4">
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    @endif

                @endauth
                <p class="font-bold">
                    {{ $post->likes->count() }}
                    <span class="font-normal">
                        Likes
                    </span>
                </p>
            </div>
            <div>
                <a href="{{ route('posts.index', $post->user) }}">
                    <p class="font-bold">{{ $post->user->username }}</p>
                </a>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-3 font-serif">{{ $post->description }}</p>
            </div>

            @auth
                @if ($post->user_id === auth()->user()->id)
                    <form action="{{ route('posts.destroy', $post) }}" method="post">
                        @method('delete')
                        @csrf
                        <input type='submit' value='Eliminar publicación'
                            class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer" />
                    </form>
                @endif
            @endauth

        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">Agrega un comentario</p>
                    @if (session('message'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form action="{{ route('comment.store', ['post' => $post, 'user' => $user]) }}" method="post">
                        @csrf
                        <div class="mb-5">
                            <label for="comment" class="mb-2 block uppercase text-gray-500 font-bold">
                                Añade un comentario
                            </label>
                            <textarea id="comment" name="comment" placeholder="Agrega un comentario"
                                class="border p-3 w-full rounded-lg 
                            @error('comment')
                                border-red-500
                            @enderror"></textarea>
                            @error('comment')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <input type="submit" value="Comentar"
                            class="bg-sky-600 hover:bg-sky-700 transition-colors 
                    cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
                    </form>
                @endauth

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comments->count())
                        @foreach ($post->comments as $comment)
                            <div class="p-5 border-gray-300 border-b ">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('posts.index', $comment->user) }}">
                                        <img src="{{ $comment->user->image ? asset('profiles') . '/' . $comment->user->image : asset('img/usuario.svg') }}"
                                            alt="User image {{ $comment->user->image }}"
                                            class="rounded-full max-h-9 w-9" />
                                    </a>
                                    <div>
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('posts.index', $comment->user) }}"
                                                class="font-bold hover:text-slate-500">
                                                {{ $comment->user->username }}
                                            </a>
                                            <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <p class="font-serif">{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentarios aun</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
