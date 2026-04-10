<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DiplomaProgram;

class DiplomaProgramController extends Controller
{
    public function index()
    {
        $programs = DiplomaProgram::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get(['id', 'title']);

        return response()->json([
            'success' => true,
            'data' => $programs,
        ]);
    }

    public function show($id)
    {
        $program = DiplomaProgram::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $program,
        ]);
    }
}
