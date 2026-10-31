<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LaporBanjir') - BPBD Kabupaten Bandung</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; background: #f1f5f9; color: #1e293b; display: flex; flex-direction: column; min-height: 100vh; }
        header { background: #0b4f8a; color: #fff; padding: 16px 24px; }
        header h1 { margin: 0; font-size: 22px; }
        nav { background: #083b69; padding: 0 24px; }
        nav a { display: inline-block; color: #cfe3f7; text-decoration: none; padding: 12px 16px; }
        nav a:hover, nav a.active { background: #0b4f8a; color: #fff; }
        main { flex: 1; width: 100%; max-width: 900px; margin: 24px auto; padding: 0 16px; }
        footer { background: #0f172a; color: #94a3b8; text-align: center; padding: 14px; font-size: 14px; }
        .box { background: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,.1); }
        label { display: block; margin: 12px 0 4px; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 9px; border: 1px solid #cbd5e1; border-radius: 6px; font: inherit; }
        textarea { min-height: 100px; resize: vertical; }
        .error { color: #b91c1c; font-size: 13px; margin-top: 4px; }
        .btn { margin-top: 16px; background: #0b4f8a; color: #fff; border: 0; padding: 10px 20px; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; }
        .alert { padding: 12px 16px; border-radius: 6px; margin-bottom: 16px; }
        .alert-success { background: #dcfce7; color: #166534; border: 1px solid #86efac; }
        .alert-info { background: #dbeafe; color: #1e40af; border: 1px solid #93c5fd; }
        .table-wrap { overflow-x: auto; background: #fff; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,.1); }
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #e2e8f0; vertical-align: middle; }
        .thumbnail { width: 76px; height: 58px; object-fit: cover; border-radius: 4px; }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 999px; color: #fff; font-size: 13px; font-weight: bold; background: #64748b; }
        .badge.diproses { background: #f97316; }
        .badge.selesai { background: #16a34a; }
        .actions { white-space: nowrap; }
        .pagination { display: flex; gap: 8px; list-style: none; padding: 0; margin-top: 16px; }
        .pagination a, .pagination span { display: inline-block; padding: 6px 10px; background: #fff; border-radius: 4px; text-decoration: none; color: #0b4f8a; }
        table.detail td { padding: 6px 12px 6px 0; }
        nav{display:flex}nav form{display:flex;margin:0}nav button{background:none;border:0;color:#cfe3f7;padding:12px 16px;cursor:pointer;font:inherit}nav button:hover{background:#0b4f8a;color:#fff}
    </style>
</head>
<body>
    <header>
        <h1>LaporBanjir</h1>
        <small>Sistem Pelaporan Banjir - BPBD Kabupaten Bandung</small>
    </header>

<nav>
    <a href="{{ route('laporan.create') }}" class="{{ request()->routeIs('laporan.create', 'laporan.store') ? 'active' : '' }}">Form Pelaporan</a>

    @guest
        <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
        <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active' : '' }}">Register</a>
    @endguest

    @auth
        <a href="{{ route('laporan.index') }}" class="{{ request()->routeIs('laporan.index') ? 'active' : '' }}">Daftar Laporan</a>
        <a href="{{ route('profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}">Profil Petugas</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endauth
</nav>

    <main>
        @if (session('success'))
            <x-alert type="success">{{ session('success') }}</x-alert>
        @endif
        @if (session('status'))
            <x-alert type="info">{{ session('status') }}</x-alert>
        @endif
        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} BPBD Kabupaten Bandung - LaporBanjir (Prototipe)
    </footer>
</body>
</html>