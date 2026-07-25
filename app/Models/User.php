<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'otp_code',
        'otp_expires_at',
    ];

    /**
     * Helper method to check if user has super admin role.
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    /**
     * Helper method to check if user has admin access (admin or super_admin).
     */
    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'super_admin']);
    }

    /**
     * Helper method to check if user has a specific role.
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Generate 6-digit OTP code, save expiration, and send notification mail.
     */
    public function generateOtp(string $actionText = ''): string
    {
        $otp = sprintf("%06d", mt_rand(1, 999999));
        
        $this->forceFill([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ])->save();

        try {
            \Illuminate\Support\Facades\Mail::to($this->email)->send(new \App\Mail\OtpNotificationMail($otp, $this->name, $actionText));
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::warning('OTP Mail Exception: ' . $e->getMessage());
        }

        return $otp;
    }

    /**
     * Verify submitted 6-digit OTP code.
     */
    public function verifyOtp(?string $otp): bool
    {
        if (empty($otp)) return false;

        if ($this->otp_code && $this->otp_code === trim($otp) && $this->otp_expires_at && now()->lessThanOrEqualTo($this->otp_expires_at)) {
            $this->forceFill([
                'otp_code' => null,
                'otp_expires_at' => null,
            ])->save();

            return true;
        }
        return false;
    }

    /**
     * Check if request has valid 30-day trusted device cookie for this user.
     */
    public function isTrustedDevice(\Illuminate\Http\Request $request): bool
    {
        $cookieName = 'trusted_device_' . $this->user_id;
        $cookieToken = $request->cookie($cookieName);
        
        if (empty($cookieToken)) {
            return false;
        }

        $expectedHash = hash_hmac('sha256', $this->user_id . '|' . $this->email, config('app.key'));
        return hash_equals($expectedHash, $cookieToken);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [];
    }
}
