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

    $categoryMapping = [
        'wine-semisweet' => 'wino półsłodkie',
        'wine-dry' => 'wino wytrawne',
    ];
    $filename = $categoryMapping[$filename] ?? $filename;

    $category_id = [];

    if ($filename == "product_search") {
      $stmt->execute(['%']);
      while ($row = $stmt->fetch()) {
        $category_id[] = $row['id'];
      }
    } else {
      $stmt->execute([$filename]);
      $single_id = $stmt->fetchColumn();
      if ($single_id !== false) {
        $category_id[] = $single_id;
      }
    }
unset($arr);

if (empty($category_id)) {
    echo "<p>Brak filtrów dla tej kategorii.</p>";
} else {
    $placeholders = implode(',', array_fill(0, count($category_id), '?'));

    $sql = <<<SQL
    SELECT DISTINCT param_name
    FROM parameters
    WHERE id IN (
      SELECT param_id
      FROM `product-params`
      WHERE product_id IN (
        SELECT id
        FROM product
        WHERE category_id IN ($placeholders)
      )
    );
SQL;


    $stmt = $pdo->prepare($sql);
    $stmt->execute($category_id);

    while ($paramRow = $stmt->fetchColumn()):
?>
      <h3 class="products__left--headline2"><?= htmlspecialchars($paramRow) ?></h3>
      <?php
      $sql = <<<SQL
      SELECT DISTINCT param_value
      FROM `product-params`
      INNER JOIN parameters ON `product-params`.param_id = parameters.id
      WHERE param_name = ?
      AND product_id IN (
        SELECT id
        FROM product
        WHERE category_id IN ($placeholders)
      );
SQL;
      $query = $pdo->prepare($sql);
      $params = array_merge([$paramRow], $category_id);
      $query->execute($params);

      while ($row = $query->fetch()):
      ?>
        <div class="products__left--optionBox">
          <label for="<?= htmlspecialchars($row['param_value']) ?>">
            <input type="checkbox" name="type" id="<?= htmlspecialchars($row['param_value']) ?>" class="filter_checkbox">
            <?= htmlspecialchars($row['param_value']) ?>
          </label>
        </div>
      <?php endwhile; ?>
    <?php endwhile; ?>
<?php
}
?>
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
ob_end_clean();
?>
