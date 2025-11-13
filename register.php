<?php
session_start();
require 'db_config.php';

$errors = [];
$email = '';
$name = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $name = trim($_POST['name'] ?? '');

    if ($email === '' || $password === '') {
        $errors[] = 'Email dan password wajib diisi.';
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        if ($stmt->fetch()) {
            $errors[] = 'Email sudah terdaftar.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (email, password_hash, name) VALUES (:email, :hash, :name) RETURNING id");
            $stmt->execute([':email' => $email, ':hash' => $hash, ':name' => $name ?: null]);
            $newId = $stmt->fetchColumn();
            
            $_SESSION['user_id'] = (int)$newId;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_name'] = $name ?: $email;
            header('Location: index.php');
            exit;
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
  <div class="bg-white rounded shadow-sm p-4 mx-auto" style="width: 100%; max-width:550px;">
    <h3 class="mb-3 text-center">Register</h3>
    <?php if ($errors): ?>
      <div class="alert alert-danger"><?php foreach ($errors as $e) echo '<div>'.htmlspecialchars($e).'</div>'; ?></div>
    <?php endif; ?>
    <form method="post" action="register.php" novalidate>
      <div class="mb-3"><label class="form-label">Name</label><input name="name" class="form-control" value="<?=htmlspecialchars($name)?>"></div>
      <div class="mb-3"><label class="form-label">Email</label><input name="email" type="email" class="form-control" required value="<?=htmlspecialchars($email)?>"></div>
      <div class="mb-3"><label class="form-label">Password</label><input name="password" type="password" class="form-control" required></div>
      <div class="d-grid"><button class="btn btn-primary" style="background-color: #C3F73A; border-color: #C3F73A; color: #000;">Register</button></div>
    </form>
  </div>
</main>

<?php include 'footer.php'; ?>