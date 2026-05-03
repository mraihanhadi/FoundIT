@extends('admin.partials.layoutAdmin')

@section('title', 'Verifikasi Penemuan')

@push('styles')
  @vite('resources/css/user/beranda.css')
@endpush

@section('content')

<div class="main-layout">

  <aside class="sidebar-icons">
    <a href="{{ route('admin.beranda') }}" class="sidebar-icon-btn" title="Beranda">
      <svg viewBox="0 0 24 24">
        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
      </svg>
    </a>
    <a href="{{ route('admin.verifikasi') }}" class="sidebar-icon-btn active" title="Verifikasi Penemuan">
      <svg viewBox="0 0 24 24">
        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
      </svg>
    </a>
    <a href="{{ route('admin.verifikasi.status') }}" class="sidebar-icon-btn" title="Verifikasi Status">
      <svg viewBox="0 0 24 24">
        <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/>
      </svg>
    </a>
    <a href="{{ route('admin.profil') }}" class="sidebar-icon-btn" title="Profil">
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

    {{-- kalau kosong --}}
    <div class="empty-state" id="emptyState" style="display:none;">
      <svg viewBox="0 0 24 24" style="width:64px; height:64px; fill:#c3d1fa;">
        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
      </svg>
      <p style="font-size:1rem; font-weight:600; color:#9ca3af; margin-top:12px;">Belum ada verifikasi masuk</p>
      <span style="font-size:0.85rem; color:#9ca3af;">Verifikasi dari user akan muncul di sini</span>
    </div>

    <div class="item-grid" id="itemGrid"></div>

  </main>

</div>

