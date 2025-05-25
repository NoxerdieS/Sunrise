<?php
require_once('./dblogin.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start();
header('Content-Type: application/json');

function escape_like($input) {
    return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $input);
}

$category = trim($_POST['category'] ?? '');
$filters = [];

foreach ($_POST as $key => $value) {
    if (strpos($key, 'filters') === 0) {
        $filters = is_array($value) ? $value : explode(',', $value);
        break;
    }
}

if ($category === '') {
    echo json_encode([]);
    ob_end_flush();
    exit;
}

if (empty($filters)) {
    $sql = 'SELECT product.id
            FROM product
            INNER JOIN category ON product.category_id = category.id
            WHERE category_name = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$category]);
    $all = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo json_encode($all);
    ob_end_flush();
    exit;
}

$ids = [];
foreach ($filters as $filter) {
    $escaped = escape_like($filter);
    $sql = 'SELECT product_id
        FROM `product-params`
        INNER JOIN product ON product.id = `product-params`.product_id
        INNER JOIN category ON product.category_id = category.id
        WHERE param_value LIKE ? ESCAPE \'\\\\\'
        AND category_name = ?';

    $stmt = $pdo->prepare($sql);
    $stmt->execute(["%$escaped%", $category]);
    $found = $stmt->fetchAll(PDO::FETCH_COLUMN);

    if (empty($found)) {
        echo json_encode([]);
        ob_end_flush();
        exit;
    }

    $ids[] = $found;
}

$final = $ids[0];
for ($i = 1; $i < count($ids); $i++) {
    $final = array_intersect($final, $ids[$i]);
}

echo json_encode(array_values($final));
ob_end_flush();
exit;
