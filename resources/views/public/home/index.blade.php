{{-- resources/views/public/home/index.blade.php --}}

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
                    <h5 class="card-header">Recent Posts</h5>
                    <div class="card-body">
                        @foreach ($posts as $post)
                            @if ($post->cover_photo)
                                <!-- Periksa apakah post memiliki cover photo -->
                                <div class="card">
                                   <img src="{{ asset('storage/' . $post->cover_photo) }}" alt="{{ $post->title }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <p class="card-text">{{ $post->content }}</p>
                                        <p class="card-text">Category: {{ $post->category->name }}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach



                    </div>
                </div>
                <!-- End Recent Posts -->
            </div>
            <div class="col-md-4">
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
