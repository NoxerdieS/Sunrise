<?php
    session_start();
    require_once('../../php/dblogin.php');

    $sql = 'select order_details.id, total, payment_name, shipper_name from order_details inner join payment on order_details.payment_id=payment.id inner join shipping on order_details.shipping_id=shipping.id where order_details.id = ?';
    $query = $pdo -> prepare($sql);
    $query -> execute([$_GET['item']]);
    $order_info = $query -> fetch();
    
    $sql = 'select firstname, lastname, mail, telephone, address_id, order_id, invoice_name, invoice_mail, invoice_telephone, invoice_address_id from order_data where order_id = ?';
    $query = $pdo -> prepare($sql);
    $query -> execute([$_GET['item']]);
    $user_info = $query -> fetch();
    $sql = 'select city, postal, address from address where id = ?';
    $query = $pdo -> prepare($sql);
    $query -> execute([$user_info['address_id']]);
    $address_info = $query -> fetch();

    $sql = 'select city, postal, address from address where id = ?';
    $query = $pdo -> prepare($sql);
    $query -> execute([$user_info['invoice_address_id']]);
    $invoice_address_info = $query -> fetch();
    ob_start();
?>

<form class="admin__contentContainer--userForm">
    <div class="admin__formContainer">
                      <label for="order_id">Numer zamówienia:</label>
                      <input type="text" name="order_id" id="order_id" class="admin__contentContainer--input" placeholder="Numer zamówienia" value="<?=$order_info['id']?>" >
                  </div>              
    <div class="admin__formContainer">
                      <label for="total">Wartość zamówienia</label>
                      <input type="text" name="total" id="total" class="admin__contentContainer--input" placeholder="Wartość zamówienia" value="<?=$order_info['total']?>" >
                  </div>
                  <div class="admin__formContainer">
                      <label for="shipping">Sposób dostawy:</label>
                      <input type="text" name="shipping" id="shipping" class="admin__contentContainer--input" placeholder="Sposób dostawy" value="<?=$order_info['shipper_name']?>" >
                  </div>
                  <div class="admin__formContainer">
                      <label for="payment">Sposób płatności:</label>
                      <input type="text" name="payment" id="payment" class="admin__contentContainer--input" placeholder="Sposób płatności" value="<?=$order_info['payment_name']?>" >
                  </div>
                  <div class="admin__formContainer">
                      <label for="firstname">Imię:</label>
                      <input type="text" name="firstname" id="firstname" class="admin__contentContainer--input" placeholder="Imię" value="<?=$user_info['firstname']?>" >
                  </div>
                  <div class="admin__formContainer">
                      <label for="lastname">Nazwisko:</label>
                      <input type="text" name="lastname" id="lastname" class="admin__contentContainer--input" placeholder="Nazwisko" value="<?=$user_info['lastname']?>" >
                  </div>
                  <div class="admin__formContainer">
                      <label for="email">E-mail:</label>
                      <input type="email" name="email" id="email" class="admin__contentContainer--input" placeholder="Email" value="<?=$user_info['mail']?>" >
                  </div>
                  <div class="admin__formContainer">
                      <label for="phone">Telefon:</label>
                      <input type="number" name="phone" id="phone" class="admin__contentContainer--input" placeholder="Telefon" value="<?=$user_info['telephone']?>" >
                  </div>
                  <div class="admin__formContainer">
                      <label for="address">Ulica i numer:</label>
                      <input type="text" name="address" id="address" class="admin__contentContainer--input" placeholder="Ulica i numer" value="<?=$address_info['address']?>" >
                  </div>
                  <div class="admin__formContainer">
                      <label for="postcode">Kod pocztowy:</label>
                      <input type="text" name="postcode" id="postcode" class="admin__contentContainer--input" placeholder="Kod pocztowy" value="<?=$address_info['postal']?>" >
                  </div>
                  <div class="admin__formContainer">
                      <label for="city">Miasto:</label>
                      <input type="text" name="city" id="city" class="admin__contentContainer--input" placeholder="Miasto" value="<?=$address_info['city']?>" >
                  </div>
                  <div class="order__delivery order__productBox">
            <?php
              $sql = 'select product_id, quantity from order_product where order_id = ?';
              $query = $pdo -> prepare($sql);
              $query -> execute([$_GET['item']]);
              while ($product = $query -> fetch()):
                $sql = 'select product_name, price, path from product inner join photos on product.photo_id=photos.id where product.id = ?';
                $query = $pdo -> prepare($sql);
                $query -> execute([$product['product_id']]);
                $row = $query -> fetch();
            ?>
            <div class="cart__product order__product">
                <img src="<?=$row['path']?>" alt="" class="cart__product--img">
                <p class="cart__product--name order__product--name"><?=$row['product_name']?></p>
                <p class="cart__product--price order__product--price"><?=$row['price']?> zł</p>
                <div class="number">
                <h3>x <?=$product['quantity']?></h3>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
</form>
<?php
$details = ob_get_contents();
ob_end_clean();
echo $details;