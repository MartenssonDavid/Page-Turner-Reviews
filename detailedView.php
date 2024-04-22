<?php require "php/functions.php" ?>
<?php
// Check if data exists and set
  if(isset($_GET['book_name'])){
    $bookName = ($_GET['book_name']);
    $book = getDetailedView($bookName);
    $bookId = $book[0]['book_id'];
    $reviews = getReviews($bookId);
  }

  ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ucfirst($bookName)?> Books</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    
  </head>

  <body>
<?php include "includes/nav.php" ?>
    <!--Main body--> <!--On click make popup-->
    <div class="container-fluid mt-3">
        <!--Row holding books-->
        <div class="row justify-content-center">
        <div class="col-md-3 mt-5 border border-secondary bg-light data-index="1"mx-3">
            <!-- Echo first spot in array to get correct book -->
            <form action="includes/favoriteFunction.php" id="favorite_form" method="post">
              <?php if(isset($_SESSION['user_id'])){?>
                <input type="hidden" class="form-control" id="user_id_favorite" name="user_id_favorite" value="<?php echo $_SESSION['user_id']; ?>">
              <?php
              }?>
              <input type="hidden" class="form-control" id="book_id_favorite" name="book_id_favorite" value="<?php echo $book[0]['book_id']; ?>">
              <button type="submit" id="heart" class="heart" name="heart"><i class="fa fa-heart"></i></button>
            </form>
            <h3 class="book_name text-center">             
              <?php echo $book[0]['book_name'] ?>           
            </h3>
            <!--Get picture-->
            <div class="picture"> 
              <img src="<?php echo $book[0]['picture']?>" class="img-fluid" alt="Book Cover">
            </div>
            <!--Get author-->
            <div class = "d-flex justify-content-between author-rating"> 
                <p class= "author flex-grow-1"> Author:  <?php echo $book[0]['author']?> </p> 
            </div>
            <div class = "description">
              <?php echo $book[0]['description'] ?>
            </div>
            <!-- Get button in center -->
            <div class="container d-flex justify-content-center align-items-center">
            <!--Create buttons in middle,--> 
            <!--Send book_id in url to next page -->
            
        </div>
        <div class="container mt-3">
        <form action="includes/reviewFunction.php" method="post">
          <!-- Hidden input for book_id from URL and user_id from session-->
          <?php if(isset($_SESSION['user_id'])){?>
            <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
              <?php
              }?>
          <input type="hidden" class="form-control" id="book_id" name="book_id" value="<?php echo $book[0]['book_id']; ?>">
          <input type="hidden" class="form-control" id="ratingInput" name="ratingInput" value="0">
          <!-- Username Input -->
          <div class="form-group">
              <label for="ReviewInput"> Review </label>
              <textarea class="form-control" rows="8" id="ReviewInput" name="review" placeholder="Review"> </textarea>
          </div>
          <!-- Star rating -->
          <!-- avg rating -->
          <div>
            <h3>
              <span id="ratingAvg"> 0.0</span>  
            </h3>
            <div class="form-group" id="rating">
              <i class="fas fa-star star-light"data-index="0"></i>
              <i class="fas fa-star star-light"data-index="1"></i>
              <i class="fas fa-star star-light"data-index="2"></i>
              <i class="fas fa-star star-light"data-index="3"></i>
              <i class="fas fa-star star-light"data-index="4"></i>
            </div>  
          </div>
          <!--Create buttons in middle, ontop of eachother, sign in and --> 
          <div class="container mt-3 d-flex justify-content-center align-items-center">
              <button type="submit" id="submitReview" name="submit">Submit Review</button>
          </div>
        </form>
    </div>
    <!-- Show reviews if found -->
            <?php if (!empty($reviews)){ ?>
                <div class="reviews mt-3">
                    <h4 class="header text-center">Reviews</h4>
                    <?php foreach ($reviews as $review) {?>
                        <div class="review p-2 mt-3 border border-secondary">
                            <p>User: <?php echo $review['username'] ?></p>
                            <p>Rating: <?php echo $review['rating'] ?></p>
                            <p>Date: <?php echo $review['date'] ?></p>
                            <p>Comments: <?php echo $review['comments'] ?></p>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/favorite.js"></script>
    <script src="js/rating.js"></script>



    
  </body>

</html>