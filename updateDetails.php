<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    
  </head>

  <body>
<?php include "includes/nav.php" ?>


    <div class="container mt-3 bg-warning">
      <form action="includes/updateDetailsFunction.php" method="post">
      <input type="hidden" class="form-control" id="user_id_favorite" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
        <!-- Username Input -->
        <div class="form-group">
            <label for="UpdateUserNameInput"> Username </label>
            <input type="username" class="form-control" id="UpdateUserNameInput" name="username" placeholder="username">
        </div>

        <!-- Email Input -->
        <div class="form-group">
            <label for="UpdateEmailInput">Email adress</label>
            <input type="email" class="form-control" id="UpdateEmailInput" name="email" placeholder="name@email.com">
        </div>

        <!-- Password Input -->
        <div class="form-group">
            <label for="UpdatePasswordInput">Password</label>
            <input type="password" class="form-control" id="UpdatePasswordInput" name="password" placeholder="Password123">
        </div>
        <div class="form-group">
            <label for="UpdatePasswordInputVerify">Password</label>
            <input type="password" class="form-control" id="UpdatePasswordInputVerify" name="passwordVerify" placeholder="Password123">
        </div>
        <div class="container d-flex justify-content-center align-items-center">
            <!--Create buttons in middle, ontop of eachother, sign in and --> 
            <button type="submit" name="submit">Update</button>
        </div>
      </form>





    </div>



    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
   


    
  </body>

</html>