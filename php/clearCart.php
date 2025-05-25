<?php
    session_start();
    $cart = $_SESSION['cart'];
    $cart = [];
    $_SESSION['cart'] = $cart;
    echo json_encode($_SESSION['cart']);
?>