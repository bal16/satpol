<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Services\ServiceService;

class ServiceController extends Controller
{
    public function __construct(private ServiceService $service) {}

    public function index()
    {
        return view('services', ['services' => $this->service->listWithItems()]);
    }

    public function show(Service $service)
    {
        return view('service.show', ['service' => $service]);
    }
}
