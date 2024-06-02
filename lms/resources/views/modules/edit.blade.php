@extends('layouts.layout')

@section('content')
    {{-- Success message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('modules.show', $course) }}">Go back to modules</a>
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-primary text-white">
                        <h4>Edit Module</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('modules.update', [$course, $module]) }}" method="POST">
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

                            {{-- Semester --}}
                            <div class="mb-3">
                                <label for="semester" class="form-label">Semester</label>
                                <select class="form-select" id="semester" name="semester">
                                    <option value="1" {{ $module->semester == '1' ? 'selected' : '' }}>
                                        1</option>
                                    <option value="2" {{ $module->semester == '2' ? 'selected' : '' }}>
                                        2</option>
                                    <option value="3" {{ $module->semester == '3' ? 'selected' : '' }}>3
                                    <option value="4" {{ $module->semester == '4' ? 'selected' : '' }}>4
                                    </option>
                                </select>
                                @if ($errors->has('semester'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('semester') }}
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

                            {{-- Credits --}}
                            <div class="mb-3">
                                <label for="credits" class="form-label">Credits</label>
                                <input type="number" class="form-control" id="credits" name="credits"
                                    value="{{ $module->credits }}" min="1">
                                @if ($errors->has('credits'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('credits') }}
                                    </div>
                                @endif
                            </div>

                            {{-- Faild message --}}
                            <div class="mb-4">
                                @if ($errors->has('failed'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('failed') }}
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex justify-content-end">
                                {{-- Update mutton --}}
                                <button type="submit" class="btn btn-primary">Update</button>

                                {{-- Cancel and re-direct to courses --}}
                                <a href="{{ route('courses.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
