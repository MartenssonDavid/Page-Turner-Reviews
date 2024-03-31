<?php
    // Require variables, make availble to use
    require_once 'C:\xampp\htdocs\PageTurnerReviews\php\dbconnection.php';

    function getTitles(){
        $conn = dbconnect();
        $query = "SELECT book_name FROM books ORDER BY RAND()";
        $results = mysqli_query($conn, $query);

        $titles = array();
        // Put data from row into associative array
        while($row = mysqli_fetch_assoc($results)){
            // Put array into $titels
            $titles[] = $row['book_name'];
        }
        return $titles;
    }
    // Get all data from Books
    function getBooks(){
        // Connection usable variable
        $conn = dbconnect();
        // Query
        $query = "SELECT book_id, book_name, picture FROM books ORDER BY RAND()";
        // Put query into result
        $results = mysqli_query($conn, $query);

        // Array to store data
        // Specifying what needs to go in array since we are initilizing a new array
        $books = array();
        // Data from rows into accociative array
        while($row = mysqli_fetch_assoc($results)){
            // Put resulting array in this array
            $reviews = getReviews($row['book_id']);
            // Link arrays via key
            $row['reviews']= $reviews;
            // Put data of row array into new
            $books[] = $row;
        }
        return $books;
    }

    // Books to fetch reviews 
    function getReviews($book_id){
        $conn = dbconnect();
        // To avoid making prepared statement and changing other code, escape
        $escaped_book_id = mysqli_real_escape_string($conn, $book_id);
        $query = "SELECT rating, comments, date, username FROM reviews 
        LEFT JOIN user ON user.user_id = reviews.user_id 
        WHERE reviews.book_id = '$escaped_book_id'";
        $results = mysqli_query($conn, $query);

        $reviews = array();
        while($row = mysqli_fetch_assoc($results)){
            $reviews[] = $row;
        }
        return $reviews;
    }

    // Function to get categories for navbar
    function getCategories(){
        $conn = dbconnect();
        $query = "SELECT DISTINCT category FROM books";
        $resutls = mysqli_query($conn,$query);

        $categories = array();
        while($row = mysqli_fetch_assoc($resutls)){
            $categories[] = $row;
        }
        return $categories;

    }

    // Function to sort by categories
    function getByCategory($category){
        $mysqli = dbconnect();

        $stmt = $mysqli->prepare("SELECT book_name, author, description, picture FROM books WHERE category = ?");
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $results = $stmt->get_result();
        $data = $results->fetch_all(MYSQLI_ASSOC);
        return $data;
        
    }
    // Function to get detailed view 
    function getDetailedView($bookName){
        $mysqli = dbconnect();
        // Getting data from title pressed
        $stmt = $mysqli->prepare("SELECT * FROM books WHERE book_name = ?");
        $stmt->bind_param("s", $bookName);
        $stmt->execute();
        $bookResults = $stmt->get_result();
        $bookData = $bookResults->fetch_all(MYSQLI_ASSOC);

        // Get reviews as well
        $stmt = $mysqli->prepare("SELECT rating, comments, date, username FROM reviews 
        LEFT JOIN user ON user.user_id = reviews.user_id 
        WHERE reviews.book_id = ?");
        // Get book id from first array
        $bookId = $bookData[0]['book_id'];
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $reviewResults = $stmt->get_result();
        $reviewData = $reviewResults->fetch_all(MYSQLI_ASSOC);

        // Add new data to book array
        $bookData[0]['reviews'] = $reviewData;

        return $bookData;

    }
    // Function to register user 
    function register($username,$email,$password){
        $conn = dbconnect();
        $sql = "INSERT INTO user(userName, email, password) VALUES (?,?,?)";
        
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            // If not working
            header("location: ../register.php?error=stmtNotWorking");
            // Stop code from running completly
            exit();           
        }

        // Hash password and set as new vairable
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        // If no error bind parameters and execute statement then close
        mysqli_stmt_bind_param($stmt, "sss",$username,$email,$hashPassword);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Send user back to homepage
        header("location: ../index.php");
        exit();
    }
    // Function to check if input fields are empty
    function inputEmpty($username,$email,$password,$passwordVerify){
        // Initate variable
        $result;
        // If any are empty
        if(empty($username) || empty($email) || empty($password) || empty($passwordVerify)){
            // Set result true
            $result = true;

        }
        else{
            $result = false;
        }
        return $result;
    }
    // Function to check if passwords match
    function passwordVerify($password,$passwordVerify){
        // Initate variable
        $result;
        // If any are empty
        if($password !== $passwordVerify){
            // Set result true
            $result = true;

        }
        else{
            $result = false;
        }
        return $result;
    }
    // Function to check if email or name is taken and if data exists
    function takenNameEmail($username,$email){
        $conn = dbconnect();
        // Select all
        $sql = "SELECT * FROM user WHERE username = ? OR email=?;";

        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            // If not working
            header("location: ../register.php?error=stmtNotWorking");
            // Stop code from running completly
            exit();           
        }
        // If no error bind parameters and execute statement
        mysqli_stmt_bind_param($stmt, "ss",$username,$email);
        mysqli_stmt_execute($stmt);
        // Get resulting data
        $resultData = mysqli_stmt_get_result($stmt);

        // If data found, place in variable, used for login as well
        if($row = mysqli_fetch_assoc($resultData)){
            return $row;

        }
        else{
            $result = false;
            return $result;
        }
        mysqli_stmt_close($stmt);
    }
    // Function to log in
    function login($username,$password){
        // Connection handeled in function call below
        // Since query is run to check if email is taken
        $username = takenNameEmail($username,$email);
        // If username does not exist
        if($username === false){
            // Return to homepage
            header("location: ../index.php?error=Incorrectusername");
            // Stop code from running completly
            exit();
        }
        // Since array holds all data from users table, we get the hashedpassword
        $hashedPassword = $username['password'];
        // Verify is given password and hashed in db are the same
        $verifyPassword = password_verify($password, $hashedPassword);
    
        // If passwords do not match
        if($verifyPassword === false){
            // Return to homepage
            header("location: ../index.php?error=Incorrectpassword");
            // Stop code from running completly
            exit();
        }
        else if($verifyPassword === true){
            // Login user and start session
            session_start();
            // Set global variable primary key, get from used function
            $_SESSION['user_id'] = $username['user_id'];
            // Send back to homepage
            header("location: ../index.php");
            // Stop code from running completly
            exit();
        }
    }

    // Check if input is empty
    function inputEmptyLogin($username,$password){
        // Initate variable
        $result;
        // If any are empty
        if(empty($username) || empty($password)){
            // Set result true
            $result = true;

        }
        else{
            $result = false;
        }
        return $result;
    }
?>
