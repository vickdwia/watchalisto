<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Watchalisto</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logoup.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        /* ===== GLOBAL ===== */
        * { margin:0; padding:0; box-sizing:border-box; }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background:#0f172a;
            color:#fff;
        }

        /* ===== LAYOUT ===== */
        .admin-layout {
            display:flex;
            min-height:100vh;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width:240px;
            background:#020617;
            padding:24px 18px;
            display:flex;
            flex-direction:column;
            gap:10px;
            transition:transform .3s ease;
        }

        .sidebar h2 {
            color:#14b8a6;
            font-size:20px;
            text-align:center;
            margin-bottom:20px;
        }

        .sidebar a {
            color:#cbd5f5;
            text-decoration:none;
            padding:12px 14px;
            border-radius:8px;
            transition:.25s;
        }

        .sidebar a:hover {
            background:rgba(20,184,166,.15);
            color:#14b8a6;
        }

        .sidebar form {
            margin-top:auto;
        }

        .sidebar button {
            width:100%;
            background:#14b8a6;
            border:none;
            padding:12px;
            border-radius:8px;
            color:#fff;
            font-weight:600;
            cursor:pointer;
        }

        /* ===== MAIN ===== */
        .main-content {
            flex:1;
            padding:28px;
        }

        /* ===== MOBILE TOGGLE ===== */
        .sidebar-toggle {
            display:none;
            position:fixed;
            top:16px;
            left:16px;
            z-index:1100;
            background:#020617;
            border:1px solid rgba(255,255,255,.1);
            color:#14b8a6;
            font-size:22px;
            padding:6px 10px;
            border-radius:8px;
        }

        /* ===== STATS ===== */
        .stats-grid {
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(160px,1fr));
            gap:16px;
            margin-bottom:28px;
        }

        .stat-card {
            background:rgba(20,184,166,.1);
            padding:20px;
            border-radius:12px;
            text-align:center;
        }

        .stat-card h3 {
            color:#14b8a6;
            font-size:26px;
        }

        .stat-card p {
            font-size:14px;
            color:#cbd5f5;
        }

        /* ===== CARD ===== */
        .card {
            background:rgba(17,25,40,.7);
            padding:20px;
            border-radius:14px;
            margin-bottom:22px;
            box-shadow:0 10px 30px rgba(0,0,0,.35);
        }

        .card h2 {
            color:#14b8a6;
            margin-bottom:12px;
        }

        .recent-media ul { list-style:none; }

        .recent-media li {
            padding:8px 0;
            border-bottom:1px solid rgba(255,255,255,.08);
            display:flex;
            justify-content:space-between;
            font-size:14px;
        }

        .badge {
            background:#1e293b;
            color:#38bdf8;
            font-size:11px;
            padding:2px 8px;
            border-radius:6px;
        }

        /* ===== CHARTS LAYOUT ===== */
        .charts-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 22px;
            margin-bottom: 22px;
        }

        .chart-card {
            background: rgba(17,25,40,.7);
            padding: 20px;
            border-radius: 14px;
            box-shadow: 0 10px 30px rgba(0,0,0,.35);
        }

        .chart-card h2 {
            color: #14b8a6;
            margin-bottom: 16px;
            text-align: center;
        }

        .chart-wrapper {
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chart-wrapper canvas {
            max-width: 100%;
            max-height: 100%;
        }

        /* ===== MOBILE MODE ===== */
        @media (max-width: 992px) {
            .sidebar-toggle {
                display:block;
            }

            .sidebar {
                position:fixed;
                top:0;
                left:0;
                height:100%;
                transform:translateX(-100%);
                z-index:1050;
            }

            .sidebar.show {
                transform:translateX(0);
            }

            .main-content {
                padding-top:70px;
            }

            .charts-container {
                grid-template-columns: 1fr;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <button class="sidebar-toggle" id="sidebarToggle">☰</button>
    <div class="admin-layout">
        <aside class="sidebar" id="sidebar">
            <h2>Watchalisto</h2>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.media.admin') }}">Kelola Media</a>
            <a href="{{ route('admin.genre.index') }}">Kelola Genre</a>
            <a href="{{ route('admin.users.index') }}">Kelola User</a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button>Logout</button>
            </form>
        </aside>
        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <script>
        document.getElementById('sidebarToggle').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('show');
        });
    </script>
    @stack('scripts')
</body>
</html>