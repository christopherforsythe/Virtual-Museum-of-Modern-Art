<?php

session_start();

$username = $_SESSION['username'];
include("conn.php");

if(isset($_POST['rating'])){
   
    $name = $username;
    $comment = $_POST['comment'];
    $rating = $_POST['rating'];

    $sql = "INSERT INTO vmoma_reviews (user_name, comment, rating)
            VALUES ('$name', '$comment', '$rating')";

    $result = $conn->query($sql);

    header('location: reviews.php?status=success');

}

?>