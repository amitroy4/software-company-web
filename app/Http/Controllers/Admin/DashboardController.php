<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Employee\EmployeePersonalInformation;
use App\Models\Admin\HrAdminSetup\Attendance;
use App\Models\Admin\SystemConfiguration\Branch;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $usercount = User::count();
        return view('admin.dashboard',compact('usercount'));
    }
}
