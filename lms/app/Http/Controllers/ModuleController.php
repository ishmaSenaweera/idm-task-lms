<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseModule;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{

    /**
     * Display a listing of the modules
     */
    public function index()
    {
        // Fetch all modules
        $modules = Module::orderBy('created_at', 'desc')->get();
        return view('modules.index', ['modules' => $modules]);
    }

    /**
     * Show the form for creating a new module
     */
    public function create()
    {
        return view('modules.create');
    }

    /**
     * Store a newly created module
     */
    public function store(Request $request,)
    {

        // Validate module
        $fields = $request->validate([
            'code' => ['required', 'max:10', 'unique:modules,code'],
            'name'  => ['required', 'max:255'],
            'description' => ['max:255']
        ]);

        try {

            // Save module in module table
            Module::create($fields);
            return back()->with('success', 'New Module Created Successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['failed' => "Failed to Create New Course. Please Try Again."]);
        }
    }

    /**
     * Show the form for editing the specified module
     */
    public function edit(Module $module)
    {

        // Pass the module to the view
        return view('modules.edit', ['module' => $module]);
    }

    /**
     * Update the specified module
     */
    public function update(Request $request, Module $module)
    {

        // Validate module
        $fields = $request->validate([
            'code' => ['required', 'max:10'],
            'name'  => ['required', 'max:255'],
            'description' => ['max:255'],
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
    public function destroy(Module $module)
    {

        try {

            $module->delete(); // Delete the module
            return back()->with('success', 'Module Deleted Successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['failed' => "Failed to Delete Module. Please Try Again."]);
        }
    }
}
