<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use Illuminate\Http\Response;

class CalendarController extends Controller
{
    /**
     * Get the active calendar
     * @return \Illuminate\Http\JsonResponse
     */
    public function getActiveCalendar()
    {
        try {
            $calendar = Calendar::where('status', 'active')->first();

            if (!$calendar) {
                return response()->json([
                    'success' => false,
                    'message' => 'No active calendar available'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json([
                'success' => true,
                'data' => $calendar,
                'message' => 'Active calendar retrieved successfully'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving calendar: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
