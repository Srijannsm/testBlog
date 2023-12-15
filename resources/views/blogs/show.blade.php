<x-app-layout>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    @if (isset($categories[$blog->categoryid]))
                        {{-- If parent category exists, display its name --}}
                        @if ($parentCategory)
                            <li class="breadcrumb-item">
                                <a>{{ $parentCategory->name }}</a>
                            </li>
                        @endif
                        <li class="breadcrumb-item">
                            <a>{{ $categories[$blog->categoryid] }}</a>
                        </li>
                    @endif
                </ol>
            </nav>


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-3xl font-semibold mb-5">{{ $blog->title }}</h1>
                    <img class="w-full h-80 object-cover object-center mb-5"
                        src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }} Image">
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
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col mb-5">
                    <img class="w-full h-48 object-cover object-center"
                        src="{{ asset('storage/' . $relatedBlog->image) }}">
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h5 class="text-xl font-semibold">{{ $relatedBlog->title }}</h5>
                            <p class="text-xs text-gray-600 break-words mb-4">
                                {{ Str::limit($relatedBlog->description, 150) }}
                            </p>
                        </div>
                        <div class="mt-auto">
                            <div class="flex flex-col items-start space-y-2">
                                {{-- Displaying Category Name --}}
                                @if (isset($categories[$relatedBlog->categoryid]))
                                    <p class="text-sm text-green-500">Category:
                                        {{ $categories[$relatedBlog->categoryid] }}</p>
                                @else
                                    <p class="text-sm text-gray-500">Category: Not Available</p>
                                @endif
                                <p class="text-sm text-gray-500">Author: {{ $relatedBlog->author }}</p>
                                <p class="text-sm text-gray-500">{{ $relatedBlog->created_at->format('M d, Y') }}</p>
                            </div>
                            <a href="{{ route('blogs.show', $relatedBlog->id) }}"
                                class="block mt-4 text-sm font-medium text-blue-500 hover:text-blue-600">Read more</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


</x-app-layout>
