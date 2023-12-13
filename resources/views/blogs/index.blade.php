<x-app-layout>
    @if(session('success'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <a href="{{ route('blogs.create') }}" class="text-sm font-semibold text-blue-500 hover:text-blue-600">Create New Blog</a>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
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
                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="text-sm text-blue-500 hover:text-blue-600">Edit</a>
                                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-500 hover:text-red-600 ml-2">Delete</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