{{-- popup detail verifikasi --}}
<div id="popupOverlay"
  onclick="handleOverlayClick(event)"
  style="
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(15,20,40,0.5);
    padding: 1rem;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.2s ease;
  ">

  <div id="popupCard"
    style="
      background: #EEF3FF;
      border-radius: 20px;
      width: 100%;
      max-width: 440px;
      max-height: 92vh;
      overflow-y: auto;
      box-shadow: 0 24px 64px rgba(0,0,0,0.28);
      transform: scale(0.92) translateY(20px);
      transition: transform 0.32s cubic-bezier(.34,1.4,.64,1);
    ">

    {{-- header popup --}}
    <div style="
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 16px 18px 12px;
      position: sticky;
      top: 0;
      background: #EEF3FF;
      z-index: 1;
      border-bottom: 1px solid rgba(123,158,255,0.18);
    ">
      <button onclick="closePopup()"
        style="
          background: rgba(0,0,0,0.07);
          border: none;
          width: 34px;
          height: 34px;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          cursor: pointer;
          flex-shrink: 0;
        ">
        <svg viewBox="0 0 24 24" style="width:18px; height:18px; fill:#111;">
          <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
        </svg>
      </button>
      <span style="font-weight:700; font-size:0.9rem; color:#111; flex:1;">Detail Verifikasi</span>
      <span style="
        font-size: 0.68rem;
        font-weight: 700;
        background: #7b9eff;
        color: #fff;
        padding: 3px 10px;
        border-radius: 9999px;
      ">👑 Admin View</span>
    </div>

    {{-- data barang lost --}}
    <div style="
      padding: 18px 18px 8px;
      background: #fff5f5;
      border-bottom: 2px solid #fecaca;
    ">
      <p style="font-size:0.75rem; font-weight:700; color:#ef4444; margin-bottom:8px;">📦 DATA BARANG LOST</p>
      <img id="popupFotoBarang" src="" alt="Foto Barang"
        style="
          width: 100%;
          aspect-ratio: 4/3;
          object-fit: cover;
          display: block;
          border-radius: 8px;
          margin-bottom: 10px;
        "
        onerror="this.style.display='none'">

      <div style="display:flex; flex-direction:column; gap:13px;">
        <div>
          <label style="display: block; font-size: 0.76rem; font-weight: 600; color: #374151; margin-bottom: 5px;">Nama Barang</label>
          <div id="pNama"
            style="background: #fff; border-radius: 8px; padding: 10px 14px; font-size: 0.875rem; color: #111; border: 1px solid rgba(0,0,0,0.06);"></div>
        </div>
        <div>
          <label style="display: block; font-size: 0.76rem; font-weight: 600; color: #374151; margin-bottom: 5px;">Deskripsi</label>
          <div id="pDeskripsi"
            style="background: #fff; border-radius: 8px; padding: 10px 14px; font-size: 0.875rem; color: #111; border: 1px solid rgba(0,0,0,0.06);"></div>
        </div>
        <div>
          <label style="display: block; font-size: 0.76rem; font-weight: 600; color: #374151; margin-bottom: 5px;">Lokasi Hilang</label>
          <div id="pLokasiBarang"
            style="background: #fff; border-radius: 8px; padding: 10px 14px; font-size: 0.875rem; color: #111; border: 1px solid rgba(0,0,0,0.06);"></div>
        </div>
      </div>
    </div>

    {{-- hasil verifikasi foundit --}}
    <div style="
      padding: 18px 18px 8px;
      background: #f0fdf4;
      border-bottom: 2px solid #bbf7d0;
    ">
      <p style="font-size:0.75rem; font-weight:700; color:#22c55e; margin-bottom:8px;">✅ HASIL VERIFIKASI FOUNDIT</p>
      <img id="popupFotoVerif" src="" alt="Foto Verifikasi"
        style="
          width: 100%;
          aspect-ratio: 4/3;
          object-fit: cover;
          display: block;
          border-radius: 8px;
          margin-bottom: 10px;
        "
        onerror="this.style.display='none'">

      <div style="display:flex; flex-direction:column; gap:13px;">
        <div>
          <label style="display: block; font-size: 0.76rem; font-weight: 600; color: #374151; margin-bottom: 5px;">No. Telepon Penemu</label>
          <div id="pNoTelp"
            style="background: #fff; border-radius: 8px; padding: 10px 14px; font-size: 0.875rem; color: #111; border: 1px solid rgba(0,0,0,0.06);"></div>
        </div>
        <div>
          <label style="display: block; font-size: 0.76rem; font-weight: 600; color: #374151; margin-bottom: 5px;">📍 Lokasi Pengambilan</label>
          <div id="pLokasiAmbil"
            style="background: #fff; border-radius: 8px; padding: 10px 14px; font-size: 0.875rem; color: #111; border: 1px solid rgba(0,0,0,0.06);"></div>
        </div>
        <div>
          <label style="display: block; font-size: 0.76rem; font-weight: 600; color: #374151; margin-bottom: 5px;">📅 Janji Temu</label>
          <div id="pJanji"
            style="background: #fff; border-radius: 8px; padding: 10px 14px; font-size: 0.875rem; color: #111; border: 1px solid rgba(0,0,0,0.06);"></div>
        </div>
      </div>
    </div>

    {{-- tombol aksi --}}
    <div style="padding:16px 18px 24px; display:flex; gap:10px;">
      <button onclick="adminKirim()"
        style="
          flex: 1;
          padding: 11px;
          background: #22c55e;
          color: #fff;
          border: none;
          border-radius: 8px;
          font-weight: 700;
          font-size: 0.875rem;
          cursor: pointer;
        ">✅ Kirim ke User</button>
      <button onclick="adminHapus()"
        style="
          flex: 1;
          padding: 11px;
          background: #fff;
          color: #ef4444;
          border: 2px solid #ef4444;
          border-radius: 8px;
          font-weight: 700;
          font-size: 0.875rem;
          cursor: pointer;
        ">❌ Hapus</button>
    </div>

  </div>
</div>

<div class="toast-notif" id="toast"></div>

@push('scripts')
<script>


var verifikasi = [];
var currentId  = null;

function render() {
  verifikasi = JSON.parse(localStorage.getItem('verifikasiAdmin') || '[]');

  var grid  = document.getElementById('itemGrid');
  var empty = document.getElementById('emptyState');
  grid.innerHTML = '';

  if (verifikasi.length === 0) {
    empty.style.display       = 'flex';
    empty.style.flexDirection = 'column';
    empty.style.alignItems    = 'center';
    empty.style.padding       = '4rem 2rem';
    grid.style.display        = 'none';
    return;
  }

  empty.style.display = 'none';
  grid.style.display  = '';

  for (var i = 0; i < verifikasi.length; i++) {
    var v    = verifikasi[i];
    var card = document.createElement('div');
    card.className = 'item-card';

    var fotoSrc = v.fotoVerif || 'https://placehold.co/400x400/EEF3FF/7B9EFF?text=Foto';

    card.innerHTML =
      '<div class="card-img-wrap">' +
        '<img src="' + fotoSrc + '" alt="' + v.namaBarang + '" ' +
          'onerror="this.src=\'https://placehold.co/400x400/EEF3FF/7B9EFF?text=Foto\'">' +
      '</div>' +
      '<div class="card-body">' +
        '<div class="card-title">' + v.namaBarang + '</div>' +
        '<div class="card-loc">📍 ' + v.lokasiBarang + '</div>' +
        '<span class="card-status lost">Lost</span>' +
      '</div>';

    (function(id) {
      card.onclick = function() { openPopup(id); };
    })(v.id);

    grid.appendChild(card);
  }

}

