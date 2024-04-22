<?php
var_dump($_POST);
// Check if data is set
if(isset($_POST['userId']) && isset($_POST['bookId']) && isset($_POST['rating']) && isset($_POST['review'])){
    // Assign data to variables
    $user_id = $_POST['userId'];
    $book_id = $_POST['bookId'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    require_once 'C:\xampp\htdocs\PageTurnerReviews\php\functions.php';
    // If all checks complete, run function
    postReview($user_id, $book_id, $rating, $review);

}