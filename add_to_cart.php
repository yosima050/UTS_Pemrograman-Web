<?php
session_start();
require 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: Gallery.php');
    exit;
}

$photo_id = isset($_POST['photo_id']) ? (int)$_POST['photo_id'] : 0;
$quantity = isset($_POST['quantity']) ? max(1, (int)$_POST['quantity']) : 1;
$sid = session_id();

try {
    $pdo->beginTransaction();

    // get or create cart for this session
    $stmt = $pdo->prepare("SELECT cart_id FROM carts WHERE session_id = :sid");
    $stmt->execute([':sid' => $sid]);
    $cart = $stmt->fetch();

    if (!$cart) {
        $stmt = $pdo->prepare("INSERT INTO carts (session_id) VALUES (:sid) RETURNING cart_id");
        $stmt->execute([':sid' => $sid]);
        $cart_id = (int)$stmt->fetchColumn();
    } else {
        $cart_id = (int)$cart['cart_id'];
    }

    // get photo info
    $stmt = $pdo->prepare("SELECT id, title, price FROM photos WHERE id = :id");
    $stmt->execute([':id' => $photo_id]);
    $photo = $stmt->fetch();

    if (!$photo) {
        $pdo->rollBack();
        header('Location: Gallery.php?msg=notfound');
        exit;
    }

    // insert or update quantity
    $sql = "INSERT INTO cart_items (cart_id, photo_id, title, price, quantity)
            VALUES (:cart_id, :photo_id, :title, :price, :qty)
            ON CONFLICT (cart_id, photo_id)
            DO UPDATE SET quantity = cart_items.quantity + EXCLUDED.quantity, added_at = now()";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':cart_id' => $cart_id,
        ':photo_id' => $photo_id,
        ':title' => $photo['title'],
        ':price' => $photo['price'],
        ':qty' => $quantity
    ]);

    $pdo->commit();
    header('Location: Gallery.php?added=1');
    exit;
} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    echo "Error adding to cart.";
    exit;
}
?>