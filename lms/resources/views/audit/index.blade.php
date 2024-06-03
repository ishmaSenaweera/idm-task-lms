@extends('layouts.layout')

@section('content')
    <div class="container mt-5">
        <h1>Audit Logs</h1>
        <a href="{{ route('audit.export') }}" class="btn btn-primary mb-3">Download CSV</a>

        <div class="audit-section">
            <h2>User Audits</h2>
            @if ($userAudits->isEmpty())
                <p>No user audits available.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>User</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>ID</th>
                            <th>Old Values</th>
                            <th>New Values</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userAudits as $audit)
                            <tr>
                                <td>{{ $audit->event }}</td>
                                <td>{{ $audit->user->name ?? 'System' }}</td>
                                <td>{{ $audit->created_at }}</td>
                                <td>{{ $audit->auditable_type }}</td>
                                <td>{{ $audit->auditable_id }}</td>
                                <td>{{ json_encode($audit->old_values) }}</td>
                                <td>{{ json_encode($audit->new_values) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="audit-section">
            <h2>Course Audits</h2>
            @if ($courseAudits->isEmpty())
                <p>No course audits available.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>User</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>ID</th>
                            <th>Old Values</th>
                            <th>New Values</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courseAudits as $audit)
                            <tr>
                                <td>{{ $audit->event }}</td>
                                <td>{{ $audit->user->name ?? 'System' }}</td>
                                <td>{{ $audit->created_at }}</td>
                                <td>{{ $audit->auditable_type }}</td>
                                <td>{{ $audit->auditable_id }}</td>
                                <td>{{ json_encode($audit->old_values) }}</td>
                                <td>{{ json_encode($audit->new_values) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="audit-section">
            <h2>Module Audits</h2>
            @if ($moduleAudits->isEmpty())
                <p>No module audits available.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>User</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>ID</th>
                            <th>Old Values</th>
                            <th>New Values</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($moduleAudits as $audit)
                            <tr>
                                <td>{{ $audit->event }}</td>
                                <td>{{ $audit->user->name ?? 'System' }}</td>
                                <td>{{ $audit->created_at }}</td>
                                <td>{{ $audit->auditable_type }}</td>
                                <td>{{ $audit->auditable_id }}</td>
                                <td>{{ json_encode($audit->old_values) }}</td>
                                <td>{{ json_encode($audit->new_values) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
