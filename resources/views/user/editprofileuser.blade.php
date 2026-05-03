<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoundIT – Beranda</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  @vite(['resources/css/main.css', 'resources/css/user/beranda.css'])
</head>
<body>

@include('user.partials.layout', ['active' => 'beranda']){{-- resources/views/user/editprofileuser.blade.php --}}
@extends('user.partials.layout')

@section('title', 'Edit Profile')

@push('styles')
 <link rel="stylesheet" href="{{ asset('css/user/profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/user/editprofile.css') }}">
@endpush

@section('content')

<div class="main-layout">

  {{-- SIDEBAR ICONS (desktop) --}}
  <aside class="sidebar-icons">
    <a href="{{ route('user.beranda') }}" class="sidebar-icon-btn {{ ($active??'')==='beranda' ? 'active' : '' }}" title="Beranda">
      <svg viewBox="0 0 24 24">
        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
      </svg>
    </a>
    <a href="{{ route('user.tambah.posting') }}" class="sidebar-icon-btn {{ in_array($active??'',['tambah-posting','riwayat-posting']) ? 'active' : '' }}" title="Tambah Postingan">
      <svg viewBox="0 0 24 24">
        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
    </a>
    </a>
    <a href="{{ route('user.notifikasi') }}" class="sidebar-icon-btn {{ ($active??'')==='notifikasi' ? 'active' : '' }}" title="Notifikasi">
      <svg viewBox="0 0 24 24">
        <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
      </svg>
    </a>
    <a href="{{ route('user.profil') }}" class="sidebar-icon-btn active" title="Profil">
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

  {{-- MAIN CONTENT --}}
  <main class="page-content">

    {{-- Page Title --}}
    <div class="page-title-bar">
      <h1>Edit Profile</h1>
    </div>

    {{-- Edit Profile Card --}}
    <div class="editprofile-card">

      {{-- Photo Section --}}
      <div class="editprofile-photo-section">
        <label for="fotoInput">
          <div class="editprofile-photo-wrapper" title="Klik untuk ganti foto">
            <img
              id="previewFoto"
              src="{{ $user->foto ? asset('storage/' . $user->foto) : 'https://ui-avatars.com/api/?name='.urlencode($user->name ?? 'User').'&background=5b8dee&color=fff&size=220' }}"
              alt="{{ $user->name ?? 'User' }}"
              onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'User') }}&background=5b8dee&color=fff&size=220'"
            >
            <div class="photo-overlay">
              <span class="photo-overlay-text">Ganti<br>Foto</span>
            </div>
          </div>
        </label>
        <input type="file" id="fotoInput" name="foto" accept="image/*" style="display:none" onchange="previewPhoto(event)">
        <span class="editprofile-role">Pengguna</span>
      </div>

      {{-- Form Fields --}}
      <div class="editprofile-fields">

        <form method="POST" action="{{ route('user.update.profil') }}" enctype="multipart/form-data" id="editProfileForm">
          @csrf
          @method('PUT')

          {{-- Hidden foto field --}}
          <input type="hidden" name="foto_hidden" id="fotoHidden">

          <div class="field-group">
            <label class="field-label" for="name">Nama</label>
            <input
              class="field-input-edit @error('name') border-red @enderror"
              type="text"
              id="name"
              name="name"
              value="{{ old('name', $user->name ?? '') }}"
              placeholder="Masukkan nama"
              required
            >
            @error('name')
              <span style="color:#e05a3a;font-size:12px;">{{ $message }}</span>
            @enderror
          </div>

          <div class="field-group">
            <label class="field-label" for="username">Username</label>
            <input
              class="field-input-edit @error('username') border-red @enderror"
              type="text"
              id="username"
              name="username"
              value="{{ old('username', $user->username ?? '') }}"
              placeholder="Masukkan username"
              required
            >
            @error('username')
              <span style="color:#e05a3a;font-size:12px;">{{ $message }}</span>
            @enderror
          </div>

          <div class="field-group">
            <label class="field-label" for="email">Email</label>
            <input
              class="field-input-edit @error('email') border-red @enderror"
              type="email"
              id="email"
              name="email"
              value="{{ old('email', $user->email ?? '') }}"
              placeholder="Masukkan email"
              required
            >
            @error('email')
              <span style="color:#e05a3a;font-size:12px;">{{ $message }}</span>
            @enderror
          </div>

          <div class="field-group">
            <label class="field-label" for="no_telp">No Telp</label>
            <input
              class="field-input-edit @error('no_telp') border-red @enderror"
              type="text"
              id="no_telp"
              name="no_telp"
              value="{{ old('no_telp', $user->no_telp ?? '') }}"
              placeholder="Masukkan nomor telepon"
            >
            @error('no_telp')
              <span style="color:#e05a3a;font-size:12px;">{{ $message }}</span>
            @enderror
          </div>

          <div class="field-group">
            <label class="field-label">Ubah Password</label>
            <div class="password-row">
              <input
                class="field-input-edit"
                type="password"
                name="password"
                id="password"
                placeholder="Ubah Password"
                autocomplete="new-password"
              >
              <input
                class="field-input-edit"
                type="password"
                name="password_confirmation"
                id="password_confirmation"
                placeholder="Konfirmasi Password"
                autocomplete="new-password"
              >
            </div>
            @error('password')
              <span style="color:#e05a3a;font-size:12px;">{{ $message }}</span>
            @enderror
          </div>

          {{-- Save Button --}}
          <div class="editprofile-actions">
            <button type="submit" class="btn-save">Save</button>
          </div>

        </form>
      </div>

    </div>

  </main>
</div>

@push('scripts')
<script>
function previewPhoto(event) {
  const file = event.target.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = function(e) {
    document.getElementById('previewFoto').src = e.target.result;
  };
  reader.readAsDataURL(file);
}

// Password match validation
document.getElementById('editProfileForm').addEventListener('submit', function(e) {
  const pw  = document.getElementById('password').value;
  const cpw = document.getElementById('password_confirmation').value;
  if (pw && pw !== cpw) {
    e.preventDefault();
    alert('Password dan Konfirmasi Password tidak cocok!');
    document.getElementById('password_confirmation').focus();
  }
});
</script>
@endpush

@endsection