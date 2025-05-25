<?php
    session_start();
    if(!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn'] || !$_SESSION["isAdmin"]){
     header('Location: ../../index.php');
    }
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
        <h1 class="admin__editorContainer--headline">Dodawanie strony</h1>
        <div class="admin__editor">
            <div id="editorjs" class="admin__editor--textArea"></div>
            <div class="admin__editor--addons">
            <div class="admin__inputContainer">
                <label for="filename">Nazwa pliku:</label>
                <input type="text" id="filename" class="admin__contentContainer--input" placeholder="Nazwa pliku">
            </div>
            <div class="admin__inputContainer">
                <label for="name">Tytuł:</label>
                <input type="text" id="name" class="admin__contentContainer--input" placeholder="Tytuł">
            </div>
                <button id="submitBtn" class="admin__contentContainer--addProduct">Zatwierdź</button>
                <a href="./info_editor.php" class="linkButton">Wróć</a>
            </div>
        </div>
    </main>
    <script>
        const editor = new EditorJS({
            holder: 'editorjs',
            autofocus: true,
            tools: {
                header: Header,
                list: List,
                paragraph: Paragraph
            },
        })
        const submitBtn = document.querySelector('#submitBtn')
        submitBtn.addEventListener('click', () => {
            editor.save().then((outputData) => {
                editor.clear()
                const filename = document.querySelector('#filename')
                const name = document.querySelector('#name')
    
                const formData = new FormData();
                formData.append("filename", filename.value);
                formData.append("name", name.value);
                formData.append("text", JSON.stringify(outputData));
                fetch('../../php/admin_panel/add_info_page.php', {
                    method: 'POST',
                    body: formData
                }).then(                
                    window.location.replace('./info_editor.php')
                )
            })
        })
    </script>
</body>
</html>