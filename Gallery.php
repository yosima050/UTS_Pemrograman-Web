<?php
session_start();
require 'db_config.php';

$photos = [];
try {
    $stmt = $pdo->query("SELECT id, title, image_url, price FROM photos ORDER BY id ASC");
    $photos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: Gagal mengambil data galeri. " . htmlspecialchars($e->getMessage());
    exit;
}
?>

<?php include 'header.php'; ?>

<main class="container-fluid py-1 flex-fill">
  <div class="bg-white rounded shadow-sm p-4 mt-1">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="h3 mb-0 fw-bold text-dark">Galeri Foto</h1>
      <a class="btn fw-bold text-dark" href="view_cart.php" style="background-color: #C3F73A; border-color: #C3F73A;">
          <i class="bi bi-cart3 me-2"></i>View Cart
      </a>
    </div>

    <?php if (isset($_GET['added'])): ?>
      <div class="alert alert-success">Item berhasil ditambahkan ke cart.</div>
    <?php endif; ?>

    <?php if (empty($photos)): ?>
      <div class="alert alert-secondary text-center">Tidak ada foto untuk ditampilkan.</div>
    <?php else: ?>
      <div class="row g-4">
        <?php foreach ($photos as $photo): ?>
          <div class="col-6 col-md-4 col-lg-3">
            <div class="card h-100 shadow-sm">
              <div class="ratio ratio-4x3">
                <img
                  src="<?= htmlspecialchars($photo['image_url']) ?>"
                  alt="<?= htmlspecialchars($photo['title']) ?>"
                  class="card-img-top img-fluid"
                  style="object-fit:cover;"
                  loading="lazy"
                >
              </div>

              <div class="card-body d-flex flex-column">
                <h5 class="card-title mb-1"><?= htmlspecialchars($photo['title']) ?></h5>
                <p class="text-muted small mb-3">ID <?= (int)$photo['id'] ?></p>
                <div class="mt-auto d-flex justify-content-between align-items-center">
                  <div class="fw-bold" style="color: #0D1F22;">Rp <?= number_format($photo['price'], 0, ',', '.') ?></div>

                  <form method="post" action="add_to_cart.php" class="d-flex gap-2 align-items-center m-0">
                    <input type="hidden" name="photo_id" value="<?= (int)$photo['id'] ?>">
                    <input type="number" name="quantity" value="1" min="1" class="form-control form-control-sm" style="width:72px;">
                    <button type="submit" class="btn btn-sm" style="background-color: #C3F73A; border-color: #C3F73A; color: #000;">Add</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</main>

<?php include 'footer.php'; ?>