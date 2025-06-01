<?php
include '../menu_component.php';
ob_start();
require_once('../../php/dblogin.php');
?>
<h1 class="admin__headline">Zamówienia</h1>
<div class="admin__products">
<?php
$sql = 'select user_order.order_id, status from user_order inner join order_data on user_order.order_id=order_data.order_id where user_id = ?';
$query = $pdo->prepare($sql);
$query -> execute([$_SESSION['userId']]);
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
    <?php
    if($row['status'] == 0){
        echo '<p>W TRAKCIE</p>';
    }elseif($row['status'] == 1){
        echo '<p>ZREALIZOWANE</p>';
    }elseif($row['status'] == 2){
        echo '<p>ZWRÓCONE</p>';
    }
    ?>
    <a class="details admin__add--addBtn admin__product--edit">Szczegóły</a>
    <?php if($row['status'] != 2): ?>
    <a class="return admin__add--addBtn admin__product--delete">Zwróć</a>
    <?php endif; ?>
    <input type="hidden" value="<?=$row['order_id']?>">
    </div>
    <?php endwhile; ?>
    <script src="../../js/user_panel.js"></script>
    <?php
$body = ob_get_contents();
ob_end_clean();

require('./user_panel.php');
