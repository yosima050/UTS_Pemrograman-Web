<?php
session_start();
require 'db_config.php';

$sid = session_id();
$stmt = $pdo->prepare("DELETE FROM cart_items WHERE cart_id = (SELECT cart_id FROM carts WHERE session_id = :sid)");
$stmt->execute([':sid' => $sid]);
$stmt = $pdo->prepare("DELETE FROM carts WHERE session_id = :sid");
$stmt->execute([':sid' => $sid]);

header('Location: view_cart.php?checkedout=1');
exit;
?>