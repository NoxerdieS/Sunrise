<?php
require_once('../dblogin.php');

$orderId = $_POST['order_id'] ?? '';
$total = $_POST['total'] ?? '';
$shipping = $_POST['shipping'] ?? '';
$payment = $_POST['payment'] ?? '';

$firstname = $_POST['firstname'] ?? '';
$lastname = $_POST['lastname'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$address = $_POST['address'] ?? '';
$postcode = $_POST['postcode'] ?? '';
$city = $_POST['city'] ?? '';


$stmt = $pdo->prepare('SELECT id FROM payment WHERE payment_name = ?');
$stmt->execute([$payment]);
$paymentId = $stmt->fetchColumn();

$stmt = $pdo->prepare('SELECT id FROM shipping WHERE shipper_name = ?');
$stmt->execute([$shipping]);
$shippingId = $stmt->fetchColumn();


$stmt = $pdo->prepare('SELECT address_id FROM order_data WHERE order_id = ?');
$stmt->execute([$orderId]);
$addressId = $stmt->fetchColumn();


$stmt = $pdo->prepare('UPDATE address SET city = ?, postal = ?, address = ? WHERE id = ?');
$stmt->execute([$city, $postcode, $address, $addressId]);


$stmt = $pdo->prepare('
    UPDATE order_data 
    SET firstname = ?, lastname = ?, mail = ?, telephone = ? 
    WHERE order_id = ?
');
$stmt->execute([$firstname, $lastname, $email, $phone, $orderId]);


$stmt = $pdo->prepare('
    UPDATE order_details 
    SET total = ?, payment_id = ?, shipping_id = ?
    WHERE id = ?
');
$stmt->execute([$total, $paymentId, $shippingId, $orderId]);

header('Location: ../../html/admin_panel/orders.php');
exit;
