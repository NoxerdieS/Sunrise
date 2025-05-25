<?php
include '../menu_component.php';
if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] || !$_SESSION["isAdmin"]){
 header('Location: ../../index.php');
}
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
      rel="stylesheet"
    />
    <script
      src="https://kit.fontawesome.com/bec5797acb.js"
      crossorigin="anonymous"
    ></script>
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
      <?=$body?>
    </section>

  </main>
  <script src="../../js/admin_panel.js"></script>
</body>

</html>
