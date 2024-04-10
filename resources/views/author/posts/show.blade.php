@extends('layouts.author')

@section('content')
    <div class="container">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $post->title }}</h2>
                    <div class="d-flex">
                        <p>{{ $post->view_count }} Views</p> &nbsp;&middot;&nbsp;
                        @if ($post->author)
                            <p>By {{ $post->author->name }}</p>
                        @elseif ($post->admin)
                            <p>By {{ $post->admin->name }}</p>
                        @else
                            <p>Creator Unknown</p>
                        @endif
                        &nbsp;&middot;&nbsp; <p>{{ $post->created_at->format('d F Y') }}</p>
                        &nbsp;&middot;&nbsp; <p class="card-text">{{ $post->category->name }}</p>
                    </div>
                </div>
                <div class="card-body">
                    <img src="{{ asset('storage/' . $post->cover_photo) }}" alt="{{ $post->title }}" class="img-fluid">
                    <p>{!! $post->content !!}</p>
                </div>

            </div>
        </div>
    </div>
@endsection
