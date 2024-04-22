<?php
    require_once 'C:\xampp\htdocs\PageTurnerReviews\php\functions.php';
    // Check for input, if found, display search results

    if(isset($_POST['input'])){
        $input = $_POST['input'];
        $searchBooks = searchBooks($input);
        // Loop through the retrieved books and display them
        foreach ($searchBooks as $searchBook) {
        ?>
        <link rel="stylesheet" href="css/style.css">
        <div class="col-md-3 mt-5 border border-secondary bg-light mx-3">
            <h3 class="book_name text-center">
                <!-- Get name book array -->
                <a href="detailedView.php?book_name=<?php echo $searchBook['book_name'] ?>">
                    <?php echo $searchBook['book_name'] ?>
                </a>
            </h3>
            <div class="picture">
                <!-- Get picture from book array -->
                <img src="<?php echo $searchBook['picture']?>" class="img-fluid" alt="Book Cover">
            </div>
        </div>
        <?php
        }
    // If Input not found, show all books 
    }else{
        // If no search query is provided, get all books
        echo '<h2 class="text-center"> Top Rated Books </h2>';
        $topRatedBooks = topRated();
        foreach($topRatedBooks as $topRatedBook){
            ?>
            
        <div class="col-md-3 mt-5 border border-secondary bg-light mx-3">
            <h3 class="book_name text-center">
                <!-- Get name book array -->
                <a href="detailedView.php?book_name=<?php echo $topRatedBook['book_name'] ?>">
                    <?php echo $topRatedBook['book_name'] ?>
                </a>
            </h3>
            <div class="picture">
                <!-- Get picture from book array -->
                <img src="<?php echo $topRatedBook['picture']?>" class="img-fluid" alt="Book Cover">
            </div>
            <div class="rating">Rating: <?php echo $topRatedBook['average_rating'] ?> </div>
        </div>
        
        <?php
        }
        echo '<h2 class="text-center"> All books </h2>';
        $books = getBooks();
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
                    <!-- Get picture from book array -->
                    <img src="<?php echo $book['picture']?>" class="img-fluid" alt="Book Cover">
                </div>
            </div>
            <?php
        }
    } ?>


    



