<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'FoundIT Admin')</title>
  @vite(['resources/css/main.css', 'resources/css/user/profile.css'])
  @stack('styles')
</head>
<body>

<!-- drawer overlay -->
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>

<!-- slide menu admin -->
<nav class="drawer" id="drawer">
  <div class="drawer-header">
    <img src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=7B9EFF&color=fff' }}" alt="{{ Auth::user()->name }}" class="drawer-avatar"
      onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=7B9EFF&color=fff'">
    <div>
      <div class="drawer-user-name">{{ Auth::user()->name }}</div>
      <div class="drawer-user-email">{{ Auth::user()->email }}</div>
    </div>
  </div>

  <div class="drawer-nav">

    <a class="nav-item {{ ($active??'')==='beranda' ? 'active' : '' }}"
      href="{{ route('admin.beranda') }}">
      <svg viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
      Beranda
    </a>

    <a class="nav-item {{ ($active??'')==='verifikasi' ? 'active' : '' }}"
      href="{{ route('admin.verifikasi') }}">
      <svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
      Verifikasi Penemuan
    </a>

    <a class="nav-item {{ ($active??'')==='Status' ? 'active' : '' }}"
      href="{{ route('admin.verifikasi.status') }}">
      <svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
      Verifikasi Status
    </a>

    <a class="nav-item {{ ($active??'')==='setting' ? 'active' : '' }}"
      href="{{ route('admin.profil') }}">
      <svg viewBox="0 0 24 24"><path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.09.63-.09.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/></svg>
      Setting
    </a>

  </div>

  <div class="drawer-footer">
    <a class="nav-item nav-danger" href="{{ route('logout') }}">
      <svg viewBox="0 0 24 24"><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
      Logout
    </a>
  </div>
</nav>

<!-- header -->
<header class="app-header">
  <button class="btn-hamburger" onclick="openDrawer()">
    <span></span><span></span><span></span>
  </button>

  <div class="header-logo">
    <img src="{{ asset('gambar/logo.png') }}" alt="FoundIT" onerror="this.style.display='none'">
    <span class="logo-text">foundIT <span style="font-size:0.65rem;font-weight:500;opacity:0.7;margin-left:2px;">ADMIN</span></span>
  </div>

  <div class="header-search">
    <span class="search-icon">
      <svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.47 6.47 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
    </span>
    <input type="text" id="searchInput" placeholder="Cari laporan, postingan..." autocomplete="off">
  </div>

  <div class="header-profile">
    <button class="profile-btn" onclick="toggleProfileDropdown()">
      <img src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=7B9EFF&color=fff' }}" alt="{{ Auth::user()->name }}" class="profile-avatar"
        onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=7B9EFF&color=fff'">
    </button>
    <div class="profile-dropdown" id="profileDropdown">
      <div class="dropdown-info">
        <div class="d-name">{{ Auth::user()->name }}</div>
        <div class="d-email">{{ Auth::user()->email }}</div>
      </div>
      <a class="dropdown-item" href="{{ route('admin.profil') }}">
        <svg viewBox="0 0 24 24"><path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.09.63-.09.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/></svg>
        Setting
      </a>
      <a class="dropdown-item danger" href="{{ route('logout') }}">
        <svg viewBox="0 0 24 24"><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
        Logout
      </a>
    </div>
  </div>
</header>

{{-- wrapper konten --}}
<div class="app-body">
  @yield('content')
</div>

<script>
function openDrawer() {
  document.getElementById('drawer').classList.add('show');
  document.getElementById('drawerOverlay').classList.add('show');
  document.body.style.overflow = 'hidden';
}
function closeDrawer() {
  document.getElementById('drawer').classList.remove('show');
  document.getElementById('drawerOverlay').classList.remove('show');
  document.body.style.overflow = '';
}
function toggleSub(id, btn) {
  var sub    = document.getElementById(id);
  var isOpen = sub.classList.contains('open');
  document.querySelectorAll('.nav-sub.open').forEach(function(s) { s.classList.remove('open'); });
  document.querySelectorAll('.nav-item.open').forEach(function(b) { b.classList.remove('open'); });
  if (!isOpen) { sub.classList.add('open'); btn.classList.add('open'); }
}
function toggleProfileDropdown() {
  document.getElementById('profileDropdown').classList.toggle('show');
}
document.addEventListener('click', function(e) {
  var dd  = document.getElementById('profileDropdown');
  var btn = document.querySelector('.profile-btn');
  if (dd && btn && !dd.contains(e.target) && !btn.contains(e.target))
    dd.classList.remove('show');
});
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') closeDrawer();
});
</script>

@stack('scripts')
</body>
</html>