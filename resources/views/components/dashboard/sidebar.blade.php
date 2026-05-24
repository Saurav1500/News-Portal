<button class="mobile-menu-btn" id="mobileMenuBtn">
    <i class="fas fa-bars"></i>
</button>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <button class="toggle-btn" id="toggleBtn">
            <i class="fas fa-chevron-left"></i>
        </button>
        <span class="logo-text">News AI</span>
    </div>

    <div class="sidebar-user">
        <div class="user-avatar">
            {{ substr(auth()->user()->name, 0, 1) }}
        </div>
        <div class="user-info">
            <span class="user-name">{{ auth()->user()->name }}</span>
            <span class="user-role">{{ auth()->user()->role?->name ?? 'प्रयोगकर्ता' }}</span>
        </div>
    </div>

    <nav class="sidebar-nav">
        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="{{ route('dashboard') }}" class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="fas fa-chart-pie"></i></span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('dashboard.news.create') }}" class="menu-link {{ request()->routeIs('dashboard.news.create') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="fas fa-plus-circle"></i></span>
                    <span class="menu-text">नयाँ समाचार</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('dashboard.news.list') }}" class="menu-link {{ request()->routeIs('dashboard.news.*') && !request()->routeIs('dashboard.news.create') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="fas fa-newspaper"></i></span>
                    <span class="menu-text">समाचार व्यवस्थापन</span>
                    <span class="menu-badge">{{\App\Models\News::count()}}</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('dashboard.categories.index') }}" class="menu-link {{ request()->routeIs('dashboard.categories.*') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="fas fa-folder"></i></span>
                    <span class="menu-text">श्रेणीहरू</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('dashboard.tags.index') }}" class="menu-link {{ request()->routeIs('dashboard.tags.*') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="fas fa-tags"></i></span>
                    <span class="menu-text">ट्यागहरू</span>
                </a>
            </li>
            @if(auth()->user()->hasPermission('sources.manage'))
            <li class="menu-item">
                <a href="{{ route('dashboard.crawl-sources.index') }}" class="menu-link {{ request()->routeIs('dashboard.crawl-sources.*') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="fas fa-cloud-download-alt"></i></span>
                    <span class="menu-text">क्रल स्रोतहरू</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->hasPermission('users.manage'))
            <li class="menu-item">
                <a href="{{ route('dashboard.users.index') }}" class="menu-link {{ request()->routeIs('dashboard.users.*') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="fas fa-users"></i></span>
                    <span class="menu-text">प्रयोगकर्ताहरू</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->hasPermission('roles.manage'))
            <li class="menu-item">
                <a href="{{ route('dashboard.roles.index') }}" class="menu-link {{ request()->routeIs('dashboard.roles.*') ? 'active' : '' }}">
                    <span class="menu-icon"><i class="fas fa-shield-alt"></i></span>
                    <span class="menu-text">भूमिका र अनुमति</span>
                </a>
            </li>
            @endif
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-magic"></i></span>
                    <span class="menu-text">AI Generate</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="sidebar-footer">
        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="{{ route('home') }}" class="menu-link" target="_blank">
                    <span class="menu-icon"><i class="fas fa-external-link-alt"></i></span>
                    <span class="menu-text">साइट हेर्नुहोस्</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{ route('logout') }}" class="menu-link">
                    <span class="menu-icon"><i class="fas fa-sign-out-alt"></i></span>
                    <span class="menu-text">लग आउट</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<style>
.mobile-menu-btn { position: fixed; top: 16px; left: 16px; width: 44px; height: 44px; background: #CD2737; border: none; border-radius: 10px; cursor: pointer; display: none; align-items: center; justify-content: center; z-index: 1001; box-shadow: 0 4px 15px rgba(205, 39, 55, 0.4); color: white; font-size: 20px; }
.sidebar-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); display: none; opacity: 0; transition: opacity 0.3s; z-index: 999; }
.sidebar-overlay.active { display: block; opacity: 1; }
.sidebar { position: fixed; top: 0; left: 0; height: 100vh; width: 80px; background: #CD2737; transition: width 0.3s ease; overflow: hidden; z-index: 1000; display: flex; flex-direction: column; }
.sidebar.active { width: 280px; }
.sidebar-header { display: flex; align-items: center; padding: 20px; height: 72px; border-bottom: 1px solid rgba(255,255,255,0.15); flex-shrink: 0; }
.toggle-btn { min-width: 40px; height: 40px; background: rgba(255,255,255,0.15); border: none; border-radius: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.85); transition: all 0.3s; font-size: 16px; }
.toggle-btn:hover { background: rgba(255,255,255,0.25); color: white; }
.logo-text { margin-left: 16px; font-size: 22px; font-weight: 700; color: white; white-space: nowrap; opacity: 0; transition: opacity 0.3s; }
.sidebar.active .logo-text { opacity: 1; }
.sidebar-user { display: flex; align-items: center; padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.15); flex-shrink: 0; gap: 12px; }
.user-avatar { min-width: 42px; height: 42px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 18px; flex-shrink: 0; }
.user-info { display: flex; flex-direction: column; opacity: 0; transition: opacity 0.3s; overflow: hidden; }
.sidebar.active .user-info { opacity: 1; }
.user-name { font-size: 15px; font-weight: 600; color: white; white-space: nowrap; }
.user-role { font-size: 12px; color: rgba(255,255,255,0.75); }
.sidebar-nav { flex: 1; overflow-y: auto; padding: 12px 0; }
.sidebar-nav::-webkit-scrollbar { width: 3px; }
.sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.3); border-radius: 3px; }
.sidebar-menu { list-style: none; }
.menu-item { padding: 2px 12px; }
.menu-link { display: flex; align-items: center; padding: 12px 12px; color: rgba(255,255,255,0.8); text-decoration: none; border-radius: 10px; transition: all 0.25s; gap: 0; position: relative; }
.menu-link:hover { background: rgba(255,255,255,0.12); color: white; }
.menu-link.active { background: rgba(255,255,255,0.2); color: white; }
.menu-icon { min-width: 40px; display: flex; align-items: center; justify-content: center; font-size: 18px; }
.menu-text { margin-left: 12px; font-size: 14px; font-weight: 500; white-space: nowrap; opacity: 0; transition: opacity 0.3s; }
.sidebar.active .menu-text { opacity: 1; }
.menu-badge { margin-left: auto; background: rgba(255,255,255,0.2); color: white; padding: 2px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; opacity: 0; transition: opacity 0.3s; }
.sidebar.active .menu-badge { opacity: 1; }
.sidebar-footer { border-top: 1px solid rgba(255,255,255,0.15); padding: 12px 0; flex-shrink: 0; }
@media (max-width: 768px) {
    .sidebar { width: 0; transform: translateX(-100%); }
    .sidebar.active { width: 280px; transform: translateX(0); }
    .logo-text, .user-info, .menu-text, .menu-badge { opacity: 1; }
}
</style>
