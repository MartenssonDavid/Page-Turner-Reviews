<?php
require "php/functions.php";
// Include here since session start is needed
include "includes/nav.php";
// Check if user logged in
  if(!isset($_SESSION['user_id'])){
    // If not redirect
    header("location: ../account.php?error=not_logged_in");
    exit;
  }
  $user_id = $_SESSION['user_id'];
  $favoriteBooks = getFavoritesByID($user_id);
  $reviews = getReviewsById($user_id);

  ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    
  </head>

  <body>
  <!--Include navbar-->


<div class="container-fluid mt-3">
        <!--Row holding books-->
        <div class="row justify-content-center">
        <?php if(!empty ($favoriteBooks)){?>
          <div class="col-md-3 mt-5 border border-secondary bg-light mx-3">
            <h2 class="text-center">Favorite Books</h2>
              <?php
              // Display book titles in headers
              
              foreach ($favoriteBooks as $favoriteBook) { 
                ?>

                  <h3 class="name text-center">
                    <a href="detailedView.php?book_name=<?php echo $favoriteBook['book_name']?>">
                    <?php echo $favoriteBook['book_name']?>
                    </a>
                  </h3>
                  <div class="image"> 
                    <img src="<?php echo $favoriteBook['picture']?>" class="img-fluid" alt="Book Cover">
                  </div>

                  <?php
              }
              ?>
          </div>  

          <?php
        }
        ?>


        <?php if(!empty ($reviews)){?>
          <div class="col-md-3 mt-5 border border-secondary bg-light mx-3">
          <h2 class="text-center">Reviews</h2>
            <?php foreach ($reviews as $review){?>
                <div class="review p-2 mt-3 border border-secondary">
                  <p>User: <?php echo $review['username'] ?></p>
                  <p>Rating: <?php echo $review['rating'] ?></p>
                  <p>Date: <?php echo $review['date'] ?></p>
                  <p>Comments: <?php echo $review['comments'] ?></p>
                </div>
            <?php
            }?>
          </div>
        <?php
        }
        ?>
</div>
        

    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
   


    
  </body>

</html>