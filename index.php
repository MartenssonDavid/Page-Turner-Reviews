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
<?php include "includes/nav.php" ?>

    <!--Main body-->
    <div class="container-fluid mt-3 bg-warning">
        <!--Row holding books-->
        <div class="row justify-content-center">
          <?php
          // Include the functions file
          require_once('php/functions.php');
          // Call the functions to retrieve book titles and authors
          $books = getBooks();
          // For each book found create a div taking up 3 cols
          foreach ($books as $book) {
          ?>
            <div class="col-md-3 mt-5 border border-secondary bg-light mx-3">
              <h3 class="book_name text-center">
              <!-- Get name book array -->
                <a href="detailedView.php?book_name=<?php echo $book['book_name'] ?>">
                <?php echo $book['book_name'] ?>
                </a>
              </h3>
              <div class="picture">
              <!--Get picture from book array--> 
              <img src="<?php echo $book['picture']?>" class="img-fluid" alt="Book Cover">
              </div>
              <!-- Commented out, might use later, at the moment reviews only availbe in detailview-->
              <?php
              /*
                // Check for data matching the book id
                if(!empty($book['reviews'])){
                  // Only print the first, change later to highest rating
                  $review = $book['reviews'][0];
                    ?>
                      <div class="reviews mt-5 mb-5 border border-secondary">
                        <h4 class="header text-center">
                        Reviews
                        </h4> 
                        <div class="details d-flex">
                          <!--Get from review array within books array -->
                          <p class="user flex-grow-1"> User:  <?php echo $review['username']?> </p>
                          <p class="rating flex-grow-1"> Rating:  <?php echo $review['rating']?> </p> 
                        </div>
                      
                        <div class= "comments"> 
                        <p class="comments"> <?php echo $review['comments']?></p>
                        </div>
                        <p class="date"> Date: <?php echo $review['date']?></p>
                      </div>
                  <?php                
                }else{
                  echo"<p> No reviews</p>";
                }
                */
                ?>

              </div>
            <?php
          }
          ?>
        
        </div>

    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
   


    
  </body>

</html>