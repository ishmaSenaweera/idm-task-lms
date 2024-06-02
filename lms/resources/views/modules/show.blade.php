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
        <h1 class="mb-4">{{ $course->name }} : Modules List</h1>


        <!-- Add Course button visible only to authorized roles (Admin & Academic Head) -->
        @can('create', App\Models\Course::class)
            <div class="mb-3">
                <a href="{{ route('modules.create', $course) }}" class="btn btn-primary">Add Module</a>
            </div>
        @endcan

        <!-- Display a message if there are no modules -->
        @if ($modules->isEmpty())
            <div class="alert alert-info" role="alert">
                No modules available.
            </div>
        @else
            <!-- Table to display modules -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Module Name</th>
                            <th scope="col">Module Code</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Batch Year</th>
                            <th scope="col">Credits</th>
                            @if (auth()->user()->role === 'Admin' || auth()->user()->role === 'Academic Head')
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modules as $module)
                            <tr>
                                <td>{{ $module->id }}</td>
                                <td>{{ $module->code }}</td>
                                <td>{{ $module->name }}</td>
                                <td>{{ $module->semester }}</td>
                                <td>{{ $module->batch_year }}</td>
                                <td>{{ $module->credits }}</td>
                                @if (auth()->user()->role === 'Admin' || auth()->user()->role === 'Academic Head')
                                    <td>{{ $module->description }}</td>
                                    <td>
                                        <div class="btn-group" aria-label="module Actions">
                                            @can('update', $module)
                                                {{-- Update button --}}
                                                <a href="{{ route('modules.edit', [$course, $module]) }}"
                                                    class="btn btn-warning me-1">Edit</a>
                                            @endcan

                                            @can('delete', $module)
                                                <!-- Delete button -->
                                                <form action="{{ route('modules.destroy', [$course, $module]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                @endif


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
