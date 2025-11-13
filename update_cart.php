<?php
session_start();
require 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: view_cart.php'); exit; }
$cart_item_id = (int)($_POST['cart_item_id'] ?? 0);
$quantity = max(1, (int)($_POST['quantity'] ?? 1));

$stmt = $pdo->prepare("UPDATE cart_items SET quantity = :qty WHERE cart_item_id = :id");
$stmt->execute([':qty' => $quantity, ':id' => $cart_item_id]);

header('Location: view_cart.php');
exit;
?>