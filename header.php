<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/index.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <title>PhotoStock - Modern Images</title>

    <style>
      .navbar-custom { background-color: #0D1F22; }
      .navbar-custom .nav-link,
      .navbar-custom .navbar-brand { color: #C3F73A !important; }
      .navbar-custom .btn-upload { background: #C3F73A; color: #000; }
    </style>
</head>
<body>

<header>
  <nav class="navbar navbar-expand-md navbar-dark navbar-custom">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">PhotoStock</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navMain">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item"><a class="nav-link" href="plans.php">Join PhotoStock+</a></li>
          <li class="nav-item"><a class="nav-link" href="Gallery.php">Browse Images</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Upload</a></li>

          <?php if (!empty($_SESSION['user_email'])):
              $displayName = !empty($_SESSION['user_name']) ? $_SESSION['user_name'] : $_SESSION['user_email'];
          ?>
            <li class="nav-item d-flex align-items-center">
              <span class="nav-link disabled small">Hello, <?= htmlspecialchars($displayName) ?></span>
            </li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
          <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="login.php">Log in</a></li>
          <?php endif; ?>

            <li class="nav-item ms-2">
                <a class="btn btn-upload btn-sm d-flex align-items-center gap-2" href="contact.php">
              <i class="bi bi-upload"></i> Upload
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

</body>
</html>