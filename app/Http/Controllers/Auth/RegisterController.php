<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Http;

class RegisterController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('admin.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(RegisterRequest $request)
    {
        // dd($request);
        Models\User::create(attributes: [
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);



        return to_route('login');
    }
}