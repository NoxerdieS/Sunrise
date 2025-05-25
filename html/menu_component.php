<?php
session_start();
$path = '/sklep_internetowy/html';
ob_start();
?>
      <nav class="nav__mobile">
        <button class="nav__mobile--bars"><i class="fa-solid fa-bars"></i></button>
        <div class="nav__mobileMenu">
          <ul>
              <li class="menu-item one">
                <p>Alkohole mocne</p>
                  <ul class="dropdown dropdown-one">
                      <li>Whisky</li>
                      <li>Gin</li>
                      <li>Wódka</li>
                      <li>Rum</li>
                      <li>Tequila</li>
                  </ul>
              </li>
              <hr>
              <li class="menu-item two">
                  <p>Wina</p>
                  <ul class="dropdown dropdown-two">
                      <li>Wytrawne</li>
                      <li>Słodkie</li>
                      <li>Półsłodkie</li>
                      <li>Musujące</li>
                  </ul>
              </li>
              <hr>
              <li class="menu-item three">
              <p>Piwo</p>
                  <ul class="dropdown dropdown-three">
                      <li>IPA</li>
                      <li>ALE</li>
                      <li>Lager</li>
                      <li>Stout</li>
                      <li>Pilzner</li>
                  </ul>
              </li>
              <hr>
              <li class="menu-item four">
              <p>Kursy</p>
            </li>
            <hr>
          </ul>
        </div>
      </nav>
      <nav class="nav__desktop nav__panelMenu">
        <div class="nav__items">
          <a href="<?=$path?>/../index.php" class="nav__item--logo"></a>
          <a href="<?=$path?>/category_pages/strong-alcohol.php" class="nav__item link link-animation">Alkohole mocne</a>
          <div class="nav__dropdown nav__dropdown--one">
            <div class="nav__dropdown--left">
              <a href="<?=$path?>/category_pages/strong-whisky.php" class="link link-animation">Whisky</a>
              <a href="<?=$path?>/category_pages/strong-gin.php" class="link link-animation">Gin</a>
              <a href="<?=$path?>/category_pages/strong-wodka.php" class="link link-animation">Wódka</a>
              <a href="<?=$path?>/category_pages/strong-rum.php" class="link link-animation">Rum</a>
              <a href="<?=$path?>/category_pages/strong-tequlia.php" class="link link-animation">Tequila</a>
            </div>
            <div class="nav__dropdown--right">
              <img src="<?=$path?>/../img/placeholder_image.jpg" alt="">
              <p>Lorem ipsum, quia dol</p>
              <p>150zł</p>
            </div>
          </div>
          <a href="<?=$path?>/category_pages/wine.php" class="nav__item link link-animation wine">Wina</a>
          <div class="nav__dropdown nav__dropdown--two">
            <div class="nav__dropdown--left">
              <a href="<?=$path?>/category_pages/wine-dry.php" class="link link-animation">Wytrawne</a>
              <a href="<?=$path?>/category_pages/wine-sweet.php" class="link link-animation">Słodkie</a>
              <a href="<?=$path?>/category_pages/wine-semisweet.php" class="link link-animation">Półsłodkie</a>
              <a href="<?=$path?>/category_pages/wine-sparkling.php" class="link link-animation">Musujące</a>
            </div>
            <div class="nav__dropdown--right">
              <img src="<?=$path?>/../img/placeholder_image.jpg" alt="">
              <p>Lorem ipsum, quia dol</p>
              <p>150zł</p>
            </div>
          </div>
          <a href="<?=$path?>/category_pages/beer.php" class="nav__item link link-animation beer">Piwa</a>
          <div class="nav__dropdown nav__dropdown--three">
            <div class="nav__dropdown--left">
              <a href="<?=$path?>/category_pages/beer-ipa.php" class="link link-animation">IPA</a>
              <a href="<?=$path?>/category_pages/beer-ale.php" class="link link-animation">ALE</a>
              <a href="<?=$path?>/category_pages/beer-lager.php" class="link link-animation">Lager</a>
              <a href="<?=$path?>/category_pages/beer-stout.php" class="link link-animation">Stout</a>
              <a href="<?=$path?>/category_pages/beer-pilzner.php" class="link link-animation">Pilzner</a>
            </div>
            <div class="nav__dropdown--right">
              <img src="<?=$path?>/../img/placeholder_image.jpg" alt="">
              <p>Lorem ipsum, quia dol</p>
              <p>150zł</p>
            </div>
          </div>
          <a href="<?=$path?>/category_pages/courses.php" class="nav__item link link-animation courses">Kursy</a>
        </div>
        <div class="nav__user">
        <div class="nav__user--search">
          <input type="text" id="navSearchBar" placeholder="Wyszukaj..." /><i id="navSearchBtn"
            class="fa-solid fa-magnifying-glass"
          ></i>
        </div>
          <a href="<?=$path?>/order/cart.php" class="nav__user--cart">
            <i class="fa-solid fa-cart-shopping"></i>
            <p>Koszyk</p>
          </a>
          <div class="nav__user--popup">
            <div class="container">
              <button class="closeBtn"><i class="fa-solid fa-x"></i></button>
              <p>Produkt został dodany do koszyka</p>
            </div>
          </div>
          <?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']):?>
            <a href="<?=$path?>/user_panel/" class="nav__user--cart login-btn">
            <i class="fa-solid fa-user"></i>
            <p>Twoje konto</p>
            </a>
            <a href="<?=$path?>/../php/logout.php" class="nav__user--cart login-btn">
            <i class="fa-solid fa-right-from-bracket"></i>
            <p>Wyloguj się</p></a>
          <?php else:?>
            <a href="<?=$path?>/login_page.php" class="nav__user--cart login-btn">
            <i class="fa-solid fa-right-to-bracket"></i>
            <p>Zaloguj się</p></a>
          <?php endif; ?>
        </div>
      </nav>
      <script>
    const navSearchBar = document.querySelector('#navSearchBar')
    const navSearchBtn = document.querySelector('#navSearchBtn')

    navSearchBtn.addEventListener('click', () => {
	  window.location.replace(`/html/category_pages/product_search.php?searchValue=${navSearchBar.value}`)
})
  </script>
<?php
  $nav = ob_get_contents();
  ob_end_clean();
?>