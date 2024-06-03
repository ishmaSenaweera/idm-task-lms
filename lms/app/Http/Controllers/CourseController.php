<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    /**
     * Display a listing of the courses
     */
    public function index()
    {
        // return Course::with('audits')->get();

        // Check the user's role
        $userRole = auth()->user()->role;

        // Retrieve courses based on user's role
        if ($userRole === 'Admin' || $userRole === 'Academic Head') {
            // Fetch all courses
            $courses = Course::orderBy('created_at', 'desc')->get();
        } else {
            // Fetch only published courses for teachers and students
            $courses = Course::where('status', 'published')->orderBy('created_at', 'desc')->get();
        }

        return view('courses.index', ['courses' => $courses, 'user' => auth()->user()]);
    }


    /**
     * Show the form for creating a new course
     */
    public function create(Course $course)
    {
        $this->authorize('create', Course::class);

        return view('courses.create', ['course' => $course]);
    }

    /**
     * Store a newly created course
     */
    public function store(Request $request)
    {

        $this->authorize('create', Course::class);

        $request->validate([
            'name' => ['required'],
            'seo_url' => ['required', 'unique:courses'],
            'faculty' => ['required'],
            'category' => ['required'],
            'status' => ['required', Rule::in(['Draft', 'Published'])]
        ]);

        // Set value of 'published_at' based on the status
        $publishedAt = $request->status === 'Published' ? Carbon::now() : null;

        // Merge 'published_at' value into the request data
        $newData = array_merge($request->all(), ['published_at' => $publishedAt]);

        try {
            // Save course
            Course::create($newData);
            return back()->with('success', 'New Course Created Successfully!');
        } catch (\Exception $e) {

            return back()->withErrors(['failed' => "Failed to Create New Course. Please Try Again."]);
        }
    }

    /**
     * Display the specified course
     */
    public function show(Course $course)
    {

        // Retrieve courses based on user's role
        if (auth()->user()->role === 'Student') {
            // Fetch only related modules according to student's batch year
            $modules = $course->modules()->where('batch_year', auth()->user()->batch_year)->get();
        } else {
            // Get all modules of the course
            $modules = $course->modules;
        }

        return view('modules.show', ['course' => $course, 'modules' => $modules]);
    }

    /**
     * Show the form for editing the specified course
     */
    public function edit(Course $course)
    {
        $this->authorize('update', $course);
        return view('courses.edit', ['course' => $course, 'user' => auth()->user()]);
    }

    /**
     * Update a specified course
     */
    public function update(Request $request, Course $course)

    {
        $this->authorize('update', $course);

        $request->validate([
            'name' => ['required'],
            'seo_url' => ['required'],
            'faculty' => ['required'],
            'category' => ['required'],
            'status' => ['required', Rule::in(['Draft', 'Published'])]
        ]);

        // Set value of 'published_at' based on the status
        $publishedAt = $request->status === 'Published' ? Carbon::now() : null;

        // Merge 'published_at' value into the request data
        $newData = array_merge($request->all(), ['published_at' => $publishedAt]);

        try {
            // Update course
            $course->update($newData);
            return redirect(route('courses.index'))->with('success', 'Course Updated Successfully!');
        } catch (\Exception $e) {

            return back()->withErrors(['failed' => "Failed to Update Course. Please Try Again."]);
        }
    }

    /**
     * Remove a specified course
     */
    public function destroy(Course $course)
    {

        $this->authorize('delete', $course);

        try {
            $course->delete();
            return back()->with('success', 'Course Deleted Successfully!');
        } catch (\Exception $e) {

            return back()->withErrors(['failed' => "Failed to Delete Course. Please Try Again."]);
        }
    }
}
