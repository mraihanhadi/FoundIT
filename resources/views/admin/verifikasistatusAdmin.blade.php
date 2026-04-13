@extends('admin.partials.layoutAdmin')

@section('title', 'Status Verifikasi')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/admin/verifikasistatusAdmin.css') }}">
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
    <a href="{{ route('admin.verifikasi.status') }}" class="sidebar-icon-btn active" title="Verifikasi Status">
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

    <div class="page-title-bar">
      <h1>Status Verifikasi</h1>
    </div>

    {{-- kalau kosong --}}
    <div class="empty-state" id="emptyState" style="display:none;">
      <svg viewBox="0 0 24 24"
        style="
          width: 64px;
          height: 64px;
          fill: #c3d1fa;
        ">
        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
      </svg>
      <p style="font-size:1rem; font-weight:600; color:#9ca3af; margin-top:12px;">Belum ada respon dari user</p>
      <span style="font-size:0.85rem; color:#9ca3af;">Respon user akan muncul di sini</span>
    </div>

    {{-- tabel --}}
    <div class="status-table-wrap" id="statusTableWrap"
      style="
        display: none;
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        overflow-x: auto;
        box-shadow: 0 2px 12px rgba(100,140,220,0.08);
      ">
      <table class="status-table"
        style="
          width: 100%;
          border-collapse: collapse;
          font-size: 13px;
          min-width: 640px;
          background: #ffffff;
        ">
        <thead style="background: #f9fafb;">
          <tr style="background: #f9fafb; border-bottom: 1px solid #e5e7eb;">
            <th style="padding:12px 16px; text-align:left; font-size:11px; font-weight:600; color:#6b7280; letter-spacing:0.05em; text-transform:uppercase; white-space:nowrap; background:#f9fafb;">Foto</th>
            <th style="padding:12px 16px; text-align:left; font-size:11px; font-weight:600; color:#6b7280; letter-spacing:0.05em; text-transform:uppercase; white-space:nowrap; background:#f9fafb;">Nama Barang</th>
            <th style="padding:12px 16px; text-align:left; font-size:11px; font-weight:600; color:#6b7280; letter-spacing:0.05em; text-transform:uppercase; white-space:nowrap; background:#f9fafb;">Lokasi Ambil</th>
            <th style="padding:12px 16px; text-align:left; font-size:11px; font-weight:600; color:#6b7280; letter-spacing:0.05em; text-transform:uppercase; white-space:nowrap; background:#f9fafb;">Janji Temu</th>
            <th style="padding:12px 16px; text-align:left; font-size:11px; font-weight:600; color:#6b7280; letter-spacing:0.05em; text-transform:uppercase; white-space:nowrap; background:#f9fafb;">Respon User</th>
            <th style="padding:12px 16px; text-align:left; font-size:11px; font-weight:600; color:#6b7280; letter-spacing:0.05em; text-transform:uppercase; white-space:nowrap; background:#f9fafb;">Status</th>
            <th style="padding:12px 16px; text-align:left; font-size:11px; font-weight:600; color:#6b7280; letter-spacing:0.05em; text-transform:uppercase; white-space:nowrap; background:#f9fafb;">Aksi</th>
          </tr>
        </thead>
        <tbody id="statusTableBody" style="background:#ffffff;"></tbody>
      </table>
    </div>

  </main>

</div>

