<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('admin.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        // $email = Models\User::where(
        //     'username',
        //     '=',
        //     $request->key
        //     )->orWhere(
        //         'email',
        //         '=',
        //         $request->key
        //         )->first('email')->email;

        // // dd($user);
        // if (!$email)
        //     return to_route('login');

        // $request['email'] = $user->email;

        $request->authenticate();

        $request->session()->regenerate(); // return boolean method
        return to_route('admin.dashboard')->with('success', "Welcome Back " . $request->key);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
