<?php

ob_start();
require_once('../../php/dblogin.php');

?>
<h1 class="admin__headline">Produkty</h1>
<div class="admin__add">
        <button class="admin__add--addBtn">Dodaj</button>
        <div class="nav__user--search admin__add--search">
          <input type="text" placeholder="Wyszukaj..." id="searchBar"/><i id="searchBtn" class="fa-solid fa-magnifying-glass"></i>
        </div>
</div>
<div class="admin__products">
<?php
$query = $pdo -> query('select product_name, path from product inner join photos on product.photo_id=photos.id;');
$html = '';
while ($row = $query->fetch()){
    $param = http_build_query([
        'item' => $row['product_name']
    ]);
    $delParams = http_build_query([
        'item' => $row['product_name'],
        'table' => 'product',
        'column' => 'product_name'
    ]);

    $html .= '<div class="admin__product">
    <img src="'.$row['path'].'" alt="" class="admin__product--img">
    <p class="admin__product--name">'.$row['product_name'].'</p>
    <a href="./edit_product.php?'.$param.'" class="admin__add--addBtn admin__product--edit">Edytuj</a>
    <a href="../../php/admin_panel/delete_item.php?'.$delParams.'" class="admin__add--addBtn admin__product--delete">Usuń</a>
    </div>';
}
echo $html;
?>
<div class="admin__popup">
      <div class="admin__contentContainer admin__contentContainerProduct">
        <button class="admin__contentContainer--closeBtn"><i class="fa-solid fa-x"></i></button>
        <form id="create-product-form" method="post">
            <input type="hidden" id='filename' name="filename" value="index">
            <div class="admin__formContainer">
                <label for="name">Nazwa produktu:</label>
                <input type="text" name="name" id="name" class="admin__contentContainer--input" placeholder="Nazwa produktu">
            </div>

            <div class="admin__formContainer">
                <label for="category">Wybierz kategorię:</label>
                <select type="text" name="category" id="category" class="admin__contentContainer--input" placeholder="Kategoria">
                    <?php foreach($pdo -> query('select id, category_name from category;') as $row): ?>
                        <option value="<?=$row["id"]?>"><?=$row["category_name"]?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="admin__formContainer">      
                <label for="price">Cena:</label>
                <input type="text" name="price" id="price" class="admin__contentContainer--input" placeholder="Cena">
            </div>

            <div class="admin__formContainer">
                <label for="description">Opis produktu:</label>
                <textarea name="description" id="description" class="admin__contentContainer--textarea" name="category" id="category" placeholder="Opis" wrap="hard"></textarea>
            </div>

            <div class="admin__formContainer">
                <label for="quantity">Ilość:</label>
                <input type="number" name="quantity" id="quantity" class="admin__contentContainer--input" placeholder="Ilość">
            </div>
            <div class="admin__formContainer">
                    <label>Dodaj parametr</label>
                    <button type="button" id="addParam" class="addParamBtn">+</button>
            </div>
            <div class="admin__formContainer">
                <label for="image">Zdjęcia produktu</label>
                (Tylko format .png)
                <input type="file" name="image" id="image" class="admin__contentContainer--file">
            </div>
            <button type="submit" id="productSubmitBtn" class="admin__contentContainer--addProduct">Dodaj</button>
        </form>
      </div>
    </div>
</div>
<script src="../../js/add_params.js"></script>
<?php

$body=ob_get_contents(); 
ob_end_clean();

require "./admin_panel.php";
