<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi OTP - TRPL A Pagi</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .email-container {
            max-width: 560px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            border: 1px solid #e2e8f0;
        }
        .email-header {
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
            padding: 32px 24px;
            text-align: center;
            color: #ffffff;
        }
        .email-header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .email-header p {
            margin: 6px 0 0 0;
            font-size: 12px;
            opacity: 0.85;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .email-body {
            padding: 32px 28px;
        }
        .greeting {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 12px;
        }
        .message-text {
            font-size: 14px;
            color: #475569;
            margin-bottom: 24px;
        }
        .otp-box {
            background: #f0f6ff;
            border: 2px dashed #bfdbfe;
            border-radius: 14px;
            padding: 20px;
            text-align: center;
            margin: 24px 0;
        }
        .otp-code {
            font-size: 36px;
            font-weight: 900;
            letter-spacing: 8px;
            color: #1d4ed8;
            font-family: 'Courier New', Courier, monospace;
        }
        .otp-expiry {
            font-size: 12px;
            color: #64748b;
            margin-top: 8px;
            font-weight: 600;
        }
        .security-notice {
            background: #fffbeb;
            border-left: 4px solid #f59e0b;
            padding: 14px;
            border-radius: 8px;
            font-size: 12px;
            color: #92400e;
            margin-top: 24px;
        }
        .email-footer {
            background: #f8fafc;
            padding: 20px 24px;
            text-align: center;
            font-size: 11px;
            color: #94a3b8;
            border-top: 1px solid #f1f5f9;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>TRPL A PAGI</h1>
            <p>Keamanan Akun Administrator</p>
        </div>

        <div class="email-body">
            <div class="greeting">Halo, {{ $userName ?? 'Administrator' }}!</div>
            <div class="message-text">
                {{ $actionText ?? 'Sistem mendeteksi akses verifikasi perangkat baru atau perubahan sensitif pada akun Anda. Gunakan kode OTP 6-Digit di bawah ini untuk melanjutkan:' }}
            </div>

            <div class="otp-box">
                <div class="otp-code">{{ $otpCode }}</div>
                <div class="otp-expiry">⏱️ Kode OTP ini berlaku selama 10 Menit</div>
            </div>

            <div class="security-notice">
                🔒 <strong>Peringatan Keamanan:</strong> Jangan berikan kode OTP ini kepada siapa pun. Tim kami tidak akan pernah meminta kode verifikasi Anda.
            </div>
        </div>

        <div class="email-footer">
            Email ini dikirim secara otomatis oleh Sistem Keamanan Web TRPL A Pagi.<br>
            &copy; {{ date('Y') }} TRPL A Pagi - Polibatam. All rights reserved.
        </div>
    </div>
</body>
</html>
