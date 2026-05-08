<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SummerSchool;

class SummerSchoolController extends Controller
{
    public function index()
    {
        $schools = SummerSchool::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get(['id', 'title']);

        return response()->json([
            'success' => true,
            'data'    => $schools,
        ]);
    }

    public function show($id)
    {
        $school = SummerSchool::findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $school,
        ]);
    }
}
