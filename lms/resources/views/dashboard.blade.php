@extends('layouts.layout')

@section('content')
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div>
            <div class="row">
                <div class="col-md-6 flex-grow-1">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('register') }}" class="btn btn-primary">User Management</a>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6 flex-grow-1">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Course Management</h5>
                            <p class="card-text">Manage courses offered in the Learning Management System.</p>
                            <a href="#" class="btn btn-primary">Go to Course Management</a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
