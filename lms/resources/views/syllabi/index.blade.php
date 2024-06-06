@extends('layouts.layout')

@section('content')
    @include('layouts.tab')

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
        <h1 class="m-4">Syllabi</h1>

        <div class="mb-3">
            <a href="{{ route('syllabi.create') }}" class="btn btn-primary">Add Syllabus</a>
        </div>

        <!-- Display a message if there are no modules -->
        @if ($syllabi->isEmpty())
            <div class="alert alert-info" role="alert">
                No syllabi available.
            </div>
        @else
            <!-- Table to display modules -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Course Name</th>
                            <th scope="col">Module Name</th>
                            <th scope="col">Module Code</th>
                            <th scope="col">Effective Year</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Credits</th>
                            @role('Admin|Academic Head')
                                <th scope="col">Actions</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($syllabi as $syllabus)
                            <tr>
                                <td>{{ $syllabus->course->name }}</td>
                                <td>{{ $syllabus->module->name }}</td>
                                <td>{{ $syllabus->module->code }}</td>
                                <td>{{ $syllabus->year_effective }}</td>
                                <td>{{ $syllabus->semester }}</td>
                                <td>{{ $syllabus->credits }}</td>
                                @role('Admin|Academic Head')
                                    <td>
                                        <div class="btn-group" aria-label="Syllabus Actions">

                                            {{-- Update button --}}
                                            <a href="{{ route('syllabi.edit', $syllabus) }}"
                                                class="btn btn-warning me-1">Edit</a>

                                            <!-- Delete button -->
                                            <form action="{{ route('syllabi.destroy', $syllabus) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger mx-1"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>

                                        </div>
                                    </td>
                                @endrole
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
