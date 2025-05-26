<?php
include '../menu_component.php';
if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] || !$_SESSION["isAdmin"]) {
    header('Location: ../../index.php');
}
require_once('../../php/dblogin.php');
$login = $_GET['item'];
$sql = 'select mail, login, pass, firstname, lastname, address_id, telephone, isAdmin, isActive from user where login like ?';
$user_info = $pdo->prepare($sql);
$user_info->execute([$login]);
$user_info = $user_info->fetch();
$sql = 'select city, postal, address from address where id = ?';
$address_info = $pdo->prepare($sql);
$address_info->execute([$user_info['address_id']]);
$address_info = $address_info->fetch();
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
            <div class="admin__contentContainer admin__editContainer">
                <form action="../../php/admin_panel/edit_customer.php?oldLogin=<?= $login ?>&address=<?= $user_info['address_id'] ?>" method="post" id="create-product-form">
                    <input type="hidden" name="filename" value="customers">
                    <input type="hidden" name="oldLogin" value="<?= $login ?>">
                    <input type="hidden" name="addressId" value="<?= $user_info['address_id'] ?>">


                    <div class="admin__formContainer">
                        <label for="name">Imię:</label>
                        <input type="text" name="firstname" id="firstname" class="admin__contentContainer--input" placeholder="Imię" value="<?= $user_info['firstname'] ?>">
                    </div>
                    <div class="admin__formContainer">
                        <label for="name">Nazwisko:</label>
                        <input type="text" name="lastname" id="lastname" class="admin__contentContainer--input" placeholder="Nazwisko" value="<?= $user_info['lastname'] ?>">
                    </div>
                    <div class="admin__formContainer">
                        <label for="name">E-mail:</label>
                        <input type="email" name="email" id="email" class="admin__contentContainer--input" placeholder="Email" value="<?= $user_info['mail'] ?>">
                    </div>
                    <div class="admin__formContainer">
                        <label for="name">Login:</label>
                        <input type="text" name="login" id="login" class="admin__contentContainer--input" placeholder="Login" value="<?= $user_info['login'] ?>">
                    </div>
                    <div class="admin__formContainer">
                        <label for="name">Hasło:</label>
                        <input type="password" name="password" id="password" class="admin__contentContainer--input" placeholder="Hasło">
                    </div>
                    <div class="admin__formContainer">
                        <label for="name">Powtórz hasło:</label>
                        <input type="password" name="password2" id="password2" class="admin__contentContainer--input" placeholder="Powtórz hasło">
                    </div>
                    <div class="admin__formContainer">
                        <label for="name">Ulica i numer:</label>
                        <input type="text" name="address" id="address" class="admin__contentContainer--input" placeholder="Ulica i numer" value="<?= $address_info['address'] ?>">
                    </div>
                    <div class="admin__formContainer">
                        <label for="name">Telefon:</label>
                        <input type="number" name="phone" id="phone" class="admin__contentContainer--input" placeholder="Telefon" value="<?= $user_info['telephone'] ?>">
                    </div>
                    <div class="admin__formContainer">
                        <label for="name">Kod pocztowy:</label>
                        <input type="text" name="postcode" id="postcode" class="admin__contentContainer--input" placeholder="Kod pocztowy" value="<?= $address_info['postal'] ?>">
                    </div>
                    <div class="admin__formContainer">
                        <label for="name">Miasto:</label>
                        <input type="text" name="city" id="city" class="admin__contentContainer--input" placeholder="Miasto" value="<?= $address_info['city'] ?>">
                    </div>
                    <div class="admin__formContainer">
                        <label for="isAdmin">isAdmin:</label>
                        <select name="isAdmin" id="isAdmin" class="admin__contentContainer--input">
                            <option value="0">Nie</option>
                            <option value="1">Tak</option>
                        </select>
                    </div>
                    <div class="admin__formContainer">
                        <label for="name">isActive:</label>
                        <select name="isActive" id="isActive" class="admin__contentContainer--input">
                            <option value="1">Tak</option>
                            <option value="0">Nie</option>
                        </select>
                    </div>
                    <div class="admin__formContainer--buttons">
                        <button type="submit" class="admin__contentContainer--addProduct">Zatwierdź</button>
                        <a href="./customers.php" class="linkButton">Wróć</a>
                    </div>
                </form>
            </div>
            </div>
        </section>
    </main>
    <script src="../../js/admin_panel.js"></script>
</body>
</html>