<?php

// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ManageAuthorController;
use App\Http\Middleware\AdminAuth;


use App\Http\Controllers\Author\AuthorController;
use App\Http\Middleware\EnsureAuthorHasAccount;

use App\Http\Controllers\Admin\ManageCategoryController;

use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Author\AuthorPostController;

use App\Http\Controllers\PublicController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('public.home.index');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware([AdminAuth::class])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });

    Route::get('/authors', [ManageAuthorController::class, 'index'])->name('admin.authors.index');
    Route::get('/authors/create', [ManageAuthorController::class, 'create'])->name('admin.authors.create');
    Route::post('/authors/store', [ManageAuthorController::class, 'store'])->name('admin.authors.store');
    Route::get('/authors/edit/{id}', [ManageAuthorController::class, 'edit'])->name('admin.authors.edit');
    Route::put('/authors/update/{id}', [ManageAuthorController::class, 'update'])->name('admin.authors.update');
    Route::delete('/authors/destroy/{id}', [ManageAuthorController::class, 'destroy'])->name('admin.authors.destroy');

    Route::resource('categories', ManageCategoryController::class)->except(['create', 'show', 'store', 'update', 'destroy']);
    Route::get('/categories', [ManageCategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [ManageCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [ManageCategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{category}/edit', [ManageCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{category}', [ManageCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [ManageCategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Rute untuk mengelola postingan
    Route::get('/admin/posts', [AdminPostController::class, 'index'])->name('admin.posts.index'); // Ini adalah rute untuk menampilkan daftar postingan
    Route::get('/admin/posts/create', [AdminPostController::class, 'create'])->name('admin.posts.create'); // Ini adalah rute untuk menampilkan formulir pembuatan postingan baru
    Route::post('/admin/posts', [AdminPostController::class, 'store'])->name('admin.posts.store'); // Ini adalah rute untuk menyimpan postingan baru ke database
    Route::get('/admin/posts/{slug}', [AdminPostController::class, 'show'])->name('admin.posts.show'); // Ini adalah rute untuk menampilkan detail postingan tertentu
    Route::get('/admin/posts/{id}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit'); // Ini adalah rute untuk menampilkan formulir pengeditan postingan
    Route::put('/admin/posts/{id}', [AdminPostController::class, 'update'])->name('admin.posts.update'); // Ini adalah rute untuk menyimpan perubahan pada postingan yang diedit
    Route::delete('/admin/posts/{id}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy'); // Ini adalah rute untuk menghapus postingan
});




Route::prefix('author')->group(function () {
    // Rute login
    Route::get('/login', [AuthorController::class, 'showLoginForm'])->name('author.login');
    Route::post('/login', [AuthorController::class, 'login'])->name('author.login.submit');

    // Rute dashboard (memerlukan autentikasi author)
    Route::middleware([EnsureAuthorHasAccount::class])->group(function () {
        Route::get('/dashboard', [AuthorController::class, 'dashboard'])->name('author.dashboard');
        // Rute untuk pengelolaan postingan
        Route::get('/author/posts', [AuthorPostController::class, 'index'])->name('author.posts.index'); // Menampilkan daftar postingan
        Route::get('/author/posts/create', [AuthorPostController::class, 'create'])->name('author.posts.create'); // Menampilkan form pembuatan postingan baru
        Route::post('/author/posts', [AuthorPostController::class, 'store'])->name('author.posts.store'); // Menyimpan postingan baru
        Route::get('/author/posts/{post}/edit', [AuthorPostController::class, 'edit'])->name('author.posts.edit'); // Menampilkan form pengeditan postingan
        Route::put('/author/posts/{post}', [AuthorPostController::class, 'update'])->name('author.posts.update'); // Menyimpan perubahan pada postingan yang diedit
        Route::get('/author/posts/{post}', [AuthorPostController::class, 'show'])->name('author.posts.show'); // Menyimpan perubahan pada postingan yang diedit
        Route::delete('/author/posts/{post}', [AuthorPostController::class, 'destroy'])->name('author.posts.destroy'); // Menghapus postingan
    });

    // Rute logout
    Route::post('/logout', [AuthorController::class, 'logout'])->name('author.logout');

   
    
});




Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('posts', AdminPostController::class);
    });

    Route::prefix('author')->group(function () {
        Route::resource('posts', AuthorPostController::class);
    });
});



// routes/web.php


Route::get('/', [PublicController::class, 'index'])->name('public.home.index');
Route::get('/posts/{slug}', [PublicController::class, 'showPost'])->name('public.post.detail');
Route::get('/search', [PublicController::class, 'search'])->name('public.search');
