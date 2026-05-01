<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register — Toko Cokomi & Wowo</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background-color: #0d1117; font-family: 'Figtree', sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 24px 0; }
        .card { background: #111827; border: 1px solid #1e2d40; border-radius: 16px; padding: 40px; width: 100%; max-width: 420px; }
        .input-dark { background: #1a2332; border: 1px solid #1e2d40; color: #e2e8f0; border-radius: 8px; padding: 11px 14px; width: 100%; font-size: 0.9rem; font-family: inherit; }
        .input-dark:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 0 2px #2563eb33; }
        .btn-primary { background: #2563eb; color: white; border: none; border-radius: 8px; padding: 12px; width: 100%; font-size: 0.95rem; font-weight: 700; cursor: pointer; font-family: inherit; transition: background 0.2s; }
        .btn-primary:hover { background: #1d4ed8; }
        .btn-secondary { background: transparent; color: #60a5fa; border: 1px solid #2563eb; border-radius: 8px; padding: 12px; width: 100%; font-size: 0.95rem; font-weight: 700; cursor: pointer; font-family: inherit; transition: all 0.2s; text-decoration: none; display: block; text-align: center; }
        .btn-secondary:hover { background: #1e3a5f; }
        label { color: #94a3b8; font-size: 0.82rem; font-weight: 600; display: block; margin-bottom: 6px; }
        .error { color: #f87171; font-size: 0.78rem; margin-top: 4px; }
        .divider { border: none; border-top: 1px solid #1e2d40; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="card">
        <div style="text-align:center;margin-bottom:28px;">
            <div style="background:#1e3a5f;border-radius:12px;padding:14px;display:inline-block;font-size:2rem;margin-bottom:14px;">🏪</div>
            <h1 style="color:white;font-size:1.3rem;font-weight:800;">Daftar Akun Baru</h1>
            <p style="color:#64748b;font-size:0.82rem;margin-top:4px;">Toko Cokomi & Wowo — Sistem Inventari</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div style="margin-bottom:16px;">
                <label>👤 Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                       class="input-dark" placeholder="Nama kamu">
                @error('name')<p class="error">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom:16px;">
                <label>📧 Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="input-dark" placeholder="email@contoh.com">
                @error('email')<p class="error">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom:16px;">
                <label>🔒 Password</label>
                <input type="password" name="password" required class="input-dark" placeholder="Min. 8 karakter">
                @error('password')<p class="error">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom:24px;">
                <label>🔒 Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="input-dark" placeholder="Ulangi password">
            </div>

            <button type="submit" class="btn-primary">✅ Daftar Sekarang</button>

            <hr class="divider">

            <div style="text-align:center;margin-bottom:12px;">
                <span style="color:#64748b;font-size:0.82rem;">Sudah punya akun?</span>
            </div>
            <a href="{{ route('login') }}" class="btn-secondary">🔑 Masuk ke Akun</a>
        </form>
    </div>
</body>
</html>