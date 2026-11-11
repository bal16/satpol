<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function __construct(private DashboardService $dashboard) {}

    public function index()
    {
        return view('admin.dashboard', $this->dashboard->admin());
    }
}
