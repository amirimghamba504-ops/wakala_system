<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/classes/Auth.php';
require_once __DIR__ . '/classes/Csrf.php';

if (Auth::check()) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Csrf::verifyOrDie();
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Tafadhali jaza jina la mtumiaji na nywila.';
    } elseif (Auth::attempt($username, $password)) {
        header('Location: index.php');
        exit;
    } else {
        $error = 'Jina la mtumiaji au nywila si sahihi, au akaunti imezimwa.';
    }
}
?>
<!DOCTYPE html>
<html lang="sw">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ingia | <?= APP_NAME ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<div class="login-wrapper">
  <div class="card login-card shadow p-4">
    <div class="card-body">
      <div class="text-center mb-4">
        <i class="bi bi-cash-coin" style="font-size:2.5rem; color:#0b6e4f;"></i>
        <h4 class="fw-bold mt-2 mb-0"><?= APP_NAME ?></h4>
        <small class="text-muted">Wakala Mkuu na Wakala wa Kawaida</small>
      </div>
      <?php if ($error): ?>
        <div class="alert alert-danger py-2"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <form method="POST" action="login.php">
        <?= Csrf::field() ?>
        <div class="mb-3">
          <label class="form-label">Jina la Mtumiaji</label>
          <input type="text" name="username" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
          <label class="form-label">Nywila</label>
          <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-wakala w-100"><i class="bi bi-box-arrow-in-right"></i> Ingia</button>
      </form>
      <p class="text-center text-muted mt-3 mb-0" style="font-size:0.8rem;">
        Akaunti ya kwanza ya Wakala Mkuu: <code>mkuu</code> / <code>mkuu123</code>
      </p>
    </div>
  </div>
</div>
</body>
</html>
