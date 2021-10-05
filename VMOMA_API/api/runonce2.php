<?php

include("../conn.php");

$query = "SELECT * FROM vmoma_artworks";

function randomImageUrl(){

    do{
        $random = rand(0, 2700);
        $endpoint = "https://picsum.photos/id/{$random}/300.jpg";
        $contents = @file_get_contents($endpoint);

        if(!$contents){
            continue;
        }
    }while (!$contents);
    return $endpoint;
}

$result = $conn->query($query);

    if(!$result){ 
        echo $conn->error;
    } else {
        while($row = $result->fetch_assoc()){
            $img = randomImageUrl();
            $edit = "UPDATE vmoma_artworks SET imgurlpath='$img' WHERE id = {$row['id']}";
            $res = $conn->query($edit);
            if(!$res){
                echo "<br>".$conn->error;
            }
        }
    }
?>