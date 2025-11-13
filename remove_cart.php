<?php
session_start();
require 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: view_cart.php'); exit; }
$cart_item_id = (int)($_POST['cart_item_id'] ?? 0);

$stmt = $pdo->prepare("DELETE FROM cart_items WHERE cart_item_id = :id");
$stmt->execute([':id' => $cart_item_id]);

header('Location: view_cart.php');
exit;
?>