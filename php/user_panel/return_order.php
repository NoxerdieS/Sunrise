<?php
    session_start();
    require_once("../dblogin.php");
    $sql = 'select user_id from user_order where order_id = ?';
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute([$_GET['id']]);
    $user_order_id = $stmt -> fetchColumn();
    if($user_order_id != $_SESSION['userId']){
        echo "Nie możesz zwrócić nieswojego zamówienia!";
    }else{
        $sql = 'update order_data set status = ? where order_id = ?';
        $stmt = $pdo -> prepare($sql);
        if($stmt -> execute([2, $_GET['id']])){// 0 - w realizacji (domyslne), 1 - zrealizowane, 2 - zwrócone
            echo "Zamówienie zostało anulowane/zwrócone!";
        }else{
            echo "Coś poszło nie tak.";
        }

    }