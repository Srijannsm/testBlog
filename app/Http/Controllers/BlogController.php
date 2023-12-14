<?php



namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('blogs', ['blogs' => $blogs]);
    }
    public function indexUser()
    {
        $user = Auth::user();
        $blogs = Blog::where('userid', $user->id)->get();
        // dd($blogs);
        return view('blogs.index', ['blogs' => $blogs]);
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
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
        ]);
        // dd($newBlog);
        session()->flash('success', 'Blog created successfully.');
        return redirect()->route('blogs.user');
    }



    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        // Fetch related blogs excluding the current one
        $relatedBlogs = Blog::where('id', '!=', $id)->limit(4)->get();

        return view('blogs.show', compact('blog', 'relatedBlogs'));
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
