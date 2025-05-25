<?php
    session_start();
    $items = $_SESSION['cart'];
    for($i = 0; $i < count($items); $i++){
        if ($items[$i][0] == $_POST['id']){
            $item = $items[$i];
            $item[1] = intval($_POST['quantity']);
            $items[$i] = $item;
        }
    }
    $_SESSION['cart'] = $items
?>