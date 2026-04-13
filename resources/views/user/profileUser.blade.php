@extends('user.partials.layout')

@section('title', 'Profile')

@push('styles')
  @vite(['resources/css/main.css', 'resources/css/user/profile.css'])
@endpush

@section('content')

<div class="main-layout">

  {{-- SIDEBAR ICONS (desktop) --}}
  <aside class="sidebar-icons">
    <a href="{{ route('user.beranda') }}" class="sidebar-icon-btn {{ ($active??'')==='beranda' ? 'active' : '' }}" title="Beranda">
      <svg viewBox="0 0 24 24">
        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
    </a>
    <a href="{{ route('user.tambah.posting') }}" class="sidebar-icon-btn {{ in_array($active??'',['tambah-posting','riwayat-posting']) ? 'active' : '' }}" title="Tambah Postingan">
      <svg viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
    </a>
    <a href="{{ route('user.lapor.kehilangan') }}" class="sidebar-icon-btn {{ in_array($active??'',['lapor','riwayat-lapor']) ? 'active' : '' }}" title="Laporan Kehilangan">
      <svg viewBox="0 0 24 24">
        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
    </a>
    <a href="{{ route('user.notifikasi') }}" class="sidebar-icon-btn {{ ($active??'')==='notifikasi' ? 'active' : '' }}" title="Notifikasi">
      <svg viewBox="0 0 24 24">
        <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/></svg>
    </a>
    <a href="{{ route('user.profil') }}" class="sidebar-icon-btn active" title="Profil">
      <svg viewBox="0 0 24 24">
        <path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.09.63-.09.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/></svg>
    </a>
    <a href="{{ route('logout') }}" class="sidebar-icon-btn danger" title="Logout">
      <svg viewBox="0 0 24 24">
        <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/></svg>
    </a>
  </aside>

  {{-- MAIN CONTENT --}}
  <main class="page-content">

    {{-- Page Title --}}
    <div class="page-title-bar">
      <h1>Profile</h1>
    </div>

    {{-- Profile Card --}}
    <div class="profile-card">

      {{-- Photo Section --}}
      <div class="profile-photo-section">
        <div class="profile-photo-wrapper">
          <img
            src="{{ asset('gambar/' . ($user->foto ?? 'default.jpg')) }}"
            alt="{{ $user->nama ?? 'User' }}"
            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->nama ?? 'user') }}&background=5b8dee&color=fff&size=220'"
          >
        </div>
        <span class="profile-role">Role User</span>
      </div>

      {{-- Fields Section --}}
      <div class="profile-fields">

        <div class="field-group">
          <label class="field-label">Nama</label>
          <input class="field-input" type="text" value="{{ $user->nama ?? 'Kevin Liu' }}" readonly>
        </div>

        <div class="field-group">
          <label class="field-label">Username</label>
          <input class="field-input" type="text" value="{{ $user->username ?? 'KevinKece22' }}" readonly>
        </div>

        <div class="field-group">
          <label class="field-label">Email</label>
          <input class="field-input" type="email" value="{{ $user->email ?? 'xxx@gmail.com' }}" readonly>
        </div>

        <div class="field-group">
          <label class="field-label">No Telp</label>
          <input class="field-input" type="text" value="{{ $user->no_telp ?? '0974ss' }}" readonly>
        </div>

        {{-- Edit Button --}}
        <div class="profile-actions">
          <a href="{{ route('user.edit.profil') }}" class="btn-edit">Edit</a>
        </div>

      </div>
    </div>

  </main>
</div>

@endsection