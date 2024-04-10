{{-- resources/views/admin/authors/edit.blade.php --}}

@extends('layouts.admin')

@section('title', 'Edit Author')

@section('content')
    <div class="container" style="margin-top: 100px">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1>Edit Author</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.authors.update', $author->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $author->name) }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $author->email) }}">
                    </div>
                    <div class="form-group">
                        <label for="password">New Password:</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Author</button>
                </form>
            </div>
        </div>
    </div>
@endsection
