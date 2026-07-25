<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /**
     * Show form to enter email for password reset.
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Send OTP 6-digit code to user email.
     */
    public function sendResetOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        $emailInput = trim(strtolower($request->email));
        $user = User::whereRaw('LOWER(email) = ?', [$emailInput])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Alamat email ini tidak terdaftar di sistem.'])->withInput();
        }

        // Generate and send 6-digit OTP to user email
        $user->generateOtp('Reset Kata Sandi Akun (Lupa Password)');

        session(['forgot_password_user_id' => $user->user_id]);

        return redirect()->route('password.verify')->with('info', 'Kode OTP 6-Digit verifikasi telah dikirimkan ke email Anda.');
    }

    /**
     * Show OTP verification screen for forgot password.
     */
    public function showOtpVerifyForm(Request $request)
    {
        $userId = session('forgot_password_user_id');
        if (!$userId) {
            return redirect()->route('password.request');
        }

        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('password.request');
        }

        return view('auth.passwords.otp', compact('user'));
    }

    /**
     * Verify OTP code for forgot password.
     */
    public function verifyResetOtp(Request $request)
    {
        $userId = session('forgot_password_user_id');
        if (!$userId) {
            return redirect()->route('password.request');
        }

        $user = User::findOrFail($userId);

        $request->validate([
            'otp_code' => ['required', 'string', 'size:6'],
        ], [
            'otp_code.required' => 'Kode OTP 6-Digit wajib diisi.',
            'otp_code.size' => 'Kode OTP harus 6 digit angka.',
        ]);

        if ($user->verifyOtp($request->otp_code)) {
            session(['password_reset_unlocked_user_id' => $user->user_id]);
            return redirect()->route('password.reset')->with('success', 'Verifikasi OTP berhasil! Silakan masukkan kata sandi baru Anda.');
        }

        return back()->withErrors(['otp_code' => 'Kode OTP 6-Digit tidak valid atau telah kedaluwarsa. Silakan periksa kembali.']);
    }

    /**
     * Show new password input form.
     */
    public function showResetForm()
    {
        $userId = session('password_reset_unlocked_user_id');
        if (!$userId) {
            return redirect()->route('password.request');
        }

        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('password.request');
        }

        return view('auth.passwords.reset', compact('user'));
    }

    /**
     * Update user password to the new password.
     */
    public function resetPassword(Request $request)
    {
        $userId = session('password_reset_unlocked_user_id');
        if (!$userId) {
            return redirect()->route('password.request');
        }

        $user = User::findOrFail($userId);

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        session()->forget(['forgot_password_user_id', 'password_reset_unlocked_user_id']);

        return redirect()->route('login')->with('success', 'Kata sandi Anda berhasil diperbarui! Silakan login dengan kata sandi baru Anda.');
    }
}
