<div>
    @if ($posts->count())

        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 justify-items-center">
            @foreach ($posts as $post)
                <div class="max-w-sm  border border-gray-200 rounded-lg shadow dark:bg-gray-500 dark:border-gray-700">
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Post image {{ $post->title }}"
                            class="transition ease-in hover:opacity-70 delay-100 duration-220 rounded-md" />
                        <div class="flex justify-between items-center px-3">
                            <div class="p-2">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight dark:text-white">
                                    {{ $post->title }}</h5>
                                <p class="mb-3 font-normal dark:text-gray-100">{{ $post->description }}</p>

                            </div>
                            <a href="{{ route('posts.index', $post->user) }} ">
                                <img src="{{ asset('profiles') . '/' . $post->user->image }}"
                                    alt="User image {{ $post->user->username }}"
                                    class="rounded-full max-h-11 w-12 transition ease-in hover:scale-125 delay-130 duration-250" />
                            </a>

                        </div>

                    </a>
                </div>
            @endforeach
            <div class="my-10">
                {{ $posts->links('pagination::tailwind') }}
            </div>
        </div>
    @else
        <p class="text-gray-600 uppercase text-base text-center font-bold">No hay publicaciones</p>
    @endif

</div>
