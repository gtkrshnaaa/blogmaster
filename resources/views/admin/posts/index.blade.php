@extends('layouts.admin')

@section('content')
    <h2 style="margin-top: 100px">All Posts</h2>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Create New Post</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Author/Admin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>
                        @if ($post->author)
                            <!-- Pemeriksaan apakah author ada -->
                            {{ $post->author->name }}
                        @elseif($post->admin)
                            <!-- Pemeriksaan apakah admin ada -->
                            {{ $post->admin->name }}
                        @else
                            Unknown <!-- Tampilkan pesan jika tidak ada author atau admin -->
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-info">View</a>
                        <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline">
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
@endsection
