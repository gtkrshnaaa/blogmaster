@extends('layouts.author')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Author Dashboard') }}</div>

                    <div class="card-body">
                        <p>Welcome, {{ Auth::guard('author')->user()->name }}!</p>

                        <!-- Add New Post Button -->
                        <a href="{{ route('author.posts.index') }}" class="btn btn-success">{{ __('Manage Your Post') }}</a>

                        <!-- Recent Posts -->
                        <div class="card shadow mb-4" style="border: none;">
                            <h5 class="card-header">All Posts in {{ $category->name }}</h5>
                            <div class="card-body">
                                @foreach ($posts as $post)
                                    @if ($post->cover_photo)
                                        <div class="row mb-3 d-flex align-items-stretch">
                                            <div class="col-md-4">
                                                <div class="image-wrapper"
                                                    style="background-image: url('{{ asset('storage/' . $post->cover_photo) }}'); background-size: cover; background-position: center; height: 100%;">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card" style="border: none;">
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
                                                            &nbsp;&middot;&nbsp; <p>
                                                                {{ $post->created_at->format('d F Y') }}
                                                            </p>
                                                            &nbsp;&middot;&nbsp; <p class="card-text">
                                                                {{ $post->category->name }}</p>
                                                        </div>
                                                        <p class="card-text">{!! \Illuminate\Support\Str::limit(strip_tags($post->content), 100, '...') !!}</p>
                                                        <a href="{{ route('author.posts.show', $post->slug) }}"
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
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <!-- Popular Posts -->
                <div class="card shadow mb-4" style="border: none;">
                    <h5 class="card-header">Popular Posts</h5>
                    <div class="card-body">
                        @foreach ($popularPosts as $popularPost)
                            <!-- Periksa apakah post populer memiliki cover photo -->
                            @if ($popularPost->cover_photo)
                                <div class="row mb-3 d-flex align-items-stretch">
                                    <div class="col-md-4">
                                        <!-- Wrapper untuk gambar dengan background -->
                                        <div class="image-wrapper"
                                            style="background-image: url('{{ asset('storage/' . $popularPost->cover_photo) }}'); background-size: cover; background-position: center; height: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <!-- Judul dan jumlah view -->
                                        <h5>{{ $popularPost->title }}</h5>
                                        <p>{{ $popularPost->view_count }} Views</p>
                                        <!-- Link untuk melihat detail post -->
                                        <a href="{{ route('author.posts.show', $popularPost->slug) }}"
                                            class="btn btn-primary">View Details</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Categories -->
                <div class="card shadow mb-4" style="border: none;">
                    <h5 class="card-header">Categories</h5>
                    <div class="card-body">
                        @foreach ($categories as $category)
                            <li class="list-group-item">
                                <a href="{{ route('author.posts.category', $category->id) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
