<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http; // Tambahkan ini
// use Symfony\Component\HttpFoundation\IpUtils; // Hapus atau pastikan ini ada jika Anda benar-benar menggunakannya
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

        $recaptcha = $request->input('g-recaptcha-response');

        if (is_null($recaptcha)) {
            return redirect()->back()->withErrors(['g-recaptcha-response' => 'Mohon lengkapi reCAPTCHA.']);
        }

        $url = "https://www.google.com/recaptcha/api/siteverify";

        $params = [
            'secret' => config('services.recaptcha.secret'),
            'response' => $recaptcha,
            'remoteip' => $request->ip() // Menggunakan IP langsung dari request
        ];

        // Melakukan POST request ke Google reCAPTCHA
        $recaptchaResponse = Http::asForm()->post($url, $params);
        $resultJson = $recaptchaResponse->json();

        // Periksa apakah request berhasil dan reCAPTCHA valid
        if (!$recaptchaResponse->successful() || !isset($resultJson['success']) || $resultJson['success'] !== true) {
            // Jika ada error codes dari Google, Anda bisa menambahkannya ke pesan error
            $errorCodes = $resultJson['error-codes'] ?? [];
            $errorMessage = 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.';
            if (!empty($errorCodes)) {
                $errorMessage .= ' Kode error: ' . implode(', ', $errorCodes);
            }
            return redirect()->back()->withErrors(['g-recaptcha-response' => $errorMessage]);
        }
        // Jika reCAPTCHA berhasil, lanjutkan ke autentikasi
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
