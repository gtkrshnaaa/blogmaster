@extends('layouts.admin')

@section('content')
    <h2 style="margin-top: 100px">Edit Post</h2>
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" required>
        </div>
        <div class="form-group">
            <label for="slug">Slug:</label>
            <input type="text" name="slug" id="slug" class="form-control" value="{{ $post->slug }}" readonly>
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ $post->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select name="category_id" id="category" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($post->category_id == $category->id) selected @endif>
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="cover_photo">Cover Photo:</label>
            <input type="file" name="cover_photo" id="cover_photo" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <script>
        document.getElementById('title').addEventListener('input', function() {
            var title = this.value.trim().toLowerCase().replace(/\s+/g, '-');
            document.getElementById('slug').value = title;
        });
    </script>
@endsection
