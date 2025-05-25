<?php
include '../menu_component.php';
if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] || !$_SESSION["isAdmin"]){
 header('Location: ../../index.php');
}
require_once('../../php/dblogin.php');

$product = $_GET['item'];
$sql = 'SELECT id, product_name, price, description, stock, photo_id FROM product WHERE product_name LIKE ?';
$product_info = $pdo->prepare($sql);
$product_info->execute([$product]);
$product_info = $product_info->fetch();

$category = $pdo->query('SELECT category.id, category_name FROM category INNER JOIN product ON category.id = product.category_id WHERE product_name LIKE "'.$product.'"')->fetch();

$sql = 'SELECT param_name, param_value 
        FROM `product-params` 
        INNER JOIN parameters ON parameters.id = `product-params`.param_id 
        WHERE product_id = ?';
$param_stmt = $pdo->prepare($sql);
$param_stmt->execute([$product_info['id']]);
$product_params = $param_stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../../img/logo_transparent.png" type="image/x-icon">
  <link rel="stylesheet" href="../../css/main.css" />
  <title>Panel administratora</title>
</head>
<body>
<?php echo $nav; ?>
<main class="user admin">
  <section class="user__menu admin__menu">
    <a href="./index.php" class="user__menu--item admin__menu--item">Zarządzanie produktami</a>
  </section>

  <section class="user__section admin__section">
    <div class="admin__contentContainer admin__editContainer">
      <form id="create-product-form" method="post" action="../../php/admin_panel/edit_product.php?id=<?=$product_info['id']?>" enctype="multipart/form-data">
        
        <div class="admin__formContainer">
          <label for="name">Nazwa produktu:</label>
          <input type="text" name="name" id="name" class="admin__contentContainer--input" value="<?=$product_info['product_name']?>">
        </div>

        <div class="admin__formContainer">
          <label for="category">Kategoria:</label>
          <select name="category" id="category" class="admin__contentContainer--input">
            <option selected value="<?=$category['id']?>"><?=$category['category_name']?></option>
            <?php foreach($pdo->query('SELECT id, category_name FROM category') as $row): ?>
              <option value="<?=$row["id"]?>"><?=$row["category_name"]?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="admin__formContainer">      
          <label for="price">Cena:</label>
          <input type="text" name="price" id="price" class="admin__contentContainer--input" value="<?=$product_info['price']?>">
        </div>

        <div class="admin__formContainer">
          <label for="quantity">Ilość:</label>
          <input type="number" name="quantity" id="quantity" class="admin__contentContainer--input" value="<?=$product_info['stock']?>">
        </div>

        <div class="admin__formContainer">
          <label for="description">Opis:</label>
          <textarea name="description" id="description" class="admin__contentContainer--textarea"><?=$product_info['description']?></textarea>
        </div>

        <div class="admin__formContainer">
          <label for="image">Zdjęcie produktu:</label>
          <input type="file" name="image" id="image" class="admin__contentContainer--file">
          <?php
            $img_path = $pdo->prepare('SELECT path FROM photos WHERE id = ?');
            $img_path->execute([$product_info['photo_id']]);
            $img_path = $img_path->fetchColumn();
          ?>
          <img src="<?=$img_path?>" alt="Obecne zdjęcie" class="admin__product--img">
        </div>

        <div class="admin__formContainer">
          <label>Parametry produktu:</label>
          <div id="paramContainer">
            <?php $i = 0; foreach ($product_params as $param): ?>
              <div class="admin__formContainer param-group">
                <input type="text" name="param_name<?=$i?>" class="admin__contentContainer--input" placeholder="Nazwa parametru" value="<?=htmlspecialchars($param['param_name'])?>">
                <input type="text" name="param_value<?=$i?>" class="admin__contentContainer--input" placeholder="Wartość parametru" value="<?=htmlspecialchars($param['param_value'])?>">
                <button type="button" class="removeParamBtn addParamBtn">-</button>
              </div>

            <?php $i++; endforeach; ?>
          </div>
          <button type="button" id="addParam" class="addParamBtn">+</button>
          <input type="hidden" name="param_count" value="<?=$i?>">
        </div>

        <div class="admin__formContainer">
          <button type="submit" class="admin__contentContainer--addProduct">Zatwierdź</button>
          <a href="./index.php" class="linkButton">Wróć</a>
        </div>

      </form>
    </div>
  </section>
</main>

<script>
function updateParamIndices() {
  const paramGroups = document.querySelectorAll('.param-group');
  paramGroups.forEach((group, index) => {
    const nameInput = group.querySelector('input[name^="param_name"]');
    const valueInput = group.querySelector('input[name^="param_value"]');

    if (nameInput) nameInput.name = `param_name${index}`;
    if (valueInput) valueInput.name = `param_value${index}`;
  });

  document.querySelector('input[name="param_count"]').value = paramGroups.length;
}

document.querySelector('#addParam').addEventListener('click', () => {
  const container = document.querySelector('#paramContainer');
  const index = container.querySelectorAll('.param-group').length;

  const div = document.createElement('div');
  div.classList.add('admin__formContainer', 'param-group');
  div.innerHTML = `
    <input type="text" name="param_name${index}" class="admin__contentContainer--input" placeholder="Nazwa parametru">
    <input type="text" name="param_value${index}" class="admin__contentContainer--input" placeholder="Wartość parametru">
    <button type="button" class="removeParamBtn addParamBtn">-</button>
  `;
  container.appendChild(div);
  updateParamIndices();
});

document.querySelector('#paramContainer').addEventListener('click', (e) => {
  if (e.target.classList.contains('removeParamBtn')) {
    e.target.parentElement.remove();
    updateParamIndices();
  }
});
</script>

</body>
</html>
