<?php
session_start();
include("../functions.php");

if(!$adminLoggedIn){
  header("Location: dashboard.php");
}

include("../conn.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/gridlex/2.7.1/gridlex.min.css">
    <link rel="stylesheet" href="../styles/ui3.css">
   
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
    <div class="container-fluid backgroundimagewall">
        <!--form-->
      <div class="body6">
      
          <div class="container2">

                  <div class="header" style="text-align: center;">
                      <h2>UPDATE COLLECTION</h2>
                  </div>

                  <form class="form" id="form" action="updatecollection.php" method="POST">
                      <div class="form-control">
                          <label>Title</label>
                          <input type="text" placeholder="Title" id="title" name="title">                   
                          <div class="error-hint hidden"><small>Title is required</small></div>
                      </div>
                      <div class="form-control">
                        <label>Artist</label>
                        <input type="text" placeholder="Artist" id="artist" name="artist">                   
                        <div class="error-hint hidden"><small>Artist is required</small></div>
                      </div>
                     <div class="form-control">
                      <label>Artist Bio</label>
                      <input type="text" placeholder="Artist Bio" id="artist_bio" name="artist_bio">                   
                      <div class="error-hint hidden"><small>Artist bio is required</small></div>
                    </div>
                   <div class="form-control">
                      <label>Nationality</label>
                      <input type="text" placeholder="Nationality" id="nationality" name="nationality">                   
                      <div class="error-hint hidden"><small>Nationality is required</small></div>
                  </div>
                  <div class="form-control">
                      <label>Gender</label>
                      <input type="text" placeholder="Gender" id="gender" name="gender">                   
                      <div class="error-hint hidden"><small>Gender is required</small></div>
                    </div>
                    <div class="form-control">
                      <label>Date</label>
                      <input type="text" placeholder="Date" id="date" name="date">                   
                      <div class="error-hint hidden"><small>Date is required</small></div>
                  </div>
                    <div class="form-control">
                      <label>Medium</label>
                      <input type="text" placeholder="Medium" id="medium" name="medium">                   
                      <div class="error-hint hidden"><small>Medium is required</small></div>
                    </div>
                    <div class="form-control">
                      <label>Clasification</label>
                      <input type="text" placeholder="Classification" id="classification" name="classification">                   
                      <div class="error-hint hidden"><small>Clasification is required</small></div>
                    </div>
                    <div class="form-control">
                      <label>Department</label>
                      <input type="text" placeholder="Department" id="department" name="department">                   
                      <div class="error-hint hidden"><small>Department is required</small></div>
                    </div>
                    <div class="form-control">
                      <label>Image URL</label>
                      <input type="text" placeholder="URL" id="image_url" name="image_url">                   
                      <div class="error-hint hidden"><small>Image URL is required</small></div>
                    </div>

                    <button type="submit" class="bg-primary">Update</button>
                      
                  </form>
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
    
    <script src="../js.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    
</body>
</html>
