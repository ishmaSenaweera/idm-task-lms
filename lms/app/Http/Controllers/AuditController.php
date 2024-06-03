<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use App\Models\User;
use OwenIt\Auditing\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AuditController extends Controller
{
    public function index()
    {
        // Retrieve audits for User, Course, and Module models
        $userAudits = Audit::where('auditable_type', User::class)->get() ?? collect();
        $courseAudits = Audit::where('auditable_type', Course::class)->get() ?? collect();
        $moduleAudits = Audit::where('auditable_type', Module::class)->get() ?? collect();

        // Output audits
        return view('audit.index', [
            'userAudits' => $userAudits,
            'courseAudits' => $courseAudits,
            'moduleAudits' => $moduleAudits,
        ]);
    }

    public function export()
    {
        $audits = Audit::all();

        $csvData = [];
        foreach ($audits as $audit) {
            $csvData[] = [
                'Event' => $audit->event,
                'User' => $audit->user->name ?? 'System',
                'Date' => $audit->created_at,
                'Type' => $audit->auditable_type,
                'ID' => $audit->auditable_id,
                'Old Values' => json_encode($audit->old_values),
                'New Values' => json_encode($audit->new_values),
            ];
        }

        $filename = "audit_logs.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array_keys($csvData[0]));

        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);

        $headers = [
            'Content-Type' => 'text/csv',
        ];

        return Response::download($filename, $filename, $headers);
    }
}
