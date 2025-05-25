<?php
$name = $_GET['item'];
$payment_name = $_POST['name'];
$cost = $_POST['cost'];
$isActive = $_POST['isActive'];
require_once('../dblogin.php');
$sql = 'update payment set payment_name = ?, payment_cost = ?, isActive = ? where payment_name = ?';
$stmt = $pdo -> prepare($sql);
$stmt ->execute([$payment_name, $cost, $isActive, $name]);
header('Location: ../../html/admin_panel/payment.php');