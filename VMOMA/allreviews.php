<?php

include("conn.php");

$logged_in = FALSE;

session_start();

if(isset($_SESSION['username'])){

  $logged_in = TRUE;
}

//set the endpoint
$endpoint = "http://cforsythe04.lampt.eeecs.qub.ac.uk/VMOMA_API/api/api.php?vmoma_reviews";

//get contents from endpoint
$reviewsjson = file_get_contents($endpoint);

//decode so php can understand
$reviewsdetails = json_decode($reviewsjson, true);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VMoMA</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href=https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/gridlex/2.7.1/gridlex.min.css">
    <link rel="stylesheet" href="styles/ui1.css">

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

    <div class="container">
        <div class="row" style="margin: auto; text-align: center;">
          <h2>All Reviews</h2>
        </div>
      </div> 
      <div class='container'>

      <?php

      foreach($reviewsdetails as $row){

        $comment = $row['comment'];
        $comment = substr($comment, 0, 50);
         
          echo "
                <div class='card float-left mr-2 mb-2 ' style='width: 10rem;'>
                      <div class='card-body' style='height: 15rem;'>
                        <p class='card-text' style='color: black; padding: 0%;'>{$row['user_name']}</p>
                        <p class='card-text' style='color: black; padding: 0%;'>{$comment}</p>
                        <p class='card-text' style='color: black; padding: 0%;'>{$row['rating']}/5</p>
                      </div>
                    </div>";
            }

            ?>
      </div>
      <br>

    <script src="js.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>