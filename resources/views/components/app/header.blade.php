
    <header class="header">
      <div class="date-bar">
        <div class="container">
          <div class="date-info">
            <div class="contact-info">
              <span><i class="fas fa-phone-alt"></i> +977-1-4790176</span>
              <span class="contact-sep"></span>
              <span><i class="fas fa-envelope"></i> news@newsai.com</span>
            </div>
            <span class="info-sep"></span>
            <span id="current-date-bs"></span>
            <span id="current-date-ad"></span>
          </div>
          <div class="header-actions">
            <div class="lang-dropdown">
              <button class="lang-toggle" onclick="this.parentElement.classList.toggle('open')">
                <i class="fas fa-globe"></i>
                <span class="lang-code">{{ strtoupper(app()->getLocale()) }}</span>
                <i class="fas fa-chevron-down"></i>
              </button>
              <div class="lang-menu">
                <a href="{{ route('language.switch', ['locale' => 'ne']) }}" class="{{ app()->getLocale() === 'ne' ? 'active' : '' }}">
                  <span class="lang-label">नेपाली</span>
                  <span class="lang-code-sm">NE</span>
                </a>
                <a href="{{ route('language.switch', ['locale' => 'en']) }}" class="{{ app()->getLocale() === 'en' ? 'active' : '' }}">
                  <span class="lang-label">English</span>
                  <span class="lang-code-sm">EN</span>
                </a>
              </div>
            </div>
            <a href="{{ route('login') }}" class="login-btn">{{ __('site.header.login') }}</a>
            <a href="{{ route('register') }}" class="register-btn">{{ __('site.header.register') }}</a>
          </div>
        </div>
      </div>

      <!-- Main Navigation -->
      <nav class="main-nav">
        <div class="container">
          <div class="nav-brand">
            <img src="/Images/Logo.png" alt="NEWSai Logo" class="logo" />
            <h1>NEWSai</h1>
          </div>

          <ul class="nav-menu">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">{{ __('site.nav.home') }}</a></li>
            <li><a href="{{ route('news') }}" class="{{ request()->routeIs('news') ? 'active' : '' }}">{{ __('site.nav.news') }}</a></li>
            <li><a href="{{ route('business') }}" class="{{ request()->routeIs('business') ? 'active' : '' }}">{{ __('site.nav.business') }}</a></li>
            <li><a href="{{ route('life-style') }}" class="{{ request()->routeIs('life-style') ? 'active' : '' }}">{{ __('site.nav.life_style') }}</a></li>
            <li><a href="{{ route('entertainment') }}" class="{{ request()->routeIs('entertainment') ? 'active' : '' }}">{{ __('site.nav.entertainment') }}</a></li>
            <li><a href="{{ route('opinion') }}" class="{{ request()->routeIs('opinion') ? 'active' : '' }}">{{ __('site.nav.opinion') }}</a></li>
            <li><a href="{{ route('technology') }}" class="{{ request()->routeIs('technology') ? 'active' : '' }}">{{ __('site.nav.technology') }}</a></li>
            <li><a href="{{ route('sports') }}" class="{{ request()->routeIs('sports') ? 'active' : '' }}">{{ __('site.nav.sports') }}</a></li>
            <li><a href="{{ route('upload') }}" class="upload-link {{ request()->routeIs('upload') ? 'active' : '' }}">{{ __('site.nav.upload') }}</a></li>
          </ul>

          <div class="nav-toggle">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
      </nav>
    </header>