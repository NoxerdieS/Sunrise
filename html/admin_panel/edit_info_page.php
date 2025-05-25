<?php
    session_start();
    if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] || !$_SESSION["isAdmin"]){
     header('Location: ../../index.php');
    }
    require_once('../../php/dblogin.php');
    $sql = 'select id, name, filename, path from info_pages where filename like ?';
    $query = $pdo ->prepare($sql);
    $query ->execute([$_GET['item']]);
    $query = $query -> fetch();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../../img/logo_transparent.png" type="image/x-icon">
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
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/paragraph"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/underline@latest"></script>


    <link rel="stylesheet" href="../../css/main.css" />
    <title>Panel administratora</title>
</head>
<body>
    <main class="admin__editorContainer">
        <h1 class="admin__editorContainer--headline">Edycja strony</h1>
        <div class="admin__editor">
        <div id="editorjs" class="admin__editor--textArea"></div>
            <div class="admin__editor--addons">
                <div class="admin__inputContainer">
                    <label for="filename">Nazwa pliku:</label>
                    <input type="text" name="filename" id="filename" class="admin__contentContainer--input" placeholder="Nazwa pliku" value="<?=$query['filename']?>" disabled>
                </div>
                
                <div class="admin__inputContainer">
                <label for="name">Tytuł:</label>
                <input type="text" name="name" id="name" class="admin__contentContainer--input" placeholder="Tytuł" value="<?=$query['name']?>" disabled>
                </div>

                <button id="submitBtn" class="admin__contentContainer--addProduct">Zatwierdź</button>
                <a href="./info_editor.php" class="linkButton">Wróć</a>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="../../js/edit_info_page.js?v=<?=date("h:i:s")?>"></script>
</body>
</html>