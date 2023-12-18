@if (isset($blogs) && count($blogs) > 0)
    @foreach ($blogs as $blog)
        <a href="{{ route('blogs.show', $blog->id) }}"
            class="flex items-center bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
            <div class="p-4 flex-1">
                <h2 class="text-lg font-semibold">{{ Str::limit($blog->title, 50) }}</h2>
                <p class="text-gray-600 mt-2">{{ Str::limit($blog->description, 150) }}</p>
                <div class="flex flex-col mt-4">
                    @if (isset($categoryName))
                        <p class="text-sm text-green-500">Category: {{ $categoryName }}</p>
                    @else
                        <p class="text-sm text-gray-500">Category: Not Available</p>
                    @endif
                    <p class="text-sm text-gray-500">Author: {{ $blog->author }}</p>
                    <p class="text-sm text-gray-500">{{ $blog->created_at->format('M d, Y') }}</p>
                </div>
            </div>
            <img class="w-32 h-32 object-cover mr-4" src="{{ asset('storage/' . $blog->image) }}"
                alt="{{ $blog->title }}">
        </a>
    @endforeach
@else
    <div class="text-center text-gray-600">
        <p>No Blogs related to {{ $categoryName }}</p>
    </div>
@endif
