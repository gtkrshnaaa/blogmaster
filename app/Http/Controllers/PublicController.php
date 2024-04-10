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
        // Ambil recent post dengan pagination
        $posts = Post::with(['category', 'author'])
            ->latest()
            ->paginate(5); // Ubah angka 3 sesuai dengan jumlah postingan yang ingin ditampilkan per halaman

        // Ambil popular post berdasarkan jumlah view
        $popularPosts = Post::with('category')
            ->orderBy('view_count', 'desc')
            ->take(5)
            ->get();

        $categories = Category::all();

        return view('public.home.index', compact('posts', 'popularPosts', 'categories'));
    }

    public function showPost($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        // Tambahkan jumlah view menggunakan model Eloquent
        $post->increment('view_count');

        // Ambil popular post berdasarkan jumlah view
        $popularPosts = Post::with('category')
            ->orderBy('view_count', 'desc')
            ->take(5)
            ->get();

        // Ambil daftar kategori
        $categories = Category::all();

        return view('public.posts.showdetail', compact('post', 'popularPosts', 'categories'));
    }

    public function showPostsByCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        // Query untuk mencari post berdasarkan judul dan kategori
        $query = $request->input('q');
        $postsQuery = Post::where('category_id', $category->id);
        
        if ($query) {
            $postsQuery->where('title', 'like', '%' . $query . '%');
        }
        
        // Ambil data post dengan pagination
        $posts = $postsQuery->paginate(5);

        // Ambil popular post berdasarkan jumlah view
        $popularPosts = Post::orderBy('view_count', 'desc')->take(5)->get();
        
        $categories = Category::all();

        return view('public.posts.category', compact('category', 'posts', 'popularPosts', 'categories', 'query'));
    }



    public function search(Request $request)
    {
        $query = $request->input('q');
        $posts = Post::where('title', 'like', '%' . $query . '%')->paginate(3);
        $categories = Category::all();
        $popularPosts = []; // Set popularPosts ke array kosong jika ada pencarian

        return view('public.home.index', compact('posts', 'categories', 'popularPosts'));
    }
}
