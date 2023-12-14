<x-app-layout>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <a href="{{ route('blogs.create') }}" class="text-sm font-semibold text-blue-500 hover:text-blue-600">Create
                New Blog</a>
        </div>
        <div
            class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @if (isset($blogs) && count($blogs) > 0)
                @foreach ($blogs as $blog)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                        <img class="w-full h-48 object-cover object-center" src="{{ asset('storage/' . $blog->image) }}">
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h5 class="text-xl font-semibold">{{ $blog->title }}</h5>
                                <p class="text-xs text-gray-600 break-words mb-4">
                                    {{ Str::limit($blog->description, 150) }}
                                </p>
                            </div>
                            <div class="mt-auto">
                                <div class="flex justify-between items-center">
                                    <p class="text-sm text-gray-500">Author: {{ $blog->author }}</p>
                                    <p class="text-sm text-gray-500">{{ $blog->created_at->format('M d, Y') }}</p>
                                </div>
                                @if (auth()->check() && auth()->user()->id === $blog->userid)
                                    <div class="mt-4">
                                        <a href="{{ route('blogs.edit', $blog->id) }}"
                                            class="text-sm text-blue-500 hover:text-blue-600">Edit</a>
                                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-sm text-red-500 hover:text-red-600 ml-2">Delete</button>
                                        </form>
                                        <a href="{{ route('blogs.show', $blog->id) }}"
                                            class="block mt-4 text-sm font-medium text-blue-500 hover:text-blue-600">Read
                                            more</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center text-gray-600">
                    <p>You have no blogs created.</p>
                </div>
            @endif
        </div>
    </div>




</x-app-layout>
