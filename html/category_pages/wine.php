<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="../img/logo_transparent.png"
      type="image/x-icon"
    />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap"
      rel="stylesheet"
    />
    <script
      src="https://kit.fontawesome.com/bec5797acb.js"
      crossorigin="anonymous"
    ></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/main.css" />
    <title>Sklep</title>
  </head>
  <body>
  <?php
      include './menu_component.php';
      echo $nav
    ?>
    <main class="productCategories">
      <section class="productCategories__left">
        <div class="productCategories__linkContainer">
          <h1 class="productCategories__left--headline">Kategorie</h1>
          <a href="./wine-dry.php" class="productCategories__left--link">Wytrawne</a>
          <a href="./wine-sweet.php" class="productCategories__left--link">Słodkie</a>
          <a href="./wine-semisweet.php" class="productCategories__left--link">Półsłodkie</a>
          <a href="./wine-sparkling.php" class="productCategories__left--link">Musujące</a>
        </div>
          <!-- <div style="width: 300px; height: 300px;"></div> -->
      </section>
      <section class="productCategories__right">
        <div class="productCategories__categoryContainer">
          <a href="./wine-dry.php" class="productCategories__categoryContainer--element">
            <img src="../../img/placeholder_image.jpg" alt="Wytrawne">
            <p>Wytrawne</p>
          </a>
          <a  href="./wine-sweet.php"class="productCategories__categoryContainer--element">
            <img src="../../img/placeholder_image.jpg" alt="Słodkie">
            <p>Słodkie</p>
          </a>
          <a href="./wine-semisweet.php" class="productCategories__categoryContainer--element">
            <img src="../../img/placeholder_image.jpg" alt="Półsłodkie">
            <p>Półsłodkie</p>
          </a>
          <a href="./wine-sparkling.php" class="productCategories__categoryContainer--element">
            <img src="../../img/placeholder_image.jpg" alt="Musujące">
            <p>Musujące</p>
          </a>
        </div>
      </section>
    </main>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../../js/index.js"></script>
  </body>
</html>
