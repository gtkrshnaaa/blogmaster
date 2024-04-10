@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 100px;"> <!-- Tambahkan container untuk padding dan margin yang konsisten -->
    <div class="row justify-content-center"> <!-- Gunakan row dan justify-content-center untuk memusatkan konten -->
        <div class="col-md-8"> <!-- Gunakan col-md-8 untuk lebar kolom -->
            <h2>Create New Post</h2>
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="slug">Slug:</label>
                    <input type="text" name="slug" id="slug" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select name="category_id" id="category" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="cover_photo">Cover Photo:</label>
                    <input type="file" name="cover_photo" id="cover_photo" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content');
    
    document.getElementById('title').addEventListener('input', function() {
        var title = this.value.trim().toLowerCase().replace(/\s+/g, '-');
        document.getElementById('slug').value = title;
    });
</script>
@endsection