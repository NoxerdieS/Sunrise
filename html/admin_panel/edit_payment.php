<?php
include '../menu_component.php';
require_once('../../php/dblogin.php');

if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] || !$_SESSION["isAdmin"]) {
  header('Location: ../../index.php');
  exit;
}

$name = $_GET['item'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $payment_name = $_POST['name'];
  $cost = str_replace(',', '.', $_POST['cost']); // 👈 konwersja przecinka na kropkę
  $isActive = $_POST['isActive'];

  $sql = 'UPDATE payment SET payment_name = ?, payment_cost = ?, isActive = ? WHERE payment_name = ?';
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$payment_name, $cost, $isActive, $name]);

  header('Location: ../../html/admin_panel/payment.php');
  exit;
}

$sql = 'SELECT payment_name, payment_cost, isActive FROM payment WHERE payment_name LIKE ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$name]);
$payment_info = $stmt->fetch();

if (!$payment_info) {
  header('Location: ./payment.php');
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
  <title>Panel administratora</title>
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
            <label for="name">Nazwa sposobu płatności:</label>
            <input type="text" name="name" id="name" class="admin__contentContainer--input"
                   value="<?= htmlspecialchars($payment_info['payment_name']) ?>">
          </div>

          <div class="admin__formContainer">
            <label for="cost">Prowizja za płatność:</label>
            <input type="text" name="cost" id="cost" class="admin__contentContainer--input"
                   value="<?= number_format($payment_info['payment_cost'], 2, ',', '') ?>">
          </div>

          <div class="admin__formContainer">
            <label for="isActive">Aktywna:</label>
            <select name="isActive" class="admin__contentContainer--input">
              <option value="1" <?= $payment_info['isActive'] ? 'selected' : '' ?>>Tak</option>
              <option value="0" <?= !$payment_info['isActive'] ? 'selected' : '' ?>>Nie</option>
            </select>
          </div>

          <button type="submit" class="admin__contentContainer--addProduct">Zapisz zmiany</button>
          <a href="./payment.php" class="linkButton">Wróć</a>
        </form>
      </div>
    </section>
  </main>
</body>
</html>
