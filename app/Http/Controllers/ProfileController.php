<?php

namespace App\Http\Controllers;

use App\Services\ProfileItemService;
use App\Services\SopService;

class ProfileController extends Controller
{
    public function __construct(
        private ProfileItemService $profile,
        private SopService $sop,
    ) {}

    public function __invoke()
    {
        return view('profile', [
            'items' => $this->profile->list(),
            'sops' => $this->sop->list(),
        ]);
    }
}
