<?php



namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all(); // Retrieve all blog entries

        // Fetch category names for each blog using the category_id
        $categoryIds = $blogs->pluck('categoryid')->unique()->toArray();
        $categories = DB::table('categories')->whereIn('id', $categoryIds)->pluck('name', 'id');
        // dd($categories);

        return view('blogs', ['blogs' => $blogs, 'categories' => $categories]);
    }
    public function indexUser()
    {
        $user = Auth::user();
        $blogs = Blog::where('userid', $user->id)->get();
        $categoryIds = $blogs->pluck('categoryid')->unique()->toArray();
        $categories = DB::table('categories')->whereIn('id', $categoryIds)->pluck('name', 'id');

        return view('blogs.index', ['blogs' => $blogs, 'categories' => $categories]);
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->get();


        return view('blogs.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // dd($data);

        $user = Auth::user();

        $imagePath = $data['image']->store('images', 'public');


        $newBlog = Blog::create([
            'userid' => $user->id,
            'image' => $imagePath,
            'title' => $data['title'],
            'author' => $user->name,
            'description' => $data['description'],
            'categoryid' => $data['category'],
        ]);
        // dd($newBlog);
        session()->flash('success', 'Blog created successfully.');
        return redirect()->route('blogs.user');
    }



        public function show($id)
        {
            $blog = Blog::findOrFail($id);
            $categoryIds = $blog->pluck('categoryid')->unique()->toArray();
            $categories = DB::table('categories')->whereIn('id', $categoryIds)->pluck('name', 'id');
            // dd($categories);
            $categoryId = $blog->categoryid;


            // Fetch the parent category ID for the current blog
            $parentCategoryId = Category::where('id', $categoryId)->value('parent_id');

            $parentCategory = Category::find($blog->categoryid)->parent;


            // Fetch related blogs based on the same category ID and parent ID
            $relatedBlogs = Blog::where('id', '!=', $id)
        ->where(function ($query) use ($categoryId, $parentCategoryId) {
            $query->where('categoryid', $categoryId)
                ->orWhere('categoryid', $parentCategoryId);
        })
        ->limit(4)
        ->get();


            return view('blogs.show', compact('blog', 'relatedBlogs', 'categories','parentCategory'));
        }


    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        return view('blogs.edit', ['blog' => $blog]);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $data['image']->store('images', 'public');
            $blog->image = $imagePath;
        } elseif (!$request->hasFile('image') && $blog->image) {
            // No new image uploaded, but the blog already has an image
            // Retain the existing image
            $data['image'] = $blog->image;
        }

        $blog->title = $data['title'];
        $blog->description = $data['description'];
        $blog->save();

        session()->flash('success', 'Blog updated successfully.');
        return redirect()->route('blogs.user');
    }


    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        $blog->delete();
        session()->flash('success', 'Blog deleted successfully.');
        return redirect()->route('blogs.user');
    }
}
