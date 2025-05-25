<?php
    require_once('dblogin.php');
    $pdo = new PDO('mysql:host='.$host.';dbname='.$db.';port=3306', $user, $pass);

    $email = $_POST['email'];
    $activationHash = $_POST['activationHash'];
    $passw = $_POST['password'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $key = $pdo -> query('select activationHash from user where mail like "'.$email.'";') -> fetchColumn();

    if(empty($key) || $activationHash != $key){
        echo '../index.php';
    }else{
        $sql = 'update user set pass = ? where mail like ?;';
        $pdo ->prepare($sql) -> execute([$password, $email]);
        echo '../html/login_page.php';
    }
?>