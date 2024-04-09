<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class AuthorPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $author = Auth::guard('author')->user();

        if ($author) {
            $posts = $author->posts()->latest()->get();
            return view('author.posts.index', compact('posts'));
        } else {
            return redirect()->route('author.login')->with('error', 'Please log in to view this page.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('author.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $author = Auth::guard('author')->user();

        if ($author) {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $coverPhotoPath = null;
            if ($request->hasFile('cover_photo')) {
                $coverPhotoPath = $request->file('cover_photo')->store('post_covers');
            }

            $post = new Post();
            $post->title = $request->title;
            $post->slug = Str::slug($request->title, '-');
            $post->content = $request->content;
            $post->category_id = $request->category_id;
            $post->cover_photo = $coverPhotoPath;
            $post->author_id = $author->id;
            $post->save();

            return redirect()->route('author.posts.index')->with('success', 'Post created successfully');
        } else {
            return redirect()->route('author.login')->with('error', 'Please log in to create a post.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('author.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $author = Auth::guard('author')->user();

        if ($author && $post->author_id === $author->id) {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $coverPhotoPath = $post->cover_photo;

            if ($request->hasFile('cover_photo')) {
                // Hapus foto sampul yang lama jika ada
                if ($post->cover_photo) {
                    Storage::delete($post->cover_photo);
                }
                $coverPhotoPath = $request->file('cover_photo')->store('post_covers');
            }

            $post->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title, '-'),
                'content' => $request->content,
                'category_id' => $request->category_id,
                'cover_photo' => $coverPhotoPath,
            ]);

            return redirect()->route('author.posts.index')->with('success', 'Post updated successfully');
        } else {
            return redirect()->back()->with('error', 'Unauthorized access');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('author.posts.show', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $author = Auth::guard('author')->user();

        if ($author && $post->author_id === $author->id) {
            if ($post->cover_photo) {
                Storage::delete($post->cover_photo);
            }

            $post->delete();

            return redirect()->route('author.posts.index')->with('success', 'Post deleted successfully');
        } else {
            return redirect()->route('author.posts.index')->with('error', 'Unauthorized access');
        }
    }
}

