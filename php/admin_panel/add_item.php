<?php
session_start();
if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] || !$_SESSION["isAdmin"]) {
    header('Location: ../../index.php');
}
require_once("../dblogin.php");
if (isset($_POST['filename'])) {
    $file = $_POST['filename'];
    if ($file == "index") {
        $name = trim($_POST["name"]);
        $price = floatval($_POST["price"]);
        $description = trim($_POST["description"]);
        $quantity = intval($_POST["quantity"]);

        if ($name === "" || $price <= 0 || $description === "" || $quantity < 0 || !isset($_FILES['image'])) {
            http_response_code(400);
            echo "Błąd: nieprawidłowe dane wejściowe.";
            exit;
        }

        $path = "../../img/" . $_POST["name"] . "_img.png";
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
        $sql = 'insert into photos(path) values(?)';
        $pdo->prepare($sql)->execute([$path]);
        $photo_id = $pdo->lastInsertId();

        $sql = 'insert into product(product_name, category_id, price, description, stock, photo_id) values(?, ?, ?, ?, ?, ?)';
        $pdo->prepare($sql)->execute([$_POST["name"], $_POST["category"], $_POST["price"], $_POST["description"], $_POST["quantity"], $photo_id]);
        $i = 0;
        $product_id = $pdo->lastInsertId();
        $sql = 'select id, param_name from parameters';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $params = $stmt->fetchAll();
        $sql_name = 'insert into parameters(param_name) values(?)';
        $sql_value = 'insert into `product-params`(product_id, param_id, param_value) values(?, ?, ?)';
        while (isset($_POST['param_name' . $i]) && isset($_POST['param_value' . $i])) {
            $temp = false;
            $j = 0;
            for ($j; $j < count($params); $j++) {
                if ($params[$j][1] == $_POST['param_name' . $i]) {
                    $temp = true;
                }
            }
            $param_id = 0;
            if ($temp) {
                $param_id = $params[$j - 1][0];
            } else {
                $stmt_name = $pdo->prepare($sql_name);
                $stmt_name->execute([$_POST['param_name' . $i]]);
                $param_id = $pdo->lastInsertId();
            }
            $stmt_value = $pdo->prepare($sql_value);
            $stmt_value->execute([$product_id, $param_id, $_POST['param_value' . $i]]);
            $i++;
        }
        include './product.php';
    } else if ($file == "categories") {
        $sql = 'insert into category(category_name) values(?)';
        $pdo->prepare($sql)->execute([$_POST['name']]);
    } else if ($file == 'payment') {
        $sql = 'insert into payment(payment_name, payment_cost, isActive) values(?, ?, 1)';
        $pdo->prepare($sql)->execute([$_POST['name'], $_POST['cost'] / 100]);
    } else if ($file == 'shipping') {
        $sql = 'insert into shipping(shipper_name, shipping_cost, isActive) values(?, ?, 1)';
        $pdo->prepare($sql)->execute([$_POST['name'], $_POST['cost']]);
    } else if ($file == 'customers') {
        if ($_POST['password'] == $_POST['password2']) {
            $sql = 'insert into address(city, postal, address) values(?, ?, ?)';
            $pdo->prepare($sql)->execute([$_POST['city'], $_POST['postcode'], $_POST['address']]);
            $address_id = $pdo->lastInsertId();

            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $sql = 'insert into user(mail, login, pass, firstname, lastname, address_id, telephone, isAdmin, isActive)
                values(?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $pdo->prepare($sql)->execute([$_POST['email'], $_POST['login'], $password, $_POST['firstname'], $_POST['lastname'], $address_id, $_POST['phone'], $_POST['isAdmin'], $_POST['isActive']]);
        }
    }
}
