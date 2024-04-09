{{-- resources/views/author/posts/show.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $post->title }}</div>

                    <div class="card-body">
                        <p><strong>Category:</strong> {{ $post->category->name }}</p>
                        <p><strong>Content:</strong></p>
                        <p>{{ $post->content }}</p>
                        @if ($post->cover_photo)
                            <img src="{{ asset('storage/' . $post->cover_photo) }}" alt="Cover Photo" class="img-fluid">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
