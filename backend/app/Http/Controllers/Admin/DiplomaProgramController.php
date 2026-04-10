<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiplomaProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DiplomaProgramController extends Controller
{
    public function index()
    {
        $programs = DiplomaProgram::latest()->paginate(15);
        return view('cspd_admin.pages.diploma.index', compact('programs'));
    }

    public function create()
    {
        return view('cspd_admin.pages.diploma.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'overview' => 'nullable|string',
            'course_outline' => 'nullable|string',
            'learning_outcomes' => 'nullable|string',
            'trainer_profile' => 'nullable|string',
            'trainer_image' => 'nullable|image|max:2048',
            'enroll_link' => 'nullable|url',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'duration' => 'nullable|string|max:50',
            'total_hours' => 'nullable|string|max:50',
            'timing' => 'nullable|string|max:100',
            'fees' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'registration_date' => 'nullable|date',
            'online_form_availability_date' => 'nullable|date',
            'form_submission_deadline' => 'nullable|date',
            'enrollment_offers_date' => 'nullable|date',
            'fee_document_submission_date' => 'nullable|date',
            'orientation_ceremony_date' => 'nullable|date',
            'class_commencement_date' => 'nullable|date',
        ]);

        if ($request->hasFile('trainer_image')) {
            $file = $request->file('trainer_image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/trainer-image', $filename, 'public');
            $validated['trainer_image'] = $path;
        }

        DiplomaProgram::create($validated);

        return redirect()
            ->route('admin.diploma.index')
            ->with('success', 'Diploma program added successfully!');
    }

    public function edit($id)
    {
        $program = DiplomaProgram::findOrFail($id);
        return view('cspd_admin.pages.diploma.edit', compact('program'));
    }

    public function update(Request $request, $id)
    {
        $program = DiplomaProgram::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'overview' => 'nullable|string',
            'course_outline' => 'nullable|string',
            'learning_outcomes' => 'nullable|string',
            'trainer_profile' => 'nullable|string',
            'trainer_image' => 'nullable|image|max:2048',
            'enroll_link' => 'nullable|url',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'duration' => 'nullable|string|max:50',
            'total_hours' => 'nullable|string|max:50',
            'timing' => 'nullable|string|max:100',
            'fees' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,inactive',
            'registration_date' => 'nullable|date',
            'online_form_availability_date' => 'nullable|date',
            'form_submission_deadline' => 'nullable|date',
            'enrollment_offers_date' => 'nullable|date',
            'fee_document_submission_date' => 'nullable|date',
            'orientation_ceremony_date' => 'nullable|date',
            'class_commencement_date' => 'nullable|date',
        ]);

        if ($request->hasFile('trainer_image')) {
            if ($program->trainer_image && Storage::disk('public')->exists($program->trainer_image)) {
                Storage::disk('public')->delete($program->trainer_image);
            }
            $file = $request->file('trainer_image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/trainer-image', $filename, 'public');
            $validated['trainer_image'] = $path;
        }

        $program->update($validated);

        return redirect()
            ->route('admin.diploma.index')
            ->with('success', 'Diploma program updated successfully!');
    }

    public function destroy($id)
    {
        $program = DiplomaProgram::findOrFail($id);

        if ($program->trainer_image && Storage::disk('public')->exists($program->trainer_image)) {
            Storage::disk('public')->delete($program->trainer_image);
        }

        $program->delete();

        return redirect()
            ->route('admin.diploma.index')
            ->with('success', 'Diploma program deleted successfully!');
    }
}
