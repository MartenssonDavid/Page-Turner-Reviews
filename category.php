
<?php
  if(isset($_GET['category'])){
    $cat = ($_GET['category']);
  }
  ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ucfirst($cat)?></title>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    
  </head>

  <body>
<?php include "includes/nav.php" ?>


   

    <!--Main body--> <!--On click make popup-->
    <div class="container-fluid mt-3 bg-warning">
        <!--Row holding books-->
        <div class="row justify-content-center">
            
            
            <?php
        // Include the functions file
        require_once('php/functions.php');

        // Call the functions to retrieve book titles and authors
        $books = getByCategory($cat);

        // Display book titles in headers
        foreach ($books as $book) {
          ?>
            <div class="col-md-3 mt-5 border border-secondary bg-light mx-3">
            <h3 class="book_name text-center">
              <a href="detailedView.php?book_name=<?php echo $book['book_name'] ?>">
              <?php echo $book['book_name'] ?>
              </a>
            </h3>
            <div class="picture"> 
              <img src="<?php echo $book['picture']?>" class="img-fluid" alt="Book Cover">
            </div>
            <!-- Review spot -->
            </div>
            <?php
        }
        ?>

    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>



    
  </body>

</html>