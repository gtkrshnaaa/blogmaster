@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $post->title }}</h2>
                        <p>{{ $post->created_at->format('d F Y') }}</p>
                        <p>Views: {{ $post->view_count }}</p>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('storage/' . $post->cover_photo) }}" alt="{{ $post->title }}" class="img-fluid">
                        <p>{{ $post->content }}</p>
                    </div>
                    <div class="card-footer">
                        @if ($post->author)
                            <p>Author: {{ $post->author->name }}</p>
                        @elseif ($post->admin)
                            <p>Admin: {{ $post->admin->name }}</p>
                        @else
                            <p>Creator: Unknown</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="row">
                    <!-- Popular Posts -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <h5 class="card-header">Popular Posts</h5>
                            <div class="card-body">
                                @foreach ($popularPosts as $popularPost)
                                    @if ($popularPost->cover_photo)
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <img src="{{ asset('storage/' . $popularPost->cover_photo) }}" alt="{{ $popularPost->title }}" class="img-fluid">
                                            </div>
                                            <div class="col-md-8">
                                                <h5>{{ $popularPost->title }}</h5>
                                                <p>Views: {{ $popularPost->view_count }}</p>
                                                <a href="{{ route('public.posts.showdetail', $popularPost->slug) }}" class="btn btn-primary">View Details</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- End Popular Posts -->

                    <!-- Categories -->
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <h5 class="card-header">Categories</h5>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($categories as $category)
                                        <li class="list-group-item">{{ $category->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Categories -->
                </div>
            </div>
        </div>
    </div>
@endsection
