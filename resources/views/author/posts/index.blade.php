@extends('layouts.author')

@section('content')
    <div class="container mt-3 col-md-8">
        <h2 style="margin-top: 100px">All Posts</h2>
        <a href="{{ route('author.posts.create') }}" class="btn btn-primary">Create New Post</a>
        <div class="row justify-content-center mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td>
                                <a href="{{ route('author.posts.show', $post->slug) }}" class="btn btn-info">View</a>
                                <a href="{{ route('author.posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('author.posts.destroy', $post->id) }}" method="POST"
                                    style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
