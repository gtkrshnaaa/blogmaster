@extends('layouts.admin')

@section('content')
    <h2>Edit Category</h2>
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $category->name }}">
        <button type="submit">Update</button>
    </form>
@endsection
