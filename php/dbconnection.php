<?php
    // Set connection variables
    define('SERVER', 'localhost');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    define('DATABASE', 'page_turner');

    function dbconnect(){
        $conn = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        } // Else
        //echo "Connected successfully";
        return $conn; // Return connection object

    }

     
    ?>