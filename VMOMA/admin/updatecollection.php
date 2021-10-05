<?php


include("../conn.php");

$title = $_POST['title'];
$artist = $_POST['artist'];
$artist_bio = $_POST['artist_bio'];
$nationality = $_POST['nationality'];
$gender = $_POST['gender'];
$date = $_POST['date'];
$medium = $_POST['medium'];
$classification = $_POST['classification'];
$department = $_POST['department'];
$imgurl = $_POST['image_url'];


$sqlread = "SELECT * FROM vmoma_artworks WHERE title = '$title' ";

    $result = $conn->query($sqlread);

    //error check result
    if(!$result){
        echo $conn->error;
    }

    $num = $result->num_rows;

    //check if artwork is already inserted
    if($num == 1){

        echo "This piece is already part of the collection.";

    } else {

        $sql = "INSERT INTO vmoma_artworks (title, artist, artist_bio, artist_nationality, gender, datecompleted,
                medium, classification, department, imgurlpath)

                VALUES ('$title', '$name', '{$artist_bio}','{$nationality}','{$gender}', '{$date}',
                '{$medium}', '{$classification}', '{$department}', '{$imgurl}')";

        $result = $conn->query($sql);

        //return to index page after the user signs up
        header('location: insertartwork.php');
}
?>

