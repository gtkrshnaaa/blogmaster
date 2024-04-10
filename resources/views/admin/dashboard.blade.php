@extends('layouts.admin')

@section('content')
    <div class="container" style="margin-top: 100px">

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">{{ __('Admin Dashboard') }}</div>


                    <div class="card-body">

                        @auth('admin')
                            @if (Auth::guard('admin')->check())
                                <p class="lead">Welcome, {{ Auth::guard('admin')->user()->name }}!</p>
                                <p class="lead">What would you like to manage?</p>
                                <ul>
                                    <li><a href="{{ route('admin.authors.index') }}">Manage Authors</a></li>
                                    <li><a href="{{ route('admin.categories.index') }}">Manage Categories</a></li>
                                    <li><a href="{{ route('admin.posts.index') }}">Manage Posts</a></li> <!-- Add this line for managing posts -->
                                    <!-- Add links for other management options as needed -->
                                </ul>
                                
                            @else
                                <p class="lead">Error: Unable to retrieve authenticated admin user.</p>
                            @endif
                        @else
                            <p class="lead">Welcome!</p>
                        @endauth

                        <!-- Add other content as needed -->

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
