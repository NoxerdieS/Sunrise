<?php
session_start();
if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']){
  header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../img/logo_transparent.png" type="image/x-icon">
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
    <link rel="stylesheet" href="../css/main.css" />
    <title>Przypomnij hasło</title>
  </head>
  <body>
    <div class="login remind">
        <div class="login__shadow"></div>
        <div class="login__field remind__field">
            <a href="./login_page.php" class="login__field--back"><i class="fa-solid fa-arrow-left"></i></a>
            <form method="post" class="login__form" id="login_form">
              <a href="../index.php" class="login__field--logo"><img src="../img/logo_transparent.png" alt="Logo firmy"></a>
                <input type="text" name="email" id="email" placeholder="Wprowadź adres email:" class="login__form--input">
                <p class="register__form--error error"></p>
                <input type="submit" value="Przypomnij hasło" class="login__form--send remind__form--send" id="remind_form_send">
            </form>
        </div>
        <div class="remind__popup register__popup">
          <div class="register__popup--container">
              <button class="register__popup--closeBtn"><i class="fa-solid fa-x"></i></button>
              <p class="register__popup--p">Link do zmiany hasła został wysłany na podany adres email</p>
          </div>
      </div>
    </div>
    <script src="../js/forgot_password.js"></script>
</body>
</html>
