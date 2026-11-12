<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\MathCaptchaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function __construct(
        protected MathCaptchaService $captchaService
    ) {}

    /**
     * Display the login view.
     */
    public function create(): View
    {
        $captcha = $this->captchaService->generate();

        return view('admin.login', [
            'captchaQuestion' => $captcha['question'],
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if (! $this->captchaService->validate($request->input('math_captcha'))) {
            return redirect()->back()
                ->withInput($request->only('key', 'remember'))
                ->withErrors(['math_captcha' => 'Jawaban hitungan matematika tidak tepat. Silakan coba lagi.']);
        }

        $request->authenticate();

        $request->session()->regenerate();

        return to_route('admin.dashboard')->with('success', 'Welcome Back '.$request->key);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
