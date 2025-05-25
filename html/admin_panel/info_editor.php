<?php
ob_start();
?>
<h1 class="admin__headline">Strony informacyjne</h1>
<div class="admin__add">
        <a href="./add_info_page.php" class="admin__add--addBtn admin__product--edit">Dodaj</a>
        <div class="nav__user--search admin__add--search">
          <input type="text" placeholder="Wyszukaj..." id="searchBar"/><i id="searchBtn" class="fa-solid fa-magnifying-glass"></i>
        </div>
</div>
<div class="admin__products">
<?php
require_once("../../php/dblogin.php");
$sql = 'select id, name, filename, path from info_pages';
$query = $pdo ->prepare($sql);
$query ->execute();
while ($row = $query->fetch()){
    $param = http_build_query([
      'item' => $row['filename']
    ]);
    $delParams = http_build_query([
      'item' => $row['filename'],
      'table' => 'info_pages',
      'column' => 'filename'
    ]);
    $html = '<div class="admin__product">
    <p class="admin__product--name">'.$row['name'].'</p>
    <a href="./edit_info_page.php?'.$param.'" class="admin__add--addBtn admin__product--edit">Edytuj</a>
    <a href="../../php/admin_panel/delete_item.php?'.$delParams.'" class="admin__add--addBtn admin__product--delete">Usuń</a>
    </div>';
    echo $html;
}
?>
</div>
<script src="../../js/info_editor.js"></script>
<?php

$body=ob_get_contents(); 
ob_end_clean();

require "./admin_panel.php";