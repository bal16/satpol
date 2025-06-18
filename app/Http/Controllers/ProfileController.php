<?php

namespace App\Http\Controllers;

use App\Models\ProfileItems;
use Illuminate\Http\Request;
// use App\Http\Requests\StoreProfileItemsRequest;
// use App\Http\Requests\UpdateProfileItemsRequest;

class ProfileController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('profile', [
            'items' => ProfileItems::all(),
        ]);
    }
}
