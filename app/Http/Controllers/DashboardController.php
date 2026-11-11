<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function __construct(private DashboardService $dashboard) {}

    public function __invoke()
    {
        return view('dashboard', $this->dashboard->home());
    }
}
