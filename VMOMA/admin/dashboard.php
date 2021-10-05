<?php

session_start();
include("../conn.php");
include('../functions.php');
$adminLoggedIn = FALSE;

do{
    if( ($_SERVER['PHP_AUTH_USER'] == "admin") && ($_SERVER['PHP_AUTH_PW'] == "password123")) {
        $_SESSION['adminLoggedIn'] = TRUE;
        $adminLoggedIn = TRUE;
        $adminApiKey = "SELECT admin_api_key FROM vmoma_admin WHERE admin_name = 'admin'";
        $adminApiKey = $conn->prepare($adminApiKey);
        $adminApiKey->execute();
        $result = $adminApiKey->get_result();
        $details = $result->fetch_assoc();
        $_SESSION['adminApiKey'] = $details['admin_api_key'];

    } else {
        
        header("WWW-Authenticate: Basic realm='Admin Dashboard'");
        header("HTTP/1.0 401 Unauthorized");
        echo "You need to enter a valid username and password";
        exit;
    }
} while (!$adminLoggedIn);

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

<div class='container'>

        <div class='row' >
            <div class='col-8-md col-8--sm' id='admin1'>
                <div class='row'  style='text-align:center;'>
                   <h1><a href='insertartwork.php'>Add New Artwork</a></h1>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class='row' >
            <div class='col-8-md col-8--sm' id='admin2'>
                <div class='row'  style='text-align:center;'>
                   <h1><a href='editcollection.php'>Edit the Collection</a></h1>
                </div>
            </div>
        </div>

    </div>
    <br>
    <br>
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