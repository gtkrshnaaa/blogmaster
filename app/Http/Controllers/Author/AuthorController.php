<?php

// app/Http/Controllers/Author/AuthorController.php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;

class AuthorController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.author.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('author')->attempt($credentials)) {
            // Jika autentikasi berhasil
            return redirect()->route('author.dashboard');
        }

        // Jika autentikasi gagal, kembalikan ke halaman login
        return redirect()->route('author.login')->with('error', 'Invalid credentials');
    }

    public function logout(Request $request)
    {
        Auth::guard('author')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('author.login');
    }

    public function dashboard()
    {
        // Ambil semua postingan author yang terkait dengan pengguna yang sedang login
        $posts = Auth::guard('author')->user()->posts;

        $popularPosts = Post::where('author_id', auth()->guard('author')->id())
            ->orderBy('view_count', 'desc')
            ->limit(5)
            ->get();

        $categories = Category::all();

        // Kirim data postingan ke view dashboard.blade.php
        return view('author.dashboard', compact('posts', 'popularPosts', 'categories'));
    }

}
