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

    <div class="item-card" onclick="openPopup('iphone')">
      <div class="card-img-wrap">
        <img src="{{ asset('gambar/iPhone13.jpg') }}" alt="Iphone 13"
          onerror="this.src='https://placehold.co/400x400/EEF3FF/7B9EFF?text=Iphone+13'">
      </div>
      <div class="card-body">
        <div class="card-title">Iphone 13</div>
        <div class="card-loc">📍 Masjid Syamul Ulum</div>
        <span class="card-status found">Found</span>
      </div>
    </div>

    <div class="item-card" onclick="openPopup('plushie')">
      <div class="card-img-wrap">
        <img src="{{ asset('gambar/crybaby.jpg') }}" alt="Plushie Crybaby"
          onerror="this.src='https://placehold.co/400x400/FFF0EE/EF4444?text=Plushie'">
      </div>
      <div class="card-body">
        <div class="card-title">Plushie Crybaby</div>
        <div class="card-loc">📍 Tult0710</div>
        <span class="card-status lost">Lost</span>
      </div>
    </div>

    <div class="item-card" onclick="openPopup('botol')">
      <div class="card-img-wrap">
        <img src="{{ asset('gambar/bottle.jpg') }}" alt="Botol Minum"
          onerror="this.src='https://placehold.co/400x400/FFF0EE/EF4444?text=Botol+Minum'">
      </div>
      <div class="card-body">
        <div class="card-title">Botol Minum</div>
        <div class="card-loc">📍 Parkir TULT</div>
        <span class="card-status lost">Lost</span>
      </div>
    </div>

    <div class="item-card" onclick="openPopup('ktm')">
      <div class="card-img-wrap">
        <img src="{{ asset('gambar/ktm.jpg') }}" alt="KTM"
          onerror="this.src='https://placehold.co/400x400/EEF3FF/7B9EFF?text=KTM'">
      </div>
      <div class="card-body">
        <div class="card-title">KTM</div>
        <div class="card-loc">📍 Kantin GKU</div>
        <span class="card-status found">Found</span>
      </div>
    </div>

    <div class="item-card" onclick="openPopup('cushion')">
      <div class="card-img-wrap">
        <img src="{{ asset('gambar/cushion.jpg') }}" alt="Cushion"
          onerror="this.src='https://placehold.co/400x400/EEF3FF/7B9EFF?text=Cushion'">
      </div>
      <div class="card-body">
        <div class="card-title">Cushion</div>
        <div class="card-loc">📍 Mushola wanita Tult</div>
        <span class="card-status found">Found</span>
      </div>
    </div>

    <div class="item-card" onclick="openPopup('iphone')">
      <div class="card-img-wrap">
        <img src="{{ asset('gambar/iPhone13.jpg') }}" alt="Iphone 13"
          onerror="this.src='https://placehold.co/400x400/EEF3FF/7B9EFF?text=Iphone+13'">
      </div>
      <div class="card-body">
        <div class="card-title">Iphone 13</div>
        <div class="card-loc">📍 Masjid Syamul Ulum</div>
        <span class="card-status found">Found</span>
      </div>
    </div>

    <div class="item-card" onclick="openPopup('plushie')">
      <div class="card-img-wrap">
        <img src="{{ asset('gambar/crybaby.jpg') }}" alt="Plushie Crybaby"
          onerror="this.src='https://placehold.co/400x400/FFF0EE/EF4444?text=Plushie'">
      </div>
      <div class="card-body">
        <div class="card-title">Plushie Crybaby</div>
        <div class="card-loc">📍 Tult0710</div>
        <span class="card-status lost">Lost</span>
      </div>
    </div>

    <div class="item-card" onclick="openPopup('ktm')">
      <div class="card-img-wrap">
        <img src="{{ asset('gambar/ktm.jpg') }}" alt="KTM"
          onerror="this.src='https://placehold.co/400x400/EEF3FF/7B9EFF?text=KTM'">
      </div>
      <div class="card-body">
        <div class="card-title">KTM</div>
        <div class="card-loc">📍 Kantin GKU</div>
        <span class="card-status found">Found</span>
      </div>
    </div>

    <div class="item-card" onclick="openPopup('cushion')">
      <div class="card-img-wrap">
        <img src="{{ asset('gambar/cushion.jpg') }}" alt="Cushion"
          onerror="this.src='https://placehold.co/400x400/EEF3FF/7B9EFF?text=Cushion'">
      </div>
      <div class="card-body">
        <div class="card-title">Cushion</div>
        <div class="card-loc">📍 Mushola wanita Tult</div>
        <span class="card-status found">Found</span>
      </div>
    </div>

    <div class="item-card" onclick="openPopup('botol')">
      <div class="card-img-wrap">
        <img src="{{ asset('gambar/bottle.jpg') }}" alt="Botol Minum"
          onerror="this.src='https://placehold.co/400x400/FFF0EE/EF4444?text=Botol+Minum'">
      </div>
      <div class="card-body">
        <div class="card-title">Botol Minum</div>
        <div class="card-loc">📍 Parkir TULT</div>
        <span class="card-status lost">Lost</span>
      </div>
    </div>

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
  iphone: {
    username: 'Kevin Liu',
    avatar: '{{ asset("gambar/kevin.jpg") }}',
    itemImg: '{{ asset("gambar/iPhone13.jpg") }}',
    nama: 'Iphone 13',
    deskripsi: 'Iphone 13 warna pink, kondisi baik',
    lokasi: 'Masjid Syamul Ulum',
    status: 'Found',
    tanggal: '01/05/2026',
    lokasiAmbil: 'Lobby GKU Lt.1'
  },
  plushie: {
    username: 'Rina',
    avatar: 'https://ui-avatars.com/api/?name=Rina&background=FFD6D6&color=c0392b',
    itemImg: '{{ asset("gambar/crybaby.jpg") }}',
    nama: 'Plushie Crybaby',
    deskripsi: 'Boneka Crybaby warna pink',
    lokasi: 'Tult0710',
    status: 'Lost',
    tanggal: '03/05/2026',
    lokasiAmbil: ''
  },
  botol: {
    username: 'Sari',
    avatar: 'https://ui-avatars.com/api/?name=Sari&background=FFD6D6&color=c0392b',
    itemImg: '{{ asset("gambar/bottle.jpg") }}',
    nama: 'Botol Minum',
    deskripsi: 'Botol minum warna cream dengan stiker apel',
    lokasi: 'Parkir TULT',
    status: 'Lost',
    tanggal: '04/05/2026',
    lokasiAmbil: ''
  },
  ktm: {
    username: 'Han',
    avatar: 'https://ui-avatars.com/api/?name=Han&background=D6E4FF&color=3B82F6',
    itemImg: '{{ asset("gambar/ktm.jpg") }}',
    nama: 'KTM',
    deskripsi: 'Kartu Tanda Mahasiswa atas nama Han',
    lokasi: 'Kantin GKU',
    status: 'Found',
    tanggal: '05/05/2026',
    lokasiAmbil: 'Pos Satpam Gerbang Utama'
  },
  cushion: {
    username: 'Minju',
    avatar: '{{ asset("gambar/minju.jpg") }}',
    itemImg: '{{ asset("gambar/cushion.jpg") }}',
    nama: 'Cushion',
    deskripsi: 'Cushion merk Clio',
    lokasi: 'Mushola wanita Tult',
    status: 'Found',
    tanggal: '08/05/2026',
    lokasiAmbil: 'Mushola wanita Tult'
  }
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

