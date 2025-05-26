<?php
include '../menu_component.php';
require_once('../../php/dblogin.php');

if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] || !$_SESSION["isAdmin"]) {
  header('Location: ../../index.php');
  exit;
}

$name = $_GET['item'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $shipper_name = $_POST['name'];
  $cost = str_replace(',', '.', $_POST['cost']); 
  $isActive = $_POST['isActive'];

  $sql = 'UPDATE shipping SET shipper_name = ?, shipping_cost = ?, isActive = ? WHERE shipper_name = ?';
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$shipper_name, $cost, $isActive, $name]);

  header('Location: ../../html/admin_panel/shipping.php');
  exit;
}

$sql = 'SELECT shipper_name, shipping_cost, isActive FROM shipping WHERE shipper_name LIKE ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$name]);
$shipper_info = $stmt->fetch();

if (!$shipper_info) {
  header('Location: shipping.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../../img/logo_transparent.png" type="image/x-icon">
  <link rel="stylesheet" href="../../css/main.css" />
  <title>Edytuj dostawę</title>
</head>
<body>
  <?php echo $nav; ?>
  <main class="user admin">
    <section class="user__menu admin__menu">
      <a href="./index.php" class="user__menu--item admin__menu--item">Zarządzanie produktami</a>
      <a href="./categories.php" class="user__menu--item admin__menu--item">Zarządzanie kategoriami</a>
      <a href="./customers.php" class="user__menu--item admin__menu--item">Zarządzanie klientami</a>
      <a href="./orders.php" class="user__menu--item admin__menu--item">Zamówienia użytkowników</a>
      <a href="./shipping.php" class="user__menu--item admin__menu--item">Ustawienia dostawy</a>
      <a href="./payment.php" class="user__menu--item admin__menu--item">Ustawienia płatności</a>
      <a href="./info_editor.php" class="user__menu--item admin__menu--item">Edytuj strony informacyjne</a>
    </section>

    <section class="user__section admin__section">
      <div class="admin__contentContainer">
        <form method="post" action="">
          <div class="admin__formContainer">
            <label for="name">Nazwa sposobu dostawy:</label>
            <input type="text" name="name" id="name" class="admin__contentContainer--input"
                   value="<?= htmlspecialchars($shipper_info['shipper_name']) ?>">
          </div>
          <div class="admin__formContainer">
            <label for="cost">Koszt dostawy:</label>
            <input type="text" name="cost" id="cost" class="admin__contentContainer--input"
                   value="<?= number_format($shipper_info['shipping_cost'], 2, ',', '') ?>">
          </div>
          <div class="admin__formContainer">
            <label for="isActive">Aktywna:</label>
            <select name="isActive" class="admin__contentContainer--input">
              <option value="1" <?= $shipper_info['isActive'] ? 'selected' : '' ?>>Tak</option>
              <option value="0" <?= !$shipper_info['isActive'] ? 'selected' : '' ?>>Nie</option>
            </select>
          </div>
          <button type="submit" class="admin__contentContainer--addProduct">Zapisz zmiany</button>
          <a href="./shipping.php" class="linkButton">Wróć</a>
        </form>
      </div>
    </section>
  </main>
</body>
</html>
