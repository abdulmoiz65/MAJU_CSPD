<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CalendarController extends Controller
{
    /**
     * Display all calendars
     */
    public function index()
    {
        $calendars = Calendar::latest()->paginate(2);
        return view('cspd_admin.pages.calendar.index', compact('calendars'));
    }

    /**
     * Show upload form
     */
    public function create()
    {
        return view('cspd_admin.pages.calendar.create');
    }

    /**
     * Store calendar PDF
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'calendar_pdf' => 'required|mimes:pdf|max:5120', // 5MB max
        ], [
            'calendar_pdf.required' => 'Calendar PDF is required.',
            'calendar_pdf.mimes' => 'Only PDF files are allowed.',
            'calendar_pdf.max' => 'PDF must be less than 5MB.',
        ]);

        // Handle the file
        $file = $request->file('calendar_pdf');

        // Generate a unique filename with extension
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

        // Store in public disk under uploads/download-calendar
        $path = $file->storeAs('uploads/download-calendar', $filename, 'public');

        // Save in database
        Calendar::create([
            'title' => $request->title,
            'file_path' => $path,
        ]);

        return redirect()
            ->route('admin.calendars.index')
            ->with('success', 'Calendar uploaded successfully.');
    }

    /**
     * Permanently delete calendar
     */
    public function destroy(Calendar $calendar)
    {
        // Safely delete the file if it exists
        if ($calendar->file_path && Storage::disk('public')->exists($calendar->file_path)) {
            Storage::disk('public')->delete($calendar->file_path);
        }

        // Delete the database record
        $calendar->delete();

        return redirect()
            ->back()
            ->with('success', 'Calendar deleted permanently.');
    }
}
