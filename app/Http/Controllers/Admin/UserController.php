<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of all admin users (Excluding Super Admin for a clean listing).
     */
    public function index()
    {
        $users = User::where('role', 'admin')->latest('created_at')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new admin user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created admin user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'role' => 'required|in:super_admin,admin',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.unique' => 'Alamat email ini sudah terdaftar.',
            'role.required' => 'Role pengguna wajib dipilih.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', "Akun admin pengurus '{$request->name}' ({$request->email}) berhasil ditambahkan!");
    }

    /**
     * Show the form for editing the specified admin user.
     */
    public function edit(User $user)
    {
        // Super Admin account management is strictly handled via "Profil Saya"
        if ($user->isSuperAdmin()) {
            return redirect()->route('admin.profile.index')->with('info', 'Pengaturan informasi dan kata sandi akun Super Admin dilakukan melalui menu Profil Saya.');
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Request OTP for resetting an admin's password (Challenge-First Step).
     */
    public function requestResetOtp(User $user)
    {
        if ($user->isSuperAdmin()) {
            return redirect()->route('admin.profile.index');
        }

        Auth::user()->generateOtp('Membuka Akses Reset Kata Sandi Akun Admin (' . $user->name . ')');
        session(['pending_reset_otp_user_id' => $user->user_id]);

        return back()->with('show_reset_otp_modal', true)->with('info', 'Kode OTP 6-Digit verifikasi telah dikirimkan ke email Super Admin Anda. Silakan verifikasi untuk membuka form reset password.');
    }

    /**
     * Verify OTP code to unlock the reset password form.
     */
    public function verifyResetOtp(Request $request, User $user)
    {
        if ($user->isSuperAdmin()) {
            return redirect()->route('admin.profile.index');
        }

        $request->validate([
            'otp_code' => ['required', 'string', 'size:6'],
        ], [
            'otp_code.required' => 'Kode OTP 6-Digit wajib diisi.',
            'otp_code.size' => 'Kode OTP harus 6 digit angka.',
        ]);

        if (Auth::user()->verifyOtp($request->otp_code)) {
            session(['reset_password_unlocked_' . $user->user_id => true]);
            session()->forget('pending_reset_otp_user_id');

            return back()->with('success', 'Verifikasi OTP Super Admin Berhasil! Form pengisian kata sandi baru untuk akun ' . $user->name . ' telah dibuka.');
        }

        return back()->with('show_reset_otp_modal', true)->withErrors(['otp_code' => 'Kode OTP 6-Digit tidak valid atau telah kedaluwarsa. Silakan periksa kembali.']);
    }

    /**
     * Update the specified admin user in storage.
     */
    public function update(Request $request, User $user)
    {
        if ($user->isSuperAdmin()) {
            return redirect()->route('admin.profile.index');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->user_id, 'user_id'),
            ],
            'role' => 'required|in:super_admin,admin',
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.unique' => 'Alamat email ini sudah digunakan oleh akun lain.',
            'role.required' => 'Role pengguna wajib dipilih.',
            'password.min' => 'Kata sandi baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
            session()->forget('reset_password_unlocked_' . $user->user_id);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', "Informasi & kata sandi akun admin '{$user->name}' ({$user->email}) berhasil diperbarui!");
    }

    /**
     * Remove the specified admin user from storage.
     */
    public function destroy(User $user)
    {
        if ($user->isSuperAdmin()) {
            return redirect()->route('admin.users.index')->with('error', 'Akun Super Admin tidak dapat dihapus!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Akun admin pengurus berhasil dihapus!');
    }
}
