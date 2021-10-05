<?php

session_start();

include("conn.php");

$logged_in = FALSE;

if(!isset($_SESSION['username'])){

  header('location: redirectpage.html');
  
} else{
    $logged_in = TRUE;
}

$highlight1Endpoint = "http://cforsythe04.lampt.eeecs.qub.ac.uk/VMOMA_API/api/api.php?vmoma_artworks&id=9206"; 
$h1json = file_get_contents($highlight1Endpoint);
$h1details = json_decode($h1json, true)[0];

$highlight2Endpoint = "http://cforsythe04.lampt.eeecs.qub.ac.uk/VMOMA_API/api/api.php?vmoma_artworks&id=9095"; 
$h2json = file_get_contents($highlight2Endpoint);
$h2details = json_decode($h2json, true)[0];

$highlight3Endpoint = "http://cforsythe04.lampt.eeecs.qub.ac.uk/VMOMA_API/api/api.php?vmoma_artworks&id=9187"; 
$h3json = file_get_contents($highlight3Endpoint);
$h3details = json_decode($h3json, true)[0];

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

      <div class="container-fluid">
        <div class="row" id ="artheader">
            <div class="col-md-10 col-sm-10" id="artheadertext">
              <h1>DISCOVER ART</h1>
              <p><i>Learn about the artists and the stories behind their work.</i></p>
            </div>
        </div>
      </div>

      <div class="container highlights">
        <div class="row" id='arttext'>
            <h2>HIGHLIGHTS</h2>
        </div>
        <div class="row">
          <div class="col-md-12 col-sm-12" style="margin: auto;">
            <div class="row" style="justify-content: center;">
              <div class="card" style="width: 30%; height: 80%; text-align: center;">
              
              <?php
              echo" 
                <a href='artinfo.php?art_id={$h1details['id']}' style='text-decoration: none; color: black;'>
                    <img src='{$h1details['imgurlpath']}' alt='' class='card-img-top'>
                    <div class='card-body'>
                        <h4 class='card-title'>{$h1details['artist']}</h4>
                        <p class='card-text' style='color: black; padding: 0%;'>{$h1details['title']}</p>";                                                     
                   ?>
                  </div>
                  </a>
              </div>
              <div class="card" style="width: 30%; height: 80%; text-align: center;">
              <?php
                echo" 
                  <a href='artinfo.php?art_id={$h2details['id']}' style='text-decoration: none; color: black;'>
                    <img src='{$h2details['imgurlpath']}' alt='' class='card-img-top'>
                      <div class='card-body'>
                        <h4 class='card-title'>{$h2details['artist']}</h4>
                        <p class='card-text' style='color: black; padding: 0%;'>{$h2details['title']}</p>";                
                   ?>
                  </div>
                  </a>
              </div>
              <div class="card" style="width: 30%; height: 80%;  text-align: center;">
              <?php
                echo" 
                    <a href='artinfo.php?art_id={$h3details['id']}' style='text-decoration: none; color: black;'>
                    <img src='{$h3details['imgurlpath']}' alt='' class='card-img-top'>
                    <div class='card-body'>
                        <h4 class='card-title'>{$h3details['artist']}</h4>
                        <p class='card-text' style='color: black; padding: 0%;'>{$h3details['title']}</p>";         
                   ?>
                  </div>
                  </a>
              </div>
            </div>
          </div>
        </div>
      </div>

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
                        <a href='artinfo.php?art_id={$row['id']}' style='padding: 0;'>
                          <button class='btn btn-primary'>More info</button>
                        </a>
                      </div>
                    </div>                 
        ";
            }

            ?>
    
            </div>
    
      <script src="js.js"></script>
    
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>