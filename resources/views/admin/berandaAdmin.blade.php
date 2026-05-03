@extends('admin.partials.layoutAdmin')

@section('title', 'Beranda Admin')

@push('styles')
  @vite('resources/css/user/beranda.css')
@endpush

@section('content')

<main class="page-content">

  <div class="feed-tabs">
    <button class="tab-btn active" id="tabSemua" onclick="filterStatus('Semua')">Semua</button>
    <button class="tab-btn" id="tabPending" onclick="filterStatus('Pending')">Pending</button>
    <button class="tab-btn" id="tabFound" onclick="filterStatus('Found')">Found</button>
    <button class="tab-btn" id="tabLost"  onclick="filterStatus('Lost')">Lost</button>
  </div>

  <div class="empty-state" id="emptyState" style="display:none;">
    <svg viewBox="0 0 24 24"
      style="
        width: 64px;
        height: 64px;
        fill: #c3d1fa;
      ">
      <path d="M19 3H5c-1.1 0-2 .9-2 2v14l4-4h12c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/>
    </svg>
    <p style="font-size:1rem; font-weight:600; color:#9ca3af; margin-top:12px;">Belum ada postingan</p>
    <span style="font-size:0.85rem; color:#9ca3af;">Postingan dari user akan muncul di sini</span>
  </div>

  <div class="item-grid" id="itemGrid"></div>

</main>

{{-- popup detail postingan --}}
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
      max-width: 400px;
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
      flex-wrap: wrap;
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
      <span id="popupUsername"
        style="
          font-weight: 700;
          font-size: 0.9rem;
          color: #111;
          flex: 1;
        "></span>
      <span style="
        font-size: 0.68rem;
        font-weight: 700;
        background: #7b9eff;
        color: #fff;
        padding: 3px 10px;
        border-radius: 9999px;
      ">👑 Admin View</span>
    </div>

    <img id="popupItemImg" src="" alt="Foto"
      style="
        width: 100%;
        aspect-ratio: 4/3;
        object-fit: cover;
        display: block;
      "
      onerror="this.src='https://placehold.co/600x450/EEF3FF/7B9EFF?text=Foto'">

    {{-- field-field detail --}}
    <div style="
      padding: 18px 18px 28px;
      display: flex;
      flex-direction: column;
      gap: 13px;
    ">

      <div>
        <label style="
          display: block;
          font-size: 0.76rem;
          font-weight: 600;
          color: #374151;
          margin-bottom: 5px;
        ">Nama Barang</label>
        <div id="popupNama"
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
          display: block;
          font-size: 0.76rem;
          font-weight: 600;
          color: #374151;
          margin-bottom: 5px;
        ">Deskripsi</label>
        <div id="popupDeskripsi"
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
          display: block;
          font-size: 0.76rem;
          font-weight: 600;
          color: #374151;
          margin-bottom: 5px;
        ">Lokasi</label>
        <div id="popupLokasi"
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
          display: block;
          font-size: 0.76rem;
          font-weight: 600;
          color: #374151;
          margin-bottom: 5px;
        ">Contact Person</label>
        <div id="popupContact"
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
          display: block;
          font-size: 0.76rem;
          font-weight: 600;
          color: #374151;
          margin-bottom: 5px;
        ">Status</label>
        <div id="popupStatus"
          style="
            background: #fff;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 0.875rem;
            font-weight: 700;
            border: 1px solid rgba(0,0,0,0.06);
          "></div>
      </div>

      <div>
        <label style="
          display: block;
          font-size: 0.76rem;
          font-weight: 600;
          color: #374151;
          margin-bottom: 5px;
        ">Tanggal</label>
        <div id="popupTanggal"
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
          display: block;
          font-size: 0.76rem;
          font-weight: 600;
          color: #374151;
          margin-bottom: 5px;
        ">📍 Janji Temu / Lokasi Pengambilan</label>
        <div id="popupJanji"
          style="
            background: #fff;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 0.875rem;
            color: #111;
            border: 1px solid rgba(0,0,0,0.06);
          "></div>
      </div>

      {{-- tombol aksi --}}
      <div style="display:flex; gap:10px; margin-top:4px;" id="actionButtons">
        <form method="POST" id="formApprove" style="flex:1;">
          @csrf
          <button type="submit" style="width:100%; padding: 11px; background: #22c55e; color: #fff; border: none; border-radius: 8px; font-weight: 700; font-size: 0.875rem; cursor: pointer;">✅ Approve</button>
        </form>
        <form method="POST" id="formReject" style="flex:1;">
          @csrf
          <button type="submit" onclick="return confirm('Yakin ingin menghapus postingan ini?')" style="width:100%; padding: 11px; background: #fff; color: #ef4444; border: 2px solid #ef4444; border-radius: 8px; font-weight: 700; font-size: 0.875rem; cursor: pointer;">❌ Hapus</button>
        </form>
      </div>

      </div>

    </div>
  </div>
</div>

<div class="toast-notif" id="toast"></div>

@push('scripts')
<script>


var currentId    = null;
var activeFilter = 'Semua';

