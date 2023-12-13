<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <img class="w-full h-64 object-cover object-center mb-4" src="{{ asset('storage/' . $blog->image) }}">
                    <h1 class="text-3xl font-semibold mb-2">{{ $blog->title }}</h1>
                    <p class="text-gray-600 break-words mb-10">{{ $blog->description }}</p>
                    <p class="text-sm text-gray-500">Author: {{ $blog->author }}</p>
                    <p class="text-sm text-gray-500">Published: {{ $blog->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>


        <!-- Section for showcasing other blog posts -->
        <div class="mt-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-semibold mb-4">Related Posts</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($relatedBlogs as $relatedBlog)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                        <img class="w-full h-48 object-cover object-center" src="{{ asset('storage/' . $relatedBlog->image) }}">
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h5 class="text-xl font-semibold">{{ $relatedBlog->title }}</h5>
                                <p class="text-xs text-gray-600 break-words mb-4">
                                    {{ Str::limit($blog->description, 150) }}
                                </p>
                            </div>
                            <div class="mt-auto">
                                <div class="flex justify-between items-center">
                                    <p class="text-sm text-gray-500">Author: {{ $relatedBlog->author }}</p>
                                    <p class="text-sm text-gray-500">{{ $relatedBlog->created_at->format('M d, Y') }}</p>
                                </div>
                                <a href="{{ route('blogs.show', $relatedBlog->id) }}" class="block mt-4 text-sm font-medium text-blue-500 hover:text-blue-600">Read more</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

</x-app-layout>
