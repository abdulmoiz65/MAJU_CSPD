<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavttcProgram;
use Illuminate\Http\Request;

class NavttcProgramController extends Controller
{
    /**
     * Display all programs
     */
    public function index()
    {
        $programs = NavttcProgram::latest()->paginate(15);
        return view('cspd_admin.pages.navttc.index', compact('programs'));
    }

    /**
     * Show form to create new program
     */
    public function create()
    {
        return view('cspd_admin.pages.navttc.create');
    }

    /**
     * Save new program
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'required_qualification' => 'required|string',
            'apply_link' => 'nullable|url',
            'status' => 'required|in:active,inactive',
        ], [
            'title.required' => 'Program title is required.',
            'required_qualification.required' => 'Qualification field is required.',
            'apply_link.url' => 'Please enter a valid URL.',
        ]);

        NavttcProgram::create([
            'title' => $validated['title'],
            'required_qualification' => $validated['required_qualification'],
            'apply_link' => $validated['apply_link'] ?? 'https://nsis.navttc.gov.pk/',
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.navttc.index')
            ->with('success', 'Program added successfully!');
    }

    /**
     * Show form to edit program
     */
    public function edit($id)
    {
        $program = NavttcProgram::findOrFail($id);
        return view('cspd_admin.pages.navttc.edit', compact('program'));
    }

    /**
     * Update program
     */
    public function update(Request $request, $id)
    {
        $program = NavttcProgram::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'required_qualification' => 'required|string',
            'apply_link' => 'nullable|url',
            'status' => 'required|in:active,inactive',
        ], [
            'title.required' => 'Program title is required.',
            'required_qualification.required' => 'Qualification field is required.',
            'apply_link.url' => 'Please enter a valid URL.',
        ]);

        $program->update([
            'title' => $validated['title'],
            'required_qualification' => $validated['required_qualification'],
            'apply_link' => $validated['apply_link'] ?? 'https://nsis.navttc.gov.pk/',
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.navttc.index')
            ->with('success', 'Program updated successfully!');
    }

    /**
     * Delete program
     */
    public function destroy($id)
    {
        $program = NavttcProgram::findOrFail($id);
        $program->delete();

        return redirect()
            ->route('admin.navttc.index')
            ->with('success', 'Program deleted successfully!');
    }
}