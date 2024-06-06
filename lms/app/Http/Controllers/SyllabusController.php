<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseModule;
use App\Models\Module;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class SyllabusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /** @var App\Models\User */
        $user = auth()->user();

        if ($user->hasRole('Student')) {
            // Retrieve the user's courses and their enrollment years
            $enrollmentYears = $user->studentCourses->pluck('enrollment_year')->unique();

            // Retrieve syllabi related to the user's batch years
            $syllabi = CourseModule::with(['course', 'module'])
                ->whereIn('year_effective', $enrollmentYears)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // Retrieve all course modules with their related course and module details
            $syllabi = CourseModule::with(['course', 'module'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('syllabi.index', ['syllabi' => $syllabi]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::get();
        $modules = Module::get();
        return view('syllabi.create', ['courses' => $courses, 'modules' => $modules]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'year_effective' => ['required'],
            'semester' => ['required'],
            'credits' => ['required']
        ]);

        try {

            // Save syllabus
            CourseModule::create([
                'course_id' => $request->course,
                'module_id' => $request->module,
                'year_effective' => $request->year_effective,
                'semester' => $request->semester,
                'credits' => $request->credits,
            ]);
            return back()->with('success', 'New Syllabus Created Successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['failed' => "Failed to Create New Syllabus. Please Try Again."]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseModule $syllabus)
    {
        $courses = Course::get();
        $modules = Module::get();

        // Pass the syllabus to the view
        return view('syllabi.edit', ['syllabus' => $syllabus, 'courses' => $courses, 'modules' => $modules]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseModule $syllabus)
    {
        // Validate module
        $fields = $request->validate([
            'year_effective' => ['required'],
            'semester' => ['required'],
            'credits' => ['required'],
        ]);

        try {

            // Update the module with the validated data
            $syllabus->update($fields);

            return back()->with('success', 'Syllabus Updated Successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['failed' => "Failed to Update Syllabus. Please Try Again."]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseModule $syllabus)
    {

        try {
            $syllabus->delete();
            return redirect()->route('syllabi.index')->with('success', 'Syllabus Deleted Successfully!');
        } catch (\Exception $e) {
            return redirect()->route('syllabi.index')->withErrors(['failed' => 'Failed to Selete Syllabus. Please Try Again.']);
        }
    }
}
