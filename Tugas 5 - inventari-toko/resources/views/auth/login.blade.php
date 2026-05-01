<<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — Toko Cokomi & Wowo</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background-color: #0d1117; font-family: 'Figtree', sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
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
        {{-- Logo & Title --}}
        <div style="text-align:center;margin-bottom:28px;">
            <div style="background:#1e3a5f;border-radius:12px;padding:14px;display:inline-block;font-size:2rem;margin-bottom:14px;">🏪</div>
            <h1 style="color:white;font-size:1.3rem;font-weight:800;">Toko Cokomi & Wowo</h1>
            <p style="color:#64748b;font-size:0.82rem;margin-top:4px;">Sistem Inventari Toko</p>
        </div>

        {{-- Session Status --}}
        @if (session('status'))
            <div style="background:#0f2a1a;border:1px solid #16a34a;color:#4ade80;padding:10px 14px;border-radius:8px;font-size:0.85rem;margin-bottom:16px;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div style="margin-bottom:16px;">
                <label>📧 Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="input-dark" placeholder="email@contoh.com">
                @error('email')<p class="error">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom:16px;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
                    <label style="margin-bottom:0;">🔒 Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           style="color:#60a5fa;font-size:0.78rem;text-decoration:none;">Lupa password?</a>
                    @endif
                </div>
                <input type="password" name="password" required class="input-dark" placeholder="••••••••">
                @error('password')<p class="error">{{ $message }}</p>@enderror
            </div>

            <div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;">
                <input type="checkbox" name="remember" id="remember"
                       style="width:16px;height:16px;accent-color:#2563eb;">
                <label for="remember" style="margin-bottom:0;color:#94a3b8;font-size:0.85rem;font-weight:400;">Ingat saya</label>
            </div>

            <button type="submit" class="btn-primary">🔑 Masuk</button>

            <hr class="divider">

            <div style="text-align:center;margin-bottom:12px;">
                <span style="color:#64748b;font-size:0.82rem;">Belum punya akun?</span>
            </div>
            <a href="{{ route('register') }}" class="btn-secondary">📝 Daftar Akun Baru</a>
        </form>
    </div>
</body>
</html>