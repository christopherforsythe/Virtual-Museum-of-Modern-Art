<?php
/**
 * https://rateyo.fundoocode.ninja/
 * used for star rating system
 */

$logged_in = FALSE;

session_start();

include("conn.php");

if(!isset($_SESSION['username'])){

    header('location: redirectpage.html');

} else{
    $logged_in = TRUE;
    $username = $_SESSION['username'];
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VMoMA</title>
        <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/gridlex/2.7.1/gridlex.min.css">
    <link rel="stylesheet" href="styles/ui3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">


</head>
  <body class="bg-light">
        <header>
        <div class="container">
            <nav>
            <h1><a href="index.php" style='color:black; text-decoration: none;'>VMoMA</a></h1>
                <button class="hamburger" id="hamburger">
                    <i class="fas fa-bars"></i>
                </button>
                <ul class="nav-ul" id="nav-ul">
                    <li><a href="exhibitions.php">Exhibitions</a></li>
                    <li><a href="artandartists.php">Artworks | Artists</a></li>
                    <?php
                        if($logged_in){
                           echo "<li><a href='logout.php'>Log-Out</a></li>";
                        } else {
                            echo "<li class='nav-item dropdown'>
                                    <a class='nav-link dropdown-toggle' href='#' id='navbarScrollingDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                    Members
                                    </a>
                                    <ul class='dropdown-menu' aria-labelledby='navbarScrollingDropdown'>
                                    <li><a class='dropdown-item' href='membership.php'>Sign up</a></li>
                                    <li><a class='dropdown-item' href='signin.php'>Login</a></li>
                                    </ul>
                                </li>";
                        }
                            
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Search
                        </a>
                        <ul class="dropdown-menu" id="searchdrop" aria-labelledby="navbarScrollingDropdown">
                            <form class="d-flex" action="search.php" method="POST">
                                <input class="form-control me-2" type="text" placeholder="Search" name="search">
                                <button class="btn btn-outline-primary" type="submit" name="submit-search">Search</button>
                            </form>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container-fluid backgroundimagewall">
        <!--form-->
      <div class="body4">
      
          <div class="container2" id="signupbox">
              <?php

              if(isset($_GET['status'])){

                if($_GET['status'] == 'success'){
                        echo "<div class='form-control' style='text-align: center;'><p>Thank you for your review! View all <a href = 'allreviews.php' style='text-decoration: none; color: black;'>reviews</a></p></div>";     
                }
              }
                ?>
                  <div class="header" id="thank-you" style="text-align: center;">
                      <h2>How was you visit?</h2>
                  </div>
                  <form class="form" id="form" action="reviewinsert.php" method="POST">

                      <div class="form-control">
                          <label>Username</label>
                          <?php
                          echo "<input type='text' placeholder='{$username}' id='username' name='username'>"; 
                          ?>             
                          <div class="error-hint hidden"><small>Your name is required</small></div>
                      </div>

                      <div class="form-control">
                          <label>Comments</label>
                          <input type="text" placeholder="Describe your visit..." id="comment" name="comment">
                          <input type="hidden" name="rating" id="rating">
                      </div>

                     <div class="form-control container4">
                        <label>Rating</label>
                        <div id="rateYo"></div>
                     </div>
                
                      <button type="submit" class="bg-primary">Submit review</button>  
                      <br>   
                  </form>
           </div>  
      </div>
  </div>

    <footer id="indexfooter">
        <div class="grid align-items-center">
            <div class="col-6">
                <h3>JOIN IN</h3>
                <ul class="footerlist">
                    <li><a href="" class="fa fa-twitter"></a></li>
                    <li><a href="" class="fa fa-facebook"></a></li>
                    <li><a href="" class="fa fa-youtube"></a></li>
                    <li><a href="" class="fa fa-instagram"></a></li>
                </ul>
            </div>
            <div class="col-6">
                <h6>The Virtual Museum of Modern Art ©</h6>
            </div>
           
        </div>
    </footer>

    <script src="js.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <script>
        $(function () {

            $("#rateYo").rateYo({
            fullStar: true,
            onSet: function(rating, rateYoInstance){
                $("#rating").val(rating);
            }
        });
    });

    </script>
     
</body>
</html>

