<?php session_start(); ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    
  </head>

  <body>
<!--Navbar-->
<nav class="navbar bg-dark">
        <!--Hold navbar items-->
        <div class="container-xxl">
            <!--Brand, picture or name-->
            <a href="index.php" class="navbar-brand">
                <!--Look up what span is, tutorials-->
                <span class="fw-bold text-secondary">
                    Page Turner Reviews
                </span>
            </a>
            <!--Navbar Items-->
                <div class="justify-content-end align-center">
                    <div class="row">   
                        <!--Div for -->
                        <div class="col-auto">
                            <!--Dropdown container-->
                            <div class="dropdown">
                                <!--Dropdown button-->
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">    
                                    Categories
                                </button>
                                <!--Items in dropdown-->
                                <div class="dropdown-menu" id="menu" aria-labelledby="dropdownMenuButton">
                                    <!-- Get array -->
                                    <?php
                                        require_once ('php/functions.php');

                                        $categories = getCategories();

                                        foreach($categories as $category){
                                            
                                            echo '<a href="category.php?category=' . $category['category'] .'">';
                                            echo $category['category'];
                                            echo '</a>';
                                            echo '<br />';
                                        }                                        
                                    ?>
                                </div>
                            </div>
                        </div>
                        

                        <!--Div for searchbar-->
                        <div class="col-auto">
                            <form class="form-inline" id="search">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            </form>
                        </div>

                        <!--Div holding search button-->
                        <div class="col-auto">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" form="search">Search</button>
                        </div>
                            <!--Account-->
                        <div class="col-auto">
                            <a href="account.php" class="btn btn-secondary " type="button">Account</a>
                        </div>
                        <!--Dropdown sign in form-->
                        <?php 
                        // If user is logged in, replace sign in button with log out   
                        if(isset($_SESSION['user_id'])){
                        echo '<div class="col-auto">';
                                echo '<div>';
                                    echo '<button class="btn btn-secondary">';
                                        echo '<a href=includes/logout.php>';
                                            echo 'Sign out';
                                        echo '</a>';
                                    echo '</button>';
                                echo '</div>';
                        echo '</div>';
                            // Else have a sign in button
                        }
                        else{
                            echo '<div class="col-auto">';
                                // Dropdown container
                                echo '<div class="dropdown">';
                                    // Dropdown button
                                    echo '<button class="btn btn-secondary dropdown-toggle type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"">';   
                                        echo 'Sign in';
                                    echo '</button>';
                                echo '<div class="dropdown-menu" id="sign-in-dropdown" aria-labelledby="dropdownMenuButton">';
                                    // Form to sign in
                                    echo '<form action="includes/login.php" method="post">';
                                        echo '<div class="form-group">';
                                            echo '<label for="usernameInput">';
                                            echo 'username</label>';
                                            echo '<input type="text" class="form-control input-lg" id="usernameInput" name="username" placeholder="Username">';
                                        echo '</div>';

                                        echo '<div class="form-group">';
                                            echo '<label for="PasswordInput">'; 
                                                echo 'Password'; 
                                            echo'</label>';
                                            echo '<input type="password" class="form-control" id="PasswordInput" name="password" placeholder="Password123">';
                                        echo '</div>';

                                        echo '<div class="container d-flex justify-content-center align-items-center">';
                                             // Create buttons for sign in
                                            echo '<button class="btn" type="submit" name="submit">'; 
                                                    echo "Sign in";
                                            echo '</button>';
                                        echo '</div>';
                                    echo '</form>';
                                        // Button to register
                                    echo '<div class= "container d-flex justify-content-center">';
                                        echo '<a href="register.php"';
                                            echo '<button class="btn btn-register">';
                                                echo "Register";
                                                echo '</a>';
                                            echo '</button>';
                                    echo '</div>';

                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                        ?> 
                                              
                        

                        
                    </div>


                    
                </div>          
        </div>
    </nav>

    


    


    
  </body>

</html>  
    