<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LanguageCourse;

class LanguageCourseController extends Controller
{
    public function index()
    {
        $courses = LanguageCourse::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get(['id', 'title']);

        return response()->json([
            'success' => true,
            'data' => $courses,
        ]);
    }

    public function show($id)
    {
        $course = LanguageCourse::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $course,
        ]);
    }
}
