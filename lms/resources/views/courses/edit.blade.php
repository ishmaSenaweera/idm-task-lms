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
                <a href="{{ route('courses.index') }}">Go back to courses</a>
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-primary text-white">
                        <h4>Edit Course</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('courses.update', $course) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Name --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $course->name }}">
                                @if ($errors->has('name'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>

                            {{-- SEO URL --}}
                            <div class="mb-3">
                                <label for="seo_url" class="form-label">SEO URL</label>
                                <input type="text" class="form-control" id="seo_url" name="seo_url"
                                    value="{{ $course->seo_url }}" disabled>
                            </div>

                            {{-- Faculty --}}
                            <div class="mb-3">
                                <label for="faculty" class="form-label">Faculty</label>
                                <select class="form-select" id="faculty" name="faculty">
                                    <option value="Computing" {{ $course->faculty == 'Computing' ? 'selected' : '' }}>
                                        Computing</option>
                                    <option value="Engineering" {{ $course->faculty == 'Engineering' ? 'selected' : '' }}>
                                        Engineering</option>
                                    <option value="Business" {{ $course->faculty == 'Business' ? 'selected' : '' }}>Business
                                    </option>
                                </select>
                                @if ($errors->has('faculty'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('faculty') }}
                                    </div>
                                @endif
                            </div>

                            {{-- Category --}}
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" class="form-control" id="category" name="category"
                                    value="{{ $course->category }}">
                                @if ($errors->has('category'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('category') }}
                                    </div>
                                @endif
                            </div>

                            {{-- Status --}}
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="draft" {{ $course->status == 'draft' ? 'selected' : '' }}>
                                        Draft</option>
                                    <option value="publish" {{ $course->status == 'publish' ? 'selected' : '' }}>Publish
                                    </option>
                                </select>
                                @if ($errors->has('status'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('status') }}
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex justify-content-end">
                                {{-- Update button --}}
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
