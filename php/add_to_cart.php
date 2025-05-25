<?php
session_start();

$id = $_POST['id'];
$quantity = intval($_POST['quantity']);
$found = false;

$items = $_SESSION['cart'] ?? [];

for ($i = 0; $i < count($items); $i++) {
    if ($items[$i][0] == $id) {
        $items[$i][1] += $quantity;
        $found = true;
        break;
    }
}

if (!$found) {
    $items[] = [$id, $quantity];
}

$_SESSION['cart'] = $items;
?>
