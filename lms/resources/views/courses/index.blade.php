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

    <div class="container">
        <h1 class="mb-4">Courses</h1>

        <!-- Add Course button visible only to users with the 'admin' or 'academic_head' role -->
        @role('Admin|Academic Head')
            <div class="mb-3">
                <a href="{{ route('courses.create') }}" class="btn btn-primary">Add Course</a>
            </div>
        @endrole


        <!-- Display a message if there are no courses -->
        @if ($courses->isEmpty())
            <div class="alert alert-info" role="alert">
                No courses available.
            </div>
        @else
            <!-- Table to display courses -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">SEO URL</th>
                            <th scope="col">Faculty</th>
                            <th scope="col">Category</th>
                            @if ($user->role === 'Admin' || $user->role === 'Academic Head')
                                <th scope="col">Status</th>
                            @endif
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            <tr>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->seo_url }}</td>
                                <td>{{ $course->faculty }}</td>
                                <td>{{ $course->category }}</td>
                                @if ($user->role === 'Admin' || $user->role === 'Academic Head')
                                    @if ($course->status === 'Draft')
                                        <td style="color: blue">{{ $course->status }}</td>
                                    @else
                                        <td style="color: green">{{ $course->status }}</td>
                                    @endif
                                @endif

                                <td>
                                    <div class="btn-group" aria-label="Course Actions">
                                        <a href="{{ route('modules.show', $course->id) }}"
                                            class="btn btn-info me-1">View</a>
                                        @can('update', $course)
                                            <a href="{{ route('courses.edit', $course->id) }}"
                                                class="btn btn-warning me-1">Edit</a>
                                        @endcan

                                        @can('delete', $course)
                                            <!-- Delete button -->
                                            <form action="{{ route('courses.destroy', $course) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
