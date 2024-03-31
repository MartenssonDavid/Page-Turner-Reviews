<?php 
// Check if data is set via button
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    // If data is set, require functions
    require_once 'C:\xampp\htdocs\PageTurnerReviews\php\functions.php';

    // Error check
    if (inputEmptyLogin($username,$password) !== false){
        // If not working
        header("location: ../index.php?error=Missing_Input");
        // Stop code from running completly
        exit();
    }
    // If all checks ok, run login function
    login($username, $password);

}
else{
    header("location: ../index.php?error=NotSet");
    exit();
}
?>