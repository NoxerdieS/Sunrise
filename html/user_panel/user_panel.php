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
  <title>Panel użytkownika</title>
</head>

<body>
  <?php
  if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
    header('Location: ../../index.php');
  }
  echo $nav;
  ?>
  <main class="user admin">
    <div class="user__popup popup">
    </div>
    </div>
    <section class="user__menu">
      <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']): ?>
        <a href="../admin_panel/" class="user__menu--adminPanel">Panel administratora <i class="fa-solid fa-arrow-right"></i></a>
      <?php endif; ?>
      <a href="./index.php" class="user__menu--item link link-animation-two">Zamówienia</a>
      <a href="./settings.php" class="user__menu--item link link-animation-two">Ustawienia konta</a>
    </section>
    <section class="user__section admin__section">
      <?= $body ?>
    </section>
  </main>
</body>

</html>