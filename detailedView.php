<?php require "php/functions.php" ?>
<?php
// Check if data exists
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
    <link rel="stylesheet" href="css/style.css">
    
  </head>

  <body>
<?php include "includes/nav.php" ?>
    <!--Main body--> <!--On click make popup-->
    <div class="container-fluid mt-3 bg-warning">
        <!--Row holding books-->
        <div class="row justify-content-center">
        <div class="col-md-3 mt-5 border border-secondary bg-light mx-3">
            <!-- Echo first spot in array to get correct book -->
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
            <?php if (!empty($reviews)){ ?>
                <div class="reviews mt-3">
                    <h4 class="header text-center">Reviews</h4>
                    <?php foreach ($reviews as $review) {?>
                        <div class="review border border-secondary">
                            <p>User <?php echo $review['username'] ?></p>
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
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>



    
  </body>

</html>