<?php

session_start();

include("conn.php");

$logged_in = FALSE;

if(isset($_SESSION['username'])){

  $logged_in = TRUE;
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MoMA</title>
        <!-- Bootstrap CSS -->
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

<div class="container" style = "height: 70vh;">
          
          <?php
            if (isset($_POST['submit-search'])){
               
                $search = $_POST['search'];

                $search = urlencode($search);
                //set the endpoint
                $endpoint = "http://cforsythe04.lampt.eeecs.qub.ac.uk/VMOMA_API/api/api.php?search={$search}";

                //get contents from endpoint
                $artjson = file_get_contents($endpoint);

                //decode so php can understand
                $artdetails = json_decode($artjson, true);

                //$result = $conn->query($sql);
                //get the number of rows
                $num = count($artdetails);

                echo "<There are ".$num." results!";

                //check how many there are
                if($num > 0){

                    foreach($artdetails as $row) {

                        echo "<a href='inforesult.php?art_id={$row['id']}' style='text-decoration: none; color: black; padding: 0'>
                            <div style='container'>
                                <h3>".$row['title']."</h3>
                                <h3>".$row['artist']."</h3>
                                <h5 style='padding:0;'>".$row['department']."</h5>
                                <h6>".$row['medium']."</h6>
                                <h6>".$row['datecompleted']."</h6>
                                <br>
                                <br>
                            </div>
                        </a>";
                    }

                } else {
                    echo "<p>No results matching your search</p>";
                }
            }
         ?>

      </div>
    
      <footer id="indexfooter" style="position: fixed; bottom:0; width: 100vw">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
</html>