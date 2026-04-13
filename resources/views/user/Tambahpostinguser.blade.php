@extends('user.partials.layout')

@section('title', 'Tambah Postingan')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/user/tambahposting.css') }}">
@endpush

@section('content')

<div class="main-layout">

  <aside class="sidebar-icons">
    <a href="{{ route('user.beranda') }}" class="sidebar-icon-btn" title="Beranda">
      <svg viewBox="0 0 24 24">
        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
      </svg>
    </a>
    <a href="{{ route('user.tambah.posting') }}" class="sidebar-icon-btn active" title="Tambah Postingan">
      <svg viewBox="0 0 24 24">
        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
      </svg>
    </a>
    <a href="{{ route('user.notifikasi') }}" class="sidebar-icon-btn" title="Notifikasi">
      <svg viewBox="0 0 24 24">
        <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
      </svg>
    </a>
    <a href="{{ route('user.profil') }}" class="sidebar-icon-btn" title="Profil">
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
      <h1>Tambah Postingan</h1>
    </div>

    <div class="form-card">
      <form action="{{ route('user.tambah.posting.post') }}" method="POST" enctype="multipart/form-data" id="formPosting">
        @csrf

        <div class="form-group">
          <label>Foto Barang</label>
          <div class="upload-area" id="uploadArea">
            <div class="upload-icon">
              <svg viewBox="0 0 24 24">
                <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
              </svg>
            </div>
            <div class="upload-text">
              <strong>Klik untuk upload</strong> atau drag & drop<br>
              <span>PNG, JPG, JPEG (maks. 5MB)</span>
            </div>
            <input type="file" name="foto" accept="image/*" onchange="previewImage(this)">
          </div>
          <img id="previewImg" class="preview-img" alt="Preview">
        </div>

        <div class="form-group">
          <label for="namaBarang">Nama Barang <span style="color:var(--lost)">*</span></label>
          <input type="text" id="namaBarang" name="nama_barang" class="form-control-custom"
            placeholder="Contoh: iPhone 13, Dompet hitam..." required>
        </div>

        <div class="form-group">
          <label for="deskripsi">Deskripsi Barang <span style="color:var(--lost)">*</span></label>
          <textarea id="deskripsi" name="deskripsi_barang" class="form-control-custom" rows="3"
            placeholder="Jelaskan ciri-ciri barang secara detail..."
            required style="resize:vertical;"></textarea>
        </div>

        <div class="form-group">
          <label for="lokasi">Lokasi Ditemukan/Hilang <span style="color:var(--lost)">*</span></label>
          <input type="text" id="lokasi" name="lokasi" class="form-control-custom"
            placeholder="Contoh: Kantin GKU, Parkir TULT..." required>
        </div>

        {{-- contact person, muncul kalau Found --}}
        <div class="form-group" id="contactGroup">
          <label for="contact">Contact Person <span style="color:var(--lost)">*</span></label>
          <input type="text" id="contact" name="contact_person" class="form-control-custom"
            placeholder="Nama : Nomor HP">
        </div>

        <div class="form-group">
          <label>Status Barang <span style="color:var(--lost)">*</span></label>
          <div class="status-toggle">
            <button type="button" class="status-btn found active" id="btnFound" onclick="setStatus('Found')">✓ Found</button>
            <button type="button" class="status-btn lost" id="btnLost" onclick="setStatus('Lost')">! Lost</button>
          </div>
          <input type="hidden" id="statusBarang" name="status" value="Found">
        </div>

        <div class="form-group">
          <label for="tanggal">Tanggal <span style="color:var(--lost)">*</span></label>
          <input type="date" id="tanggal" name="tanggal" class="form-control-custom" required>
        </div>

        {{-- janji temu, muncul kalau Found --}}
        <div class="form-group" id="janjiGroup">
          <label for="janjiTemu">📍 Janji Temu / Lokasi Pengambilan <span style="color:var(--lost)">*</span></label>
          <input type="text" id="janjiTemu" name="janji_temu" class="form-control-custom"
            placeholder="Contoh: Lobby GKU, Pos Satpam...">
        </div>

        <div class="form-actions">
          <button type="submit" class="btn-brand">
            <svg viewBox="0 0 24 24">
              <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
            </svg>
            Posting Sekarang
          </button>
          <button type="button" class="btn-outline-brand" onclick="resetForm()">Reset</button>
        </div>

      </form>
    </div>

  </main>
</div>

<div class="toast-notif" id="toast"></div>

@push('scripts')
<script>
// set tanggal hari ini otomatis
document.getElementById('tanggal').valueAsDate = new Date();

function previewImage(input) {
  var file = input.files[0];
  if (!file) return;

  var reader = new FileReader();
  reader.onload = function(e) {
    var img = document.getElementById('previewImg');
    img.src = e.target.result;
    img.classList.add('show');
  };
  reader.readAsDataURL(file);
}

function setStatus(status) {
  document.getElementById('statusBarang').value = status;

  if (status === 'Found') {
    document.getElementById('btnFound').classList.add('active');
    document.getElementById('btnLost').classList.remove('active');
    document.getElementById('contactGroup').style.display = 'block';
    document.getElementById('janjiGroup').style.display   = 'block';
  } else {
    document.getElementById('btnLost').classList.add('active');
    document.getElementById('btnFound').classList.remove('active');
    document.getElementById('contactGroup').style.display = 'none';
    document.getElementById('contact').value  = '';
    document.getElementById('janjiGroup').style.display = 'none';
    document.getElementById('janjiTemu').value = '';
  }
}

function resetForm() {
  document.getElementById('formPosting').reset();
  document.getElementById('previewImg').classList.remove('show');
  document.getElementById('statusBarang').value = 'Found';
  document.getElementById('tanggal').valueAsDate = new Date();
  setStatus('Found');
}

function showToast(msg, type) {
  if (!type) type = 'success';
  var t = document.getElementById('toast');
  t.textContent = msg;
  t.className = 'toast-notif show ' + type;
  setTimeout(function() { t.classList.remove('show'); }, 3000);
}



setStatus('Found');
</script>
@endpush

@endsection