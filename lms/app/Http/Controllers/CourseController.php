<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    /**
     * Display a listing of the courses
     */
    public function index()
    {
        $this->authorize('view', Course::class);

        // Retrieve all courses in descending order
        $courses = Course::orderBy('published_at', 'desc')->get();
        return view('courses.index', ['courses' => $courses, 'user' => auth()->user()]);
    }

    /**
     * Show the form for creating a new course
     */
    public function create()
    {
        $this->authorize('create', Course::class);

        return view('courses.create');
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
        return view('modules.show', ['courses' => $course]);
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

            return back()->withErrors(['failed' => "Failed to delete Course. Please Try Again."]);
        }
    }
}
