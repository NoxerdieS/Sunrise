<?php
include '../menu_component.php';
if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] || !$_SESSION["isAdmin"]) {
  header('Location: ../../index.php');
}
require_once('../../php/dblogin.php');
$name = $_GET['item'];
$sql = 'select shipper_name, shipping_cost, isActive from shipping where shipper_name like ?';
$shipper_info = $pdo->prepare($sql);
$shipper_info->execute([$name]);
$shipper_info = $shipper_info->fetch();
?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../../img/logo_transparent.png" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap"
    rel="stylesheet" />
  <script
    src="https://kit.fontawesome.com/bec5797acb.js"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../css/main.css" />
  <title>Panel administratora</title>
</head>

<body>
  <?php
  echo $nav;
  ?>
  <div class="admin__popup--shadow"></div>
  <main class="user admin">
    <section class="user__menu admin__menu">
      <a href="./index.php" class="user__menu--item admin__menu--item link link-animation-two">Zarządzanie produktami</a>
      <a href="./categories.php" class="user__menu--item admin__menu--item link link-animation-two">Zarządzanie kategoriami</a>
      <a href="./customers.php" class="user__menu--item admin__menu--item link link-animation-two">Zarządzanie klientami</a>
      <a href="./orders.php" class="user__menu--item admin__menu--item link link-animation-two">Zamówienia użytkowników</a>
      <a href="./shipping.php" class="user__menu--item admin__menu--item link link-animation-two">Ustawienia dostawy</a>
      <a href="./payment.php" class="user__menu--item admin__menu--item link link-animation-two">Ustawienia płatności</a>
      <a href="./info_editor.php" class="user__menu--item admin__menu--item link link-animation-two">Edytuj strony informacyjne</a>
    </section>
    <section class="user__section admin__section">
      <div class="admin__contentContainer">
        <form id="create-product-form" method="post" action="../../php/admin_panel/edit_shipper.php?item=<?= $name ?>">
          <div class="admin__formContainer">
            <label for="name">Nazwa sposobu dostawy:</label>
            <input type="text" name="name" id="name" class="admin__contentContainer--input" placeholder="Nazwa sposobu dostawy" value="<?= $shipper_info['shipper_name'] ?>">
          </div>
          <div class="admin__formContainer">
            <label for="cost">Koszt dostawy:</label>
            <input type="number" name="cost" id="cost" class="admin__contentContainer--input" placeholder="Koszt dostawy" value="<?= $shipper_info['shipping_cost'] ?>">
          </div>
          <div class="admin__formContainer">
            <label for="name">isActive:</label>
            <select name="isActive" id="isActive" class="admin__contentContainer--input">
              <option value="0">Nie</option>
              <?php if ($shipper_info['isActive'] == 1): ?>
                <option value="1" selected>Tak</option>
              <?php else: ?>
                <option value="1">Tak</option>
              <?php endif; ?>
            </select>
          </div>
          <button type="submit" class="admin__contentContainer--addProduct">Zatwierdź</button>
          <a href="./shipping.php" class="linkButton">Wróć</a>
        </form>
      </div>
    </section>
  </main>
  <script src="../../js/admin_panel.js"></script>
</body>

</html>