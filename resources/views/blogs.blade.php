<x-app-layout>
    {{-- <?php
    dd($allCategories);
    ?> --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <div class="w-3/4 pr-8">


                <div class="max-w-3xl" id="blogsContainer">

                    <div class="py-8">
                        <div class="max-w-3xl">
                            @foreach ($blogs as $blog)
                                <a href="{{ route('blogs.show', $blog->id) }}"
                                    class="flex items-center bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                                    <div class="p-4 flex-1">
                                        <h2 class="text-lg font-semibold">{{ Str::limit($blog->title, 50) }}</h2>
                                        <p class="text-gray-600 mt-2">{{ Str::limit($blog->description, 150) }}</p>
                                        <div class="flex flex-col mt-4">
                                            @if (isset($categories[$blog->categoryid]))
                                                <p class="text-sm text-green-500">Category:
                                                    {{ $categories[$blog->categoryid] }}</p>
                                            @else
                                                <p class="text-sm text-gray-500">Category: Not Available</p>
                                            @endif
                                            <p class="text-sm text-gray-500">Author: {{ $blog->author }}</p>
                                            <p class="text-sm text-gray-500">{{ $blog->created_at->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <img class="w-32 h-32 object-cover mr-4"
                                        src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>


            {{-- Category bubble --}}

            <div class="w-1/2">
                @if (auth()->user() && auth()->user()->name === 'Admin')
                    <div class="mb-4">
                        <a href="{{ route('categories.create') }}"
                            class="text-sm font-semibold text-blue-500 hover:text-blue-600">Create New Category</a>
                    </div>
                @endif
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-4">Recommended Categories</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($allCategories as $category)
                                <div class="category-filter bg-blue-500 text-white rounded-full px-4 py-2 text-sm cursor-pointer hover:bg-blue-600 transition duration-300"
                                    data-category-id="{{ $category->id }}">
                                    {{ $category->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.category-filter').click(function() {
                var categoryId = $(this).data('category-id');

                $('.category-filter').removeClass('bg-red-500'); // Reset background color
                $(this).addClass('bg-red-500'); // Change background color for selected category

                $.ajax({
                    type: 'GET',
                    url: '/blogs/filter-by-category/' + categoryId,
                    success: function(data) {
                        $('#blogsContainer').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>


</x-app-layout>
