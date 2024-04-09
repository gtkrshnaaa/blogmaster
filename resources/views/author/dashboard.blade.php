{{-- // resources/views/author/dashboard.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Author Dashboard') }}</div>

                    <div class="card-body">
                        <p>Welcome, {{ Auth::guard('author')->user()->name }}!</p>

                        <!-- List of Posts -->
                        <div class="mb-3">
                            <h5>Your Posts</h5>
                            @if ($posts && !$posts->isEmpty())
                                <ul class="list-group">
                                    @foreach ($posts as $post)
                                        <li class="list-group-item">{{ $post->title }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No posts found.</p>
                            @endif

                        </div>

                        <!-- Add New Post Button -->
                        <a href="{{ route('author.posts.index') }}" class="btn btn-success">{{ __('Manage Your Post') }}</a>

                        <!-- Logout Button -->
                        <form action="{{ route('author.logout') }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-danger">{{ __('Logout') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
