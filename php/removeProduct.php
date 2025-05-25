<?php
    session_start();
    $cart = $_SESSION['cart'] ?? [];
    for($i = 0; $i < count($cart); $i++){
        if($cart[$i][0] == $_POST['id']){
            array_splice($cart, $i, 1);
        }
    }
    $_SESSION['cart'] = $cart;
?>