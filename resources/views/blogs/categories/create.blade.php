<x-app-layout>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Category Name:</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Parent Category:</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="">Select Parent Category (optional)</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary">Create Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
