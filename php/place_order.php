<?php
session_start();

$shipping = $_POST['delivery'];
$payment = $_POST['payment'];
$cart = $_SESSION['cart'];

require_once('./dblogin.php');

$total = 0;
foreach ($cart as $item) {
    $sql = 'SELECT price FROM product WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$item[0]]);
    $price = $stmt->fetchColumn();
    $total += $price * $item[1];
}


$sql = 'SELECT shipping_cost FROM shipping WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$shipping]);
$shipping_cost = $stmt->fetchColumn();


$sql = 'SELECT payment_cost FROM payment WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$payment]);
$payment_percentage = $stmt->fetchColumn();


$payment_percentage = floatval($payment_percentage);
$payment_cost = $total * $payment_percentage;

$total += $shipping_cost + $payment_cost;


$sql = 'INSERT INTO order_details(total, payment_id, shipping_id) VALUES(?, ?, ?)';
$stmt = $pdo->prepare($sql);
$stmt->execute([$total, $payment, $shipping]);
$order_id = $pdo->lastInsertId();


foreach ($cart as $item) {
    $sql = 'INSERT INTO order_product(order_id, product_id, quantity) VALUES(?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$order_id, $item[0], $item[1]]);
}


$address_id = $invoice_address_id = 0;
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
    $sql = 'INSERT INTO user_order(user_id, order_id) VALUES(?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST['user_id'], $order_id]);

    $sql = 'SELECT id FROM address WHERE city = ? AND postal = ? AND address = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST['city'], $_POST['postcode'], $_POST['address']]);
    $address_id = $stmt->fetchColumn();

    if (!$address_id) {
        $sql = 'INSERT INTO address(city, postal, address) VALUES(?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['city'], $_POST['postcode'], $_POST['address']]);
        $address_id = $pdo->lastInsertId();
    }
} else {
    $sql = 'INSERT INTO address(city, postal, address) VALUES(?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST['city'], $_POST['postcode'], $_POST['address']]);
    $address_id = $pdo->lastInsertId();
}

if ($_POST['invoice'] == 1 && [$_POST['city'], $_POST['postcode'], $_POST['address']] != [$_POST['invoice_city'], $_POST['invoice_postcode'], $_POST['invoice_address']]) {
    $sql = 'INSERT INTO address(city, postal, address) VALUES(?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST['invoice_city'], $_POST['invoice_postcode'], $_POST['invoice_address']]);
    $invoice_address_id = $pdo->lastInsertId();
} else {
    $invoice_address_id = $address_id;
}


$sql = 'INSERT INTO order_data(firstname, lastname, mail, telephone, address_id, order_id, invoice_name, invoice_mail, invoice_telephone, invoice_address_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
$stmt = $pdo->prepare($sql);
$name = explode(' ', $_POST['name']);
$firstname = $name[0];
$lastname = end($name);
$invoice_name = $_POST['invoice_name'] ?? $_POST['name'];
$invoice_mail = $_POST['invoice_email'] ?? $_POST['email'];
$invoice_phone = $_POST['invoice_phone'] ?? $_POST['phone'];
$phone = preg_replace('/\D+/', '', $_POST['phone']);

$stmt->execute([$firstname, $lastname, $_POST['email'], $phone, $address_id, $order_id, $invoice_name, $invoice_mail, $invoice_phone, $invoice_address_id]);


echo $order_id;

$_SESSION['cart'] = [];
?>