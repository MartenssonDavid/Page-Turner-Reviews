<?php 

// Check if form data is set via button
if(isset($_POST['submit']))
{   // Set variables
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordVerify = $_POST['passwordVerify'];

    // Only require if form data is submitted

    require_once 'C:\xampp\htdocs\PageTurnerReviews\php\functions.php';
    
    // If any input is empty
    if (inputEmpty($username,$email,$password,$passwordVerify) !== false){
            // If not working
            header("location: ../register.php?error=Missing_Input");
            // Stop code from running completly
            exit();
        }
    // If passwords don't match
    if (passwordVerify($password,$passwordVerify) !== false){
            // If not working
            header("location: ../register.php?error=Passwords_don't_match");
            // Stop code from running completly
            exit();

    }
    // If email is already used
    if(takenNameEmail($username,$email)){
            // If not working
            header("location: ../register.php?error=email_Taken");
            // Stop code from running completly
            exit();
    }
    // If all checks complete, add user
    register($username,$email,$password);
}
else{
    // If not working
    header("location: ../register.php?error=notset");
    // Stop code from running completly
    exit();

}
    




?>