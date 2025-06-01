<?php
session_start();
require_once('../../php/dblogin.php');

$order_id = $_POST['order_id'];
$user_id = $_POST['user_id'];
$reason = trim($_POST['reason']);

if ($user_id != $_SESSION['userId']) {
    echo "<p class='error'>Nie masz uprawnień do tego działania.</p>";
    exit;
}

$sql = 'INSERT INTO returns (order_id, user_id, reason, submitted_at) VALUES (?, ?, ?, NOW())';
$stmt = $pdo->prepare($sql);
$success = $stmt->execute([$order_id, $user_id, $reason]);

if ($success) {
    $update = $pdo->prepare('UPDATE order_data SET status = 2 WHERE order_id = ?');
    $update->execute([$order_id]);
    echo "<p>Zgłoszenie zostało przyjęte. Status zamówienia zaktualizowano.</p>";
} else {
    echo "<p class='error'>Wystąpił problem podczas przetwarzania zgłoszenia.</p>";
}
?>
<button class='admin__contentContainer--closeBtn closeBtn' id='closeBtn'><i class='fa-solid fa-x'></i></button>
