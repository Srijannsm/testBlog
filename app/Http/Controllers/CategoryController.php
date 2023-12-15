<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('blogs.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ];

        $validatedData = $request->validate($rules);

        Category::create($validatedData);

        return redirect()->route('blogs.index')->with('success', 'Category created successfully!');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::all();
        return view('categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ];

        $validatedData = $request->validate($rules);

        $category = Category::findOrFail($id);
        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
