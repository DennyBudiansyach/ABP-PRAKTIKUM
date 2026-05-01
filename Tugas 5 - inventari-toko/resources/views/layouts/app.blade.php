<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Inventari Toko') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background-color: #0d1117; color: #e2e8f0; font-family: 'Figtree', sans-serif; }
        .nav-dark { background-color: #0d1117; border-bottom: 1px solid #1e2d40; }
        .card-dark { background-color: #111827; border: 1px solid #1e2d40; border-radius: 12px; }
        .table-dark-head { background-color: #0a0f1e; color: #60a5fa; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.08em; }
        .table-row-dark { border-bottom: 1px solid #1e2d40; }
        .table-row-dark:hover { background-color: #1a2332; }
        .btn-primary { background-color: #2563eb; color: white; border-radius: 8px; padding: 6px 14px; font-size: 0.85rem; font-weight: 600; border: none; cursor: pointer; transition: background 0.2s; }
        .btn-primary:hover { background-color: #1d4ed8; }
        .btn-edit { background-color: #1e3a5f; color: #60a5fa; border: 1px solid #2563eb; border-radius: 8px; padding: 5px 10px; font-size: 0.8rem; cursor: pointer; transition: all 0.2s; }
        .btn-edit:hover { background-color: #2563eb; color: white; }
        .btn-delete { background-color: #3b1a1a; color: #f87171; border: 1px solid #dc2626; border-radius: 8px; padding: 5px 10px; font-size: 0.8rem; cursor: pointer; transition: all 0.2s; }
        .btn-delete:hover { background-color: #dc2626; color: white; }
        .badge { padding: 3px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 600; background-color: #1e3a5f; color: #60a5fa; border: 1px solid #2563eb33; }
        .input-dark { background-color: #1a2332; border: 1px solid #1e2d40; color: #e2e8f0; border-radius: 8px; padding: 10px 14px; width: 100%; font-size: 0.9rem; }
        .input-dark:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 0 2px #2563eb33; }
        .stat-card { background-color: #111827; border: 1px solid #1e2d40; border-radius: 14px; padding: 24px; text-align: center; }
        .nav-link-dark { color: #94a3b8; font-size: 0.9rem; font-weight: 500; padding: 6px 12px; border-radius: 8px; transition: all 0.2s; text-decoration: none; display: flex; align-items: center; gap: 6px; }
        .nav-link-dark:hover, .nav-link-dark.active { background-color: #1e2d40; color: #60a5fa; }
        .nav-link-dark.active { color: white; font-weight: 700; }
        select.input-dark option { background-color: #1a2332; }
    </style>
</head>
<body>
    <div class="min-h-screen">
        @include('layouts.navigation')
        @isset($header)
            <header style="background-color:#0a0f1e; border-bottom:1px solid #1e2d40; padding: 18px 0;">
                <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
                    {{ $header }}
                </div>
            </header>
        @endisset
        <main>{{ $slot }}</main>
    </div>
</body>
</html>