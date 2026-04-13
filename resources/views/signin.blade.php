<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Sign In</title>
  @vite(['resources/css/auth/signin.css'])
</head>
<body>

  <div class="split">

    <!-- gambar kiri -->
    <div class="panel-left">
      <img
        src="{{ asset('gambar/gambardepan.png') }}"
        alt="Illustration"
        class="illustration"
        onerror="this.style.display='none';"
      />
    </div>

    <!-- form kanan -->
    <div class="panel-right">
      <h1 class="form-title">Welcome Back!</h1>

      <div class="field-group">

        <!-- username -->
        <div class="input-wrapper">
          <span class="icon">
            <svg viewBox="0 0 24 24">
              <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
            </svg>
          </span>
          <input type="text" id="signin-username" placeholder="Username" autocomplete="username"/>
        </div>

        <!-- password -->
        <div class="input-wrapper">
          <span class="icon">
            <svg viewBox="0 0 24 24">
              <path d="M18 8h-1V6A5 5 0 0 0 7 6v2H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V10a2 2 0 0 0-2-2zm-6 9a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm3.1-9H8.9V6a3.1 3.1 0 0 1 6.2 0v2z"/>
            </svg>
          </span>
          <input type="password" id="signin-password" placeholder="Password" autocomplete="current-password"/>
        </div>

      </div>

      <div class="btn-row">
        <button class="btn-primary" onclick="handleSignIn()">Sign in</button>
        <button class="btn-outline" onclick="window.location.href='/signup'">Create an account</button>
      </div>

      <p id="signin-error" class="error-msg"></p>
    </div>

  </div>

  <!-- toast notif -->
  <div id="toast" class="toast"></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // akun admin hardcode dulu, nanti diganti kalau udah ada backend
    var ADMIN_ACCOUNTS = [
      { username: 'admin',              password: 'admin123', role: 'admin' },
      { username: 'admin@foundit.ac.id', password: 'admin123', role: 'admin' }
    ];

    function showToast(msg) {
      var t = document.getElementById('toast');
      t.textContent = msg;
      t.classList.add('show');
      setTimeout(function() { t.classList.remove('show'); }, 3000);
    }

    function handleSignIn() {
      var username = document.getElementById('signin-username').value.trim();
      var password = document.getElementById('signin-password').value;
      var errEl    = document.getElementById('signin-error');

      if (!username || !password) {
        errEl.textContent   = 'Username dan password wajib diisi.';
        errEl.style.display = 'block';
        return;
      }

      errEl.style.display = 'none';

      // cek admin dulu
      var isAdmin = null;
      for (var i = 0; i < ADMIN_ACCOUNTS.length; i++) {
        if (ADMIN_ACCOUNTS[i].username === username && ADMIN_ACCOUNTS[i].password === password) {
          isAdmin = ADMIN_ACCOUNTS[i];
          break;
        }
      }

      if (isAdmin) {
        localStorage.setItem('loggedInUser', JSON.stringify({ username: username, role: 'admin' }));
        showToast('Selamat datang, Admin!');
        setTimeout(function() {
          window.location.href = '/admin/beranda';
        }, 800);
        return;
      }

      // cek user biasa dari localStorage
      var users = JSON.parse(localStorage.getItem('users') || '[]');
      var user  = null;
      for (var j = 0; j < users.length; j++) {
        if (users[j].username === username && users[j].password === password) {
          user = users[j];
          break;
        }
      }

      if (!user) {
        errEl.textContent   = 'Username atau password salah.';
        errEl.style.display = 'block';
        return;
      }

      localStorage.setItem('loggedInUser', JSON.stringify({
        username: user.username,
        email:    user.email,
        nama:     user.nama,
        role:     'user'
      }));
      showToast('Berhasil masuk!');
      setTimeout(function() {
        window.location.href = '/user/beranda';
      }, 800);
    }

    // bisa enter buat login
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Enter') handleSignIn();
    });
  </script>

</body>
</html>