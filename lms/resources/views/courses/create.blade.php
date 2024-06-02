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
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-primary text-white">
                        <h4>Create New Course</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('courses.store') }}" method="POST">
                            @csrf

                            {{-- Name --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}">
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
                                    value="{{ old('seo_url') }}">
                                @if ($errors->has('seo_url'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('seo_url') }}
                                    </div>
                                @endif
                            </div>

                            {{-- Faculty --}}
                            <div class="mb-3">
                                <label for="faculty" class="form-label">Faculty</label>
                                <select class="form-select" id="faculty" name="faculty">
                                    <option value="Computing" {{ old('faculty') == 'Computing' ? 'selected' : '' }}>
                                        Computing</option>
                                    <option value="Engineering" {{ old('faculty') == 'Engineering' ? 'selected' : '' }}>
                                        Engineering</option>
                                    <option value="Business" {{ old('faculty') == 'Business' ? 'selected' : '' }}>Business
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
                                    value="{{ old('category') }}">
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
                                    <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>
                                        Draft</option>
                                    <option value="Published" {{ old('status') == 'Published' ? 'selected' : '' }}>Publish
                                    </option>
                                </select>
                                @if ($errors->has('status'))
                                    <div class="text-danger mt-2">
                                        {{ $errors->first('status') }}
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
                                {{-- Save mutton --}}
                                <button type="submit" class="btn btn-primary">Save</button>

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
