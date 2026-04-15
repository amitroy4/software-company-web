<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class MaintenanceController extends Controller
{
    public function index() {
        return view('admin.maintenance');
    }

    public function clearCache()
    {
        Artisan::call('route:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('optimize:clear');
        return redirect()->route('dashboard')->with('success', 'Cache cleared!!');
    }

    public function storageLink()
    {
        Artisan::call('storage:link');
        return redirect()->route('dashboard')->with('success', 'Storage link recreated successfully!');
    }
}
