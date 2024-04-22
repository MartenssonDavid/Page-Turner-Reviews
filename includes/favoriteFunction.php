<?php
if(isset($_POST['bookId']) &&isset($_POST['userId'])){
    $book_id = $_POST['bookId'];
    $user_id = $_POST['userId'];
    require_once 'php/functions.php';
    addFavorite($book_id, $user_id);
}
?>