function getPostingan() {
  return [
    @foreach($items as $item)
    {
      id: {{ $item->id }},
      nama: '{{ addslashes($item->nama_barang) }}',
      deskripsi: '{{ addslashes($item->deskripsi_barang) }}',
      lokasi: '{{ addslashes($item->lokasi) }}',
      status: '{{ $item->status }}',
      contact: '{{ addslashes($item->contact_person ?? "-") }}',
      tanggal: '{{ \Carbon\Carbon::parse($item->tanggal)->format("d/m/Y") }}',
      janjiTemu: '{{ addslashes($item->janji_temu ?? "-") }}',
      foto: '{{ $item->foto ? asset("storage/" . $item->foto) : "" }}',
      is_approved: {{ $item->is_approved ? 'true' : 'false' }},
      username: '{{ addslashes($item->user->name ?? "User") }}'
    },
    @endforeach
  ];
}

function render() {
  var grid      = document.getElementById('itemGrid');
  var empty     = document.getElementById('emptyState');
  var postingan = getPostingan();
  grid.innerHTML = '';

  if (postingan.length === 0) {
    empty.style.display       = 'flex';
    empty.style.flexDirection = 'column';
    empty.style.alignItems    = 'center';
    empty.style.padding       = '4rem 2rem';
    grid.style.display        = 'none';
    return;
  }

  empty.style.display = 'none';
  grid.style.display  = '';

  var filtered = [];
  for (var i = 0; i < postingan.length; i++) {
    var p = postingan[i];
    var show = false;
    if (activeFilter === 'Semua') show = true;
    else if (activeFilter === 'Pending') show = !p.is_approved;
    else show = p.status === activeFilter;
    
    if (show) filtered.push(p);
  }

  for (var j = 0; j < filtered.length; j++) {
    var p    = filtered[j];
    var card = document.createElement('div');
    card.className      = 'item-card';
    card.dataset.status = p.status;
    card.dataset.approved = p.is_approved ? 'true' : '';

    var fotoSrc     = p.foto || 'https://placehold.co/400x400/EEF3FF/7B9EFF?text=Foto';
    var statusClass = p.status.toLowerCase();
    var pendingBadge = p.is_approved ? '' : '<span style="background:#ef4444;color:#fff;padding:2px 6px;border-radius:4px;font-size:0.7rem;position:absolute;top:8px;right:8px;z-index:2;">Pending</span>';

    card.innerHTML =
      '<div class="card-img-wrap" style="position:relative;">' +
        pendingBadge +
        '<img src="' + fotoSrc + '" alt="' + p.nama + '" ' +
          'onerror="this.src=\'https://placehold.co/400x400/EEF3FF/7B9EFF?text=Foto\'">' +
      '</div>' +
      '<div class="card-body">' +
        '<div class="card-title">' + p.nama + '</div>' +
        '<div class="card-loc">📍 ' + p.lokasi + '</div>' +
        '<span class="card-status ' + statusClass + '">' + p.status + '</span>' +
      '</div>';

    // closure biar id ga ketukar
    (function(id) {
      card.onclick = function() { openPopup(id); };
    })(p.id);

    grid.appendChild(card);
  }

}

function openPopup(id) {
  var postingan = getPostingan();
  var p = null;
  for (var i = 0; i < postingan.length; i++) {
    if (postingan[i].id === id) { p = postingan[i]; break; }
  }
  if (!p) return;

  currentId = id;
  document.getElementById('popupItemImg').src           = p.foto || 'https://placehold.co/600x450/EEF3FF/7B9EFF?text=Foto';
  document.getElementById('popupUsername').textContent  = p.nama;
  document.getElementById('popupNama').textContent      = p.nama;
  document.getElementById('popupDeskripsi').textContent = p.deskripsi;
  document.getElementById('popupLokasi').textContent    = p.lokasi;
  document.getElementById('popupContact').textContent   = p.contact || '-';
  document.getElementById('popupTanggal').textContent   = p.tanggal;
  document.getElementById('popupJanji').textContent     = p.janjiTemu || '-';

  var s = document.getElementById('popupStatus');
  s.textContent = p.status;
  s.style.color = p.status === 'Found' ? '#22c55e' : '#ef4444';

  var actBtns = document.getElementById('actionButtons');
  if (p.is_approved) {
    actBtns.style.display = 'none';
  } else {
    actBtns.style.display = 'flex';
    document.getElementById('formApprove').action = '/admin/item/' + id + '/approve';
    document.getElementById('formReject').action = '/admin/item/' + id + '/reject';
  }

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

function filterStatus(status) {
  activeFilter = status;

  document.querySelectorAll('.tab-btn').forEach(function(b) {
    b.classList.remove('active');
  });

  var map = { Semua: 'tabSemua', Pending: 'tabPending', Found: 'tabFound', Lost: 'tabLost' };
  var el  = document.getElementById(map[status]);
  if (el) el.classList.add('active');

  render();
}

document.getElementById('searchInput').addEventListener('input', function() {
  var q = this.value.toLowerCase().trim();
  document.querySelectorAll('.item-card').forEach(function(card) {
    var title    = card.querySelector('.card-title').textContent.toLowerCase();
    var loc      = card.querySelector('.card-loc').textContent.toLowerCase();
    var filterOk = activeFilter === 'Semua' || (activeFilter === 'Pending' ? !card.dataset.approved : card.dataset.status === activeFilter);
    var searchOk = !q || title.includes(q) || loc.includes(q);
    card.style.display = (filterOk && searchOk) ? '' : 'none';
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