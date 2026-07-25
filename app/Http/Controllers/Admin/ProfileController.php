<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the admin profile management page.
     */
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    /**
     * Request OTP to unlock password change form in Profile page.
     */
    public function requestProfileOtp()
    {
        $user = Auth::user();
        $user->generateOtp('Membuka Akses Pengubahan Kata Sandi Profil Anda');
        session(['pending_profile_otp' => true]);

        return back()->with('show_profile_otp_modal', true)->with('info', 'Kode OTP 6-Digit verifikasi telah dikirimkan ke email Anda. Silakan masukkan kode OTP untuk membuka form ubah kata sandi.');
    }

    /**
     * Verify OTP code to unlock password change form.
     */
    public function verifyProfileOtp(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'otp_code' => ['required', 'string', 'size:6'],
        ], [
            'otp_code.required' => 'Kode OTP 6-Digit wajib diisi.',
            'otp_code.size' => 'Kode OTP harus 6 digit angka.',
        ]);

        if ($user->verifyOtp($request->otp_code)) {
            session(['profile_password_unlocked' => true]);
            session()->forget('pending_profile_otp');

            return back()->with('success', 'Verifikasi OTP Keamanan Berhasil! Form pengisian kata sandi baru telah dibuka.');
        }

        return back()->with('show_profile_otp_modal', true)->withErrors(['otp_code' => 'Kode OTP 6-Digit tidak valid atau telah kedaluwarsa. Silakan periksa kembali.']);
    }

    /**
     * Update the admin profile information and password.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->user_id, 'user_id'),
            ],
            'current_password' => 'nullable|required_with:new_password|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Email ini sudah digunakan oleh akun lain.',
            'current_password.required_with' => 'Kata sandi saat ini wajib diisi untuk mengganti kata sandi baru.',
            'new_password.min' => 'Kata sandi baru minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        // Validate current password and update new password if unlocked
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Kata sandi saat ini tidak sesuai.'])->withInput();
            }

            $user->password = Hash::make($request->new_password);
            session()->forget('profile_password_unlocked');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('admin.profile.index')->with('success', 'Profil dan kata sandi akun Anda berhasil diperbarui!');
    }
}
