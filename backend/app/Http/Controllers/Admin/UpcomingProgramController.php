<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\UpcomingProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpcomingProgramController extends Controller
{
    /**
     * Display a listing of upcoming programs
     */
    public function index()
    {
        $programs = UpcomingProgram::latest()->paginate(15);
        return view('cspd_admin.pages.upcoming.index', compact('programs'));
    }

    /**
     * Show the form for creating a new upcoming program
     */
    public function create()
    {
        return view('cspd_admin.pages.upcoming.create');
    }

    /**
     * Store a newly created upcoming program
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'overview' => 'required|string',
            'course_outline' => 'required|string',
            'learning_outcomes' => 'required|string',
            'methodology' => 'nullable|string',
            'activities' => 'nullable|string',
            'trainer_profile' => 'required|string',
            'who_should_attend' => 'nullable|string',
            'publications' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'duration' => 'required|string|max:50',
            'total_hours' => 'required|string|max:50',
            'timing' => 'required|string|max:100',
            'fees' => 'required|numeric|min:0',
            'discount_info' => 'nullable|string',
            'brochure' => 'nullable|file|mimes:pdf|max:5120',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle the brochure file
        if ($request->hasFile('brochure')) {
            $file = $request->file('brochure');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/brochures', $filename, 'public');
            $validated['brochure'] = $path;
        }

        UpcomingProgram::create($validated);

        return redirect()
            ->route('admin.upcoming.index')
            ->with('success', 'Upcoming program added successfully!');
    }

    /**
     * Display the specified upcoming program
     */
    public function show($id)
    {
        $program = UpcomingProgram::findOrFail($id);
        return view('cspd_admin.pages.upcoming.show', compact('program'));
    }

    /**
     * Show the form for editing the specified upcoming program
     */
    public function edit($id)
    {
        $program = UpcomingProgram::findOrFail($id);
        return view('cspd_admin.pages.upcoming.edit', compact('program'));
    }

    /**
     * Update the specified upcoming program
     */
    public function update(Request $request, $id)
    {
        $program = UpcomingProgram::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'overview' => 'required|string',
            'course_outline' => 'required|string',
            'learning_outcomes' => 'required|string',
            'methodology' => 'nullable|string',
            'activities' => 'nullable|string',
            'trainer_profile' => 'required|string',
            'who_should_attend' => 'nullable|string',
            'publications' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'duration' => 'required|string|max:50',
            'total_hours' => 'required|string|max:50',
            'timing' => 'required|string|max:100',
            'fees' => 'required|numeric|min:0',
            'discount_info' => 'nullable|string',
            'brochure' => 'nullable|file|mimes:pdf|max:5120',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle the brochure file
        if ($request->hasFile('brochure')) {
            // Delete old brochure if it exists
            if ($program->brochure && Storage::disk('public')->exists($program->brochure)) {
                Storage::disk('public')->delete($program->brochure);
            }
            
            $file = $request->file('brochure');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/brochures', $filename, 'public');
            $validated['brochure'] = $path;
        }

        $program->update($validated);

        return redirect()
            ->route('admin.upcoming.index')
            ->with('success', 'Program updated successfully!');
    }

    /**
     * Remove the specified upcoming program
     */
    public function destroy($id)
    {
        $program = UpcomingProgram::findOrFail($id);
        
        // Delete the brochure file if it exists
        if ($program->brochure && Storage::disk('public')->exists($program->brochure)) {
            Storage::disk('public')->delete($program->brochure);
        }
        
        $program->delete();

        return redirect()
            ->route('admin.upcoming.index')
            ->with('success', 'Program deleted successfully!');
    }
}