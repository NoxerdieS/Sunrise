<?php
    session_start();
    $_SESSION['loggedIn'] = false;
    $_SESSION['login'] = '';
    $_SESSION['isAdmin'] = false;
    header('Location: ../index.php');
?>