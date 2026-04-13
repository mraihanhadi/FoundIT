@extends('user.partials.layout')

@section('title', 'Riwayat Postingan')

@push('styles')
  @vite(['resources/css/main.css', 'resources/css/user/riwayatposting.css'])
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

    {{-- kalau belum ada postingan --}}
    <div class="empty-state" id="emptyState" style="display:none;">
      <svg viewBox="0 0 24 24">
        <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
      </svg>
      <p>Belum ada postingan</p>
      <a href="{{ route('user.tambah.posting') }}" class="btn-tambah">+ Tambah Postingan</a>
    </div>

    <div class="item-grid" id="itemGrid"></div>

  </main>
</div>

{{-- popup detail --}}
<div class="popup-overlay" id="popupOverlay" onclick="handleOverlayClick(event)">
  <div class="popup-card">

    <div class="popup-header">
      <button class="btn-back" onclick="closePopup()">
        <svg viewBox="0 0 24 24">
          <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
        </svg>
      </button>
      <span class="popup-username">Postingan Saya</span>
    </div>

    <img id="popupItemImg" src="" alt="Foto" class="popup-item-img"
      onerror="this.src='https://placehold.co/600x450/EEF3FF/7B9EFF?text=Foto+Barang'">

    <div class="popup-fields">
      <div class="popup-field">
        <label>Nama Barang</label>
        <div class="field-val" id="popupNama"></div>
      </div>
      <div class="popup-field">
        <label>Deskripsi</label>
        <div class="field-val" id="popupDeskripsi"></div>
      </div>
      <div class="popup-field">
        <label>Lokasi</label>
        <div class="field-val" id="popupLokasi"></div>
      </div>
      <div class="popup-field">
        <label>Status</label>
        <div class="field-val" id="popupStatus"></div>
      </div>
      <div class="popup-field">
        <label>Contact Person</label>
        <div class="field-val" id="popupContactPerson"></div>
      </div>
      <div class="popup-field">
        <label>Tanggal</label>
        <div class="field-val" id="popupTanggal"></div>
      </div>
    </div>

  </div>
</div>

{{-- konfirmasi hapus --}}
<div class="confirm-overlay" id="confirmOverlay">
  <div class="confirm-box">
    <p>Yakin hapus postingan ini?</p>
    <div class="confirm-actions">
      <button class="btn-cancel" onclick="closeConfirm()">Batal</button>
      <button class="btn-hapus" id="btnHapusConfirm">Hapus</button>
    </div>
  </div>
</div>

<div class="toast-notif" id="toast"></div>

@push('scripts')
<script>
var postingan = [];
var deleteId  = null;

function loadPostingan() {
  postingan = JSON.parse(localStorage.getItem('postingan') || '[]');

  var grid  = document.getElementById('itemGrid');
  var empty = document.getElementById('emptyState');
  grid.innerHTML = '';

  if (postingan.length === 0) {
    empty.style.display = 'flex';
    return;
  }
  empty.style.display = 'none';

  for (var i = 0; i < postingan.length; i++) {
    var p    = postingan[i];
    var card = document.createElement('div');
    card.className = 'item-card';

    // bikin isi foto dulu
    var fotoHtml = '';
    if (p.foto) {
      fotoHtml = '<img src="' + p.foto + '" alt="' + p.nama + '" ' +
        'onerror="this.parentElement.innerHTML=\'<div class=no-img-inner>' +
        '<svg viewBox=\\\'0 0 24 24\\\'><path d=\\\'M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z\\\'/></svg></div>\'">';
    } else {
      fotoHtml =
        '<div class="no-img-inner">' +
          '<svg viewBox="0 0 24 24">' +
            '<path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>' +
          '</svg>' +
        '</div>';
    }

    var statusClass = p.status === 'Found' ? 'found' : 'lost';

    card.innerHTML =
      '<div class="card-action-btns">' +
        '<button class="btn-edit-card" onclick="goEdit(' + p.id + ')" title="Edit">' +
          '<svg viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>' +
        '</button>' +
        '<button class="btn-delete-card" onclick="confirmDelete(' + p.id + ')" title="Hapus">' +
          '<svg viewBox="0 0 24 24"><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/></svg>' +
        '</button>' +
      '</div>' +
      '<div class="card-img-wrap" onclick="openPopup(' + p.id + ')">' +
        fotoHtml +
      '</div>' +
      '<div class="card-body" onclick="openPopup(' + p.id + ')">' +
        '<div class="card-title">' + p.nama + '</div>' +
        '<div class="card-loc">📍 ' + p.lokasi + '</div>' +
        '<span class="card-status ' + statusClass + '">' + p.status + '</span>' +
      '</div>';

    grid.appendChild(card);
  }
}

function openPopup(id) {
  var p = null;
  for (var i = 0; i < postingan.length; i++) {
    if (postingan[i].id === id) { p = postingan[i]; break; }
  }
  if (!p) return;

  document.getElementById('popupItemImg').src               = p.foto || '';
  document.getElementById('popupNama').textContent          = p.nama;
  document.getElementById('popupDeskripsi').textContent     = p.deskripsi;
  document.getElementById('popupLokasi').textContent        = p.lokasi;
  document.getElementById('popupTanggal').textContent       = p.tanggal;
  document.getElementById('popupContactPerson').textContent = p.contactPerson;
  var s = document.getElementById('popupStatus');
  s.textContent = p.status;
  s.className   = 'field-val ' + (p.status === 'Found' ? 'status-found' : 'status-lost');

  document.getElementById('popupOverlay').classList.add('show');
  document.body.style.overflow = 'hidden';
}

function closePopup() {
  document.getElementById('popupOverlay').classList.remove('show');
  document.body.style.overflow = '';
}

function handleOverlayClick(e) {
  if (e.target === document.getElementById('popupOverlay')) closePopup();
}

function goEdit(id) {
  localStorage.setItem('editPostingId', id);
  window.location.href = '{{ route("user.edit.posting") }}';
}

function confirmDelete(id) {
  deleteId = id;
  document.getElementById('confirmOverlay').classList.add('show');
}

function closeConfirm() {
  document.getElementById('confirmOverlay').classList.remove('show');
  deleteId = null;
}

document.getElementById('btnHapusConfirm').addEventListener('click', function() {
  if (!deleteId) return;

  var hasil = [];
  for (var i = 0; i < postingan.length; i++) {
    if (postingan[i].id !== deleteId) hasil.push(postingan[i]);
  }
  postingan = hasil;

  localStorage.setItem('postingan', JSON.stringify(postingan));
  closeConfirm();
  showToast('Postingan berhasil dihapus!', 'success');
  loadPostingan();
});

function showToast(msg, type) {
  if (!type) type = 'success';
  var t = document.getElementById('toast');
  t.textContent = msg;
  t.className = 'toast-notif show ' + type;
  setTimeout(function() { t.classList.remove('show'); }, 3000);
}

loadPostingan();
</script>
@endpush

@endsection