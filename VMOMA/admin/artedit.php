<?php

session_start();

include('../functions.php');

if(!$adminLoggedIn){
    header("Location: dashboard.php");
}

include('../conn.php');

$artid = $_GET['art_id'];
$edited = FALSE;
$updateIssue = FALSE;
$deleteProblem = FALSE;

$artEditEndpoint = "http://cforsythe04.lampt.eeecs.qub.ac.uk/VMOMA_API/api/api.php?vmoma_artworks&id={$artid}";

$artEditJson = file_get_contents($artEditEndpoint);

$artEditDetails = json_decode($artEditJson, true)[0];

/** EDIT API */
if(isset($_POST['edit'])){

    $edited = TRUE;
    //Set endpoint for edit request 
    $endpoint = "http://cforsythe04.lampt.eeecs.qub.ac.uk/VMOMA_API/api/api.php";

    $adminApiKey = $_SESSION['adminApiKey'];

    $data = array(
        'admin_api_key'=>$adminApiKey,
        'artist'=>$_POST['artist'],
        'title'=>$_POST['title'],
        'artist_bio'=>$_POST['artist_bio'],
        'datecompleted'=>$_POST['datecompleted'],
        'medium'=>$_POST['medium'],
        'department'=>$_POST['department'],
        'imgurlpath'=>$_POST['imgurlpath'],
        'id' => $artid
    );

    $contents = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded",
            'method' => 'PUT',
            'content' =>json_encode($data)
        ),
    );

    $context = stream_context_create($contents);

    $result = file_get_contents($endpoint, false, $context);

    if(!$result){
        echo $conn->error;
    }

    $result = json_decode($result, true);

    if($result['update']){
        header("Location: ../artinfo.php?art_id=$artid");

    } else {
        $updateIssue = TRUE;
    }
}
/** DELETE API */
if(isset($_POST['delete'])){

    $deleteEndPoint = "http://cforsythe04.lampt.eeecs.qub.ac.uk/VMOMA_API/api/api.php";

    $adminApiKey = $_SESSION['adminApiKey'];

    $data = array(
        'admin_api_key' => $adminApiKey,
        'id' => $artid
    );
    $opts = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded",
            'method' => 'DELETE',
            'content' => json_encode($data)
        ), 
    );

    $context = stream_context_create($opts);

    $result = file_get_contents($deleteEndPoint, false, $context);

    if(!$result){
        echo $conn->error;
    }

    $result = json_decode($result, true);

    if($result['delete']){
        header("Location: editcollection.php");
    } else {
        $deleteProblem = TRUE;
    }
}



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
    <link rel="stylesheet" href="../styles/ui1.css">

    <style>
        input{
            display: block;
            width: 300px;
            padding: 5px;
        }
    </style>

</head>
<body class="bg-light">
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

  <?php

    $artistname = $artEditDetails['artist'];
    $titleofwork = $artEditDetails['title'];
    $bio = $artEditDetails['artist_bio'];
    $date = $artEditDetails['datecompleted'];
    $medium = $artEditDetails['medium'];
    $dep = $artEditDetails['department'];
    $img = $artEditDetails['imgurlpath'];

    //$artid = openssl_encrypt($artid, "AES-128-ECB", "id");

    echo " <div class='container' id='infobox'>

            
        <form class='form' id='form' method='POST'>
        <input value='$artid' type='hidden' name='sentartid' class='form-control'>
              <div class='row' style='justify-contents:center; margin: auto;'>
                <div class='col-md-6 col-sm-6' style='color: black;'>
                  <div>

                    <input name='artist' value='{$artistname}'></input>
                    <input name='title' value='{$titleofwork}'></input>
                    <input name='artist_bio' value='{$bio}'></input>
                    <input name='datecompleted' value = '{$date}'></input>
                    <input name ='medium' value='{$medium}'></input>
                    <input name='department' value='{$dep}'></input>
                    <input name='imgurlpath' value='{$img}'></input>
                    <button type='submit' class='btn btn-success' id='edit-button' name='edit'>SUBMIT</button>
                    <button type='delete' class='btn btn-danger' id='delete-button' name='delete'>DELETE</button>

                    <a href='editcollection.php'>
                      <button class='btn btn-primary'>Back</button>
                    </a>
                  
                  </div>
                </div>
                <div class='col-md-6 col-sm-6'>
                  <img src='{$img}' alt='' style='height:350px; width:400px;'>
                </div>
              </div>

        </form>
    </div> ";

    ?>

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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>