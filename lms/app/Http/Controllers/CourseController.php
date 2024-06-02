<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', Course::class);

        // Retrieve all courses in descending order
        $courses = Course::orderBy('published_at', 'desc')->get();
        return view('courses.index', ['courses' => $courses, 'user' => auth()->user()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Course::class);

        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {

        $this->authorize('delete', $course);

        try {
            $course->delete();
            return redirect()->route('courses.index')->with('success', 'Course Deleted Successfully!');
        } catch (\Exception $e) {

            return redirect()->route('courses.index')->withErrors(['failed' => "Failed to delete Course. Please Try Again."]);
        }
    }
}
