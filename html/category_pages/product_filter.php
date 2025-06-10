<?php
ob_start();
?>
<section class="products__left">
  <div class="products__filtersContainer">
    <h2 class="products__left--headline">Filtry</h2>
    <?php
    require_once('../../php/dblogin.php');
    $sql = 'select id from category where category_name like ?';
    $stmt = $pdo->prepare($sql);
    $arr = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $filename = pathinfo(array_pop($arr), PATHINFO_FILENAME);
    $arr = explode('-', $filename);
    if (count($arr) == 1) {
      $filename = $arr[0];
    } else {
      $filename = $arr[1];
    }

    $category_id;
    if ($filename == "product_search") {
      $stmt->execute(['%']);
      $category_id = [];
      while ($row = $stmt->fetch()) {
        array_push($category_id, $row['id']);
      }
      // $category_id = implode(',', $category_id);
      $category_id = "'".implode("', '",$category_id)."'" ;

    } else {
      $stmt->execute([$filename]);
      $category_id = $stmt->fetchColumn();
    }
    unset($arr);

    $sql = <<<SQL
  SELECT distinct(param_name)
  FROM `parameters`
  WHERE id in (
    SELECT param_id 
    FROM `product-params`
    WHERE product_id IN (
      SELECT product.id
      FROM product
      WHERE category_id IN (?)
    ) 
  );
SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$category_id]);
    // var_dump($stmt->fetchAll());
    // var_dump($category_id);
    while ($paramRow = $stmt->fetchColumn()):
    ?>
      <h3 class="products__left--headline2"><?= $paramRow ?></h3>
      <?php
      $sql = 'select distinct(param_value) from `product-params` inner join parameters on `product-params`.param_id = parameters.id where param_name like ? and product_id IN (SELECT product.id FROM product WHERE category_id IN (?))';
      $query = $pdo->prepare($sql);
      $query->execute([$paramRow, $category_id]);
      while ($row = $query->fetch()):
      ?>
        <div class="products__left--optionBox">
          <label for="<?= $row['param_value'] ?>">
            <input type="checkbox" name="type" id="<?= $row['param_value'] ?>" class="filter_checkbox">
            <?= $row['param_value'] ?>
          </label>
        </div>
      <?php endwhile; ?>
    <?php endwhile; ?>
    <h3 class="products__left--headline2">Cena</h3>
    <div class="products__left--priceAdjust">
      <input type="number" id="minPrice" placeholder="od">
      <hr>
      <input type="number" id="maxPrice" placeholder="do">
    </div>
    <button class="button" id="filterSubmit">Zatwierdź</button>
    <button class="button" id="filterReset">Zresetuj filtry</button>
  </div>
</section>
<?php
$filters = ob_get_contents();
ob_end_clean()
?>