@extends('layouts.layout')

@section('content')
    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-primary text-white">
                        <h2>Register User</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('auth.register.submit') }}">
                            @csrf

                            {{-- Name --}}
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>

                            {{-- Email --}}
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>

                            {{-- Password --}}
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                @if ($errors->has('password'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>

                            {{-- Role --}}
                            <div class="form-group mb-3">
                                <label for="role">Role</label>
                                <select class="form-select" id='role' name="role">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ old('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Faild Message --}}
                            <div class="mb-4">
                                @if ($errors->has('failed'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('failed') }}
                                    </div>
                                @endif
                            </div>

                            {{-- Register Button --}}
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
