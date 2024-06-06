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
        /** @var App\Models\User */

        // Get the authenticated user
        $user = auth()->user();

        // Retrieve courses based on user's role
        if ($user->hasRole('Admin') || $user->hasRole('Academic Head')) {
            // Fetch all courses
            $courses = Course::orderBy('created_at', 'desc')->get();
        } else {
            // Fetch only published courses for teachers and students
            $courses = Course::where('status', 'publish')->orderBy('created_at', 'desc')->get();
        }

        return view('courses.index', ['courses' => $courses]);
    }


    /**
     * Show the form for creating a new course
     */
    public function create(Course $course)
    {
        return view('courses.create', ['course' => $course]);
    }

    /**
     * Store a newly created course
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'faculty' => ['required'],
            'category' => ['required'],
            'status' => ['required']
        ]);

        // Set value of 'published_at' based on the status
        $publishedAt = $request->status === 'publish' ? Carbon::now() : null;

        // Merge 'published_at' value into the request data
        $fields = array_merge($request->all(), ['published_at' => $publishedAt]);

        try {
            // Save course
            Course::create($fields);
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
        return view('courses.edit', ['course' => $course]);
    }

    /**
     * Update a specified course
     */
    public function update(Request $request, Course $course)
    {
        /** @var App\Models\User */

        // Get the authenticated user
        $user = auth()->user();

        $request->validate([
            'name' => ['required'],
            'faculty' => ['required'],
            'category' => ['required'],
            'status' => ['required']
        ]);

        // Set value of 'published_at' based on the status
        $publishedAt = $request->status === 'publish' ? Carbon::now() : null;

        // Merge 'published_at' value into the request data
        $fields = array_merge($request->all(), ['published_at' => $publishedAt]);

        try {
            
            // Check if the user is an Academic Head 
            if ($user->hasRole('Academic Head')) {

                // Check if the course is in draft mode or published within 6 hours 
                if ($course->status === 'draft' || ($course->status === 'publish' && Carbon::parse($course->published_at)->addHours(6)->gt(Carbon::now()))) {
                    // Update course
                    $course->update($fields);
                    return redirect(route('courses.index'))->with('success', 'Course Updated Successfully!');
                } else {
                    // If not in draft mode or published longer than 6 hours ago, only admin can update
                    return back()->withErrors(['failed' => "You Can't Update this Course."]);
                }
            }

            // Update course
            $course->update($fields);
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
        /** @var App\Models\User */

        // Get the authenticated user
        $user = auth()->user();

        try {

            // heck if the user is an Academic Head 
            if ($user->hasRole('Academic Head')) {

                // Check if the course is in draft mode
                if ($course->status === 'draft') {
                    $course->delete();
                    return back()->with('success', 'Course Deleted Successfully!');
                } else {

                    return back()->withErrors(['failed' => "Can't Delete Published Course."]);
                }
            }

            $course->delete();
            return back()->with('success', 'Course Deleted Successfully!');
        } catch (\Exception $e) {

            return back()->withErrors(['failed' => "Failed to Delete Course. Please Try Again."]);
        }
    }
}
