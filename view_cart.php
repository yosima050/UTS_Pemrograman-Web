<?php
session_start();
require 'db_config.php';

$sid = session_id();
$stmt = $pdo->prepare("SELECT cart_id FROM carts WHERE session_id = :sid");
$stmt->execute([':sid' => $sid]);
$cart = $stmt->fetch(PDO::FETCH_ASSOC);

$items = [];
$total = 0.0;
if ($cart) {
    $cart_id = (int)$cart['cart_id'];
    $stmt = $pdo->prepare("SELECT cart_item_id, photo_id, title, price, quantity FROM cart_items WHERE cart_id = :cart_id ORDER BY added_at ASC");
    $stmt->execute([':cart_id' => $cart_id]);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($items as $it) {
        $total += (float)$it['price'] * (int)$it['quantity'];
    }
}
?>

<?php include 'header.php'; ?>

<main class="container py-5">
  <div class="bg-white rounded shadow-sm p-4 mx-auto" style="max-width:1150px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="h4 mb-0">Your Cart</h1>
      <a class="btn btn-outline-secondary" href="Gallery.php">Continue Shopping</a>
    </div>

    <?php if (empty($items)): ?>
      <div class="alert alert-info">Cart kosong. <a href="Gallery.php" class="link-primary">Kembali ke gallery</a></div>
    <?php else: ?>
      <div class="table-responsive">
        <table class="table align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th>Item</th>
              <th class="text-end">Price</th>
              <th style="width:140px;">Quantity</th>
              <th class="text-end">Subtotal</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($items as $it): ?>
              <tr>
                <td>
                  <div class="fw-semibold"><?= htmlspecialchars($it['title']) ?></div>
                  <small class="text-muted">ID: <?= (int)$it['photo_id'] ?></small>
                </td>
                <td class="text-end">Rp <?= number_format($it['price'], 0, ',', '.') ?></td>
                <td>
                  <form action="update_cart.php" method="post" class="d-flex gap-2 align-items-center">
                    <input type="hidden" name="cart_item_id" value="<?= (int)$it['cart_item_id'] ?>">
                    <input type="number" name="quantity" value="<?= (int)$it['quantity'] ?>" min="1" class="form-control form-control-sm" style="width:80px;">
                    <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                  </form>
                </td>
                <td class="text-end">Rp <?= number_format($it['price'] * $it['quantity'], 0, ',', '.') ?></td>
                <td class="text-end">
                  <form action="remove_cart.php" method="post" onsubmit="return confirm('Hapus item dari cart?');">
                    <input type="hidden" name="cart_item_id" value="<?= (int)$it['cart_item_id'] ?>">
                    <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>

    <div class="row mt-4">
      <div class="col-md-6 offset-md-6">
        <div class="card">
          <div class="card-body">
            <h6 class="mb-3">Order Summary</h6>
            <dl class="row mb-0">
              <dt class="col-6">Items</dt>
              <dd class="col-6 text-end"><?= count($items) ?></dd>

              <dt class="col-6">Subtotal</dt>
              <dd class="col-6 text-end">Rp <?= number_format($total, 0, ',', '.') ?></dd>

              <dt class="col-6">Estimated Shipping</dt>
              <dd class="col-6 text-end">Rp 0</dd>

              <dt class="col-6 fw-bold">Total</dt>
              <dd class="col-6 text-end fw-bold">Rp <?= number_format($total, 0, ',', '.') ?></dd>
            </dl>

            <div class="d-grid gap-2 mt-3">
              <a href="checkout.php" class="btn btn-success" >Checkout</a>
              <a href="Gallery.php" class="btn btn-outline-secondary">Continue Shopping</a>
            </div>

            <form action="clear_cart.php" method="post" class="mt-3 text-center">
              <button type="submit" class="btn btn-link text-danger p-0">Clear cart</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include 'footer.php'; ?>