<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>TaskTrack — Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg:        #0d0d12;
      --surface:   #13131a;
      --card:      #1a1a24;
      --border:    #2a2a38;
      --purple:    #7c5cfc;
      --purple-lt: #a285fd;
      --green:     #00e096;
      --pink:      #ff4d94;
      --orange:    #ffaa00;
      --text:      #e8e8f0;
      --muted:     #6b6b80;
    }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      display: flex;
      overflow: hidden;
    }

    /* ── LEFT PANEL ─────────────────────────────── */
    .left {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 48px 56px;
      position: relative;
      overflow: hidden;
    }

    /* Animated mesh background */
    .left::before {
      content: '';
      position: absolute;
      inset: 0;
      background:
        radial-gradient(ellipse 80% 60% at 20% 20%, rgba(124,92,252,.18) 0%, transparent 60%),
        radial-gradient(ellipse 60% 50% at 80% 80%, rgba(0,224,150,.12) 0%, transparent 55%),
        radial-gradient(ellipse 50% 40% at 60% 10%, rgba(255,74,148,.1) 0%, transparent 50%);
      animation: meshShift 8s ease-in-out infinite alternate;
    }

    @keyframes meshShift {
      0%   { transform: scale(1)   rotate(0deg); }
      100% { transform: scale(1.1) rotate(3deg); }
    }

    /* Dot grid */
    .left::after {
      content: '';
      position: absolute;
      inset: 0;
      background-image: radial-gradient(circle, rgba(255,255,255,.06) 1px, transparent 1px);
      background-size: 28px 28px;
      pointer-events: none;
    }

    /* Floating stat cards */
    .float-cards {
      position: absolute;
      inset: 0;
      pointer-events: none;
    }

    .fcard {
      position: absolute;
      background: rgba(26,26,36,.75);
      border: 1px solid var(--border);
      backdrop-filter: blur(10px);
      border-radius: 14px;
      padding: 16px 20px;
      min-width: 150px;
      animation: floatUp 6s ease-in-out infinite;
    }

    .fcard:nth-child(1) { top: 18%; left: 12%; animation-delay: 0s; }
    .fcard:nth-child(2) { top: 42%; right: 8%; animation-delay: 1.5s; }
    .fcard:nth-child(3) { bottom: 22%; left: 20%; animation-delay: 3s; }

    @keyframes floatUp {
      0%, 100% { transform: translateY(0); }
      50%       { transform: translateY(-12px); }
    }

    .fcard-label {
      font-size: 10px;
      text-transform: uppercase;
      letter-spacing: .1em;
      color: var(--muted);
      margin-bottom: 6px;
    }

    .fcard-val {
      font-family: 'Syne', sans-serif;
      font-size: 26px;
      font-weight: 800;
      line-height: 1;
    }

    .fcard-sub {
      font-size: 11px;
      color: var(--muted);
      margin-top: 4px;
    }

    .fcard-bar {
      height: 3px;
      border-radius: 99px;
      margin-top: 10px;
      width: 100%;
      background: var(--border);
      overflow: hidden;
    }

    .fcard-bar-fill {
      height: 100%;
      border-radius: 99px;
      animation: growBar 1.8s ease forwards;
    }

    @keyframes growBar {
      from { width: 0; }
    }

    .c-purple { color: var(--purple-lt); }
    .c-green  { color: var(--green); }
    .c-pink   { color: var(--pink); }
    .c-orange { color: var(--orange); }
    .bg-green  { background: var(--green); }
    .bg-pink   { background: var(--pink); }
    .bg-orange { background: var(--orange); }

    .left-brand {
      position: relative;
      z-index: 2;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .brand-icon {
      width: 36px;
      height: 36px;
      background: linear-gradient(135deg, var(--purple), #5b3de8);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
    }

    .brand-name {
      font-family: 'Syne', sans-serif;
      font-size: 22px;
      font-weight: 800;
    }

    .brand-name span { color: var(--purple-lt); }

    .left-hero {
      position: relative;
      z-index: 2;
    }

    .left-hero h1 {
      font-family: 'Syne', sans-serif;
      font-size: clamp(32px, 3.5vw, 48px);
      font-weight: 800;
      line-height: 1.15;
      margin-bottom: 16px;
    }

    .left-hero h1 .accent {
      background: linear-gradient(90deg, var(--purple-lt), var(--green));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .left-hero p {
      color: var(--muted);
      font-size: 15px;
      line-height: 1.65;
      max-width: 360px;
    }

    .left-foot {
      position: relative;
      z-index: 2;
      display: flex;
      gap: 24px;
    }

    .stat-chip {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 12px;
      color: var(--muted);
    }

    .stat-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
    }

    /* ── RIGHT PANEL (LOGIN FORM) ─────────────────── */
    .right {
      width: 460px;
      flex-shrink: 0;
      background: var(--surface);
      border-left: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 48px 48px;
      position: relative;
      overflow: hidden;
    }

    /* Subtle glow top-right */
    .right::before {
      content: '';
      position: absolute;
      top: -80px;
      right: -60px;
      width: 260px;
      height: 260px;
      background: radial-gradient(circle, rgba(124,92,252,.2) 0%, transparent 70%);
      pointer-events: none;
    }

    .form-wrap {
      width: 100%;
      max-width: 360px;
      animation: slideUp .55s cubic-bezier(.22,1,.36,1) both;
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(28px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .form-header {
      margin-bottom: 36px;
    }

    .form-header h2 {
      font-family: 'Syne', sans-serif;
      font-size: 28px;
      font-weight: 800;
      margin-bottom: 6px;
    }

    .form-header p {
      font-size: 14px;
      color: var(--muted);
    }

    /* Avatar row */
    .avatar-row {
      display: flex;
      align-items: center;
      gap: -8px;
      margin-bottom: 6px;
    }

    .avatar {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      border: 2px solid var(--surface);
      margin-right: -8px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
      font-weight: 700;
    }

    .av1 { background: linear-gradient(135deg,#7c5cfc,#5b3de8); }
    .av2 { background: linear-gradient(135deg,#00e096,#00b874); }
    .av3 { background: linear-gradient(135deg,#ff4d94,#cc1166); }

    .avatar-text {
      font-size: 12px;
      color: var(--muted);
      margin-left: 18px;
    }

    /* Divider */
    .divider {
      display: flex;
      align-items: center;
      gap: 12px;
      margin: 28px 0;
      color: var(--muted);
      font-size: 12px;
    }

    .divider::before,
    .divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--border);
    }

    /* Field */
    .field {
      margin-bottom: 18px;
    }

    label {
      display: block;
      font-size: 12px;
      font-weight: 500;
      color: var(--muted);
      margin-bottom: 7px;
      letter-spacing: .04em;
      text-transform: uppercase;
    }

    .input-wrap {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--muted);
      font-size: 15px;
      pointer-events: none;
      transition: color .2s;
    }

    input[type=text],
    input[type=email],
    input[type=password] {
      width: 100%;
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 12px 40px 12px 42px;
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: 14px;
      outline: none;
      transition: border-color .2s, box-shadow .2s;
    }

    input:focus {
      border-color: var(--purple);
      box-shadow: 0 0 0 3px rgba(124,92,252,.15);
    }

    input:focus + .input-focus-ring { opacity: 1; }

    input:focus ~ .input-icon { color: var(--purple-lt); }

    .eye-btn {
      position: absolute;
      right: 13px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: var(--muted);
      cursor: pointer;
      font-size: 16px;
      padding: 2px;
      transition: color .2s;
    }

    .eye-btn:hover { color: var(--text); }

    /* Options row */
    .opt-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 28px;
    }

    .check-label {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: 13px;
      color: var(--muted);
      cursor: pointer;
      user-select: none;
    }

    .check-label input { display: none; }

    .custom-check {
      width: 16px;
      height: 16px;
      border: 1.5px solid var(--border);
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all .2s;
      flex-shrink: 0;
      font-size: 10px;
    }

    .check-label input:checked ~ .custom-check {
      background: var(--purple);
      border-color: var(--purple);
      color: white;
    }

    .forgot {
      font-size: 13px;
      color: var(--purple-lt);
      text-decoration: none;
      transition: opacity .2s;
    }

    .forgot:hover { opacity: .7; }

    /* CTA button */
    .btn-login {
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, var(--purple), #5b3de8);
      border: none;
      border-radius: 10px;
      color: white;
      font-family: 'Syne', sans-serif;
      font-size: 15px;
      font-weight: 700;
      cursor: pointer;
      position: relative;
      overflow: hidden;
      transition: transform .15s, box-shadow .2s;
      box-shadow: 0 6px 24px rgba(124,92,252,.35);
      letter-spacing: .03em;
    }

    .btn-login::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, rgba(255,255,255,.12), transparent);
      opacity: 0;
      transition: opacity .2s;
    }

    .btn-login:hover { transform: translateY(-1px); box-shadow: 0 10px 32px rgba(124,92,252,.5); }
    .btn-login:hover::before { opacity: 1; }
    .btn-login:active { transform: translateY(0); }

    .btn-shine {
      position: absolute;
      top: 0; left: -100%;
      width: 60%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,.15), transparent);
      animation: shine 2.5s ease-in-out infinite;
    }

    @keyframes shine {
      0%   { left: -100%; }
      40%, 100% { left: 150%; }
    }

    /* Google SSO */
    .btn-google {
      width: 100%;
      margin-bottom: 20px;
      padding: 12px;
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 10px;
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      transition: border-color .2s, background .2s;
    }

    .btn-google:hover {
      background: rgba(255,255,255,.04);
      border-color: rgba(255,255,255,.15);
    }

    .google-icon {
      width: 18px;
      height: 18px;
    }

    /* Footer */
    .form-foot {
      text-align: center;
      margin-top: 28px;
      font-size: 13px;
      color: var(--muted);
    }

    .form-foot a {
      color: var(--purple-lt);
      text-decoration: none;
      font-weight: 500;
    }

    .form-foot a:hover { text-decoration: underline; }

    /* Responsive */
    @media (max-width: 860px) {
      .left { display: none; }
      .right { width: 100%; border: none; }
    }
  </style>
</head>
<body>

<!-- ───── LEFT ───── -->
<div class="left">
  <!-- Floating stat cards -->
  <div class="float-cards">
    <div class="fcard">
      <div class="fcard-label">Total Tugas</div>
      <div class="fcard-val c-purple-lt" style="color:var(--purple-lt)">12</div>
      <div class="fcard-sub">↑ 4 tugas baru minggu ini</div>
      <div class="fcard-bar"><div class="fcard-bar-fill" style="width:75%;background:var(--purple)"></div></div>
    </div>
    <div class="fcard">
      <div class="fcard-label">Selesai</div>
      <div class="fcard-val c-green">8</div>
      <div class="fcard-sub">67% dari total tugas</div>
      <div class="fcard-bar"><div class="fcard-bar-fill bg-green" style="width:67%"></div></div>
    </div>
    <div class="fcard">
      <div class="fcard-label">Terlambat</div>
      <div class="fcard-val c-pink">2</div>
      <div class="fcard-sub">⚠ Segera diselesaikan!</div>
      <div class="fcard-bar"><div class="fcard-bar-fill bg-pink" style="width:25%"></div></div>
    </div>
  </div>

  <!-- Brand -->
  <div class="left-brand">
    <div class="brand-icon">✦</div>
    <div class="brand-name">Task<span>Track</span></div>
  </div>

  <!-- Hero copy -->
  <div class="left-hero">
    <h1>Kelola tugasmu<br/><span class="accent">lebih cerdas.</span></h1>
    <p>Pantau progress, lacak deadline, dan raih produktivitas maksimal — semua dalam satu dashboard yang intuitif.</p>
  </div>

  <!-- Bottom stats -->
  <div class="left-foot">
    <div class="stat-chip">
      <div class="stat-dot" style="background:var(--green)"></div>
      500+ pengguna aktif
    </div>
    <div class="stat-chip">
      <div class="stat-dot" style="background:var(--purple)"></div>
      98% kepuasan
    </div>
    <div class="stat-chip">
      <div class="stat-dot" style="background:var(--orange)"></div>
      Gratis selamanya
    </div>
  </div>
</div>

<!-- ───── RIGHT (FORM) ───── -->
<div class="right">
  <div class="form-wrap">

    <div class="form-header">
      <div class="avatar-row">
        <span class="avatar av1">S</span>
        <span class="avatar av2">A</span>
        <span class="avatar av3">R</span>
        <span class="avatar-text">Bergabung bersama ribuan pengguna</span>
      </div>
      <h2>Selamat Datang 👋</h2>
      <p>Masuk ke akun TaskTrack kamu</p>
    </div>

    <!-- start login form -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
    <div class="divider">atau masuk dengan email</div>

    <!-- Email field -->
    <div class="field">
      <label>Email</label>
      <div class="input-wrap">
        <span class="input-icon">✉</span>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="kamu@email.com" />
      </div>
      @error('email')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
    </div>

    <!-- Password field -->
    <div class="field">
      <label>Password</label>
      <div class="input-wrap">
        <span class="input-icon">🔒</span>
        <input type="password" id="pwd" name="password" required placeholder="Masukkan password" />
        <button class="eye-btn" onclick="togglePwd()" id="eyeBtn" title="Tampilkan password">👁</button>
      </div>
      @error('password')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
    </div>

    <!-- Options -->
    <div class="opt-row">
      <label class="check-label">
        <input type="checkbox" name="remember" />
        <span class="custom-check">✓</span>
        Ingat saya
      </label>
      <a href="{{ route('password.request') }}" class="forgot">Lupa password?</a>
    </div>

    <!-- Submit -->
    <button class="btn-login">
      <span class="btn-shine"></span>
      Masuk Sekarang →
    </button>

    <!-- Footer -->
    <div class="form-foot">
      Belum punya akun? <a href="{{ route('register') }}">Daftar gratis</a>
    </div>
    </form>

  </div>
</div>

<script>
  function togglePwd() {
    const input = document.getElementById('pwd');
    const btn = document.getElementById('eyeBtn');
    if (input.type === 'password') {
      input.type = 'text';
      btn.textContent = '🙈';
    } else {
      input.type = 'password';
      btn.textContent = '👁';
    }
  }
</script>
</body>
</html>
