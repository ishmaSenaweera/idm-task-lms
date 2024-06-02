@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="card-body">
            <div class="row justify-content-center align-items-center vh-100">
                {{-- Show both components only to admin if not admin show course management only --}}
                @if (auth()->user()->role === 'Admin')
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h5 class="card-title mb-3">User Management</h5>
                                <a href="{{ route('register') }}" class="btn btn-primary">Go to User Management</a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <h5 class="card-title mb-3">Course Management</h5>
                            <a href="{{ route('courses.index') }}" class="btn btn-primary">Go to Course
                                Management</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection