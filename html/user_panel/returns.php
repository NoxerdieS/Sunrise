<?php
require_once('../../php/dblogin.php');
include '../menu_component.php';
if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']){
 header('Location: ../index.php');
}
ob_start();
?>
<h1 class="admin__headline">Zwroty i reklamacje</h1>
<div class="admin__products">
<?php
$sql = 'select user_order.order_id, login from user_order inner join user on user.id=user_order.user_id where user.id=?';
$query = $pdo->prepare($sql);
$query -> execute([$_SESSION['userId']]);
while ($row = $query->fetch()){
    $param = http_build_query([
        'item' => $row['order_id']
    ]);
    $delParams = http_build_query([
        'item' => $row['order_id'],
        'table' => 'order_details',
        'column' => 'id'
    ]);
    $html = '<div class="admin__product">
    <p class="admin__product--name">Nr: '.$row['order_id'].', User: '.$row['login'].'</p>
    <a href="./edit_order.php?'.$param.'" class="admin__add--addBtn admin__product--edit">Edytuj</a>
    <a href="../../php/admin_panel/delete_item.php?'.$delParams.'" class="admin__add--addBtn admin__product--delete">Usuń</a>
    </div>';
    echo $html;
}
?>
<?php
$body = ob_get_contents();
ob_end_clean();


require('./user_panel.php');