function openPopup(id) {
  var v = null;
  for (var i = 0; i < verifikasi.length; i++) {
    if (verifikasi[i].id === id) { v = verifikasi[i]; break; }
  }
  if (!v) return;

  currentId = id;
  document.getElementById('popupFotoBarang').src       = v.fotoBarang || '';
  document.getElementById('pNama').textContent         = v.namaBarang;
  document.getElementById('pDeskripsi').textContent    = v.deskripsiBarang;
  document.getElementById('pLokasiBarang').textContent = v.lokasiBarang;
  document.getElementById('popupFotoVerif').src        = v.fotoVerif || '';
  document.getElementById('pNoTelp').textContent       = v.noTelp;
  document.getElementById('pLokasiAmbil').textContent  = v.lokasiAmbil;
  document.getElementById('pJanji').textContent        = v.janjiTemu;

  var ov = document.getElementById('popupOverlay');
  ov.style.opacity       = '1';
  ov.style.pointerEvents = 'all';
  document.getElementById('popupCard').style.transform = 'scale(1) translateY(0)';
  document.body.style.overflow = 'hidden';
}

function closePopup() {
  var ov = document.getElementById('popupOverlay');
  ov.style.opacity       = '0';
  ov.style.pointerEvents = 'none';
  document.getElementById('popupCard').style.transform = 'scale(0.92) translateY(20px)';
  document.body.style.overflow = '';
  currentId = null;
}

function handleOverlayClick(e) {
  if (e.target === document.getElementById('popupOverlay')) closePopup();
}

function adminKirim() {
  if (!currentId) return;

  var v = null;
  for (var i = 0; i < verifikasi.length; i++) {
    if (verifikasi[i].id === currentId) { v = verifikasi[i]; break; }
  }

  if (v) {
    // kirim ke notifikasi user
    var notif = JSON.parse(localStorage.getItem('notifikasiUser') || '[]');
    notif.unshift({
      id:          Date.now(),
      nama:        v.namaBarang,
      deskripsi:   v.deskripsiBarang,
      foto:        v.fotoVerif,
      nomor:       v.noTelp,
      lokasiAmbil: v.lokasiAmbil,
      janji:       v.janjiTemu,
      waktu:       v.waktu,
      status:      'pending'
    });
    localStorage.setItem('notifikasiUser', JSON.stringify(notif));

    // hapus dari verifikasiAdmin
    var updated = [];
    for (var j = 0; j < verifikasi.length; j++) {
      if (verifikasi[j].id !== currentId) updated.push(verifikasi[j]);
    }
    localStorage.setItem('verifikasiAdmin', JSON.stringify(updated));
  }

  showToast('Verifikasi berhasil dikirim ke user!', 'success');
  closePopup();
  render();
}

function adminHapus() {
  if (!currentId) return;
  if (!confirm('Yakin ingin menghapus verifikasi ini?')) return;

  var updated = [];
  for (var i = 0; i < verifikasi.length; i++) {
    if (verifikasi[i].id !== currentId) updated.push(verifikasi[i]);
  }
  localStorage.setItem('verifikasiAdmin', JSON.stringify(updated));

  showToast('Verifikasi dihapus!', 'error');
  closePopup();
  render();
}

document.getElementById('searchInput').addEventListener('input', function() {
  var q = this.value.toLowerCase().trim();
  document.querySelectorAll('.item-card').forEach(function(card) {
    var title = card.querySelector('.card-title').textContent.toLowerCase();
    var loc   = card.querySelector('.card-loc').textContent.toLowerCase();
    card.style.display = (!q || title.includes(q) || loc.includes(q)) ? '' : 'none';
  });
});

function showToast(msg, type) {
  if (!type) type = 'success';
  var t = document.getElementById('toast');
  t.textContent = msg;
  t.className   = 'toast-notif show ' + type;
  setTimeout(function() { t.classList.remove('show'); }, 3000);
}

render();
</script>
@endpush

@endsection