<?php

include("conn.php");

$file = "Artworks.csv";

if(file_exists($file)) {

    $filepath = fopen($file, "r");

    $counter = 1;

    while( ($line = fgetcsv($filepath)) !== FALSE ){

        if($counter % 13 == 0){

            $title = $conn->real_escape_string($line[0]);
            $artist = $conn->real_escape_string($line[1]);
            $artist_bio = $conn->real_escape_string($line[3]);
            $artist_nationality = $conn->real_escape_string($line[4]);
            $gender = $conn->real_escape_string($line[7]);
            $datecompleted = $conn->real_escape_string($line[8]);
            $medium = $conn->real_escape_string($line[9]);
            $classification = $conn->real_escape_string($line[13]);
            $department = $conn->real_escape_string($line[14]);

            $insert = "INSERT INTO vmoma_artworks (title, artist, artist_bio, artist_nationality,
            gender, datecompleted, medium, classification, department)
            
            VALUES ('{$title}', '{$artist}', '{$artist_bio}', '{$artist_nationality}', '{$gender}', '{$datecompleted}',
            '{$medium}', '{$classification}', '{$department}')";


           $result = $conn->query($insert);

            if(!$result){
                echo $conn->error;
                die();
            }       
    }
    $counter++;
  } 

}