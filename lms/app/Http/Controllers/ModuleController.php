<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\modules;
use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{

    /**
     * Show the form for creating a new module
     */
    public function create(Course $course)
    {
        $this->authorize('create', Module::class);

        return view('modules.create', ['course' => $course]);
    }

    /**
     * Store a newly created module
     */
    public function store(Request $request, Course $course)
    {
        $this->authorize('create', Module::class);

        // Validate module
        $fields = $request->validate([
            'code' => ['required', 'max:10'],
            'name'  => ['required', 'max:255'],
            'semester'  => ['required'],
            'description' => ['max:255'],
            'credits'  => ['required', 'integer']
        ]);

        try {
            // Save module
            $course->modules()->create($fields);
            return back()->with('success', 'New Module Created Successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['failed' => "Failed to Create New Course. Please Try Again."]);
        }
    }

    /**
     * Show the form for editing the specified module
     */
    public function edit(Course $course, Module $module)
    {
        // Pass the $course and $module to the view
        return view('modules.edit', ['course' =>  $course, 'module' => $module]);
    }

    /**
     * Update the specified module
     */
    public function update(Request $request, Course $course, Module $module)
    {
        $this->authorize('update', $module);

        // Validate module
        $fields = $request->validate([
            'code' => ['required', 'max:10'],
            'name'  => ['required', 'max:255'],
            'semester'  => ['required'],
            'description' => ['max:255'],
            'credits'  => ['required', 'integer']
        ]);

        try {
            // Update the module with the validated data
            $module->update($fields);

            return back()->with('success', 'Module Updated Successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['failed' => "Failed to Update Module. Please Try Again."]);
        }
    }

    /**
     * Remove the specified module
     */
    public function destroy(Course $course, Module $module)
    {
        $this->authorize('delete', $module); // Authorize the delete action for the module

        try {
            $module->delete(); // Delete the module

            return back()->with('success', 'Module Deleted Successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['failed' => "Failed to Delete Module. Please Try Again."]);
        }
    }
}
