<?php
require_once('../../php/dblogin.php');
include '../menu_component.php';
if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']){
 header('Location: ../index.php');
}
ob_start();
?>
<h1 class="admin__headline">Ustawienia konta</h1>
<div class="admin__products">
<?php
$sql = 'select mail, login, pass, firstname, lastname, address_id, telephone from user where login like ?';
$query = $pdo->prepare($sql);
$query -> execute([$_SESSION['login']]);
$user_info = $query -> fetch();
$sql = 'select city, postal, address from address where id = ?';
$address_info = $pdo -> prepare($sql);
$address_info -> execute([$user_info['address_id']]);
$address_info = $address_info -> fetch();
?>
<section class="user__section admin__section">
        <div class="admin__contentContainer admin__editContainer">
              <form class="admin__contentContainer--userForm" id="updateUserForm" method="post">
                <input type="hidden" id="address_id" value="<?=$user_info['address_id']?>">  
                <div class="admin__formContainer">
                      <label for="name">Imię:</label>
                      <input type="text" name="firstname" id="firstname" class="admin__contentContainer--input" placeholder="Imię" value="<?=$user_info['firstname']?>">
                  </div>
                  <div class="admin__formContainer">
                      <label for="name">Nazwisko:</label>
                      <input type="text" name="lastname" id="lastname" class="admin__contentContainer--input" placeholder="Nazwisko" value="<?=$user_info['lastname']?>">
                  </div>
                  <div class="admin__formContainer">
                      <label for="name">E-mail:</label>
                      <input type="email" name="email" id="email" class="admin__contentContainer--input" placeholder="Email" value="<?=$user_info['mail']?>">
                  </div>
                  <div class="admin__formContainer">
                      <label for="name">Telefon:</label>
                      <input type="number" name="phone" id="phone" class="admin__contentContainer--input" placeholder="Telefon" value="<?=$user_info['telephone']?>">
                  </div>
                  <div class="admin__formContainer">
                      <label for="name">Login:</label>
                      <input type="text" name="login" id="login" class="admin__contentContainer--input" placeholder="Login" value="<?=$user_info['login']?>">
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
                      <input type="text" name="address" id="address" class="admin__contentContainer--input" placeholder="Ulica i numer" value="<?=$address_info['address']?>">
                  </div>
                  <div class="admin__formContainer">
                      <label for="name">Kod pocztowy:</label>
                      <input type="text" name="postcode" id="postcode" class="admin__contentContainer--input" placeholder="Kod pocztowy" value="<?=$address_info['postal']?>">
                  </div>
                  <div class="admin__formContainer">
                      <label for="name">Miasto:</label>
                      <input type="text" name="city" id="city" class="admin__contentContainer--input" placeholder="Miasto" value="<?=$address_info['city']?>">
                  </div>
                  <div class="admin__formContainer">
                      <button type="submit" id="test" class="admin__contentContainer--addProduct">Zatwierdź</button>
                      </div>
                    </form>
            </div>
          </div>
    </section>
    <script src="../../js/user_settings.js"></script>
<?php
$body = ob_get_contents();
ob_end_clean();

require('./user_panel.php');