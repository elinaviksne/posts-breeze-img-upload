<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('List of all posts') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="post-list">
                        <a href="/posts/create" type="button" class="button">Create</a>
                        <ul>
                            @foreach ($posts as $post)
                            <li>
                                <h2>{{ $post->title }}</h2>
                                <h5>By {{ $post->user->name }}</h5>
                                <p>{{ $post->content }}</p>
                                @if ($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post Image">
                                @endif
                                <form action="/posts/{{ $post->id }}" method="post">
                                    @csrf
                                    @method('delete')

                                    <button type="submit"
                                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        Delete
                                    </button>
                                </form>
                                <div style="outline:0.01em solid black">
                                    <h2>Comments:</h2>
                                    @foreach ($post->comments as $comment)
                                    <div>
                                        <h3>By {{ $comment->user->name }}</h3>
                                        <p>{{ $comment->content }}</p>
                                    </div>
                                    @endforeach
                                </div>

                                <form action="{{ route('comments.store', $post->id) }}" method="post">
                                    @csrf

                                    <div>
                                        <textarea name="content" id="content" rows="4"
                                            required
                                            placeholder="Write your comment here..."></textarea>
                                    </div>
                                    <div>
                                        <button type="submit" class="button">Add Comment</button>
                                    </div>

                                </form>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>