<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>TaskTrack — Daftar</title>
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

    /* ── LEFT PANEL ── */
    .left {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 48px 56px;
      position: relative;
      overflow: hidden;
    }

    .left::before {
      content: '';
      position: absolute;
      inset: 0;
      background:
        radial-gradient(ellipse 80% 60% at 15% 30%, rgba(0,224,150,.15) 0%, transparent 60%),
        radial-gradient(ellipse 60% 50% at 85% 70%, rgba(124,92,252,.15) 0%, transparent 55%),
        radial-gradient(ellipse 50% 40% at 50% 5%,  rgba(255,170,0,.08) 0%, transparent 50%);
      animation: meshShift 9s ease-in-out infinite alternate;
    }

    @keyframes meshShift {
      0%   { transform: scale(1)   rotate(0deg); }
      100% { transform: scale(1.1) rotate(-3deg); }
    }

    .left::after {
      content: '';
      position: absolute;
      inset: 0;
      background-image: radial-gradient(circle, rgba(255,255,255,.055) 1px, transparent 1px);
      background-size: 28px 28px;
      pointer-events: none;
    }

    /* Steps visual */
    .steps-visual {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      display: flex;
      flex-direction: column;
      gap: 18px;
      width: 300px;
      pointer-events: none;
      animation: floatUp 6s ease-in-out infinite;
    }

    @keyframes floatUp {
      0%, 100% { transform: translate(-50%,-50%) translateY(0); }
      50%       { transform: translate(-50%,-50%) translateY(-14px); }
    }

    .step-card {
      background: rgba(26,26,36,.8);
      border: 1px solid var(--border);
      backdrop-filter: blur(12px);
      border-radius: 14px;
      padding: 16px 20px;
      display: flex;
      align-items: center;
      gap: 14px;
      animation: fadeSlide .6s ease both;
    }

    .step-card:nth-child(1) { animation-delay: .1s; }
    .step-card:nth-child(2) { animation-delay: .25s; }
    .step-card:nth-child(3) { animation-delay: .4s; }
    .step-card:nth-child(4) { animation-delay: .55s; }

    @keyframes fadeSlide {
      from { opacity: 0; transform: translateX(-20px); }
      to   { opacity: 1; transform: translateX(0); }
    }

    .step-icon {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 17px;
      flex-shrink: 0;
    }

    .step-info { flex: 1; }
    .step-title { font-family: 'Syne', sans-serif; font-size: 13px; font-weight: 700; margin-bottom: 2px; }
    .step-desc  { font-size: 11px; color: var(--muted); }

    .step-badge {
      font-size: 10px;
      font-weight: 700;
      padding: 3px 8px;
      border-radius: 99px;
      letter-spacing: .05em;
    }

    .left-brand {
      position: relative;
      z-index: 2;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .brand-icon {
      width: 36px; height: 36px;
      background: linear-gradient(135deg, var(--purple), #5b3de8);
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-size: 18px;
    }

    .brand-name { font-family: 'Syne', sans-serif; font-size: 22px; font-weight: 800; }
    .brand-name span { color: var(--purple-lt); }

    .left-hero { position: relative; z-index: 2; }

    .left-hero h1 {
      font-family: 'Syne', sans-serif;
      font-size: clamp(30px, 3vw, 44px);
      font-weight: 800;
      line-height: 1.15;
      margin-bottom: 14px;
    }

    .left-hero h1 .accent {
      background: linear-gradient(90deg, var(--green), var(--orange));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .left-hero p { color: var(--muted); font-size: 14px; line-height: 1.7; max-width: 340px; }

    .left-foot {
      position: relative; z-index: 2;
      display: flex; gap: 24px;
    }

    .stat-chip { display: flex; align-items: center; gap: 8px; font-size: 12px; color: var(--muted); }
    .stat-dot  { width: 8px; height: 8px; border-radius: 50%; }

    /* ── RIGHT PANEL ── */
    .right {
      width: 480px;
      flex-shrink: 0;
      background: var(--surface);
      border-left: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 48px;
      position: relative;
      overflow: hidden;
      overflow-y: auto;
    }

    .right::before {
      content: '';
      position: absolute;
      top: -80px; right: -60px;
      width: 260px; height: 260px;
      background: radial-gradient(circle, rgba(0,224,150,.15) 0%, transparent 70%);
      pointer-events: none;
    }

    .right::after {
      content: '';
      position: absolute;
      bottom: -60px; left: -40px;
      width: 200px; height: 200px;
      background: radial-gradient(circle, rgba(124,92,252,.12) 0%, transparent 70%);
      pointer-events: none;
    }

    .form-wrap {
      width: 100%;
      max-width: 360px;
      animation: slideUp .55s cubic-bezier(.22,1,.36,1) both;
      position: relative;
      z-index: 1;
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(28px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .form-header { margin-bottom: 28px; }

    .progress-steps {
      display: flex;
      align-items: center;
      gap: 0;
      margin-bottom: 20px;
    }

    .ps-item {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 11px;
      color: var(--muted);
    }

    .ps-dot {
      width: 20px; height: 20px;
      border-radius: 50%;
      border: 1.5px solid var(--border);
      display: flex; align-items: center; justify-content: center;
      font-size: 10px;
      font-weight: 700;
      transition: all .3s;
    }

    .ps-item.active .ps-dot  { background: var(--green); border-color: var(--green); color: #000; }
    .ps-item.active          { color: var(--text); font-weight: 500; }
    .ps-item.done .ps-dot    { background: var(--purple); border-color: var(--purple); color: white; }

    .ps-line {
      flex: 1;
      height: 1px;
      background: var(--border);
      margin: 0 6px;
    }

    .form-header h2 {
      font-family: 'Syne', sans-serif;
      font-size: 26px;
      font-weight: 800;
      margin-bottom: 5px;
    }

    .form-header p { font-size: 13px; color: var(--muted); }

    /* Fields */
    .field { margin-bottom: 16px; }

    .field-row { display: flex; gap: 12px; }
    .field-row .field { flex: 1; }

    label {
      display: block;
      font-size: 11px;
      font-weight: 500;
      color: var(--muted);
      margin-bottom: 6px;
      letter-spacing: .05em;
      text-transform: uppercase;
    }

    .input-wrap { position: relative; }

    .input-icon {
      position: absolute;
      left: 13px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--muted);
      font-size: 14px;
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
      padding: 11px 38px 11px 40px;
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: 13.5px;
      outline: none;
      transition: border-color .2s, box-shadow .2s;
    }

    input:focus { border-color: var(--green); box-shadow: 0 0 0 3px rgba(0,224,150,.12); }
    input:focus ~ .input-icon { color: var(--green); }

    .eye-btn {
      position: absolute;
      right: 11px; top: 50%;
      transform: translateY(-50%);
      background: none; border: none;
      color: var(--muted);
      cursor: pointer; font-size: 14px;
      padding: 2px;
      transition: color .2s;
    }
    .eye-btn:hover { color: var(--text); }

    /* Strength bar */
    .strength-wrap { margin-top: 8px; }
    .strength-bars { display: flex; gap: 4px; margin-bottom: 4px; }
    .sbar {
      flex: 1; height: 3px; border-radius: 99px;
      background: var(--border);
      transition: background .3s;
    }
    .strength-label { font-size: 11px; color: var(--muted); }

    /* Terms */
    .terms-wrap {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      margin-bottom: 22px;
      margin-top: 4px;
    }

    .terms-wrap input { display: none; }

    .custom-check {
      width: 16px; height: 16px; flex-shrink: 0;
      border: 1.5px solid var(--border);
      border-radius: 4px;
      display: flex; align-items: center; justify-content: center;
      cursor: pointer;
      transition: all .2s;
      font-size: 9px;
      margin-top: 2px;
    }

    .terms-wrap input:checked ~ .custom-check {
      background: var(--green);
      border-color: var(--green);
      color: #000;
    }

    .terms-text { font-size: 12px; color: var(--muted); line-height: 1.55; cursor: pointer; }
    .terms-text a { color: var(--purple-lt); text-decoration: none; }
    .terms-text a:hover { text-decoration: underline; }

    /* CTA */
    .btn-register {
      width: 100%;
      padding: 13px;
      background: linear-gradient(135deg, var(--green), #00b874);
      border: none;
      border-radius: 10px;
      color: #0d0d12;
      font-family: 'Syne', sans-serif;
      font-size: 15px;
      font-weight: 800;
      cursor: pointer;
      position: relative;
      overflow: hidden;
      transition: transform .15s, box-shadow .2s;
      box-shadow: 0 6px 24px rgba(0,224,150,.3);
      letter-spacing: .03em;
    }

    .btn-register::before {
      content: '';
      position: absolute; inset: 0;
      background: linear-gradient(135deg, rgba(255,255,255,.18), transparent);
      opacity: 0;
      transition: opacity .2s;
    }

    .btn-register:hover { transform: translateY(-1px); box-shadow: 0 10px 32px rgba(0,224,150,.45); }
    .btn-register:hover::before { opacity: 1; }
    .btn-register:active { transform: translateY(0); }

    .btn-shine {
      position: absolute;
      top: 0; left: -100%;
      width: 60%; height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,.2), transparent);
      animation: shine 2.5s ease-in-out infinite;
    }

    @keyframes shine {
      0%         { left: -100%; }
      40%, 100%  { left: 150%; }
    }

    /* Divider */
    .divider {
      display: flex; align-items: center; gap: 12px;
      margin: 20px 0;
      color: var(--muted); font-size: 12px;
    }
    .divider::before, .divider::after {
      content: ''; flex: 1; height: 1px; background: var(--border);
    }

    /* Google */
    .btn-google {
      width: 100%;
      padding: 11px;
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: 10px;
      color: var(--text);
      font-family: 'DM Sans', sans-serif;
      font-size: 13px;
      font-weight: 500;
      cursor: pointer;
      display: flex; align-items: center; justify-content: center; gap: 10px;
      transition: border-color .2s, background .2s;
    }
    .btn-google:hover { background: rgba(255,255,255,.04); border-color: rgba(255,255,255,.14); }

    .form-foot {
      text-align: center;
      margin-top: 22px;
      font-size: 13px;
      color: var(--muted);
    }
    .form-foot a { color: var(--purple-lt); text-decoration: none; font-weight: 500; }
    .form-foot a:hover { text-decoration: underline; }

    @media (max-width: 860px) {
      .left { display: none; }
      .right { width: 100%; border: none; }
    }
  </style>
</head>
<body>

<!-- ── LEFT ── -->
<div class="left">

  <!-- Floating step cards -->
  <div class="steps-visual">
    <div class="step-card">
      <div class="step-icon" style="background:rgba(0,224,150,.15)">✏️</div>
      <div class="step-info">
        <div class="step-title" style="color:var(--green)">Buat Akun</div>
        <div class="step-desc">Daftar gratis dalam 30 detik</div>
      </div>
      <span class="step-badge" style="background:rgba(0,224,150,.15);color:var(--green)">1</span>
    </div>
    <div class="step-card">
      <div class="step-icon" style="background:rgba(124,92,252,.15)">📋</div>
      <div class="step-info">
        <div class="step-title" style="color:var(--purple-lt)">Tambah Tugas</div>
        <div class="step-desc">Mulai atur semua tugasmu</div>
      </div>
      <span class="step-badge" style="background:rgba(124,92,252,.15);color:var(--purple-lt)">2</span>
    </div>
    <div class="step-card">
      <div class="step-icon" style="background:rgba(255,170,0,.15)">🎯</div>
      <div class="step-info">
        <div class="step-title" style="color:var(--orange)">Lacak Progress</div>
        <div class="step-desc">Pantau deadline & status</div>
      </div>
      <span class="step-badge" style="background:rgba(255,170,0,.15);color:var(--orange)">3</span>
    </div>
    <div class="step-card">
      <div class="step-icon" style="background:rgba(255,77,148,.15)">🏆</div>
      <div class="step-info">
        <div class="step-title" style="color:var(--pink)">Raih Target</div>
        <div class="step-desc">Produktivitas meningkat 3x</div>
      </div>
      <span class="step-badge" style="background:rgba(255,77,148,.15);color:var(--pink)">4</span>
    </div>
  </div>

  <!-- Brand -->
  <div class="left-brand">
    <div class="brand-icon">✦</div>
    <div class="brand-name">Task<span>Track</span></div>
  </div>

  <!-- Hero -->
  <div class="left-hero">
    <h1>Mulai perjalanan<br/><span class="accent">produktifmu.</span></h1>
    <p>Daftar sekarang dan rasakan perbedaannya. Gratis selamanya, tanpa kartu kredit.</p>
  </div>

  <!-- Bottom -->
  <div class="left-foot">
    <div class="stat-chip"><div class="stat-dot" style="background:var(--green)"></div>Gratis selamanya</div>
    <div class="stat-chip"><div class="stat-dot" style="background:var(--purple)"></div>Setup 30 detik</div>
    <div class="stat-chip"><div class="stat-dot" style="background:var(--orange)"></div>Tanpa kartu kredit</div>
  </div>
</div>

<!-- ── RIGHT ── -->
<div class="right">
  <div class="form-wrap">

    <!-- Progress indicator -->
    <div class="progress-steps">
      <div class="ps-item active">
        <div class="ps-dot">1</div>
        <span>Akun</span>
      </div>
      <div class="ps-line"></div>
      <div class="ps-item">
        <div class="ps-dot">2</div>
        <span>Verifikasi</span>
      </div>
      <div class="ps-line"></div>
      <div class="ps-item">
        <div class="ps-dot">3</div>
        <span>Selesai</span>
      </div>
    </div>

    <div class="form-header">
      <h2>Buat Akun Baru 🚀</h2>
      <p>Isi data di bawah untuk memulai perjalananmu</p>
    </div>

    <!-- start form -->
    <form method="POST" action="{{ route('register') }}">
        @csrf
    <!-- Name -->
    <div class="field">
      <label>Nama Lengkap</label>
      <div class="input-wrap">
        <span class="input-icon">👤</span>
        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Santi Dewi" />
      </div>
      @error('name')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
    </div>

    <!-- Email -->
    <div class="field">
      <label>Email</label>
      <div class="input-wrap">
        <span class="input-icon">✉</span>
        <input type="email" name="email" value="{{ old('email') }}" required placeholder="kamu@email.com" />
      </div>
      @error('email')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
    </div>

    <!-- Password -->
    <div class="field">
      <label>Password</label>
      <div class="input-wrap">
        <span class="input-icon">🔒</span>
        <input type="password" id="pwd1" name="password" required placeholder="Min. 8 karakter" oninput="checkStrength(this.value)" />
        <button class="eye-btn" onclick="toggle('pwd1','eye1')" id="eye1">👁</button>
      </div>
      @error('password')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
      <div class="strength-wrap">
        <div class="strength-bars">
          <div class="sbar" id="sb1"></div>
          <div class="sbar" id="sb2"></div>
          <div class="sbar" id="sb3"></div>
          <div class="sbar" id="sb4"></div>
        </div>
        <div class="strength-label" id="slabel">Masukkan password</div>
      </div>
    </div>

    <!-- Confirm password -->
    <div class="field">
      <label>Konfirmasi Password</label>
      <div class="input-wrap">
        <span class="input-icon">🔒</span>
        <input type="password" id="pwd2" name="password_confirmation" required placeholder="Ulangi password" oninput="checkMatch()" />
        <button class="eye-btn" onclick="toggle('pwd2','eye2')" id="eye2">👁</button>
      </div>
    </div>

    <!-- Terms -->
    <div class="terms-wrap" onclick="toggleCheck()">
      <input type="checkbox" id="terms" name="terms" required />
      <div class="custom-check" id="chk">✓</div>
      <div class="terms-text">
        Saya menyetujui <a href="#">Syarat & Ketentuan</a> serta
        <a href="#">Kebijakan Privasi</a> TaskTrack
      </div>
    </div>

    <!-- Register button -->
    <button type="submit" class="btn-register">
      <span class="btn-shine"></span>
      Buat Akun Sekarang →
    </button>

    <div class="form-foot">
      Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
    </div>
    </form>
  </div>
</div>

<script>
  function toggle(id, btnId) {
    const input = document.getElementById(id);
    const btn   = document.getElementById(btnId);
    if (input.type === 'password') { input.type = 'text';     btn.textContent = '🙈'; }
    else                           { input.type = 'password'; btn.textContent = '👁'; }
  }

  let checked = false;
  function toggleCheck() {
    checked = !checked;
    const chk = document.getElementById('chk');
    const inp = document.getElementById('terms');
    inp.checked = checked;
    chk.style.background     = checked ? 'var(--green)' : '';
    chk.style.borderColor    = checked ? 'var(--green)' : 'var(--border)';
    chk.style.color          = checked ? '#000' : '';
  }

  function checkStrength(val) {
    const bars   = [1,2,3,4].map(i => document.getElementById('sb'+i));
    const label  = document.getElementById('slabel');
    const colors = ['#ff4d4d','var(--orange)','var(--orange)','var(--green)'];
    const labels = ['Sangat Lemah','Lemah','Cukup Kuat','Kuat 💪'];

    let score = 0;
    if (val.length >= 8)              score++;
    if (/[A-Z]/.test(val))           score++;
    if (/[0-9]/.test(val))           score++;
    if (/[^A-Za-z0-9]/.test(val))    score++;

    bars.forEach((b, i) => {
      b.style.background = i < score ? colors[Math.min(score-1, 3)] : 'var(--border)';
    });

    label.textContent  = val.length === 0 ? 'Masukkan password' : labels[Math.min(score-1, 3)] || 'Sangat Lemah';
    label.style.color  = val.length === 0 ? 'var(--muted)' : colors[Math.min(score-1, 3)];
  }

  function checkMatch() {
    const p1 = document.getElementById('pwd1');
    const p2 = document.getElementById('pwd2');
    if (p2.value.length === 0) { p2.style.borderColor = 'var(--border)'; return; }
    p2.style.borderColor = p1.value === p2.value ? 'var(--green)' : 'var(--pink)';
  }
</script>
</body>
</html>
