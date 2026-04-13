@extends('user.partials.layout')

@section('title', 'Penemuan Barang')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/user/notifikasi.css') }}">
@endpush

@section('content')

<div class="main-layout">

  <aside class="sidebar-icons">
    <a href="{{ route('user.beranda') }}" class="sidebar-icon-btn" title="Beranda">
      <svg viewBox="0 0 24 24">
        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
      </svg>
    </a>
    <a href="{{ route('user.tambah.posting') }}" class="sidebar-icon-btn" title="Tambah Postingan">
      <svg viewBox="0 0 24 24">
        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
      </svg>
    </a>
    <a href="{{ route('user.notifikasi') }}" class="sidebar-icon-btn active" title="Notifikasi">
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
      <h1>Penemuan Barang</h1>
    </div>

    {{-- kalau kosong --}}
    <div class="empty-state" id="emptyState" style="display:none;">
      <svg viewBox="0 0 24 24">
        <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
      </svg>
      <p>Belum ada notifikasi</p>
      <span>Notifikasi akan muncul jika barang yang kamu laporkan telah ditemukan</span>
    </div>

    <div class="item-grid" id="notifGrid"></div>

  </main>
</div>

{{-- popup detail notifikasi --}}
<div class="popup-overlay" id="popupOverlay" onclick="handleOverlayClick(event)">
  <div class="popup-card">

    <div class="popup-header">
      <button class="btn-back" onclick="closePopup()">
        <svg viewBox="0 0 24 24">
          <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
        </svg>
      </button>
      <span class="popup-username">🎉 Barang Ditemukan!</span>
    </div>

    <img id="popupItemImg" src="" alt="Foto" class="popup-item-img"
      onerror="this.src='https://placehold.co/600x450/EEF3FF/7B9EFF?text=Foto'">

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
        <label>📞 Nomor Telepon Penemu</label>
        <div class="field-val" id="popupNomor"></div>
      </div>
      <div class="popup-field">
        <label>📍 Lokasi Pengambilan Barang</label>
        <div class="field-val" id="popupLokasi"></div>
      </div>
      <div class="popup-field">
        <label>📅 Tanggal & Jam Janji Temu</label>
        <div class="field-val" id="popupJanji"></div>
      </div>

      <button class="btn-ya" onclick="konfirmasi(true)">✅ Ya, itu barang saya!</button>
      <button class="btn-bukan" onclick="konfirmasi(false)">❌ Bukan barang saya</button>
    </div>

  </div>
</div>

<div class="toast-notif" id="toast"></div>

@push('scripts')
<script>
var notifData = [];
var currentId = null;

function render() {
  notifData = JSON.parse(localStorage.getItem('notifikasiUser') || '[]');

  var grid  = document.getElementById('notifGrid');
  var empty = document.getElementById('emptyState');
  grid.innerHTML = '';

  if (!notifData.length) {
    empty.style.display = 'flex';
    return;
  }
  empty.style.display = 'none';

  for (var i = 0; i < notifData.length; i++) {
    var n = notifData[i];
    var badge = '';

    if (n.status === 'confirmed') {
      badge = '<span class="notif-badge confirmed">✅ Dikonfirmasi</span>';
    } else if (n.status === 'rejected') {
      badge = '<span class="notif-badge rejected">❌ Ditolak</span>';
    } else {
      badge = '<span class="notif-badge new">🔔 Barang Ditemukan!</span>';
    }

    var card = document.createElement('div');
    card.className = 'item-card notif-card' + (n.status !== 'pending' ? ' notif-done' : '');

    // pakai closure biar id-nya ga ketukar
    (function(id) {
      card.onclick = function() { openPopup(id); };
    })(n.id);

    var fotoSrc = n.foto || '';
    card.innerHTML =
      '<div class="notif-badge-wrap">' + badge + '</div>' +
      '<div class="card-img-wrap">' +
        '<img src="' + fotoSrc + '" alt="' + n.nama + '" ' +
          'onerror="this.src=\'https://placehold.co/400x400/EEF3FF/7B9EFF?text=Foto\'">' +
      '</div>' +
      '<div class="card-body">' +
        '<div class="card-title">' + n.nama + '</div>' +
        '<div class="card-loc">📍 ' + (n.lokasiAmbil || '-') + '</div>' +
        '<div class="card-time">' + (n.waktu || '') + '</div>' +
      '</div>';

    grid.appendChild(card);
  }
}

function openPopup(id) {
  var n = null;
  for (var i = 0; i < notifData.length; i++) {
    if (notifData[i].id === id) { n = notifData[i]; break; }
  }
  if (!n) return;

  currentId = id;
  document.getElementById('popupItemImg').src           = n.foto || '';
  document.getElementById('popupNama').textContent      = n.nama || '-';
  document.getElementById('popupDeskripsi').textContent = n.deskripsi || '-';
  document.getElementById('popupNomor').textContent     = n.nomor || '-';
  document.getElementById('popupLokasi').textContent    = n.lokasiAmbil || '-';
  document.getElementById('popupJanji').textContent     = n.janji || '-';

  document.getElementById('popupOverlay').classList.add('show');
  document.body.style.overflow = 'hidden';
}

function closePopup() {
  document.getElementById('popupOverlay').classList.remove('show');
  document.body.style.overflow = '';
  currentId = null;
}

function handleOverlayClick(e) {
  if (e.target === document.getElementById('popupOverlay')) closePopup();
}

function konfirmasi(isYa) {
  if (!currentId) return;

  var idx = -1;
  for (var i = 0; i < notifData.length; i++) {
    if (notifData[i].id === currentId) { idx = i; break; }
  }
  if (idx === -1) return;

  notifData[idx].status     = isYa ? 'confirmed' : 'rejected';
  notifData[idx].responUser = isYa ? 'ya' : 'bukan';
  localStorage.setItem('notifikasiUser', JSON.stringify(notifData));

  // update ke verifikasiStatus buat admin
  var n = notifData[idx];
  var statusList = JSON.parse(localStorage.getItem('verifikasiStatus') || '[]');

  var existIdx = -1;
  for (var j = 0; j < statusList.length; j++) {
    if (statusList[j].id === n.id) { existIdx = j; break; }
  }

  var entry = {
    id:          n.id,
    nama:        n.nama,
    deskripsi:   n.deskripsi,
    foto:        n.foto,
    lokasiAmbil: n.lokasiAmbil,
    janji:       n.janji,
    nomor:       n.nomor,
    waktu:       n.waktu,
    responUser:  isYa ? 'ya' : 'bukan',
    status:      isYa ? 'Claimed' : 'Lost'
  };

  if (existIdx !== -1) {
    statusList[existIdx] = entry;
  } else {
    statusList.unshift(entry);
  }
  localStorage.setItem('verifikasiStatus', JSON.stringify(statusList));

  closePopup();
  showToast(isYa ? 'Konfirmasi berhasil dikirim!' : 'Ditandai bukan barang kamu.', 'success');
  render();
}

function showToast(msg, type) {
  if (!type) type = 'success';
  var t = document.getElementById('toast');
  t.textContent = msg;
  t.className = 'toast-notif show ' + type;
  setTimeout(function() { t.classList.remove('show'); }, 3000);
}

render();
</script>
@endpush

@endsection