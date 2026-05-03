@extends('admin.partials.layoutAdmin')

@section('title', 'Edit Profile')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/user/profile.css') }}">
  <link rel="stylesheet" href="{{ asset('css/user/editprofile.css') }}">
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
      <h1>Edit Profile</h1>
    </div>

    <div class="editprofile-card">

      {{-- foto profil --}}
      <div class="editprofile-photo-section">
        <label for="fotoInput">
          <div class="editprofile-photo-wrapper" title="Klik untuk ganti foto">
            <img
              id="previewFoto"
              src="{{ asset('gambar/' . ($user->foto ?? 'default.jpg')) }}"
              alt="{{ $user->nama ?? 'Admin' }}"
              onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->nama ?? 'Admin') }}&background=5b8dee&color=fff&size=220'"
            >
            <div class="photo-overlay">
              <span class="photo-overlay-text">Ganti<br>Foto</span>
            </div>
          </div>
        </label>
        <input type="file" id="fotoInput" name="foto" accept="image/*"
          style="display:none" onchange="previewPhoto(event)">
        <span class="editprofile-role">Admin</span>
      </div>

      {{-- form --}}
      <div class="editprofile-fields">

        <form method="POST" action="{{ route('admin.update.profil') }}"
          enctype="multipart/form-data" id="editProfileForm">
          @csrf
          @method('PUT')

          <input type="hidden" name="foto_hidden" id="fotoHidden">

          <div class="field-group">
            <label class="field-label" for="nama">Nama</label>
            <input class="field-input-edit" type="text" id="nama" name="nama"
              value="{{ old('nama', $user->nama ?? '') }}"
              placeholder="Masukkan nama" required>
          </div>

          <div class="field-group">
            <label class="field-label" for="username">Username</label>
            <input class="field-input-edit" type="text" id="username" name="username"
              value="{{ old('username', $user->username ?? '') }}"
              placeholder="Masukkan username" required>
          </div>

          <div class="field-group">
            <label class="field-label" for="email">Email</label>
            <input class="field-input-edit" type="email" id="email" name="email"
              value="{{ old('email', $user->email ?? '') }}"
              placeholder="Masukkan email" required>
          </div>

          <div class="field-group">
            <label class="field-label" for="no_telp">No Telp</label>
            <input class="field-input-edit" type="text" id="no_telp" name="no_telp"
              value="{{ old('no_telp', $user->no_telp ?? '') }}"
              placeholder="Masukkan nomor telepon">
          </div>

          <div class="field-group">
            <label class="field-label">Ubah Password</label>
            <div class="password-row">
              <input class="field-input-edit" type="password" name="password" id="password"
                placeholder="Password baru" autocomplete="new-password">
              <input class="field-input-edit" type="password" name="password_confirmation" id="password_confirmation"
                placeholder="Konfirmasi password" autocomplete="new-password">
            </div>
            @error('password')
              <span style="color:#e05a3a;font-size:12px;">{{ $message }}</span>
            @enderror
          </div>

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
  var file = event.target.files[0];
  if (!file) return;

  var reader = new FileReader();
  reader.onload = function(e) {
    document.getElementById('previewFoto').src = e.target.result;
  };
  reader.readAsDataURL(file);
}

// validasi password sebelum submit
document.getElementById('editProfileForm').addEventListener('submit', function(e) {
  var pw  = document.getElementById('password').value;
  var cpw = document.getElementById('password_confirmation').value;

  if (pw && pw !== cpw) {
    e.preventDefault();
    alert('Password dan Konfirmasi Password tidak cocok!');
    document.getElementById('password_confirmation').focus();
  }
});
</script>
@endpush

@endsection