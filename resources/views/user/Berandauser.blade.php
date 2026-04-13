@extends('user.partials.layout')

@section('title', 'Beranda')

@push('styles')
  @vite(['resources/css/main.css', 'resources/css/user/beranda.css'])
@endpush

@section('content')

<main class="page-content">

  <div class="feed-tabs">
    <button class="tab-btn active" id="tabForYou">For You</button>
    <a class="tab-btn" id="tabAllItem" href="{{ route('user.allitem') }}">All Item</a>
  </div>

  <div class="item-grid" id="itemGrid">

    @forelse($items as $item)
    <div class="item-card" onclick="openPopup('item_{{ $item->id }}')">
      <div class="card-img-wrap">
        <img src="{{ $item->foto ? asset('storage/' . $item->foto) : 'https://placehold.co/400x400/EEF3FF/7B9EFF?text=Foto+Barang' }}" alt="{{ $item->nama_barang }}"
          onerror="this.src='https://placehold.co/400x400/EEF3FF/7B9EFF?text=Foto+Barang'">
      </div>
      <div class="card-body">
        <div class="card-title">{{ $item->nama_barang }}</div>
        <div class="card-loc">📍 {{ $item->lokasi }}</div>
        <span class="card-status {{ strtolower($item->status) }}">{{ $item->status }}</span>
      </div>
    </div>
    @empty
      <div style="text-align:center;width:100%;padding:20px;color:#888;">Belum ada postingan barang.</div>
    @endforelse

  </div>
</main>

{{-- popup detail barang --}}
<div class="popup-overlay" id="popupOverlay" onclick="handleOverlayClick(event)">
  <div class="popup-card" id="popupCard">

    <div class="popup-header">
      <button class="btn-back" onclick="closePopup()">
        <svg viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
      </button>
      <img id="popupUserAvatar" src="" alt="" class="popup-user-avatar"
        onerror="this.src='https://ui-avatars.com/api/?name=U&background=C8D8FF&color=5B7FE8'">
      <span id="popupUsername" class="popup-username"></span>
    </div>

    <img id="popupItemImg" src="" alt="Foto Barang" class="popup-item-img"
      onerror="this.src='https://placehold.co/600x450/EEF3FF/7B9EFF?text=Foto+Barang'">

    <div class="popup-fields">
      <div class="popup-field">
        <label>Nama Barang</label>
        <div class="field-val" id="popupNama"></div>
      </div>
      <div class="popup-field">
        <label>Deskripsi Barang</label>
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
        <label>Tanggal</label>
        <div class="field-val" id="popupTanggal"></div>
      </div>

      {{-- khusus status found --}}
      <div id="popupJanjiFound" style="display:none;">
        <div class="popup-field">
          <label>📍 Janji Temu / Lokasi Pengambilan</label>
          <div class="field-val" id="popupLokasiFound"></div>
        </div>
      </div>

      {{-- khusus status lost --}}
      <div id="popupFoundItBtn" style="display:none; margin-top:4px;">
        <button onclick="openVerifikasi()" class="btn-found-it">📞 Found It!</button>
      </div>
    </div>

  </div>
</div>

{{-- popup verifikasi --}}
<div class="popup-overlay" id="verifikasiOverlay" onclick="handleVerifikasiOverlayClick(event)">
  <div class="popup-card" id="verifikasiCard">

    <div class="popup-header">
      <button class="btn-back" onclick="closeVerifikasi()">
        <svg viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
      </button>
      <span class="popup-username">Verifikasi Barang</span>
    </div>

    <div class="popup-fields">

      <div class="popup-field">
        <label>Foto Bukti Penemuan <span style="color:var(--lost)">*</span></label>
        <div class="verif-upload-area">
          <div class="upload-icon">
            <svg viewBox="0 0 24 24">
              <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
            </svg>
          </div>
          <div class="upload-text">
            <strong>Klik untuk upload foto</strong><br>
            <span>PNG, JPG, JPEG (maks. 5MB)</span>
          </div>
          <input type="file" accept="image/*" onchange="previewVerifImg(this)">
        </div>
        <img id="verifPreviewImg" class="verif-preview-img" alt="Preview">
      </div>

      <div class="popup-field">
        <label>Nomor Telepon <span style="color:var(--lost)">*</span></label>
        <input type="tel" id="verifNoTelp" class="verif-input"
          placeholder="Contoh: 08123456789" maxlength="15">
      </div>

      <div class="popup-field">
        <label>📍 Lokasi Pengambilan Barang <span style="color:var(--lost)">*</span></label>
        <input type="text" id="verifLokasi" class="verif-input"
          placeholder="Contoh: Lobby GKU, Kantin TULT...">
      </div>

      <div class="popup-field">
        <label>📅 Tanggal & Jam Janji Temu <span style="color:var(--lost)">*</span></label>
        <div class="verif-datetime-row">
          <input type="date" id="verifTanggal" class="verif-input">
          <input type="time" id="verifJam" class="verif-input">
        </div>
      </div>

      <button class="btn-found-it" onclick="kirimVerifikasi()">✅ Kirim Verifikasi</button>

    </div>
  </div>
</div>

<div class="toast-notif" id="toast"></div>

@push('scripts')
<script>
// data item statis buat dummy
var itemData = {
@foreach($items as $item)
  "item_{{ $item->id }}": {
    username: '{{ addslashes($item->user->name ?? "User") }}',
    avatar: 'https://ui-avatars.com/api/?name={{ urlencode($item->user->name ?? "User") }}&background=C8D8FF&color=5B7FE8',
    itemImg: '{{ $item->foto ? asset("storage/" . $item->foto) : "https://placehold.co/400x400/EEF3FF/7B9EFF?text=Foto+Barang" }}',
    nama: '{{ addslashes($item->nama_barang) }}',
    deskripsi: '{{ addslashes($item->deskripsi_barang) }}',
    lokasi: '{{ addslashes($item->lokasi) }}',
    status: '{{ $item->status }}',
    tanggal: '{{ \Carbon\Carbon::parse($item->tanggal)->format("d/m/Y") }}',
    lokasiAmbil: '{{ addslashes($item->janji_temu ?? "") }}'
  },
@endforeach
};

