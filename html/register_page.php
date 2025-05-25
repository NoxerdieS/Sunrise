<?php
    session_start();
    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']){
        header('Location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logo_transparent.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/bec5797acb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/main.css">
    <title>Zarejestruj się</title>
</head>
<body>
    <div class="login register">
        <div class="login__shadow"></div>
        
        <div class="login__field register__field">
            <a href="./login_page.php" class="login__field--back"><i class="fa-solid fa-arrow-left"></i></a>
            <a href="../index.php" class="login__field--logo"><img src="../img/logo_transparent.png" alt="Logo firmy"></a>
            <form method="post" class="login__form register__form" id="register_form"> 
                
                <input type="text" name="name" id="name-register" placeholder="Imię:" class="login__form--input register__form--input">
                <p class="register__form--error error error-name">Niepoprawne imie</p>

                <input type="text" name="lastname" id="lastname-register" placeholder="Nazwisko:" class="login__form--input register__form--input">
                <p class="register__form--error error error-lastname">Niepoprawne nazwisko</p>

                <input type="email" name="email" id="email-register" placeholder="Email:" class="login__form--input register__form--input">
                <p class="register__form--error error error-email">Niepoprawny email</p>

                <div class="register__form--number">
                    <input type="text" name="phone" id="phone-register" placeholder="Numer telefonu:" class="login__form--input register__form--number--2">
                </div>
                <p class="register__form--error error error-phone">Niepoprawny numer</p>

                <input type="text" name="login" id="login-register" placeholder="Login:" class="login__form--input register__form--input">
                <p class="register__form--error error error-login">Za krótki login</p>

                <input type="password" name="password" id="password-register" placeholder="Hasło:" class="login__form--input register__form--input">
                <p class="register__form--error error error-password">Hasło musi mieć co najmniej 8 znaków</p>

                <input type="password" name="password2" id="password2-register" placeholder="Powtórz hasło:" class="login__form--input register__form--input">
                <p class="register__form--error error error-password2">Hasła nie są identyczne</p>

                <input type="text" name="address" id="address-register" placeholder="Ulica i numer:" class="login__form--input register__form--input">
                <p class="register__form--error error error-address">Pole nie może być puste</p>

                <input type="text" name="postcode" id="postcode-register" placeholder="Kod pocztowy:" class="login__form--input register__form--input">
                <p class="register__form--error error error-postcode">Niepoprawny kod pocztowy</p>

                <input type="text" name="city" id="city-register" placeholder="Miasto:" class="login__form--input register__form--input">
                <p class="register__form--error error error-city">Pole nie może być puste</p>
            </form>
            <input type="submit" value="Zarejestruj się" class="login__form--send register__form--send" id="register_form_send">
        </div>
        <div class="register__popup">
            <div class="register__popup--container">
                <button class="register__popup--closeBtn"><i class="fa-solid fa-x"></i></button>
                <p class="register__popup--p">Link aktywacyjny został wysłany na podany adres email (początkowo rzeczywiście potwierdzenie było wysyłane. Jednak obecnie biblioteka do wysyłki przestała działać. Użytkownik jest domyślnie aktywowany.)</p>
            </div>
        </div>
    </div>
    <script src="../js/register.js"></script>
</body>
</html>