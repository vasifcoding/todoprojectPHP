<?php 
try {
    $db = new PDO('mysql:host=localhost;dbname=todolist', 'root', '');

} catch (PDOException $e) {
   echo 'hata : '.$e->getMessage();
}
?>
