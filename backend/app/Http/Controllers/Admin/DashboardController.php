<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UpcomingProgram;
use App\Models\NavttcProgram;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_upcoming_programs' => UpcomingProgram::count(),
            'active_upcoming_programs' => UpcomingProgram::where('status', 'active')->count(),
            'total_navttc_programs' => NavttcProgram::count(),
            'active_navttc_programs' => NavttcProgram::where('status', 'active')->count(),
            // Keep these for backward compatibility
            'total_programs' => UpcomingProgram::count() + NavttcProgram::count(),
            'upcoming_programs' => UpcomingProgram::count(),
            'active_programs' => UpcomingProgram::where('status', 'active')->count(),
            'navttc_programs' => NavttcProgram::count(),
        ];

        return view('cspd_admin.pages.index', compact('stats'));
    }
}
