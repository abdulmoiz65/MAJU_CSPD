<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NavttcProgram;
use Illuminate\Http\Response;

class NavttcProgramController extends Controller
{
    /**
     * Get all active NAVTTC programs
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $programs = NavttcProgram::where('status', 'active')
                ->latest()
                ->get();

            return response()->json([
                'success' => true,
                'data' => $programs,
                'message' => 'Programs retrieved successfully'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving programs: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get a single NAVTTC program by ID
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $program = NavttcProgram::findOrFail($id);

            if ($program->status !== 'active') {
                return response()->json([
                    'success' => false,
                    'message' => 'Program not found'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'data' => $program,
                'message' => 'Program retrieved successfully'
            ], Response::HTTP_OK);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Program not found'
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving program: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
