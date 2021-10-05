<?php
session_start();
include('../functions.php');

if(!$adminLoggedIn){
    header("Location: dashboard.php");
}

  //$adminApiKey = $_SESSION['adminApiKey'];
  //echo $adminApiKey;
include("../conn.php");

//set the endpoint
$endpoint = "http://cforsythe04.lampt.eeecs.qub.ac.uk/VMOMA_API/api/api.php?vmoma_artworks";

//get contents from endpoint
$artjson = file_get_contents($endpoint);

//decode so php can understand
$artdetails = json_decode($artjson, true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href=https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/gridlex/2.7.1/gridlex.min.css">
    <link rel="stylesheet" href="../styles/ui1.css">
   
</head>
<body>
<header>
        <div class="container">
            <nav>
            <h1><a href="dashboard.php" style='color:black; text-decoration: none;'>VMoMA - ADMIN</a></h1>
                <button class="hamburger" id="hamburger">
                    <i class="fas fa-bars"></i>
                </button>
                <ul class="nav-ul" id="nav-ul">
                    <li><a href="../exhibitions.php">Exhibitions</a></li>
                    <li><a href="../artandartists.php">Artworks | Artists</a></li>
                    <li><a href='../logout.php'>Log-Out</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Search
                        </a>
                        <ul class="dropdown-menu" id="searchdrop" aria-labelledby="navbarScrollingDropdown">
                            <form class="d-flex" method="POST" action="../search.php">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-primary" type="submit">Search</button>
                            </form>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="row" style="margin: auto; text-align: center;">
          <h2>Art and Artists</h2>
          <p style="color: black;">Browse the collection: Over 90 years of artwork at the VMOMA</p>
        </div>
      </div> 
      <div class='container'>


      <?php

      foreach($artdetails as $row){

        $title = $row['title'];
        $title = substr($title, 0, 50);

        $artist = $row['artist'];
        $artist = substr($artist, 0, 50);
         
          echo "
                <div class='card float-left mr-2 mb-2 ' style='width: 15rem;'>
                      <img src='{$row['imgurlpath']}' alt='' class='card-img-top' style='height: 200px; width: 100%;'>
                      <div class='card-body' style='height: 20.5rem;'>
                        <h4 class='card-title' style = 'padding: 0;'><strong>{$artist}</strong></h4>
                        <h6 class='card-text'><strong>{$title}...</strong></h6>
                        <p class='card-text' style='color: black; padding: 0%;'>{$row['datecompleted']}</p>
                        <p class='card-text' style='color: black; padding: 0%;'>{$row['department']}</p>
                        <a href='artedit.php?art_id={$row['id']}' style='padding: 0;'>
                          <button class='btn btn-primary'>Edit</button>
                        </a>
                      </div>
                    </div>                 
        ";
            }

            ?>
    
            </div>

    <script src="../js.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
     
</body>
</html>