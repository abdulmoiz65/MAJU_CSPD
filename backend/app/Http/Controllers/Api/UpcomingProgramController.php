<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UpcomingProgram;
use Illuminate\Http\Request;

class UpcomingProgramController extends Controller
{
    /**
     * Get all upcoming programs
     */
    public function index()
    {
        $programs = UpcomingProgram::where('status', 'active')
            ->where('completed', false)
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhereDate('end_date', '>=', now());
            })
            ->orderBy('start_date', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $programs,
        ]);
    }

    /**
     * Get a specific upcoming program by ID
     */
    public function show($id)
    {
        $program = UpcomingProgram::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $program,
        ]);
    }

    /**
     * Get upcoming programs grouped by month
     */
    public function byMonth()
    {
        $programs = UpcomingProgram::where('status', 'active')
            ->where('completed', false)
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhereDate('end_date', '>=', now());
            })
            ->orderBy('start_date', 'asc')
            ->get();

        $grouped = [];

        foreach ($programs as $program) {
            if ($program->start_date) {
                $month = strtoupper($program->start_date->format('M')); // JAN, FEB, etc. (3-letter uppercase)
                if (!isset($grouped[$month])) {
                    $grouped[$month] = [];
                }
                $grouped[$month][] = $program;
            }
        }

        return response()->json([
            'success' => true,
            'data' => $grouped,
        ]);
    }

    /**
     * Get all completed programs
     */
    public function completed()
    {
        $programs = UpcomingProgram::where('status', 'active')
            ->where(function ($query) {
                $query->where('completed', true)
                    ->orWhereDate('end_date', '<', now());
            })
            ->orderBy('end_date', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $programs,
        ]);
    }

    /**
     * Store a new upcoming program
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'overview' => 'nullable|string',
            'course_outline' => 'nullable|string',
            'learning_outcomes' => 'nullable|string',
            'methodology' => 'nullable|string',
            'activities' => 'nullable|string',
            'trainer_profile' => 'nullable|string',
            'who_should_attend' => 'nullable|string',
            'publications' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'duration' => 'nullable|string',
            'total_hours' => 'nullable|string',
            'timing' => 'nullable|string',
            'fees' => 'nullable|numeric',
            'currency' => 'nullable|string',
            'discount_info' => 'nullable|string',
            'brochure' => 'nullable|string',
            'status' => 'nullable|in:active,inactive',
        ]);

        $program = UpcomingProgram::create($validated);

        return response()->json([
            'success' => true,
            'data' => $program,
            'message' => 'Program created successfully',
        ], 201);
    }

    /**
     * Update an upcoming program
     */
    public function update(Request $request, $id)
    {
        $program = UpcomingProgram::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'overview' => 'nullable|string',
            'course_outline' => 'nullable|string',
            'learning_outcomes' => 'nullable|string',
            'methodology' => 'nullable|string',
            'activities' => 'nullable|string',
            'trainer_profile' => 'nullable|string',
            'who_should_attend' => 'nullable|string',
            'publications' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'duration' => 'nullable|string',
            'total_hours' => 'nullable|string',
            'timing' => 'nullable|string',
            'fees' => 'nullable|numeric',
            'currency' => 'nullable|string',
            'discount_info' => 'nullable|string',
            'brochure' => 'nullable|string',
            'status' => 'nullable|in:active,inactive',
        ]);

        $program->update($validated);

        return response()->json([
            'success' => true,
            'data' => $program,
            'message' => 'Program updated successfully',
        ]);
    }

    /**
     * Delete an upcoming program
     */
    public function destroy($id)
    {
        $program = UpcomingProgram::findOrFail($id);
        $program->delete();

        return response()->json([
            'success' => true,
            'message' => 'Program deleted successfully',
        ]);
    }
}
