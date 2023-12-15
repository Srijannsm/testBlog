<x-app-layout>
    <div class="py-12">
        @if (auth()->user() && auth()->user()->name === 'Admin')
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
                <a href="{{ route('categories.create') }}"
                    class="text-sm font-semibold text-blue-500 hover:text-blue-600">Create New Category</a>
            </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($blogs as $blog)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                        <div class="relative">
                            <img class="w-full h-48 object-cover object-center"
                                src="{{ asset('storage/' . $blog->image) }}">
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <h5 class="text-xl font-semibold">
                                {{ Str::limit($blog->title, 20) }}
                            </h5>
                            <p class="text-xs text-gray-600 break-words mb-4">
                                {{ Str::limit($blog->description, 150) }}
                            </p>
                            <div class="mt-auto">
                                <div class="flex flex-col items-start space-y-2">
                                   {{-- @dd($categories); --}}
                                    @if (isset($categories[$blog->categoryid]))
                                        <p class="text-sm text-green-500">Category: {{ $categories[$blog->categoryid] }}</p>
                                    @else
                                        <p class="text-sm text-gray-500">Category: Not Available</p>
                                    @endif
                                    <p class="text-sm text-gray-500">Author: {{ $blog->author }}</p>
                                    <p class="text-sm text-gray-500">{{ $blog->created_at->format('M d, Y') }}</p>
                                </div>

                                <a href="{{ route('blogs.show', $blog->id) }}"
                                    class="block mt-4 text-sm font-medium text-blue-500 hover:text-blue-600">Read
                                    more</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