{{-- popup edit status --}}
<div id="editOverlay"
  onclick="handleEditOverlayClick(event)"
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

  <div id="editCard"
    style="
      background: #EEF3FF;
      border-radius: 20px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 24px 64px rgba(0,0,0,0.28);
      transform: scale(0.92) translateY(20px);
      transition: transform 0.32s cubic-bezier(.34,1.4,.64,1);
      overflow: hidden;
    ">

    <div style="
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 16px 18px 12px;
      background: #EEF3FF;
      border-bottom: 1px solid rgba(123,158,255,0.18);
    ">
      <button onclick="closeEdit()"
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
      <span style="font-weight:700; font-size:0.9rem; color:#111;">Edit Status Barang</span>
    </div>

    <div style="
      padding: 20px 18px 24px;
      display: flex;
      flex-direction: column;
      gap: 14px;
    ">
      <div>
        <label style="
          font-size: 0.75rem;
          font-weight: 600;
          color: #374151;
          display: block;
          margin-bottom: 6px;
        ">Nama Barang</label>
        <div id="editNama"
          style="
            background: #fff;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 0.875rem;
            color: #111;
            border: 1px solid rgba(0,0,0,0.06);
          "></div>
      </div>

      <div>
        <label style="
          font-size: 0.75rem;
          font-weight: 600;
          color: #374151;
          display: block;
          margin-bottom: 6px;
        ">Pilih Status</label>
        <div style="display:flex; gap:10px; flex-wrap:wrap;">
          <button onclick="setEditStatus('Found')" id="choiceFound"
            style="
              flex: 1;
              padding: 10px;
              border-radius: 8px;
              border: 2px solid #22c55e;
              background: #f0fdf4;
              color: #22c55e;
              font-weight: 700;
              cursor: pointer;
            ">✓ Found</button>
          <button onclick="setEditStatus('Lost')" id="choiceLost"
            style="
              flex: 1;
              padding: 10px;
              border-radius: 8px;
              border: 2px solid #ef4444;
              background: #fff5f5;
              color: #ef4444;
              font-weight: 700;
              cursor: pointer;
            ">! Lost</button>
          <button onclick="setEditStatus('Claimed')" id="choiceClaimed"
            style="
              flex: 1;
              padding: 10px;
              border-radius: 8px;
              border: 2px solid #7b9eff;
              background: #EEF3FF;
              color: #7b9eff;
              font-weight: 700;
              cursor: pointer;
            ">✅ Claimed</button>
        </div>
      </div>

      <button onclick="simpanStatus()"
        style="
          width: 100%;
          padding: 12px;
          background: #7b9eff;
          color: #fff;
          border: none;
          border-radius: 8px;
          font-weight: 700;
          font-size: 0.9rem;
          cursor: pointer;
          margin-top: 4px;
        ">Simpan Status</button>
    </div>

  </div>
</div>

<div class="toast-notif" id="toast"></div>

@push('scripts')
<script>
var statusList = [];
var editId     = null;
var editStatus = null;

function render() {
  statusList = JSON.parse(localStorage.getItem('verifikasiStatus') || '[]');

  var wrap  = document.getElementById('statusTableWrap');
  var empty = document.getElementById('emptyState');
  var tbody = document.getElementById('statusTableBody');
  tbody.innerHTML = '';

  if (!statusList.length) {
    empty.style.display       = 'flex';
    empty.style.flexDirection = 'column';
    empty.style.alignItems    = 'center';
    empty.style.padding       = '4rem 2rem';
    wrap.style.display        = 'none';
    return;
  }

  empty.style.display      = 'none';
  wrap.style.display       = 'block';
  wrap.style.background    = '#ffffff';
  wrap.style.borderRadius  = '16px';
  wrap.style.border        = '1px solid #e5e7eb';
  wrap.style.overflow      = 'hidden';
  wrap.style.boxShadow     = '0 2px 12px rgba(100,140,220,0.08)';

  for (var i = 0; i < statusList.length; i++) {
    var s = statusList[i];

    var responBadge = '';
    if (s.responUser === 'ya') {
      responBadge = '<span style="display:inline-flex; align-items:center; gap:5px; padding:4px 10px; border-radius:9999px; font-size:11px; font-weight:600; background:#dcfce7; color:#16a34a;">✅ Iya barang saya</span>';
    } else {
      responBadge = '<span style="display:inline-flex; align-items:center; gap:5px; padding:4px 10px; border-radius:9999px; font-size:11px; font-weight:600; background:#fee2e2; color:#dc2626;">❌ Bukan barang saya</span>';
    }

    var statusBadge = '';
    if (s.status === 'Found') {
      statusBadge = '<span style="display:inline-flex; align-items:center; padding:4px 10px; border-radius:9999px; font-size:11px; font-weight:600; background:#dcfce7; color:#16a34a;">Found</span>';
    } else if (s.status === 'Claimed') {
      statusBadge = '<span style="display:inline-flex; align-items:center; padding:4px 10px; border-radius:9999px; font-size:11px; font-weight:600; background:#eff6ff; color:#2563eb;">Claimed</span>';
    } else {
      statusBadge = '<span style="display:inline-flex; align-items:center; padding:4px 10px; border-radius:9999px; font-size:11px; font-weight:600; background:#fee2e2; color:#dc2626;">Lost</span>';
    }

    var fotoSrc = s.foto || 'https://placehold.co/60x60/EEF3FF/7B9EFF?text=Foto';

    var tr = document.createElement('tr');
    tr.style.background = '#ffffff';
    tr.onmouseover = function() { this.style.background = '#f9fafb'; };
    tr.onmouseout  = function() { this.style.background = '#ffffff'; };

    tr.innerHTML =
      '<td style="padding:14px 16px; border-bottom:1px solid #f3f4f6; background:#ffffff; vertical-align:middle;">' +
        '<img src="' + fotoSrc + '" ' +
          'style="width:52px; height:52px; object-fit:cover; border-radius:10px; border:1px solid #e5e7eb; display:block;" ' +
          'onerror="this.src=\'https://placehold.co/60x60/EEF3FF/7B9EFF?text=Foto\'">' +
      '</td>' +
      '<td style="padding:14px 16px; border-bottom:1px solid #f3f4f6; background:#ffffff; vertical-align:middle; font-weight:600; color:#111827;">' + s.nama + '</td>' +
      '<td style="padding:14px 16px; border-bottom:1px solid #f3f4f6; background:#ffffff; vertical-align:middle; color:#111827;">' + (s.lokasiAmbil || '-') + '</td>' +
      '<td style="padding:14px 16px; border-bottom:1px solid #f3f4f6; background:#ffffff; vertical-align:middle; color:#111827;">' + (s.janji || '-') + '</td>' +
      '<td style="padding:14px 16px; border-bottom:1px solid #f3f4f6; background:#ffffff; vertical-align:middle;">' + responBadge + '</td>' +
      '<td style="padding:14px 16px; border-bottom:1px solid #f3f4f6; background:#ffffff; vertical-align:middle;">' + statusBadge + '</td>' +
      '<td style="padding:14px 16px; border-bottom:1px solid #f3f4f6; background:#ffffff; vertical-align:middle;">' +
        '<button onclick="openEdit(' + s.id + ')" class="btn-edit-status">✏️ Edit</button>' +
      '</td>';

    tbody.appendChild(tr);
  }

  // hapus border baris terakhir
  var rows = tbody.querySelectorAll('tr');
  if (rows.length > 0) {
    var lastTds = rows[rows.length - 1].querySelectorAll('td');
    for (var j = 0; j < lastTds.length; j++) {
      lastTds[j].style.borderBottom = 'none';
    }
  }
}

