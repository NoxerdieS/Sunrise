<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    
    require_once('dblogin.php');
    require_once('maillogin.php');
    $pdo = new PDO('mysql:host='.$host.';dbname='.$db.';port=3306', $user, $pass);
    
    $mail = new PHPMailer();

    $email = $_POST['email'];
    $userInfo = $pdo -> query('Select id, isActive from user where mail like "'.$email.'";') -> fetch();
    if (empty($userInfo)){
        echo 0;
    }else if($userInfo['isActive'] != 0){
        $activationHash = password_hash(mt_rand(10000, 99999), PASSWORD_DEFAULT);
        $sql = 'update user set activationHash = ? where id = ?;';
        $pdo -> prepare($sql) -> execute([$activationHash, $userInfo['id']]);
        $mail -> isSMTP();
        $mail->Host = $mailhost;
        $mail ->SMTPAuth = true;
        $mail ->Username = 'jseroka08@gmail.com'; 
        $mail ->Password = $mailpassword;
        $mail ->SMTPSecure = 'STARTTLS';
        $mail ->Port = $mailport;
    
        $mail -> setFrom('noreply@sunrise.j.pl', 'Sklep Sunrise');
        $mail -> addAddress($email);
        $mail -> Subject = 'Zresetuj swoje hasło w sklepie Sunrise';
        $mail -> Body = 'Zresetuj swoje hasło klikając w ten link: http://localhost/sklep_internetowy/html/remember_password.php?email='.$email.'&activationHash='.$activationHash;
        $mail -> send();
        echo "success";
    }else{
        echo 1;
    }
?>