<?php
    require_once('dblogin.php');
    session_start();
    function cleanData($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $login = cleanData($_POST['login']);
    $password = cleanData($_POST['password']);
    $userInfo = $pdo -> query('select id, pass, isAdmin, isActive from user where login like "'.$login.'";') -> fetch();
    if(empty($userInfo['pass'])){
        $_SESSION['loggedIn'] = false;
        echo 0;
    }else if(password_verify($password, $userInfo['pass'])){
        if($userInfo['isActive'] == 0){
            $_SESSION['loggedIn'] = false;
            echo 1;
        }else{
            $_SESSION['userId'] = $userInfo['id'];
            $_SESSION['loggedIn'] = true;
            $_SESSION['login'] = $login;
            $_SESSION['isAdmin'] = $userInfo['isAdmin'];
            echo 2;
        }
    }else{
        $_SESSION['loggedIn'] = false;
        echo 0;
    }
?>