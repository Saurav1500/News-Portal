<!doctype html>
<html lang="ne">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Noto Sans Devanagari', sans-serif;
            background: #f8f9fa;
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
        }

        .dashboard-body {
            display: flex;
            min-height: 100vh;
        }

        .main-content-area {
            flex: 1;
            margin-left: 80px;
            transition: margin-left 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .main-content-area.expanded {
            margin-left: 280px;
        }

        .page-content {
            flex: 1;
            padding: 0;
        }

        @media (max-width: 768px) {
            .main-content-area {
                margin-left: 0;
            }
            .main-content-area.expanded {
                margin-left: 0;
            }
        }

        /* Toast notification for session messages */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .toast {
            padding: 14px 20px;
            border-radius: 10px;
            color: white;
            font-size: 14px;
            font-weight: 500;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            animation: slideInRight 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .toast-success { background: #28a745; }
        .toast-error { background: #CD2737; }
        .toast-info { background: #17a2b8; }

        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #a1a1a1; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="dashboard-body">
        <x-dashboard.sidebar />

        <div class="main-content-area" id="mainContentArea">
            <x-dashboard.header />

            @if(session('success'))
                <div class="toast-container">
                    <div class="toast toast-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                </div>
                <script>
                    setTimeout(() => {
                        document.querySelector('.toast-container')?.remove();
                    }, 4000);
                </script>
            @endif

            @if(session('error'))
                <div class="toast-container">
                    <div class="toast toast-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                    </div>
                </div>
                <script>
                    setTimeout(() => {
                        document.querySelector('.toast-container')?.remove();
                    }, 4000);
                </script>
            @endif

            <main class="page-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
    <script>
        // Sidebar toggle
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleBtn');
        const mainContent = document.getElementById('mainContentArea');
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function handleResponsive() {
            const isMobile = window.innerWidth <= 768;
            if (isMobile) {
                toggleBtn.style.display = 'none';
                mobileMenuBtn.style.display = 'flex';
                if (!sidebar.classList.contains('active')) {
                    mobileMenuBtn.style.display = 'flex';
                }
                sidebar.classList.remove('active');
                mainContent.classList.remove('expanded');
                if (sidebarOverlay) sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            } else {
                toggleBtn.style.display = 'flex';
                mobileMenuBtn.style.display = 'none';
                const saved = localStorage.getItem('sidebarActive');
                if (saved === 'true') {
                    sidebar.classList.add('active');
                    mainContent.classList.add('expanded');
                }
            }
        }

        handleResponsive();
        window.addEventListener('resize', () => {
            clearTimeout(window._resizeTimer);
            window._resizeTimer = setTimeout(handleResponsive, 100);
        });

        if (toggleBtn) {
            toggleBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                sidebar.classList.toggle('active');
                mainContent.classList.toggle('expanded');
                localStorage.setItem('sidebarActive', sidebar.classList.contains('active'));
            });
        }

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                sidebar.classList.add('active');
                mainContent.classList.add('expanded');
                if (sidebarOverlay) sidebarOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
                mobileMenuBtn.style.display = 'none';
            });
        }

        function closeMobileSidebar() {
            sidebar.classList.remove('active');
            mainContent.classList.remove('expanded');
            if (sidebarOverlay) sidebarOverlay.classList.remove('active');
            document.body.style.overflow = '';
            if (window.innerWidth <= 768) {
                mobileMenuBtn.style.display = 'flex';
            }
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', closeMobileSidebar);
        }
    </script>
    @stack('scripts')
</body>
</html>
