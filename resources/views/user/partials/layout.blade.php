<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'FoundIT')</title>
  @vite(['resources/css/main.css', 'resources/css/user/profile.css', 'resources/css/user/tambahposting.css'])
  @stack('styles')
</head>
<body>

<!-- DRAWER OVERLAY -->
<div class="drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>

<!-- SLIDE MENU -->
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
       href="{{ route('user.beranda') }}">
      <svg viewBox="0 0 24 24"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
      Beranda
    </a>

    <button class="nav-item {{ in_array($active??'',['tambah-posting','riwayat-posting'])?'active open':'' }}"
            id="navPostingan" onclick="toggleSub('subPostingan',this)">
      <svg viewBox="0 0 24 24">
        <path d="M19 3H5c-1.1 0-2 .9-2 2v14l4-4h12c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c.55 0 1 .45 1 1v2h2c.55 0 1 .45 1 1s-.45 1-1 1h-2v2c0 .55-.45 1-1 1s-1-.45-1-1v-2H9c-.55 0-1-.45-1-1s.45-1 1-1h2V7c0-.55.45-1 1-1z"/></svg>
      Tambah Postingan
      <span class="chevron"><svg viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg></span>
    </button>
    <div class="nav-sub {{ in_array($active??'',['tambah-posting','riwayat-posting'])?'open':'' }}" id="subPostingan">
      <a class="nav-sub-item" href="{{ route('user.tambah.posting') }}">Tambah Postingan</a>
      <a class="nav-sub-item" href="{{ route('user.riwayat.posting') }}">Riwayat Postingan</a>
    </div>

    <button class="nav-item {{ ($active??'')==='notifikasi'?'active open':'' }}"
            id="navNotifikasi" onclick="toggleSub('subNotifikasi',this)">
      <svg viewBox="0 0 24 24">
        <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
      </svg>
      Notifikasi
      <span class="chevron"><svg viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg></span>
    </button>
    <div class="nav-sub {{ ($active??'')==='notifikasi'?'open':'' }}" id="subNotifikasi">
      <a class="nav-sub-item" href="{{ route('user.notifikasi') }}">Laporan Penemuan Barang</a>
    </div>

    <a class="nav-item {{ ($active??'')==='profil'?'active':'' }}" href="{{ route('user.profil') }}">
      <svg viewBox="0 0 24 24">
        <path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.09.63-.09.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/></svg>
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

<!-- HEADER -->
<header class="app-header">
  <button class="btn-hamburger" onclick="openDrawer()">
    <span></span><span></span><span></span>
  </button>

  <div class="header-logo">
    <img src="{{ asset('gambar/logo.png') }}" alt="FoundIT" onerror="this.style.display='none'">
    <span class="logo-text">foundIT</span>
  </div>

  <div class="header-search">
    <span class="search-icon">
      <svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.47 6.47 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
    </span>
    <input type="text" id="searchInput" placeholder="Cari barang hilang..." autocomplete="off">
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
      <a class="dropdown-item" href="{{ route('user.profil') }}">
        <svg viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
        Profil Saya
      </a>
      <a class="dropdown-item danger" href="{{ route('logout') }}">
        <svg viewBox="0 0 24 24"><path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
        Logout
      </a>
    </div>
  </div>
</header>

<!-- PAGE CONTENT -->
@yield('content')

<!-- SHARED JS -->
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
  const sub = document.getElementById(id);
  const isOpen = sub.classList.contains('open');
  document.querySelectorAll('.nav-sub.open').forEach(s => s.classList.remove('open'));
  document.querySelectorAll('.nav-item.open').forEach(b => b.classList.remove('open'));
  if (!isOpen) { sub.classList.add('open'); btn.classList.add('open'); }
}
function toggleProfileDropdown() {
  document.getElementById('profileDropdown').classList.toggle('show');
}
document.addEventListener('click', function(e) {
  const dd  = document.getElementById('profileDropdown');
  const btn = document.querySelector('.profile-btn');
  if (dd && btn && !dd.contains(e.target) && !btn.contains(e.target))
    dd.classList.remove('show');
});
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeDrawer();
    if (typeof closePopup === 'function') closePopup();
  }
});
</script>

@stack('scripts')

</body>
</html>