<?php
include '../menu_component.php';
ob_start();
require_once('../../php/dblogin.php');
?>
<h1 class="admin__headline">Zamówienia</h1>
<div class="admin__products">
<?php
$sql = 'select id from user where login like ?';
$query = $pdo->prepare($sql);
$query -> execute([$_SESSION['login']]);
$user_id = $query -> fetchColumn();
$sql = 'select order_id from user_order where user_id = ?';
$query = $pdo->prepare($sql);
$query -> execute([$user_id]);
while ($row = $query->fetch()):
    $param = http_build_query([
        'item' => $row['order_id']
    ]);
    $delParams = http_build_query([
        'item' => $row['order_id'],
        'table' => 'user_order',
        'column' => 'order_id'
    ]);
?>
    <div class="admin__product">
    <p class="admin__product--name">Numer zamówienia: <?=$row['order_id']?></p>
    <button class="details admin__add--addBtn admin__product--delete">Szczegóły</button>
    <input type="hidden" value="<?=$row['order_id']?>">
    </div>
    <?php endwhile; ?>
    <script src="../../js/user_panel.js"></script>
    <?php
$body = ob_get_contents();
ob_end_clean();

require('./user_panel.php');
