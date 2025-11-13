<?php
session_start();
require 'db_config.php';

$errors = [];
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $errors[] = 'Email dan password wajib diisi.';
    } else {
        $stmt = $pdo->prepare("SELECT id, email, password_hash, name FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = (int)$user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = !empty($user['name']) ? $user['name'] : $user['email'];
            header('Location: index.php');
            exit;
        } else {
            $errors[] = 'Email atau password salah.';
        }
    }
}
?>

<?php include 'header.php'; ?>

<style>
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .main-header {
        position: relative !important; 
    }

    main.flex-fill {
        flex: 1 1 auto; 

        display: grid;
        place-items: center;
    }
</style>
<main class="container-fluid flex-fill">
  <div class="bg-white rounded shadow-sm p-4 mx-auto" style="max-width:420px;">
    <h3 class="mb-3 text-center">Sign in to PhotoStock</h3>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $err): ?>
          <div><?= htmlspecialchars($err) ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form method="post" action="login.php" novalidate>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input id="email" name="email" type="email" class="form-control" required value="<?= htmlspecialchars($email) ?>">
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input id="password" name="password" type="password" class="form-control" required>
      </div>

      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary" style="background-color: #C3F73A; border-color: #C3F73A; color: #000;">Sign in</button>
        <a href="Gallery.php" class="btn btn-outline-secondary">Continue browsing</a>
      </div>

      <div class="text-center mt-3 small">
        Belum punya akun? <a href="register.php">Register</a>
      </div>
    </form>
  </div>
</main>

<?php include 'footer.php'; ?>