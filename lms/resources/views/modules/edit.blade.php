@extends('layouts.layout')

@section('content')
    {{-- Success message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Faild message --}}
    @if ($errors->has('failed'))
        <div class="alert alert-danger">
            {{ $errors->first('failed') }}
        </div>
    @endif

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('modules.index') }}">Go back to modules</a>
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-primary text-white">
                        <h4>Edit Module</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('modules.update', $module) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Code --}}
                            <div class="mb-3">
                                <label for="code" class="form-label">Module Code</label>
                                <input type="text" class="form-control" id="code" name="code"
                                    value="{{ $module->code }}">
                                @if ($errors->has('code'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('code') }}
                                    </div>
                                @endif
                            </div>

                            {{-- Name --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Module Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $module->name }}">
                                @if ($errors->has('name'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>

                            {{-- Description --}}
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="5">{{ $module->description }}</textarea>
                                @if ($errors->has('description'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex justify-content-end">
                                {{-- Update button --}}
                                <button type="submit" class="btn btn-primary">Update</button>

                                {{-- Cancel and re-direct to courses --}}
                                <a href="{{ route('modules.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
