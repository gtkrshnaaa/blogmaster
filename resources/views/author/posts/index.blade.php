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
                                        <li class="list-group-item">
                                            {{ $post->title }}
                                            <!-- Edit Button -->
                                            <a href="{{ route('author.posts.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <!-- View Button -->
                                            <a href="{{ route('author.posts.show', $post->id) }}" class="btn btn-info btn-sm">View</a>
                                            <!-- Delete Button -->
                                            <form action="{{ route('author.posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No posts found.</p>
                            @endif

                        </div>

                        <!-- Add New Post Button -->
                        <a href="{{ route('author.posts.create') }}" class="btn btn-success">{{ __('Add New Post') }}</a>
                         
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
