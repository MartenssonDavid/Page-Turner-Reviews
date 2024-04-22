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
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" id="searchInput" aria-label="Search">
                            </form>
                        </div>
                            <!--Account-->

                        <!--Dropdown sign in form-->
                        <?php 
                        // If user is logged in, replace sign in with sign out, and register with change account details
                        if(isset($_SESSION['user_id'])){
                            ?>
                            <div class="col-auto">
                            <a href="account.php" class="btn btn-secondary " type="button">Account</a>
                        </div>
                         <div class="col-auto">
                               <!--Dropdown container-->
                                 <div class="dropdown">
                                    <!--Dropdown button -->
                                     <button class="btn btn-secondary dropdown-toggle type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"">   
                                         Account Details
                                     </button>
                                 <div class="dropdown-menu" id="sign-in-dropdown" aria-labelledby="dropdownMenuButton">
                                 </form>
                                        <!-- Button to register-->
                                     <div class= "container d-flex justify-content-center">
                                         <a href="updateDetails.php"';
                                             <button class="btn btn-register">
                                                 Update details
                                                 </a>
                                             </button>
                                     </div>
                                    <!--Form to sign in-->
                                         <div class="container d-flex justify-content-center align-items-center">
                                             <!-- Button to sign in-->
                                             <a href=includes/logout.php>
                                             <button class="btn"> 
                                                     Sign out
                                             </button>
                                             </a>
                                         </div>
 
                             </div>
                        <!--Else have a sign in button -->
                        <?php
                        }
                        else{
                            ?>
                             <div class="col-auto">
                                <!--Dropdown container-->
                                 <div class="dropdown">
                                    <!--Dropdown button -->
                                     <button class="btn btn-secondary dropdown-toggle type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"">   
                                         Sign in
                                     </button>
                                 <div class="dropdown-menu" id="sign-in-dropdown" aria-labelledby="dropdownMenuButton">
                                    <!--Form to sign in-->
                                     <form action="includes/login.php" method="post">
                                         <div class="form-group">
                                             <label for="usernameInput">
                                             username</label>
                                             <input type="text" class="form-control input-lg" id="usernameInput" name="username" placeholder="Username">
                                         </div>

                                         <div class="form-group">
                                             <label for="PasswordInput"> 
                                                 Password
                                            </label>
                                             <input type="password" class="form-control" id="PasswordInput" name="password" placeholder="Password123">
                                         </div>

                                         <div class="container d-flex justify-content-center align-items-center">
                                             <!-- Button to sign in-->
                                             <button class="btn" type="submit" name="submit"> 
                                                     Sign in
                                             </button>
                                         </div>
                                     </form>
                                        <!--Button to register-->
                                     <div class= "container d-flex justify-content-center">
                                         <a href="register.php"';
                                             <button class="btn btn-register">
                                                 Register
                                                 </a>
                                             </button>
                                     </div>

                                     </div>
                                 </div>
                             </div>
                            <?php
                        }
                        ?>      
                </div>    
            </div>          
        </div>
    </nav>    
</body>
</html>  
    