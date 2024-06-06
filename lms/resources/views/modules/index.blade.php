@extends('layouts.layout')

@section('content')
    @role('Admin|Academic Head|Teacher')
        @include('layouts.tab')
    @endrole

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
        <h1 class="m-4">Modules</h1>

        <!-- Add Course button visible only to authorized roles (Admin & Academic Head) -->
        @haspermission('create module')
            <div class="mb-3">
                <a href="{{ route('modules.create') }}" class="btn btn-primary">Add Module</a>
            </div>
        @endhaspermission

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
                            <th scope="col">Module Name</th>
                            <th scope="col">Module Code</th>
                            <th scope="col">Description</th>
                            @role('Admin|Academic Head')
                                <th scope="col">Actions</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modules as $module)
                            <tr>
                                <td>{{ $module->code }}</td>
                                <td>{{ $module->name }}</td>
                                <td>{{ $module->description }}</td>
                                @role('Admin|Academic Head')
                                    <td>
                                        <div class="btn-group" aria-label="module Actions">

                                            {{-- Update button --}}
                                            <a href="{{ route('modules.edit', [$module]) }}"
                                                class="btn btn-warning me-1">Edit</a>

                                            <!-- Delete button -->
                                            <form action="{{ route('modules.destroy', [$module]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
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
