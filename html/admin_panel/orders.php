<?php

ob_start();
require_once('../../php/dblogin.php');
$pdo = new PDO('mysql:host='.$host.';dbname='.$db.';port=3306', $user, $pass);
?>
<h1 class="admin__headline">Zamówienia</h1>
<div class="admin__products">
<?php
$sql = 'select user_order.order_id, status from user_order inner join order_data on user_order.order_id=order_data.order_id';
$query = $pdo->prepare($sql);
$query -> execute();
while ($row = $query->fetch()):
    $param = http_build_query([
        'item' => $row['order_id']
    ]);
    $delParams = http_build_query([
        'item' => $row['order_id'],
        'table' => 'order_details',
        'column' => 'id'
    ]);
?>
    <div class="admin__product">
    <?php
    if($row['status'] == 0){
        echo '<p>W TRAKCIE</p>';
    }elseif($row['status'] == 1){
        echo '<p>ZREALIZOWANE</p>';
    }elseif($row['status'] == 2){
        echo '<p>ZWRÓCONE</p>';
    }
    ?>
    <p class="admin__product--name">Nr zamówienia: <?=$row['order_id']?></p>
    <a href="./edit_order.php?<?=$param?>" class="admin__add--addBtn admin__product--edit">Edytuj</a>
    <a href="../../php/admin_panel/delete_item.php?<?=$delParams?>" class="admin__add--addBtn admin__product--delete">Usuń</a>
    </div>
<?php endwhile; ?>

</div>
<?php
$body=ob_get_contents(); 
ob_end_clean();

require "./admin_panel.php";