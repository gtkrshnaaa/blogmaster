<?php
// PublicController.php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
{
    $posts = Post::with(['category', 'author']) // Memuat relasi kategori dan penulis
                 ->whereNotNull('cover_photo') // Hanya ambil post dengan cover photo
                 ->latest()
                 ->take(5)
                 ->get();

    $categories = Category::all();
    
    return view('public.home.index', compact('posts', 'categories'));
}


    public function showPost($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        
        return view('public.post_detail', compact('post'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $posts = Post::where('title', 'like', '%'.$query.'%')->get();
        $categories = Category::all();
        
        return view('public.home.index', compact('posts', 'categories'));
    }
}

