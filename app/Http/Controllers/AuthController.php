<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $emailInput = trim(strtolower($request->email));
        $user = User::whereRaw('LOWER(email) = ?', [$emailInput])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Alamat email ini tidak terdaftar di sistem admin. Periksa kembali email Anda.',
            ])->onlyInput('email');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Kata sandi yang Anda masukkan salah. Silakan periksa kembali.',
            ])->onlyInput('email');
        }

        // If accessing from a NEW / untrusted device -> Require OTP verification
        if (!$user->isTrustedDevice($request)) {
            $request->session()->put('pending_user_id', $user->user_id);
            $user->generateOtp('Verifikasi Keamanan Akses Login Perangkat Baru');

            return redirect()->route('login.otp')->with('info', 'Kode OTP 6-Digit verifikasi login telah dikirimkan ke email Anda (' . $user->email . ').');
        }

        // Direct login if device is already trusted on this browser
        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard')->with('success', 'Selamat datang kembali, ' . $user->name . '!');
    }

    /**
     * Show OTP Verification Screen for login.
     */
    public function showOtpForm(Request $request)
    {
        $userId = $request->session()->get('pending_user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('login');
        }

        return view('auth.otp', compact('user'));
    }

    /**
     * Verify OTP and set 30-Day Trusted Device cookie if checked.
     */
    public function verifyLoginOtp(Request $request)
    {
        $userId = $request->session()->get('pending_user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $user = User::findOrFail($userId);

        $request->validate([
            'otp_code' => ['required', 'string', 'size:6'],
        ], [
            'otp_code.required' => 'Kode OTP 6-Digit wajib diisi.',
            'otp_code.size' => 'Kode OTP harus berjumlah 6 digit angka.',
        ]);

        if ($user->verifyOtp($request->otp_code)) {
            $request->session()->forget('pending_user_id');
            Auth::login($user);
            $request->session()->regenerate();

            // Set 30-day Trusted Device cookie if user checked "Ingat Perangkat Ini"
            if ($request->boolean('remember_device')) {
                $cookieName = 'trusted_device_' . $user->user_id;
                $cookieValue = hash_hmac('sha256', $user->user_id . '|' . $user->email, config('app.key'));
                Cookie::queue(Cookie::make($cookieName, $cookieValue, 60 * 24 * 30, '/')); // 30 days
            }

            return redirect()->route('admin.dashboard')->with('success', 'Verifikasi OTP berhasil! Selamat datang kembali, ' . $user->name . '!');
        }

        return back()->withErrors(['otp_code' => 'Kode OTP 6-Digit tidak valid atau telah kedaluwarsa. Silakan periksa kembali.']);
    }

    /**
     * Resend OTP Code.
     */
    public function resendOtp(Request $request)
    {
        $userId = $request->session()->get('pending_user_id');
        if ($userId) {
            $user = User::find($userId);
            if ($user) {
                $user->generateOtp('Verifikasi Ulang Akses Login Perangkat Baru');
                return back()->with('success', 'Kode OTP 6-Digit yang baru telah dikirimkan ke email Anda.');
            }
        }
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}
