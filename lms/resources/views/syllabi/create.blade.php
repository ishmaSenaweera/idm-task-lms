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

                <a href="{{ route('syllabi.index') }}">Go back to Syllabi</a>
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-primary text-white">
                        <h4>Create New Syllabus</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('syllabi.store') }}" method="POST">
                            @csrf

                            {{-- Course --}}
                            <div class="form-group mb-3">
                                <label for="course">Course</label>
                                <select class="form-select" id='course' name="course">
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}"
                                            {{ old('course') == $course->name ? 'selected' : '' }}>{{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Module --}}
                            <div class="form-group mb-3">
                                <label for="module">Module</label>
                                <select class="form-select" id='module' name="module">
                                    @foreach ($modules as $module)
                                        <option value="{{ $module->id }}"
                                            {{ old('module') == $module->name ? 'selected' : '' }}>{{ $module->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Effective year --}}
                            <div class="form-group mb-3">
                                <label for="year_effective" class="form-label">Effective Year</label>
                                <select class="form-select" id="year_effective" name="year_effective">
                                    <option value="">Select Year</option>
                                    @for ($i = date('Y'); $i >= 2020; $i--)
                                        <option value="{{ $i }}"
                                            {{ old('year_effective') == $i ? 'selected' : '' }}>{{ $i }}
                                        </option>
                                    @endfor
                                </select>

                                @if ($errors->has('year_effective'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('year_effective') }}
                                    </div>
                                @endif
                            </div>

                            {{-- Semester --}}
                            <div class="mb-3">
                                <label for="semester" class="form-label">Semester</label>
                                <select class="form-select" id="semester" name="semester">
                                    <option value="1" {{ old('semester') == '1' ? 'selected' : '' }}>
                                        1</option>
                                    <option value="2" {{ old('semester') == '2' ? 'selected' : '' }}>
                                        2</option>
                                    <option value="3" {{ old('semester') == '3' ? 'selected' : '' }}>3
                                    <option value="4" {{ old('semester') == '4' ? 'selected' : '' }}>4
                                    </option>
                                </select>
                                @if ($errors->has('semester'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('semester') }}
                                    </div>
                                @endif
                            </div>

                            {{-- Credits --}}
                            <div class="mb-3">
                                <label for="credits" class="form-label">Credits</label>
                                <input type="number" class="form-control" id="credits" name="credits"
                                    value="{{ old('credits') }}" min="1">
                                @if ($errors->has('credits'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('credits') }}
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex justify-content-end">
                                {{-- Save button --}}
                                <button type="submit" class="btn btn-primary">Save</button>

                                {{-- Cancel and re-direct to courses --}}
                                <a href="{{ route('syllabi.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const yearEffectiveInput = document.getElementById('year_effective');

            yearEffectiveInput.addEventListener('change', function() {
                const selectedYear = yearEffectiveInput.value;
                console.log('Selected Year:',
                    selectedYear);
            });
        });
    </script>
@endsection
