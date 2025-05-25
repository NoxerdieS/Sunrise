<?php
require_once '../dblogin.php';

$id = $_GET['id'];
$name = $_POST['name'];
$category = $_POST['category'];
$price = $_POST['price'];
$desc = $_POST['description'];
$stock = $_POST['quantity'];

$pdo->beginTransaction();

try {
    $sql = 'UPDATE product SET product_name = ?, category_id = ?, price = ?, description = ?, stock = ? WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $category, $price, $desc, $stock, $id]);

    if (!empty($_FILES['image']['name'])) {
        $path = "../../img/" . $name . "_img.png";
        move_uploaded_file($_FILES['image']['tmp_name'], $path);

        $photo_id = $pdo->prepare("SELECT photo_id FROM product WHERE id = ?");
        $photo_id->execute([$id]);
        $photo_id = $photo_id->fetchColumn();

        $stmt = $pdo->prepare("UPDATE photos SET path = ? WHERE id = ?");
        $stmt->execute([$path, $photo_id]);
    }

    $pdo->prepare('DELETE FROM `product-params` WHERE product_id = ?')->execute([$id]);

    $stmt = $pdo->query('SELECT id, param_name FROM parameters');
    $existingParams = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

    $i = 0;
    while (isset($_POST["param_name$i"]) && isset($_POST["param_value$i"])) {
        $paramName = trim($_POST["param_name$i"]);
        $paramValue = trim($_POST["param_value$i"]);

        if ($paramName === '' || $paramValue === '') {
            $i++;
            continue;
        }

        $param_id = array_search($paramName, $existingParams);
        if ($param_id === false) {
            $stmt = $pdo->prepare('INSERT INTO parameters (param_name) VALUES (?)');
            $stmt->execute([$paramName]);
            $param_id = $pdo->lastInsertId();
            $existingParams[$param_id] = $paramName;
        }

        $stmt = $pdo->prepare('INSERT INTO `product-params` (product_id, param_id, param_value) VALUES (?, ?, ?)');
        $stmt->execute([$id, $param_id, $paramValue]);

        $i++;
    }

    $pdo->commit();
    header('Location: ../../html/admin_panel/index.php');
    exit;
} catch (Exception $e) {
    $pdo->rollBack();
    $param = http_build_query(['item' => $name]);
    header('Location: ../../html/admin_panel/edit_product.php?' . $param);
    exit;
}
