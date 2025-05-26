<?php
require_once("../dblogin.php");
$mail = $_POST['email'];
$login = $_POST['login'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$telephone = $_POST['phone'];
$isAdmin = $_POST['isAdmin'];
$isActive = $_POST['isActive'];
$oldLogin = $_GET['oldLogin'];

$address_id = $_GET['address'];
$address = $_POST['address'];
$postcode = $_POST['postcode'];
$city = $_POST['city'];

$sql = 'update address set city = ?, postal = ?, address = ? where id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$city, $postcode, $address, $address_id]);
if (empty($password)) {
    $sql = 'update user set mail = ?, login = ?, firstname = ?, lastname = ?, telephone = ?, isAdmin = ?, isActive = ? where login like ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$mail, $login, $firstname, $lastname, $telephone, $isAdmin, $isActive, $oldLogin]);
} else {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = 'update user set mail = ?, login = ?, pass = ?, firstname = ?, lastname = ?, telephone = ?, isAdmin = ?, isActive = ? where login like ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$mail, $login, $password, $firstname, $lastname, $telephone, $isAdmin, $isActive, $oldLogin]);
}
header('Location: ../../html/admin_panel/customers.php');
