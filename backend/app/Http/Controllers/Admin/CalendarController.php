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
        $calendars = Calendar::latest()->paginate(15);
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
        'calendar_pdf' => 'required|mimes:pdf|max:5120',
        'status' => 'required|in:active,inactive',
    ]);

    $file = $request->file('calendar_pdf');
    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
    $path = $file->storeAs('uploads/download-calendar', $filename, 'public');

    // 🔥 If new calendar is ACTIVE → deactivate others
    if ($request->status === 'active') {
        Calendar::where('status', 'active')->update([
            'status' => 'inactive'
        ]);
    }

    Calendar::create([
        'title' => $request->title,
        'file_path' => $path,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('admin.calendars.index')
        ->with('success', 'Calendar uploaded successfully.');
}

public function edit(Calendar $calendar)
{
    return view('cspd_admin.pages.calendar.edit', compact('calendar'));
}

public function update(Request $request, Calendar $calendar)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'calendar_pdf' => 'nullable|mimes:pdf|max:5120',
        'status' => 'required|in:active,inactive',
    ]);

    // If status is being set to active → deactivate others
    if ($request->status === 'active') {
        Calendar::where('id', '!=', $calendar->id)
            ->where('status', 'active')
            ->update(['status' => 'inactive']);
    }

    $data = [
        'title' => $request->title,
        'status' => $request->status,
    ];

    // Replace PDF if uploaded
    if ($request->hasFile('calendar_pdf')) {

        // Delete old file
        if (
            $calendar->file_path &&
            Storage::disk('public')->exists($calendar->file_path)
        ) {
            Storage::disk('public')->delete($calendar->file_path);
        }

        $filename = Str::uuid() . '.' .
                    $request->file('calendar_pdf')->getClientOriginalExtension();

        $path = $request->file('calendar_pdf')
                        ->storeAs('uploads/download-calendar', $filename, 'public');

        $data['file_path'] = $path;
    }

    $calendar->update($data);

    return redirect()
        ->route('admin.calendars.index')
        ->with('success', 'Calendar updated successfully.');
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
