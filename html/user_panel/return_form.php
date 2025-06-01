<?php
session_start();
require_once('../../php/dblogin.php');

$order_id = $_GET['id'] ?? 0;

$sql = 'SELECT user_id FROM user_order WHERE order_id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$order_id]);
$user_id = $stmt->fetchColumn();

if (!$user_id || $user_id != $_SESSION['userId']) {
    echo "<p class='error'>Nie masz dostępu do tego zamówienia.</p>";
    exit;
}
?>

<button class="admin__contentContainer--closeBtn" id="closeBtn"><i class="fa-solid fa-x"></i></button>
<form class="admin__contentContainer--userForm" id="return-form">
    <input type="hidden" name="order_id" value="<?= htmlspecialchars($order_id) ?>">
    <input type="hidden" name="user_id" value="<?= htmlspecialchars($_SESSION['userId']) ?>">

    <div class="admin__formContainer">
        <label for="reason">Powód zwrotu/reklamacji:</label>
        <textarea name="reason" id="reason" rows="10" cols="80" class="admin__contentContainer--textarea admin__contentContainer--textareaReturn" placeholder="Opisz problem lub powód zwrotu..."></textarea>
    </div>

    <div class="admin__formContainer">
        <button type="submit" class="admin__contentContainer--addProduct">Wyślij zgłoszenie</button>
    </div>
</form>