// load postingan user dari localStorage kalau ada
function loadPostinganUser() {
  var postingan = JSON.parse(localStorage.getItem('postingan') || '[]');
  var approved  = postingan.filter(function(p) { return p.approved; });
  var grid      = document.getElementById('itemGrid');

  approved.forEach(function(p) {
    var card = document.createElement('div');
    card.className = 'item-card';
    card.onclick = function() {
      currentPopupData = p;
      _showPopup(
        'https://ui-avatars.com/api/?name=User&background=C8D8FF&color=5B7FE8',
        p.contact || 'User',
        p.foto || 'https://placehold.co/400x400/EEF3FF/7B9EFF?text=Foto',
        p.nama, p.deskripsi, p.lokasi, p.tanggal, p.status, p.janjiTemu
      );
    };
    card.innerHTML =
      '<div class="card-img-wrap">' +
        '<img src="' + (p.foto || 'https://placehold.co/400x400/EEF3FF/7B9EFF?text=Foto') + '" alt="' + p.nama + '" ' +
          'onerror="this.src=\'https://placehold.co/400x400/EEF3FF/7B9EFF?text=Foto\'">' +
      '</div>' +
      '<div class="card-body">' +
        '<div class="card-title">' + p.nama + '</div>' +
        '<div class="card-loc">📍 ' + p.lokasi + '</div>' +
        '<span class="card-status ' + p.status.toLowerCase() + '">' + p.status + '</span>' +
      '</div>';
    grid.appendChild(card);
  });
}
loadPostinganUser();

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