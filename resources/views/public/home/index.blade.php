<!-- resources/views/public/home/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- Search Bar -->
                <div class="card shadow mb-4" style="border: none;"> <!-- Added shadow class and removed border -->
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
                <div class="card shadow mb-4" style="border: none;"> <!-- Added shadow class and removed border -->
                    <h5 class="card-header">All Posts</h5>
                    <div class="card-body">
                        @foreach ($posts as $post)
                            <!-- Periksa apakah post memiliki cover photo -->
                            @if ($post->cover_photo)
                                <div class="row mb-3 d-flex align-items-stretch">
                                    <div class="col-md-4">
                                        <!-- Wrapper untuk gambar dengan background -->
                                        <div class="image-wrapper" style="background-image: url('{{ asset('storage/' . $post->cover_photo) }}'); background-size: cover; background-position: center; height: 100%;"></div>
                                    </div>
                                    <div class="col-md-8">
                                        <!-- Konten tulisan di sebelah kanan -->
                                        <div class="card " style="border: none;"> <!-- Added shadow class and removed border -->
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $post->title }}</h5>
                                                <div class="d-flex">
                                                    <p>{{ $post->view_count }} Views</p> &nbsp;&middot;&nbsp;
                                                    @if ($post->author)
                                                        <p>By {{ $post->author->name }}</p>
                                                    @elseif ($post->admin)
                                                        <p>By {{ $post->admin->name }}</p>
                                                    @else
                                                        <p>Creator Unknown</p>
                                                    @endif
                                                    &nbsp;&middot;&nbsp; <p>{{ $post->created_at->format('d F Y') }}</p>
                                                    &nbsp;&middot;&nbsp; <p class="card-text">{{ $post->category->name }}
                                                    </p>
                                                </div>
                                                <p class="card-text">{!! \Illuminate\Support\Str::limit(strip_tags($post->content), 100, '...') !!}</p>
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
                <div class="card shadow mb-4" style="border: none;"> <!-- Added shadow class and removed border -->
                    <h5 class="card-header">Popular Posts</h5>
                    <div class="card-body">
                        @foreach ($popularPosts as $popularPost)
                            <!-- Periksa apakah post populer memiliki cover photo -->
                            @if ($popularPost->cover_photo)
                                <div class="row mb-3 d-flex align-items-stretch">
                                    <div class="col-md-4">
                                        <!-- Wrapper untuk gambar dengan background -->
                                        <div class="image-wrapper" style="background-image: url('{{ asset('storage/' . $popularPost->cover_photo) }}'); background-size: cover; background-position: center; height: 100%;"></div>
                                    </div>
                                    <div class="col-md-8">
                                        <!-- Judul dan jumlah view -->
                                        <h5>{{ $popularPost->title }}</h5>
                                        <p>{{ $popularPost->view_count }} Views</p>
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
                <div class="card shadow mb-4" style="border: none;"> <!-- Added shadow class and removed border -->
                    <h5 class="card-header">Categories</h5>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($categories as $category)
                                <li class="list-group-item">
                                    <a
                                        href="{{ route('public.posts.category', $category->id) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- End Categories -->
            </div>
        </div>
    </div>
@endsection
