<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Minimarket</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root{
            --emerald-500:#10b981; --emerald-600:#059669; --emerald-700:#047857;
            --indigo-500:#6366f1;  --indigo-600:#4f46e5;  --indigo-700:#4338ca;
            --ink-900:#0f172a; --ink-700:#334155; --ink-500:#64748b;
            --glass:rgba(255,255,255,.55);
            --glass-brd:rgba(255,255,255,.65);
            --shadow:0 20px 60px -20px rgba(15,23,42,.25);
        }
        *{box-sizing:border-box}
        body{
            margin:0;
            font-family:'Plus Jakarta Sans',system-ui,sans-serif;
            color:var(--ink-900);
            background:
                radial-gradient(1200px 600px at -10% -20%, #d1fae5 0%, transparent 60%),
                radial-gradient(1000px 500px at 110% 10%, #e0e7ff 0%, transparent 55%),
                radial-gradient(900px 600px at 50% 120%, #cffafe 0%, transparent 60%),
                linear-gradient(135deg,#f8fafc 0%,#f1f5f9 100%);
            background-attachment:fixed;
            min-height:100vh;
        }
        body::before, body::after{
            content:""; position:fixed; border-radius:50%; filter:blur(80px);
            opacity:.55; z-index:0; pointer-events:none;
        }
        body::before{width:380px;height:380px;background:linear-gradient(135deg,#34d399,#818cf8);top:-120px;left:-120px;animation:float 14s ease-in-out infinite}
        body::after{width:320px;height:320px;background:linear-gradient(135deg,#818cf8,#22d3ee);bottom:-120px;right:-100px;animation:float 18s ease-in-out infinite reverse}
        @keyframes float{0%,100%{transform:translate(0,0) scale(1)}50%{transform:translate(40px,-30px) scale(1.08)}}

        .app-shell{display:flex; gap:18px; padding:18px; min-height:100vh; position:relative; z-index:1}

        .sidebar{
            width:280px; flex-shrink:0;
            background:var(--glass);
            backdrop-filter:blur(22px) saturate(180%);
            -webkit-backdrop-filter:blur(22px) saturate(180%);
            border:1px solid var(--glass-brd);
            border-radius:22px; box-shadow:var(--shadow);
            padding:22px 16px;
            display:flex; flex-direction:column;
            position:sticky; top:18px;
            height:calc(100vh - 36px);
            overflow:hidden;
            transition:width .35s cubic-bezier(.4,0,.2,1), padding .35s;
        }
        .sidebar.collapsed{width:86px; padding:22px 10px}
        .sidebar.collapsed .label,
        .sidebar.collapsed .section-title,
        .sidebar.collapsed .brand-text,
        .sidebar.collapsed .profile-info,
        .sidebar.collapsed .logout-text{display:none}
        .sidebar.collapsed .nav-link{justify-content:center; padding:12px}
        .sidebar.collapsed .brand{justify-content:center}
        .sidebar.collapsed .profile-card{justify-content:center; padding:10px}

        .brand{display:flex; align-items:center; gap:12px; padding:4px 8px 18px; border-bottom:1px solid rgba(15,23,42,.08); margin-bottom:14px}
        .brand-logo{width:44px;height:44px;border-radius:14px;background:linear-gradient(135deg,var(--emerald-500),var(--indigo-600));display:grid;place-items:center;color:#fff;font-size:18px;box-shadow:0 8px 20px -8px rgba(16,185,129,.6);flex-shrink:0}
        .brand-text{line-height:1.1}
        .brand-text .title{font-weight:800; font-size:15px}
        .brand-text .subtitle{font-size:11px; color:var(--ink-500); font-weight:500}

        .section-title{text-transform:uppercase;font-size:10.5px;letter-spacing:1.2px;color:var(--ink-500);font-weight:700;padding:14px 14px 6px}

        .nav-list{flex:1; overflow-y:auto; padding:0 2px}
        .nav-list::-webkit-scrollbar{width:4px}
        .nav-list::-webkit-scrollbar-thumb{background:rgba(15,23,42,.15); border-radius:4px}

        .nav-link{
            display:flex; align-items:center; gap:12px;
            padding:11px 14px; border-radius:12px;
            color:var(--ink-700); font-weight:500; font-size:14px;
            text-decoration:none; margin:3px 0; position:relative;
            transition:background .25s, color .25s, transform .25s;
        }
        .nav-link .icon{width:22px;text-align:center;color:var(--ink-500);transition:color .25s, transform .3s}
        .nav-link:hover{background:rgba(255,255,255,.7);color:var(--ink-900);transform:translateX(3px)}
        .nav-link:hover .icon{color:var(--emerald-600);transform:scale(1.15)}
        .nav-link.active{background:linear-gradient(135deg, rgba(16,185,129,.18), rgba(99,102,241,.18));color:var(--ink-900);font-weight:600;box-shadow:inset 0 0 0 1px rgba(16,185,129,.25)}
        .nav-link.active .icon{color:var(--emerald-600)}
        .nav-link.active::before{content:"";position:absolute;left:-16px;top:50%;transform:translateY(-50%);width:4px;height:24px;border-radius:0 4px 4px 0;background:linear-gradient(180deg,var(--emerald-500),var(--indigo-500))}

        .profile-card{display:flex;align-items:center;gap:12px;padding:12px;margin-top:12px;border-radius:14px;background:linear-gradient(135deg, rgba(16,185,129,.10), rgba(99,102,241,.12));border:1px solid rgba(255,255,255,.7)}
        .avatar{width:40px;height:40px;border-radius:50%;background:linear-gradient(135deg,var(--emerald-500),var(--indigo-600));color:#fff;display:grid;place-items:center;font-weight:700;font-size:14px;flex-shrink:0;box-shadow:0 6px 14px -6px rgba(79,70,229,.5)}
        .profile-info{line-height:1.2; overflow:hidden}
        .profile-info .name{font-weight:700;font-size:13px;color:var(--ink-900);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .profile-info .role{display:inline-flex;align-items:center;gap:5px;margin-top:3px;font-size:10.5px;font-weight:600;color:var(--emerald-700);background:#ecfdf5;padding:2px 8px;border-radius:999px}
        .profile-info .role .dot{width:6px;height:6px;border-radius:50%;background:var(--emerald-500);box-shadow:0 0 0 3px rgba(16,185,129,.25)}

        .logout-btn{margin-top:10px;display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:11px 12px;border:none;border-radius:12px;background:linear-gradient(135deg,#fb7185,#ef4444);color:#fff;font-weight:600;font-size:13.5px;cursor:pointer;box-shadow:0 10px 20px -10px rgba(239,68,68,.6);transition:transform .2s, box-shadow .2s, filter .2s}
        .logout-btn:hover{transform:translateY(-2px);filter:brightness(1.05);box-shadow:0 14px 24px -10px rgba(239,68,68,.7)}

        .main{flex:1; min-width:0; display:flex; flex-direction:column; gap:18px}
        .topbar{background:var(--glass);backdrop-filter:blur(22px) saturate(180%);-webkit-backdrop-filter:blur(22px) saturate(180%);border:1px solid var(--glass-brd);border-radius:18px;box-shadow:var(--shadow);padding:14px 22px;display:flex;align-items:center;gap:14px}
        .toggle-btn{width:40px;height:40px;border-radius:12px;border:1px solid rgba(15,23,42,.08);background:rgba(255,255,255,.75);color:var(--ink-700);cursor:pointer;display:grid;place-items:center;transition:all .2s}
        .toggle-btn:hover{background:#fff;color:var(--emerald-600);transform:scale(1.05)}
        .topbar-title{font-weight:700;font-size:16px;color:var(--ink-900)}
        .topbar-title .muted{color:var(--ink-500);font-weight:500;font-size:13px}
        .topbar-spacer{flex:1}
        .badge-access{display:inline-flex;align-items:center;gap:8px;padding:7px 14px;border-radius:999px;background:linear-gradient(135deg, rgba(16,185,129,.12), rgba(99,102,241,.14));border:1px solid rgba(255,255,255,.7);color:var(--indigo-700);font-weight:600;font-size:12.5px}
        .badge-access i{color:var(--emerald-600)}

        .content-card{background:var(--glass);backdrop-filter:blur(22px) saturate(180%);-webkit-backdrop-filter:blur(22px) saturate(180%);border:1px solid var(--glass-brd);border-radius:22px;box-shadow:var(--shadow);padding:28px;min-height:60vh}

        @media (max-width: 992px){
            .app-shell{padding:12px; gap:12px}
            .sidebar{width:86px; padding:22px 10px}
            .sidebar .label,.sidebar .section-title,.sidebar .brand-text,.sidebar .profile-info,.sidebar .logout-text{display:none}
            .sidebar .nav-link{justify-content:center; padding:12px}
            .sidebar .brand{justify-content:center}
            .sidebar.expanded-mobile{width:260px; padding:22px 16px}
            .sidebar.expanded-mobile .label,.sidebar.expanded-mobile .section-title,.sidebar.expanded-mobile .brand-text,.sidebar.expanded-mobile .profile-info,.sidebar.expanded-mobile .logout-text{display:block}
            .sidebar.expanded-mobile .nav-link{justify-content:flex-start; padding:11px 14px}
        }

        .fade-in{opacity:0; transform:translateY(8px); animation:fadeIn .5s ease forwards}
        .fade-in.d1{animation-delay:.05s}
        .fade-in.d2{animation-delay:.12s}
        @keyframes fadeIn{to{opacity:1; transform:translateY(0)}}
    </style>
</head>
<body>

    <div class="app-shell">

        <aside class="sidebar fade-in" id="sidebar">

            <div class="brand">
                <div class="brand-logo"><i class="fas fa-store"></i></div>
                <div class="brand-text">
                    <div class="title">SISTEM INVENTARIS</div>
                    <div class="subtitle">Minimarket Manager</div>
                </div>
            </div>

            <div class="nav-list">

                <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    <span class="icon"><i class="fas fa-gauge-high"></i></span>
                    <span class="label">Dashboard</span>
                </a>

                @if(auth()->check() && auth()->user()->role == 'admin')
                    <div class="section-title">Master Data</div>

                    <a href="/kategori" class="nav-link {{ request()->is('kategori*') ? 'active' : '' }}">
                        <span class="icon"><i class="fas fa-tags"></i></span>
                        <span class="label">Kategori Barang</span>
                    </a>

                    <a href="/supplier" class="nav-link {{ request()->is('supplier*') ? 'active' : '' }}">
                        <span class="icon"><i class="fas fa-truck-fast"></i></span>
                        <span class="label">Supplier Utama</span>
                    </a>
                @endif

                <div class="section-title">Manajemen Inventaris</div>

                <a href="/barang" class="nav-link {{ request()->is('barang') ? 'active' : '' }}">
                    <span class="icon"><i class="fas fa-box-open"></i></span>
                    <span class="label">Katalog Barang</span>
                </a>

                <a href="/barang-masuk" class="nav-link {{ request()->is('barang-masuk*') ? 'active' : '' }}">
                    <span class="icon"><i class="fas fa-arrow-down"></i></span>
                    <span class="label">Barang Masuk</span>
                </a>

                <a href="/barang-keluar" class="nav-link {{ request()->is('barang-keluar*') ? 'active' : '' }}">
                    <span class="icon"><i class="fas fa-arrow-up"></i></span>
                    <span class="label">Transaksi Keluar</span>
                </a>

            </div>

            @if(auth()->check())
                <div class="profile-card">
                    <div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</div>
                    <div class="profile-info">
                        <div class="name">{{ auth()->user()->name ?? 'User' }}</div>
                        <span class="role">
                            <span class="dot"></span>
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="logout-text">Logout</span>
                    </button>
                </form>
            @endif

        </aside>

        <main class="main">

            <nav class="topbar fade-in d1">
                <button class="toggle-btn" id="toggleSidebar" aria-label="Toggle sidebar">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="topbar-title">
                    Panel Akses
                    <div class="muted">{{ auth()->check() ? ucfirst(auth()->user()->role) : 'Guest (Belum Login)' }}</div>
                </div>

                <div class="topbar-spacer"></div>

                <div class="badge-access">
                    <i class="fas fa-shield-halved"></i>
                    {{ auth()->check() ? ucfirst(auth()->user()->role) : 'Guest' }}
                </div>
            </nav>

            <section class="content-card fade-in d2">
                @yield('content')
            </section>

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function(){
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggleSidebar');

            if (localStorage.getItem('sidebar-collapsed') === '1') {
                sidebar.classList.add('collapsed');
            }
            toggleBtn && toggleBtn.addEventListener('click', function(){
                if (window.innerWidth <= 992) {
                    sidebar.classList.toggle('expanded-mobile');
                } else {
                    sidebar.classList.toggle('collapsed');
                    localStorage.setItem('sidebar-collapsed', sidebar.classList.contains('collapsed') ? '1' : '0');
                }
            });
            if (!document.querySelector('.nav-link.active')) {
                const path = window.location.pathname;
                document.querySelectorAll('.nav-link').forEach(a => {
                    if (a.getAttribute('href') === path) a.classList.add('active');
                });
            }
        })();
    </script>
</body>
</html>