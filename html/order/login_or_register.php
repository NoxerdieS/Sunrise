<?php
  session_start();
  if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']){
    header('Location: ./order.php');
  }
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="../../img/logo_transparent.png"
      type="image/x-icon"
    />

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/main.css" />
    <title>Sklep</title>
  </head>
  <body>
    <main class="login-or-register">

        <div class="login-or-register__login">
        <a href="./cart.php" class="login__field--back"><i class="fa-solid fa-arrow-left"></i></a>
            <form id="loginForm">
                <h2>Zaloguj się</h2>
                    <div class="inputBox">
                        <input type="text" name="login" placeholder="Login">
                        <p class="error">Pole nie może być puste</p>
                    </div>
                    <div class="inputBox">
                        <input type="password" name="password" placeholder="Hasło">
                        <p class="error">Podane hasło jest niepoprawne</p>
                    </div>
                    <a href="../forgot_password.php" class="remember-password">Nie pamiętasz hasła?</a>
                    <p class="error">Podane dane są niepoprawne</p>
                <button type="submit" class="button submitBtn">Zaloguj się</button>
            </form>
        </div>
        <div class="login-or-register__others">
            <div class="login-or-register__others--element">
                <h2>Zamów bez logowania</h2>
                <p>Jeśli się nie zalogujesz, nie będziesz miał dostępu do historii zamówień.</p>
                <a href="./order.php" class="linkButton noLoginBtn">Kontynuuj bez logowania</a>
            </div>
            <div class="login-or-register__others--element">
                <h2>Załóż konto</h2>
                <p><i class="fa-solid fa-magnifying-glass"></i>Śledzenie zamówień</p>
                <p><i class="fa-solid fa-tag"></i>Rabaty i promocje</p>
                <a href="../register_page.php" class="linkButton noLoginBtn">Załóż konto</a>
            </div>
        </div>
    </main>
    <script src="../../js/order_login.js"></script>
  </body>
</html>
