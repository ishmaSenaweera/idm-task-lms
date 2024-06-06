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

        <!-- Add Course button visible only with create course permission -->
        @haspermission('create course')
            <div class="mb-3">
                <a href="{{ route('courses.create') }}" class="btn btn-primary">Add Course</a>
            </div>
        @endhaspermission

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
                            @role('Admin|Academic Head')
                                <th scope="col">Status</th>
                            @endrole
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

                                @role('Admin|Academic Head')
                                    @if ($course->status === 'Draft')
                                        <td style="color: blue">{{ $course->status }}</td>
                                    @else
                                        <td style="color: green">{{ $course->status }}</td>
                                    @endif
                                @endrole

                                <td>
                                    <div class="btn-group" aria-label="Course Actions">

                                        <!-- View button -->
                                        <a href="{{ route('modules.show', $course->id) }}"
                                            class="btn btn-info mx-1">View</a>

                                        @canany(['edit course', 'delete course'])
                                            <!-- Edit button -->
                                            <a href="{{ route('courses.edit', $course->id) }}"
                                                class="btn btn-warning mx-1">Edit</a>

                                            <!-- Delete button -->
                                            <form action="{{ route('courses.destroy', $course) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger mx-1"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        @endcanany

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
