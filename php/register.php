<?php
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';

require_once('dblogin.php');
//    require_once('maillogin.php');

function cleanData($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$name = cleanData($_POST['name']);
$lastname = cleanData($_POST['lastname']);
$email = cleanData($_POST['email']);
$login = cleanData($_POST['login']);
$password = password_hash(cleanData($_POST['password']), PASSWORD_DEFAULT);
function cleanPhone($data)
{
    return preg_replace('/\D/', '', $data); 
}
$phone = cleanPhone($_POST['phone']);

$address = cleanData($_POST['address']);
$postcode = cleanData($_POST['postcode']);
$city = cleanData($_POST['city']);

// $mail = new PHPMailer();

$stmt = $pdo->query('Select login from user where login like "' . $login . '" or mail like "' . $email . '";');
if ($stmt->rowCount() > 0) {
    echo 'Podany login lub email jest już zajęty';
} else {
    $activationHash = password_hash(mt_rand(10000, 99999), PASSWORD_DEFAULT);
    $sql = 'insert into address(city, postal, address) values(?, ?, ?);';
    $pdo->prepare($sql)->execute([$city, $postcode, $address]);
    $address_id = $pdo->query('select id from address where address like "' . $address . '";')->fetchColumn();
    $sql = 'Insert into user(mail, login, pass, firstname, lastname, address_id, telephone, isAdmin, isActive, activationHash) values(?, ?, ?, ?, ?, ?, ?, 0, 1, ?)';
    $pdo->prepare($sql)->execute([$email, $login, $password, $name, $lastname, $address_id, $phone, $activationHash]);
    // $mail -> isSMTP();
    // $mail->Host = $mailhost;
    // $mail ->SMTPAuth = true;
    // $mail ->Username = 'noreply@sunrise.j.pl';
    // $mail ->Password = $mailpassword;
    // $mail ->SMTPSecure = 'STARTTLS';
    // $mail ->Port = $mailport;

    // $mail -> setFrom('noreply@sunrise.j.pl', 'Sklep Sunrise');
    // $mail -> addAddress($email);
    // $mail -> Subject = 'Aktywuj swoje konto w sklepie Sunrise';
    // $mail -> Body = 'Aktywuj swoje konto klikając w ten link: http://localhost/sklep_internetowy/php/authorize.php?login='.$login.'&activationHash='.$activationHash;
    // $mail -> send();
    echo "success";
}
