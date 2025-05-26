<?php
require_once('../dblogin.php');

$oldLogin = $_POST['oldLogin'] ?? '';
$addressId = $_POST['addressId'] ?? '';

$firstname = $_POST['firstname'] ?? '';
$lastname = $_POST['lastname'] ?? '';
$email = $_POST['email'] ?? '';
$login = $_POST['login'] ?? '';
$password = $_POST['password'] ?? '';
$password2 = $_POST['password2'] ?? '';
$address = $_POST['address'] ?? '';
$phone = $_POST['phone'] ?? '';
$postcode = $_POST['postcode'] ?? '';
$city = $_POST['city'] ?? '';
$isAdmin = $_POST['isAdmin'] ?? '0';
$isActive = $_POST['isActive'] ?? '1';

if (!empty($password) && $password !== $password2) {
    header('Location: ../../html/admin_panel/edit_customer.php?item=' . urlencode($oldLogin));
    exit;
}

if (!empty($password)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $updateUser = $pdo->prepare('
        UPDATE user
        SET mail = ?, login = ?, pass = ?, firstname = ?, lastname = ?, telephone = ?, isAdmin = ?, isActive = ?
        WHERE login = ?
    ');
    $updateUser->execute([$email, $login, $hashedPassword, $firstname, $lastname, $phone, $isAdmin, $isActive, $oldLogin]);
} else {
    $updateUser = $pdo->prepare('
        UPDATE user
        SET mail = ?, login = ?, firstname = ?, lastname = ?, telephone = ?, isAdmin = ?, isActive = ?
        WHERE login = ?
    ');
    $updateUser->execute([$email, $login, $firstname, $lastname, $phone, $isAdmin, $isActive, $oldLogin]);
}

$updateAddress = $pdo->prepare('
    UPDATE address
    SET city = ?, postal = ?, address = ?
    WHERE id = ?
');
$updateAddress->execute([$city, $postcode, $address, $addressId]);

header('Location: ../../html/admin_panel/customers.php');
exit;
