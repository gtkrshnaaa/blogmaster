{{-- resources/views/admin/authors/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manage Authors')

@section('content')
    <div class="container" style="margin-top: 100px">
        <div class="row">
            <div class="col-md-12">
                <h1>Manage Authors</h1>
                <a href="{{ route('admin.authors.create') }}" class="btn btn-primary mb-3">Add Author</a>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($authors as $author)
                            <tr>
                                <td>{{ $author->id }}</td>
                                <td>{{ $author->name }}</td>
                                <td>{{ $author->email }}</td>
                                <td>
                                    <a href="{{ route('admin.authors.edit', $author->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.authors.destroy', $author->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this author?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
