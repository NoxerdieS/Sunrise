<?php
include '../menu_component.php';
if (isset($_SESSION['cart']) && empty($_SESSION['cart'])) {
  header('Location: ../../index.php');
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
    type="image/x-icon" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap"
    rel="stylesheet" />
  <script
    src="https://kit.fontawesome.com/bec5797acb.js"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="../../css/main.css" />
  <title>Sklep</title>
</head>

<body>
  <?php
  echo $nav;

  ?>
  <main class="cart order">
    <section class="order__left">
      <div class="order__delivery">
        <form id="delivery" class="order__delivery--form">
          <p class="error cart-error delivery-error">Nie wybrano sposobu dostawy</p>
          <h2>Dostawa</h2>
          <?php
          require_once('../../php/dblogin.php');
          $sql = 'select id, shipper_name, shipping_cost from shipping where isActive = 1';
          $query1 = $pdo->prepare($sql);
          $query1->execute();
          while ($shipping_row = $query1->fetch()):
          ?>
            <div class="delivery-option">
              <label>
                <input type="radio" name="delivery" value="<?= $shipping_row['id'] ?>">
                <?= $shipping_row['shipper_name'] ?>
              </label>
              <p><?= $shipping_row['shipping_cost'] ?> zł</p>
            </div>
          <?php endwhile; ?>
        </form>
      </div>
      <div class="order__address">
        <form id="address" class="order__address--form">
          <h2>Adres dostawy</h2>
          <div class="order__personOption">
            <div class="person-option">
              <label>
                <input type="radio" name="person" id="private" checked>
                Osoba prywatna
              </label>
            </div>
            <div class="person-option">
              <label>
                <input type="radio" name="person" id="business">
                Firma
              </label>
            </div>
          </div>
          <?php
          $sql = 'select user.id, address_id, firstname, lastname, telephone, mail, city, postal, address from address inner join user on user.address_id=address.id where login = ?';
          $query4 = $pdo->prepare($sql);
          if (isset($_SESSION['login'])) {
            $login = $_SESSION['login'];
          } else {
            $login = '';
          }
          $query4->execute([$login]);
          $info = $query4->fetch();
          $fname = $info['firstname'] ?? '';
          $lname = $info['lastname'] ?? '';
          if ($fname != '') {
            $fname .= ' ';
          }
          ?>
          <input type="hidden" name="user_id" value="<?= $info['id'] ?>">
          <input type="hidden" name="address_id" value="<?= $info['address_id'] ?>">
          <div class="order__address--inputBox">

            <input type="text" name="name" id="name" placeholder="Imię i nazwisko lub nazwa firmy" value="<?= $fname . $lname ?>" class="address-input" required>
            <p class="error cart-error">To pole nie może być puste</p>
          </div>

          <div class="order__address--inputBox">
            <input type="text" name="address" id="address-input" placeholder="Ulica i numer domu / mieszkania" value="<?= $info['address'] ?? '' ?>" class="address-input" required>
            <p class="error cart-error">To pole nie może być puste</p>
          </div>

          <div class="order__address--inputBox">
            <input type="text" name="postcode" id="postcode" placeholder="Kod pocztowy" value="<?= $info['postal'] ?? '' ?>" class="address-input" required>
            <p class="error cart-error">Niepoprawny kod pocztowy</p>
          </div>

          <div class="order__address--inputBox">
            <input type="text" name="city" id="city" placeholder="Miejscowość" value="<?= $info['city']  ?? '' ?>" class="address-input" required>
            <p class="error cart-error">To pole nie może być puste</p>
          </div>

          <div class="order__address--inputBox">
            <?php
            function formatPhone($phone)
            {
              return preg_replace('/(\d{3})(\d{3})(\d{3})/', '$1 $2 $3', $phone);
            }
            ?>
            <input type="text" name="phone" id="phone" placeholder="Numer telefonu"
              value="<?= isset($info['telephone']) ? formatPhone($info['telephone']) : '' ?>"
              class="address-input">
            <p class="error cart-error">Niepoprawny numer telefonu</p>
          </div>

          <div class="order__address--inputBox">
            <input type="email" name="email" id="email" placeholder="Email" value="<?= $info['mail'] ?? '' ?>" class="address-input" required>
            <p class="error cart-error">Niepoprawny adres email</p>
          </div>

          <h2>Dane do faktury</h2>
          <p class="invoiceInfo"><i class="ti ti-info-circle"></i>W naszym sklepie internetowym dowodem zakupu jest faktura. Standardowo wystawiamy ją na dane z adresu dostawy.</p>

          <div class="order__address--checkboxBox">
            <input type="checkbox" name="invoice" id="invoice" class="checkbox">
            <label for="invoice">Chcę podać inne dane do faktury</label>
          </div>

        </form>
        <form id="invoice" class="order__address--invoceData">
          <div class="order__address--inputBox">
            <input type="text" name="invoice_name" id="name-invoice" placeholder="Imię i nazwisko lub nazwa firmy" class="address-input">
            <p class="order__address--inputBox--error error error-name">To pole nie możę być puste</p>
          </div>
          <div class="order__address--inputBox">
            <input type="text" name="invoice_address" id="address-invoice" placeholder="Ulica i numer domu / mieszkania" class="address-input">
            <p class="order__address--inputBox--error error error-name">To pole nie możę być puste</p>
          </div>
          <div class="order__address--inputBox">
            <input type="text" name="invoice_postcode" id="postcode-invoice" placeholder="Kod pocztowy" class="address-input">
            <p class="order__address--inputBox--error error error-postcode">Niepoprawny kod pocztowy</p>
          </div>
          <div class="order__address--inputBox">
            <input type="text" name="city" id="city-invoice" placeholder="Miejscowość" class="address-input">
            <p class="order__address--inputBox--error error error-name">To pole nie możę być puste</p>
          </div>
        </form>
      </div>
      <div class="order__delivery">
        <form id="payment" class="order__delivery--form">
          <p class="error cart-error payment-error">Nie wybrano sposobu płatności</p>
          <h2>Forma płatności</h2>
          <?php
          $sql = 'select id, payment_name, payment_cost from payment where isActive = 1';
          $query3 = $pdo->prepare($sql);
          $query3->execute();
          while ($payment_row = $query3->fetch()):
          ?>
            <div class="delivery-option">
              <label>
                <input type="radio" name="payment" value="<?= $payment_row['id'] ?>">
                <?= $payment_row['payment_name'] ?>
              </label>
            </div>
          <?php endwhile; ?>
        </form>
      </div>
      <div class="order__agreements">
        <h2>Zgody i oświadczenia</h2>
        <form>
          <p class="error cart-error">Nie zaakceptowano zgód</p>
          <div class="order__address--checkboxBox">
            <input type="checkbox" name="agreements" id="agreement" class="checkbox" required>
            <label for="agreement">Akceptuję regulamin sklepu(wymagane)</label>
          </div>
        </form>
      </div>
    </section>
    <section class="order__right">
      <div class="cart__buySection order__right--buySection">
        <button id="promoBtn" class="cart__buySection--promoBtn">Masz kod promocyjny?<i class="ti ti-chevron-down"></i></button>
        <div class="input-box" id="promobox">
          <input type="text" id="promocode" name="promocode">
          <button>Aktywuj</button>
        </div>
        <div class="cart__priceSection">
          <div class="priceBox">
            <p>Łączna kwota</p>
            <?php
            $sql = 'select price from product where id = ?';
            $query2 = $pdo->prepare($sql);
            $cart = $_SESSION['cart'] ?? [];
            $total = 0;
            for ($i = 0; $i < count($cart); $i++) {
              $query2->execute([$cart[$i][0]]);
              $price = $query2->fetchColumn();
              $total += $cart[$i][1] * $price;
            }

            $shipping_cost = 0;
            $payment_cost = 0;

            if (isset($_POST['delivery'])) {
              $sql = 'SELECT shipping_cost FROM shipping WHERE id = ?';
              $query = $pdo->prepare($sql);
              $query->execute([$_POST['delivery']]);
              $shipping_cost = $query->fetchColumn();
            }

            $payment_cost = 0;
            if (isset($_POST['payment'])) {
              $sql = 'SELECT payment_cost FROM payment WHERE id = ?';
              $query = $pdo->prepare($sql);
              $query->execute([$_POST['payment']]);
              $payment_percentage = $query->fetchColumn();
              $payment_cost = $total * $payment_percentage; 
            }

            $total += $shipping_cost + $payment_cost;
            ?>
            <p class="price"><?= $total ?> zł</p>
          </div>
          <button id="orderBtn" class="cart__priceSection--buyBtn">Złóż zamówienie<i class="ti ti-chevron-right"></i></button>
        </div>
      </div>
    </section>
  </main>
  <footer class="text-light py-4 text-center">
    <?php
    include '../footer_component.php';
    echo $footer;
    ?>
    <script src="../../js/order.js"></script>
    <p class="mb-0"> &copy; 2025 | Sunrise</p>
  </footer>
</body>

</html>