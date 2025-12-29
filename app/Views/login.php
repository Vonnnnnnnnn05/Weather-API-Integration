<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root{
      /* Brown Theme */
      --bg:#fbf7f2;           /* warm off-white */
      --text:#2a1a12;         /* deep cocoa */
      --muted:#6f5a4e;        /* muted brown */
      --line:#2a1a12;         /* cocoa line */
      --soft:#eadfd6;         /* soft beige */
      --panel:#ffffff;        /* panel */
      --accent:#6b3f2a;       /* espresso brown */
      --accent2:#a66a47;      /* caramel */
      --danger:#8b2e1a;       /* brick */
    }

    body{
      background: var(--bg);
      color: var(--text);
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
      min-height: 100vh;
      margin: 0;
      padding: 0;
    }

    .mono-container{
      min-height: 100vh;
      display:flex;
      align-items:center;
      justify-content:center;
      padding: 20px;
      background:
        radial-gradient(circle at 18% 25%, rgba(107,63,42,0.12) 0%, transparent 45%),
        radial-gradient(circle at 80% 75%, rgba(166,106,71,0.10) 0%, transparent 45%),
        linear-gradient(180deg, rgba(111,90,78,0.05), transparent 40%);
    }

    .mono-card{
      width: 100%;
      max-width: 450px;
      background: rgba(255,255,255,0.92);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(42,26,18,0.18);
      border-radius: 16px;
      overflow:hidden;
      box-shadow:
        0 10px 34px rgba(42,26,18,0.14),
        0 0 0 1px rgba(42,26,18,0.04);
    }

    .mono-header{
      background: linear-gradient(135deg, var(--accent), #3a2319);
      padding: 32px 28px;
      text-align:center;
      position: relative;
      overflow:hidden;
      color:#fff;
    }

    .mono-header::before{
      content:'';
      position:absolute;
      top:0; left:0; right:0; bottom:0;
      background: linear-gradient(45deg, transparent 30%, rgba(255,255,255,0.16) 50%, transparent 70%);
      animation: shine 3.2s infinite;
    }

    @keyframes shine{
      0%{ transform: translateX(-120%); }
      100%{ transform: translateX(120%); }
    }

    .logo-text{
      font-size: 22px;
      font-weight: 900;
      letter-spacing: .4px;
      margin:0;
      position: relative;
      text-transform: uppercase;
    }

    .mono-body{ padding: 34px; }

    .login-title{
      font-size: 28px;
      font-weight: 900;
      text-align:center;
      margin-bottom: 6px;
      color: var(--text);
    }

    .login-subtitle{
      color: var(--muted);
      text-align:center;
      margin-bottom: 22px;
      font-size: 14px;
      letter-spacing: .3px;
    }

    .form-label{
      color: var(--text);
      font-weight: 800;
      font-size: 11px;
      margin-bottom: 8px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .form-control{
      background: #fff;
      border: 2px solid rgba(42,26,18,0.18);
      border-radius: 12px;
      color: var(--text);
      padding: 12px 14px;
      font-size: 14px;
      transition: all .25s ease;
    }

    .form-control:hover{
      border-color: rgba(107,63,42,0.35);
    }

    .form-control:focus{
      border-color: var(--accent) !important;
      box-shadow: 0 0 0 3px rgba(107,63,42,0.16) !important;
      outline:none;
    }

    .form-control::placeholder{ color: rgba(42,26,18,0.35); }

    .btn-mono{
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      border: 1px solid rgba(42,26,18,0.22);
      border-radius: 999px;
      color: #fff;
      font-weight: 900;
      font-size: 13px;
      padding: 14px;
      width: 100%;
      transition: all 0.25s ease;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin-top: 6px;
      position: relative;
      overflow:hidden;
    }

    .btn-mono:hover{
      transform: translateY(-2px);
      box-shadow: 0 12px 24px rgba(42,26,18,0.18);
      color:#fff;
    }

    .btn-mono:active{ transform: translateY(0); }

    .btn-mono::after{
      content:'';
      position:absolute;
      top:0; left:0; right:0; bottom:0;
      background: linear-gradient(135deg, transparent 30%, rgba(255,255,255,0.18) 50%, transparent 70%);
      opacity: 0;
      transition: opacity .25s;
    }
    .btn-mono:hover::after{ opacity: 1; }

    .alert{
      border-radius: 12px;
      border: 1px solid rgba(42,26,18,0.18);
      font-size: 14px;
      padding: 12px 14px;
      margin-bottom: 16px;
      background: #fff7ee;
      color: var(--text);
      animation: slideIn .25s ease;
    }

    @keyframes slideIn{
      from{ opacity:0; transform: translateY(-8px); }
      to{ opacity:1; transform: translateY(0); }
    }

    .wave-line{
      height: 2px;
      background: linear-gradient(90deg, transparent, rgba(107,63,42,0.65), transparent);
      margin: 22px 0;
      opacity: .35;
    }

    .mono-footer{
      text-align:center;
      margin-top: 18px;
      color: var(--muted);
      font-size: 12px;
    }

    .mono-footer a{
      color: var(--accent);
      text-decoration:none;
      border-bottom: 1px solid rgba(107,63,42,0.55);
      padding-bottom: 1px;
      font-weight: 700;
    }
    .mono-footer a:hover{ opacity: .8; }

    /* Loading animation */
    .btn-mono.loading{
      position: relative;
      color: transparent !important;
    }
    .btn-mono.loading::before{
      content:'';
      position:absolute;
      top:50%; left:50%;
      width: 20px; height: 20px;
      margin:-10px 0 0 -10px;
      border: 2px solid rgba(255,255,255,0.40);
      border-top-color: #fff;
      border-radius: 50%;
      animation: spin .6s linear infinite;
    }
    @keyframes spin{ to{ transform: rotate(360deg); } }

    @media (max-width: 480px){
      .mono-body{ padding: 28px 20px; }
      .login-title{ font-size: 24px; }
      .mono-card{ border-radius: 12px; }
    }
  </style>
</head>

<body>
<div class="mono-container">
  <div class="mono-card">

    <div class="mono-header">
      <h1 class="logo-text">Weather Tracker</h1>
    </div>

    <div class="mono-body">
      <h2 class="login-title">Welcome Back</h2>
      <p class="login-subtitle">Sign in to continue</p>

      <!-- Error / Success Messages -->
      <?php if(session()->getFlashdata('error')): ?>
        <div class="alert"><?= esc(session()->getFlashdata('error')) ?></div>
      <?php endif; ?>

      <?php if(session()->getFlashdata('success')): ?>
        <div class="alert"><?= esc(session()->getFlashdata('success')) ?></div>
      <?php endif; ?>

      <?php if (isset($_GET['logout']) && $_GET['logout'] == '1'): ?>
        <div class="alert">Successfully logged out</div>
      <?php endif; ?>

      <?php if(isset($validation) && $validation->hasError('username')): ?>
        <div class="alert"><?= esc($validation->getError('username')) ?></div>
      <?php endif; ?>

      <?php if(isset($validation) && $validation->hasError('password')): ?>
        <div class="alert"><?= esc($validation->getError('password')) ?></div>
      <?php endif; ?>

      <form action="<?= base_url('login') ?>" method="post" id="loginForm">
        <?= csrf_field() ?>

        <div class="mb-4">
          <label for="username" class="form-label">Username</label>
          <input
            type="text"
            name="username"
            id="username"
            class="form-control"
            required
            placeholder="Enter your username"
            autocomplete="username"
            value="<?= old('username') ?>"
          >
        </div>

        <div class="mb-4">
          <label for="password" class="form-label">Password</label>
          <input
            type="password"
            name="password"
            id="password"
            class="form-control"
            required
            placeholder="Enter your password"
            autocomplete="current-password"
          >
        </div>

        <div class="wave-line"></div>

        <button type="submit" class="btn btn-mono" id="loginButton">Sign In</button>
      </form>

      <div class="mono-footer">
        Need help? <a href="#">Contact Support</a>
      </div>
    </div>

  </div>
</div>

<script>
  document.getElementById('loginForm').addEventListener('submit', function() {
    const button = document.getElementById('loginButton');
    button.classList.add('loading');
    button.disabled = true;

    setTimeout(() => {
      button.classList.remove('loading');
      button.disabled = false;
    }, 3000);
  });

  const inputs = document.querySelectorAll('.form-control');
  inputs.forEach(input => {
    input.addEventListener('focus', function() {
      this.parentElement.style.transform = 'translateY(-2px)';
    });
    input.addEventListener('blur', function() {
      this.parentElement.style.transform = 'translateY(0)';
    });
  });
</script>

</body>
</html>
