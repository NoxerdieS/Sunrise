<?php
$text = $_POST['text'];
$filename = $_POST['filename'];
$name = $_POST['name'];

file_put_contents('../../html/info_pages/'.$filename, $text);