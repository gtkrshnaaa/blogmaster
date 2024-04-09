<?php
// app/Http/Controllers/Admin/AdminPostController.php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Retrieve all categories from the database
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'cover_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max size
    ]);

    $slug = Str::slug($request->title, '-');

    // Simpan foto sampul
    if ($request->hasFile('cover_photo')) {
        $coverPhotoPath = $request->file('cover_photo')->store('post_covers');
    } else {
        $coverPhotoPath = null;
    }

    // Create new post instance
    $post = new Post();
    $post->title = $request->title;
    $post->slug = $slug;
    $post->content = $request->content;
    $post->category_id = $request->category_id;
    $post->cover_photo = $coverPhotoPath;

    // Set the admin ID
    $post->admin_id = Auth::guard('admin')->id();

    // Save the post
    $post->save();

    return redirect()->route('admin.posts.index')->with('success', 'Post created successfully');
}

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all(); // Mengambil semua kategori untuk ditampilkan dalam dropdown
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'cover_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max size
        ]);

        $post = Post::findOrFail($id);

        $slug = Str::slug($request->title, '-');

        // Update foto sampul jika ada yang diunggah
        if ($request->hasFile('cover_photo')) {
            // Hapus foto sampul yang lama jika ada
            if ($post->cover_photo) {
                Storage::delete($post->cover_photo);
            }
            $coverPhotoPath = $request->file('cover_photo')->store('post_covers');
        } else {
            $coverPhotoPath = $post->cover_photo;
        }

        $post->update([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'cover_photo' => $coverPhotoPath,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Hapus foto sampul jika ada
        if ($post->cover_photo) {
            Storage::delete($post->cover_photo);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully');
    }
}
