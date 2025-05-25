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
    <title>Przypominanie hasła</title>
  </head>
  <body>
    <div class="login">
        <div class="login__shadow"></div>
        <div class="login__field">
          <a href="../index.php" class="login__field--back"><i class="fa-solid fa-arrow-left"></i></a>
          <form method="post" class="login__form" id="login_form">
              <a href="../index.php" class="login__field--logo"><img src="../img/logo_transparent.png" alt="Logo firmy"></a>
                <input type="password" name="password" id="password" placeholder="Wprowadź nowe hasło:" class="login__form--input">
                <input type="password" name="password2" id="password2" placeholder="Powtórz hasło:" class="login__form--input">
                <p class="login__form--error error">Hasła się nie zgadzają</p>
                <input type="submit" value="Zmień hasło" class="login__form--send" id="change_pass_form_send">
                </div>    
          </form>
        </div>
    </div>
    <script src="../js/remember_password.js"></script>
</body>
</html>
