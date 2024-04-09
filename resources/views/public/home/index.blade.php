<!-- resources/views/public/home/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- Search Bar -->
                <div class="card mb-4">
                    <h5 class="card-header">Search</h5>
                    <div class="card-body">
                        <form action="/search" method="GET">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Search for...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-secondary">Go!</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End Search Bar -->

                <!-- Recent Posts -->
                <div class="card mb-4">
                    <h5 class="card-header">All Posts</h5>
                    <div class="card-body">
                        @foreach ($posts as $post)
                            <!-- Periksa apakah post memiliki cover photo -->
                            @if ($post->cover_photo)
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <!-- Gambar di sebelah kiri -->
                                        <img src="{{ asset('storage/' . $post->cover_photo) }}" alt="{{ $post->title }}"
                                            class="img-fluid">
                                    </div>
                                    <div class="col-md-8">
                                        <!-- Konten tulisan di sebelah kanan -->
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $post->title }}</h5>
                                                <p>Views: {{ $post->view_count }}</p>
                                                <p class="card-text">{{ $post->content }}</p>
                                                <p class="card-text">Category: {{ $post->category->name }}</p>
                                                <a href="{{ route('public.posts.showdetail', $post->slug) }}"
                                                    class="btn btn-primary">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <!-- End Recent Posts -->

                <!-- Pagination Links -->
                {{ $posts->links() }}

            </div>
            <div class="col-md-4">
                <!-- Popular Posts -->
                <div class="card mb-4">
                    <h5 class="card-header">Popular Posts</h5>
                    <div class="card-body">
                        @foreach ($popularPosts as $popularPost)
                            <!-- Periksa apakah post populer memiliki cover photo -->
                            @if ($popularPost->cover_photo)
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <!-- Gambar di sebelah kiri -->
                                        <img src="{{ asset('storage/' . $popularPost->cover_photo) }}"
                                            alt="{{ $popularPost->title }}" class="img-fluid">
                                    </div>
                                    <div class="col-md-8">
                                        <!-- Judul dan jumlah view -->
                                        <h5>{{ $popularPost->title }}</h5>
                                        <p>Views: {{ $popularPost->view_count }}</p>
                                        <!-- Link untuk melihat detail post -->
                                        <a href="{{ route('public.posts.showdetail', $popularPost->slug) }}"
                                            class="btn btn-primary">View Details</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <!-- End Popular Posts -->

                <!-- Categories -->
                <div class="card mb-4">
                    <h5 class="card-header">Categories</h5>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($categories as $category)
                                <li class="list-group-item">{{ $category->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- End Categories -->
            </div>
        </div>
    </div>
@endsection
