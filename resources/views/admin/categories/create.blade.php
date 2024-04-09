@extends('layouts.admin')

@section('content')
    <h2>Create Category</h2>
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Category Name">
        <button type="submit">Create</button>
    </form>
@endsection
