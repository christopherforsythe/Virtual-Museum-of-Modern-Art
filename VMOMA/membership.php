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
    <link rel="stylesheet" href="styles/ui3.css">  
</head>
<body>

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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Members
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                          <li><a class="dropdown-item" href="membership.php">Sign up</a></li>
                          <li><a class="dropdown-item" href="signin.php">Login</a></li>
                        </ul>
                    </li>
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
      <div class="body2">
      
          <div class="container2" id="signupbox">
                  <div class="header" id="thank-you" style="text-align: center;">
                      <h2>Create Account</h2>
                  </div>
                  <form class="form" id="form" action="registration.php" method="POST">

                      <div class="form-control">
                          <label>Username</label>
                          <input type="text" placeholder="Username" id="username" name="username">                   
                          <div class="error-hint hidden"><small>Your name is required</small></div>
                      </div>

                      <div class="form-control">
                          <label>Email</label>
                          <input type="email" placeholder="hello@world.com" id="email" name="email">
                          <div class="error-hint hidden"><small>Your email is required</small></div>
                      </div>

                      <div class="form-control">
                          <label>Password</label>
                          <input type="password" placeholder="Password" id="current-password" name="password">
                          <div class="error-hint hidden"><small>Your password is required</small></div>
                      </div>

                      <button type="submit" name="submit" class="bg-primary">Register</button>           
                  </form>
                  <?php

                    if(isset($_GET["error"])){

                        if($_GET["error"] == "emptyinput"){
                            echo "<div class='form-control' style='text-align: center;'><p>Fill in all fields.</p></div>";
                        }
                        else if ($_GET["error"] == "invalidemail"){
                            echo "<div class='form-control'style='text-align: center;'><p>Invalid email.</p></div>";
                        }
                        else if ($_GET["error"] == "usernametaken"){
                            echo "<div class='form-control' style='text-align: center;'><p>Username already taken - try again.</p></div>";
                        }
                        else if ($_GET["error"] == "stmtfailed"){
                            echo "<p><div class='form-control' style='text-align: center;'><>Something went wrong - try again.</p></div>";
                        }
                        else if ($_GET["error"] == "none"){
                            echo "<div class='form-control' style='text-align: center;'><p>Thanks for signing up!</p></div>";
                        }
                    }
                    ?>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <script src="js.js"></script>
</body>
</html>