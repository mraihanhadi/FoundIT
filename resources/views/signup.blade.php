<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  @vite(['resources/css/app.css', 'resources/css/auth/signup.css', 'resources/js/app.js'])
</head>
<body>

  <div class="split">

    <!-- gambar kiri -->
    <div class="panel-left">
      <img
        src="{{ asset('gambar/gambardepan.png') }}"
        alt="Illustration"
        class="illustration"
        onerror="this.src='https://cdnjs.cloudflare.com/ajax/libs/twemoji/15.0.3/72x72/1f50d.png'; this.style.width='180px';"
      />
    </div>

    <!-- form kanan -->
    <div class="panel-right">
      <h1 class="form-title">Welcome !</h1>

      <div class="field-group">

        <!-- nama lengkap -->
        <div class="input-wrapper">
          <span class="icon">
            <svg viewBox="0 0 24 24">
              <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
            </svg>
          </span>
          <input type="text" id="signup-fullname" placeholder="Full Name" autocomplete="name"/>
        </div>

        <!-- username -->
        <div class="input-wrapper">
          <span class="icon">
            <svg viewBox="0 0 24 24">
              <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
            </svg>
          </span>
          <input type="text" id="signup-username" placeholder="Username" autocomplete="username"/>
        </div>

        <!-- nomor hp -->
        <div class="input-wrapper">
          <span class="prefix">+62</span>
          <input type="tel" id="signup-phone" placeholder="Nomor Handphone" autocomplete="tel"/>
        </div>

        <!-- email -->
        <div class="input-wrapper">
          <span class="icon">
            <svg viewBox="0 0 24 24">
              <path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"/>
            </svg>
          </span>
          <input type="email" id="signup-email" placeholder="Email" autocomplete="email"/>
        </div>

        <!-- password -->
        <div class="input-wrapper">
          <span class="icon">
            <svg viewBox="0 0 24 24">
              <path d="M18 8h-1V6A5 5 0 0 0 7 6v2H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V10a2 2 0 0 0-2-2zm-6 9a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm3.1-9H8.9V6a3.1 3.1 0 0 1 6.2 0v2z"/>
            </svg>
          </span>
          <input type="password" id="signup-password" placeholder="Password" autocomplete="new-password"/>
        </div>

      </div>

      <div class="btn-row">
        <button class="btn-primary" onclick="handleSignUp()">Submit</button>
        <button class="btn-outline" onclick="window.location.href = '/signin'">Sudah punya akun?</button>
      </div>

      <p id="signup-error" class="error-msg"></p>
    </div>

  </div>

  <!-- toast notif -->
  <div id="toast" class="toast"></div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function showToast(msg) {
      var t = document.getElementById('toast');
      t.textContent = msg;
      t.classList.add('show');
      setTimeout(function() { t.classList.remove('show'); }, 3000);
    }

    function handleSignUp() {
      var fullname = document.getElementById('signup-fullname').value.trim();
      var username = document.getElementById('signup-username').value.trim();
      var phone    = document.getElementById('signup-phone').value.trim();
      var email    = document.getElementById('signup-email').value.trim();
      var password = document.getElementById('signup-password').value;
      var errEl    = document.getElementById('signup-error');

      if (!fullname || !username || !phone || !email || !password) {
        errEl.textContent   = 'Semua field wajib diisi.';
        errEl.style.display = 'block';
        return;
      }

      if (password.length < 6) {
        errEl.textContent   = 'Password minimal 6 karakter.';
        errEl.style.display = 'block';
        return;
      }

      // cek username sudah ada belum
      var users = JSON.parse(localStorage.getItem('users') || '[]');
      var udahAda = false;
      for (var i = 0; i < users.length; i++) {
        if (users[i].username === username) {
          udahAda = true;
          break;
        }
      }

      if (udahAda) {
        errEl.textContent   = 'Username sudah digunakan.';
        errEl.style.display = 'block';
        return;
      }

      errEl.style.display = 'none';

      users.push({
        fullname: fullname,
        username: username,
        phone:    phone,
        email:    email,
        password: password
      });
      localStorage.setItem('users', JSON.stringify(users));

      showToast('Akun berhasil dibuat! Silakan Sign In.');

      // kosongin semua field
      document.getElementById('signup-fullname').value = '';
      document.getElementById('signup-username').value = '';
      document.getElementById('signup-phone').value    = '';
      document.getElementById('signup-email').value    = '';
      document.getElementById('signup-password').value = '';

      setTimeout(function() {
        window.location.href = '/signin';
      }, 900);
    }

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Enter') handleSignUp();
    });
  </script>

</body>
</html>