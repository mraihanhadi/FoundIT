@extends('admin.partials.layoutAdmin')

@section('title', 'Profile')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/user/profile.css') }}">
@endpush

@section('content')

<div class="main-layout">

  <aside class="sidebar-icons">
    <a href="{{ route('admin.beranda') }}" class="sidebar-icon-btn" title="Beranda">
      <svg viewBox="0 0 24 24">
        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
      </svg>
    </a>
    <a href="{{ route('admin.verifikasi') }}" class="sidebar-icon-btn" title="Verifikasi Penemuan">
      <svg viewBox="0 0 24 24">
        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
      </svg>
    </a>
    <a href="{{ route('admin.verifikasi.status') }}" class="sidebar-icon-btn" title="Verifikasi Status">
      <svg viewBox="0 0 24 24">
        <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/>
      </svg>
    </a>
    <a href="{{ route('admin.profil') }}" class="sidebar-icon-btn active" title="Profil">
      <svg viewBox="0 0 24 24">
        <path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.09.63-.09.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6z"/>
      </svg>
    </a>
    <a href="{{ route('logout') }}" class="sidebar-icon-btn danger" title="Logout">
      <svg viewBox="0 0 24 24">
        <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
      </svg>
    </a>
  </aside>

  <main class="page-content">

    <div class="page-title-bar">
      <h1>Profile</h1>
    </div>

    <div class="profile-card">

      {{-- foto --}}
      <div class="profile-photo-section">
        <div class="profile-photo-wrapper">
          <img
            src="{{ $user->foto ? asset('storage/' . $user->foto) : 'https://ui-avatars.com/api/?name='.urlencode($user->name ?? 'Admin').'&background=5b8dee&color=fff&size=220' }}"
            alt="{{ $user->name ?? 'Admin' }}"
            onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'Admin') }}&background=5b8dee&color=fff&size=220'"
          >
        </div>
        <span class="profile-role">Admin</span>
      </div>

      {{-- info --}}
      <div class="profile-fields">

        <div class="field-group">
          <label class="field-label">Nama</label>
          <input class="field-input" type="text" value="{{ $user->name ?? '' }}" readonly>
        </div>

        <div class="field-group">
          <label class="field-label">Username</label>
          <input class="field-input" type="text" value="{{ $user->username ?? '' }}" readonly>
        </div>

        <div class="field-group">
          <label class="field-label">Email</label>
          <input class="field-input" type="email" value="{{ $user->email ?? '' }}" readonly>
        </div>

        <div class="field-group">
          <label class="field-label">No Telp</label>
          <input class="field-input" type="text" value="{{ $user->no_telp ?? '-' }}" readonly>
        </div>

        <div class="profile-actions">
          <a href="{{ route('admin.edit.profil') }}" class="btn-edit">Edit</a>
        </div>

      </div>
    </div>

  </main>
</div>

@endsection