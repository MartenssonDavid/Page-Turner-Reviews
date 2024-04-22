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
        $conn = dbconnect();

        $stmt = $conn->prepare("SELECT book_name, author, description, picture FROM books WHERE category = ?");
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $results = $stmt->get_result();
        $data = $results->fetch_all(MYSQLI_ASSOC);
        return $data;
        
    }
    // Function to get detailed view 
    function getDetailedView($bookName){
        $conn = dbconnect();
        // Getting data from title pressed
        $stmt = $conn->prepare("SELECT * FROM books WHERE book_name = ?");
        $stmt->bind_param("s", $bookName);
        $stmt->execute();
        $bookResults = $stmt->get_result();
        $bookData = $bookResults->fetch_all(MYSQLI_ASSOC);

        // Get reviews as well
        $stmt = $conn->prepare("SELECT rating, comments, date, username FROM reviews 
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
        $stmt = $conn->prepare("INSERT INTO user(userName, email, password) VALUES (?,?,?)");
        // Hash password and set as new vairable
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sss",$username,$email,$hashPassword);
        $stmt->execute();
        $stmt->close();
        // Send user back to homepage
        header("location: ../index.php");
    }
    // Function to post review
    function postReview($user_id,$book_id,$rating,$review){
        $conn = dbconnect();
        $stmt =$conn->prepare("INSERT INTO reviews(user_id,book_id,rating,comments) VALUES (?,?,?,?)");
        $stmt->bind_param("iiis",$user_id,$book_id,$rating,$review);
        $stmt->execute();
        $stmt->close();
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
        $stmt =$conn->prepare("SELECT * FROM user WHERE username = ? OR email=?;");
        $stmt->bind_param("ss",$username,$email);
        $stmt->execute();
        $results = $stmt->get_result();
        if($row=$results->fetch_assoc()){
            return $row;
        }else{
            $result = false;
            return $result;
        }
        $stmt->close();
    }
    // Check if username exists
    function usernameExists($username){
        $conn = dbconnect();
        // Select all
        $stmt =$conn->prepare("SELECT * FROM user WHERE username = ?;");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $results = $stmt->get_result();
        if($row=$results->fetch_assoc()){
            return $row;
        }else{
            $result = false;
            return $result;
        }
        $stmt->close();
    }
    // Function to log in
    function login($username,$password){
        // Connection handeled in function call below
        // Since query is run to check if email is taken
        $username = usernameExists($username);
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
            // Set global variable primary key, get from used function
            session_start();
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
    // Function for searching books, try to make prepared if possible
    function searchBooks($input){
        $conn = dbconnect();
        // Query
        $stmt = $conn->prepare("SELECT book_name, picture FROM books WHERE book_name LIKE '%{$input}%'");
        $stmt->execute();
        $results = $stmt->get_result();
        // Array to store data
        $searchBooks = array();
        // Data from rows into accociative array
        while($row = $results->fetch_assoc()){
            // Put data of row array into new
            $searchBooks[] = $row;
        }
        return $searchBooks;          
    }
    // Add book to favorites
    function addFavorite($book_id, $user_id){
        $conn = dbconnect();
        $stmt =$conn->prepare("INSERT INTO favorites(book_id,user_id) VALUES (?,?)");
        $stmt->bind_param("ii",$book_id, $user_id);
        $stmt->execute();
        $stmt->close();

    }
    // Get favorites by userid
    function getFavoritesByID($user_id){
        $conn = dbconnect();
        // Get bookId for the user in favorites
        $stmt = $conn->prepare("SELECT books.book_name,books.picture FROM favorites INNER JOIN books ON favorites.book_id = books.book_id WHERE  favorites.user_id= ?");
        $stmt->bind_param("i" ,$user_id);
        $stmt->execute();
        $results = $stmt->get_result();
        $favoriteBooks = array();
        while($row = $results->fetch_assoc()){
            $favoriteBooks[] = $row;
        }
        return $favoriteBooks;
        
    }

    function getReviewsById($user_id){
        $conn = dbconnect();
        $stmt = $conn->prepare("SELECT rating, comments, date, username FROM reviews 
        LEFT JOIN user ON user.user_id = reviews.user_id 
        WHERE reviews.user_id = ?");
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        $results = $stmt->get_result();
        $reviews = array();
        while($row = $results->fetch_assoc()){
            $reviews[] = $row;
        }
        return $reviews;
    }
    // Update account details
    function updateAccountDetails($user_id,$email, $username,  $password){
        $conn = dbconnect();
        $stmt = $conn->prepare("UPDATE user SET email=? ,username=?,password=? WHERE user_id = ?");
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("sssi",$email,$username,$hashPassword,$user_id);
        $stmt->execute();
        $stmt->close();
        header("location: ../index.php");
        
        
    }
    // Get top five rated by review rating average
    function topRated(){

        $conn = dbconnect();
        $stmt = $conn->prepare("SELECT books.book_name,books.picture, AVG(reviews.rating) AS average_rating FROM books books LEFT JOIN reviews reviews ON 
        books.book_id = reviews.book_id GROUP BY books.book_id
        ORDER BY average_rating DESC LIMIT 5");
        $stmt->execute();
        $topResults = $stmt->get_result();
        $topBooks = $topResults->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $topBooks;


    }

?>
