{{-- resources/views/admin/posts/show.blade.php --}}

@extends('layouts.admin')

@section('content')
    <h2 style="margin-top: 100px">{{ $post->title }}</h2>
    <p>{!! $post->content !!}</p>
    <p>Category: {{ $post->category->name }}</p>
    
    @if($post->author) <!-- Pemeriksaan apakah ada author -->
        <p>Author: {{ $post->author->name }}</p>
    @elseif($post->admin) <!-- Pemeriksaan apakah ada admin -->
        <p>Admin: {{ $post->admin->name }}</p>
    @else
        <p>Creator: Unknown</p> <!-- Tampilkan pesan jika tidak ada author atau admin -->
    @endif
    
    @if($post->cover_photo)
        <img src="{{ asset('storage/' . $post->cover_photo) }}" alt="Cover Photo">
    @endif
    <p><a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary">Edit</a></p>
@endsection