function openEdit(id) {
  var s = null;
  for (var i = 0; i < statusList.length; i++) {
    if (statusList[i].id === id) { s = statusList[i]; break; }
  }
  if (!s) return;

  editId     = id;
  editStatus = s.status;
  document.getElementById('editNama').textContent = s.nama;
  highlightChoice(editStatus);

  var ov = document.getElementById('editOverlay');
  ov.style.opacity       = '1';
  ov.style.pointerEvents = 'all';
  document.getElementById('editCard').style.transform = 'scale(1) translateY(0)';
  document.body.style.overflow = 'hidden';
}

function closeEdit() {
  var ov = document.getElementById('editOverlay');
  ov.style.opacity       = '0';
  ov.style.pointerEvents = 'none';
  document.getElementById('editCard').style.transform = 'scale(0.92) translateY(20px)';
  document.body.style.overflow = '';
  editId     = null;
  editStatus = null;
}

function handleEditOverlayClick(e) {
  if (e.target === document.getElementById('editOverlay')) closeEdit();
}

function setEditStatus(status) {
  editStatus = status;
  highlightChoice(status);
}

function highlightChoice(status) {
  var pilihan = ['Found', 'Lost', 'Claimed'];
  for (var i = 0; i < pilihan.length; i++) {
    var btn = document.getElementById('choice' + pilihan[i]);
    btn.style.opacity = pilihan[i] === status ? '1' : '0.4';
  }
}

function simpanStatus() {
  if (!editId || !editStatus) return;

  for (var i = 0; i < statusList.length; i++) {
    if (statusList[i].id === editId) {
      statusList[i].status = editStatus;
      break;
    }
  }

  localStorage.setItem('verifikasiStatus', JSON.stringify(statusList));
  showToast('Status berhasil diperbarui!', 'success');
  closeEdit();
  render();
}

document.getElementById('searchInput').addEventListener('input', function() {
  var q = this.value.toLowerCase().trim();
  var rows = document.querySelectorAll('#statusTableBody tr');
  for (var i = 0; i < rows.length; i++) {
    var teks = rows[i].textContent.toLowerCase();
    rows[i].style.display = (!q || teks.includes(q)) ? '' : 'none';
  }
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