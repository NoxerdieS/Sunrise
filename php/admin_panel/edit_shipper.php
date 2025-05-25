<?php
$name = $_GET['item'];
$shipper_name = $_POST['name'];
$cost = $_POST['cost'];
$isActive = $_POST['isActive'];
require_once('../dblogin.php');
$sql = 'update shipping set shipper_name = ?, shipping_cost = ?, isActive = ? where shipper_name = ?';
$stmt = $pdo -> prepare($sql);
$stmt ->execute([$shipper_name, $cost, $isActive, $name]);
header('Location: ../../html/admin_panel/shipping.php');