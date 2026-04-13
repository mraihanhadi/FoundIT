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

      <form method="POST" action="{{ route('signin.post') }}">
        @csrf
        <div class="field-group">

          <!-- username -->
          <div class="input-wrapper">
            <span class="icon">
              <svg viewBox="0 0 24 24">
                <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
              </svg>
            </span>
            <input type="text" name="username" id="signin-username" placeholder="Username" autocomplete="username" required value="{{ old('username') }}"/>
          </div>

          <!-- password -->
          <div class="input-wrapper">
            <span class="icon">
              <svg viewBox="0 0 24 24">
                <path d="M18 8h-1V6A5 5 0 0 0 7 6v2H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V10a2 2 0 0 0-2-2zm-6 9a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm3.1-9H8.9V6a3.1 3.1 0 0 1 6.2 0v2z"/>
              </svg>
            </span>
            <input type="password" name="password" id="signin-password" placeholder="Password" autocomplete="current-password" required/>
          </div>

        </div>

        <div class="btn-row">
          <button type="submit" class="btn-primary">Sign in</button>
          <button type="button" class="btn-outline" onclick="window.location.href='/signup'">Create an account</button>
        </div>
      </form>

      @if($errors->any())
        <p class="error-msg" style="display:block;">
          {{ $errors->first() }}
        </p>
      @endif

    </div>

  </div>

  @if(session('success'))
    <div id="toast" class="toast show">{{ session('success') }}</div>
  @else
    <div id="toast" class="toast"></div>
  @endif

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Remove toast after 3 seconds if it's shown
    var t = document.getElementById('toast');
    if (t && t.classList.contains('show')) {
      setTimeout(function() { t.classList.remove('show'); }, 3000);
    }
  </script>

</body>
</html>