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
                        <form method="POST" action="{{ route('register') }}">
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
                                <select class="form-select" id="role" name="role">
                                    <option value="Teacher" {{ old('role') == 'Teacher' ? 'selected' : '' }}>Teacher
                                    </option>
                                    <option value="Student" {{ old('role') == 'Student' ? 'selected' : '' }}>Student
                                    </option>
                                    <option value="Academic Head" {{ old('role') == 'Academic Head' ? 'selected' : '' }}>
                                        Academic Head</option>
                                    <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>

                            {{-- Batch year --}}
                            <div class="form-group mb-3">
                                <label for="batch_year" class="form-label">Batch Year</label>
                                <input type="text" class="form-control" id="batch_year" name="batch_year"
                                    value="{{ old('batch_year') }}">
                                @if ($errors->has('batch_year'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('batch_year') }}
                                    </div>
                                @endif
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
