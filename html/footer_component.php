<?php
    if(is_readable('./php/dblogin.php')){
        include './php/dblogin.php';
    }else if(is_readable('../php/dblogin.php')){
        include '../php/dblogin.php';
    }else{
        include '../../php/dblogin.php';
    }
    $path = '/sklep_internetowy/html/info_pages/';
    $sql = 'select name, path from info_pages';
    $query = $pdo -> prepare($sql);
    $query -> execute();
    ob_start();
    while ($row = $query -> fetch()):
?>
<a href="<?=$path.$row['path'].'.php'?>"><?=$row['name']?></a> <br>
<?php
endwhile;
$footer = ob_get_contents();
ob_end_clean();
?>