var currentPopupData = null;

function openPopup(key) {
  var d = itemData[key];
  if (!d) return;
  currentPopupData = d;
  _showPopup(d.avatar, d.username, d.itemImg, d.nama, d.deskripsi, d.lokasi, d.tanggal, d.status, d.lokasiAmbil);
}

function _showPopup(avatar, username, itemImg, nama, deskripsi, lokasi, tanggal, status, lokasiAmbil) {
  document.getElementById('popupUserAvatar').src       = avatar;
  document.getElementById('popupUsername').textContent = username;
  document.getElementById('popupItemImg').src          = itemImg;
  document.getElementById('popupNama').textContent     = nama;
  document.getElementById('popupDeskripsi').textContent = deskripsi;
  document.getElementById('popupLokasi').textContent   = lokasi;
  document.getElementById('popupTanggal').textContent  = tanggal;

  var s = document.getElementById('popupStatus');
  s.textContent = status;
  s.className = 'field-val ' + (status === 'Found' ? 'status-found' : 'status-lost');

  if (status === 'Found') {
    document.getElementById('popupJanjiFound').style.display = 'block';
    document.getElementById('popupFoundItBtn').style.display = 'none';
    document.getElementById('popupLokasiFound').textContent  = lokasiAmbil || '-';
  } else {
    document.getElementById('popupJanjiFound').style.display = 'none';
    document.getElementById('popupFoundItBtn').style.display = 'block';
  }

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

function openVerifikasi() {
  document.getElementById('verifNoTelp').value  = '';
  document.getElementById('verifLokasi').value  = '';
  document.getElementById('verifTanggal').value = '';
  document.getElementById('verifJam').value     = '';

  var prevImg = document.getElementById('verifPreviewImg');
  prevImg.classList.remove('show');
  prevImg.src = '';

  document.getElementById('popupOverlay').classList.remove('show');
  document.getElementById('verifikasiOverlay').classList.add('show');
}

function closeVerifikasi() {
  document.getElementById('verifikasiOverlay').classList.remove('show');
  document.getElementById('popupOverlay').classList.add('show');
}

function handleVerifikasiOverlayClick(e) {
  if (e.target === document.getElementById('verifikasiOverlay')) closeVerifikasi();
}

function previewVerifImg(input) {
  var file = input.files[0];
  if (!file) return;
  var reader = new FileReader();
  reader.onload = function(e) {
    var img = document.getElementById('verifPreviewImg');
    img.src = e.target.result;
    img.classList.add('show');
  };
  reader.readAsDataURL(file);
}

function kirimVerifikasi() {
  var noTelp  = document.getElementById('verifNoTelp').value.trim();
  var lokasi  = document.getElementById('verifLokasi').value.trim();
  var tanggal = document.getElementById('verifTanggal').value;
  var jam     = document.getElementById('verifJam').value;
  var foto    = document.getElementById('verifPreviewImg');

  // validasi dulu
  if (!foto.classList.contains('show')) {
    showToast('Foto bukti wajib diupload!', 'error');
    return;
  }
  if (!noTelp) {
    showToast('Nomor telepon wajib diisi!', 'error');
    return;
  }
  if (!lokasi) {
    showToast('Lokasi pengambilan wajib diisi!', 'error');
    return;
  }
  if (!tanggal || !jam) {
    showToast('Tanggal dan jam wajib diisi!', 'error');
    return;
  }

  // simpan ke localStorage buat admin
  var verifikasi = JSON.parse(localStorage.getItem('verifikasiAdmin') || '[]');
  verifikasi.unshift({
    id: Date.now(),
    namaBarang:      currentPopupData ? currentPopupData.nama      : '-',
    deskripsiBarang: currentPopupData ? currentPopupData.deskripsi : '-',
    lokasiBarang:    currentPopupData ? currentPopupData.lokasi    : '-',
    tanggalBarang:   currentPopupData ? currentPopupData.tanggal   : '-',
    fotoBarang:      currentPopupData ? currentPopupData.itemImg   : null,
    fotoVerif:       foto.src,
    noTelp:          noTelp,
    lokasiAmbil:     lokasi,
    janjiTemu:       tanggal + ' ' + jam,
    waktu:           new Date().toLocaleDateString('id-ID'),
    status:          'pending'
  });
  localStorage.setItem('verifikasiAdmin', JSON.stringify(verifikasi));

  showToast('Verifikasi berhasil dikirim ke Admin!', 'success');
  setTimeout(function() {
    document.getElementById('verifikasiOverlay').classList.remove('show');
    document.body.style.overflow = '';
  }, 1500);
}

// search
document.getElementById('searchInput').addEventListener('input', function() {
  var q = this.value.toLowerCase().trim();
  document.querySelectorAll('.item-card').forEach(function(card) {
    var title = card.querySelector('.card-title').textContent.toLowerCase();
    var loc   = card.querySelector('.card-loc').textContent.toLowerCase();
    if (!q || title.includes(q) || loc.includes(q)) {
      card.style.display = '';
    } else {
      card.style.display = 'none';
    }
  });
});

function showToast(msg, type) {
  type = type || 'success';
  var t = document.getElementById('toast');
  t.textContent = msg;
  t.className   = 'toast-notif show ' + type;
  setTimeout(function() { t.classList.remove('show'); }, 3000);
}
</script>
@endpush

@endsection