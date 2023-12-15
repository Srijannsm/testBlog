<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-4">Edit Blog Post</h2>
                    <form class="w-full max-w-lg" method="POST" action="{{ route('blogs.update', $blog->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- For the update method -->

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-600 mb-2">Title</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300"
                                placeholder="Enter Blog Title"
                                value="{{ $blog->title }}"
                                required
                            >
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-600 mb-2">Description</label>
                            <textarea
                                id="description"
                                name="description"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300"
                                placeholder="Enter Blog Description"
                                rows="4"
                                required
                            >{{ $blog->description }}</textarea> <!-- Fill with existing description -->
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-600 mb-2">Upload Image</label>
                            <input
                                type="file"
                                id="image"
                                name="image"
                                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300"
                                accept="image/*"
                                
                            >
                        </div>
                        <button
                            class="w-full p-3 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300"
                            type="submit"
                        >
                            Update Blog
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
