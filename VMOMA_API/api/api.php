<?php

include("../conn.php");
//return as json
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'PUT'){
    
    $input = json_decode(file_get_contents('php://input'), true);
    
    $validKey = false;
    
    if(!isset($input['admin_api_key'])){
        echo "key required";
    } else {
        $key = $input['admin_api_key'];
        $keyConfirm = "SELECT * FROM vmoma_admin WHERE admin_api_key = ?";

        $keyConfirm = $conn->prepare($keyConfirm);

        if(!$keyConfirm){
            echo "prep error : ". $conn->error;
        }
        $keyConfirm->bind_param("s", $key);

        if(!$keyConfirm){
            echo "binding error : ". $conn->error;
        }
        $keyConfirm->execute();

        if(!$keyConfirm){
            echo "execute error : ". $conn->error;
        }

        $result = $keyConfirm->get_result();
        if($result->num_rows > 0){
            $newTitle = htmlentities($input['title']);
            $newArtist = htmlentities($input['artist']);
            $newArtistBio = htmlentities($input['artist_bio']);
            $newDate = htmlentities($input['datecompleted']);
            $newMedium = htmlentities($input['medium']);
            $newDepartment = htmlentities($input['department']);
            $newImgUrlPath = htmlentities($input['imgurlpath']);
            $artid = htmlentities($input['id']);

            $updateArtSQL = "UPDATE vmoma_artworks SET title = ?,
                                                       artist = ?,
                                                       artist_bio = ?,
                                                       datecompleted = ?,
                                                       medium = ?,
                                                       department = ?,
                                                       imgurlpath = ?
                                                       WHERE id = ?";
            
            $updateSQL = $conn->prepare($updateArtSQL);
            if (!$updateSQL){
                echo "prepare error ".$conn->error;
            }
            $updateSQL->bind_param("sssssssi", $newTitle, $newArtist, $newArtistBio, $newDate, $newMedium, $newDepartment, $newImgUrlPath, $artid);
            if (!$updateSQL){
                echo "bind error ".$conn->error;
            }
            $updateSQL->execute();
            if (!$updateSQL){
                echo "execute error ".$conn->error;
            }
            if($updateSQL){

                $response = array(
                    "update" => true,
                    "id" => $artid,
                );
            } else {
                $response = array(
                    "update" => false,
                );
            }

            echo json_encode($response);
        
        } else{
            $response = array(
                "update" => false,
                "message"=>"no key"
            );

            echo json_encode($response);
        }
    }
}

if($method == 'DELETE'){

    $input = json_decode(file_get_contents('php://input'), true);

    $validKey = false;
    if(!isset($input['admin_api_key'])){
        echo "key required";
    } else {
        $key = $input['admin_api_key'];

        $keyConfirm = "SELECT * FROM vmoma_admin WHERE admin_api_key = ?";

        $keyConfirm = $conn->prepare($keyConfirm);
        if(!$keyConfirm){
            echo "prep error : ". $conn->error;
        }

        $keyConfirm->bind_param("s", $key);
        if(!$keyConfirm){
            echo "binding error : ". $conn->error;
        }

        $keyConfirm->execute();
        if(!$keyConfirm){
            echo "execute error : ". $conn->error;
        }
        
        $result = $keyConfirm->get_result();

        if(!$result->num_rows > 0) {
            echo "invalid key";
        } else {
            $artid = $input['id'];

            $deleteArtworkSQL = "DELETE FROM vmoma_artworks WHERE id = ?";

            $deleteArtworkSQL = $conn->prepare($deleteArtworkSQL);
            if (!$deleteArtworkSQL){
                echo "prepare error ".$conn->error;
            }

            $deleteArtworkSQL->bind_param("i", $artid);
            if (!$deleteArtworkSQL){
                echo "bind error ".$conn->error;
            }

            $deleteArtworkSQL->execute();
            if (!$deleteArtworkSQL){
                echo "execute error ".$conn->error;
            }

            if($deleteArtworkSQL){
                $response = array(
                    "delete" => true,
                    "id" => $artid,
                );
            } else {
                
                $response = array(
                    "delete" => false,
                );
            }
            echo json_encode($response);

            $deleteArtworkSQL->close();

        }
    }
}

//if url has this query parameter - do this
if(isset($_GET['vmoma_artworks'])){
    
    $response = array();

    //prepare sql
    $sqlReq = "SELECT * FROM vmoma_artworks";

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        //append to the sql statement
        $sqlReq = $sqlReq." WHERE id = {$id}"; 
    }

    if(isset($_GET['title'])){
        $title = $_GET['title'];
        //append to the sql statement
        $sqlReq = $sqlReq." WHERE title LIKE '%".$title."%'"; 
    }

    if(isset($_GET['artist'])){
        $artist = $_GET['artist'];
        $sqlReq = $sqlReq." WHERE artist LIKE '%".$artist."%'"; 

    }

    if(isset($_GET['artist_bio'])){
        $artist_bio = $_GET['artist_bio'];
        $sqlReq = $sqlReq." WHERE artist_bio LIKE '%".$artist_bio."%'"; 

    }

    if(isset($_GET['department'])){
        $department = $_GET['department'];
        $sqlReq = $sqlReq." WHERE department LIKE '%".$department."%'"; 
    }

    if(isset($_GET['medium'])){
        $medum = $_GET['medium'];
        $sqlReq = $sqlReq." WHERE medium LIKE '%".$medium."%'"; 
    }

    if(isset($_GET['datecompleted'])){
        $datecompleted = $_GET['datecompleted'];
        $sqlReq = $sqlReq." WHERE datecompleted LIKE '%".$datecompleted."%'"; 
    }

    if(isset($_GET['imgurlpath'])){
        $imgpath = $_GET['imgurlpath'];
        $sqlReq = $sqlReq." WHERE imgurlpath LIKE '%".$imgpath."%'"; 
    }

    //query the db for 
    $result = $conn->query($sqlReq);

    if(!$result){
        echo $conn->error;
    } else {

        while($row = $result->fetch_assoc()){

            $arrayCollection = array('id'=>$row['id'],
                            'title'=>$row['title'],
                            'artist'=>$row['artist'],
                            'artist_bio'=>$row['artist_bio'],
                            'artist_nationality'=>$row['artist_nationality'],
                            'gender'=>$row['gender'],
                            'datecompleted'=>$row['datecompleted'],
                            'medium'=>$row['medium'],
                            'classification'=>$row['classification'],
                            'department'=>$row['department'],
                            'imgurlpath'=>$row['imgurlpath']);

            array_push($response, $arrayCollection);
        } 
        echo json_encode($response);
    }
}

if(isset($_GET['search'])){

    $search = $_GET['search'];

    $search = urldecode($search);

    $response = array();

    $sql = "SELECT * FROM vmoma_artworks WHERE title LIKE '%$search%' OR artist LIKE '%$search%' OR
    artist_bio LIKE '%$search%' OR artist_nationality LIKE '%$search%' OR gender LIKE '%$search%' OR
    datecompleted LIKE '%$search%' OR medium LIKE '%$search%' OR classification LIKE '%$search%' OR
    department LIKE '%$search%'";

    //query the db for 
    $result = $conn->query($sql);

    if(!$result){
        echo $conn->error;
    } else {

        while($row = $result->fetch_assoc()){

            $arrayCollection = array('id'=>$row['id'],
                            'title'=>$row['title'],
                            'artist'=>$row['artist'],
                            'artist_bio'=>$row['artist_bio'],
                            'artist_nationality'=>$row['artist_nationality'],
                            'gender'=>$row['gender'],
                            'datecompleted'=>$row['datecompleted'],
                            'medium'=>$row['medium'],
                            'classification'=>$row['classification'],
                            'department'=>$row['department'],
                            'imgurlpath'=>$row['imgurlpath']);

            array_push($response, $arrayCollection);
        }   
        echo json_encode($response);
    }
}

if(isset($_GET['vmoma_reviews'])){

    $response = array();

    $sql = "SELECT * FROM vmoma_reviews";

    $result = $conn->query($sql);

    if(!$result){
        echo $conn->error;
    } else {
        
        while($row = $result->fetch_assoc()){
        
            $arrayCollection = array('id'=>$row['id'],
                                     'user_name'=>$row['user_name'],
                                     'comment'=>$row['comment'],
                                     'rating'=>$row['rating']);
                    
                     array_push($response, $arrayCollection);
            }     
            echo json_encode($response);
    }
}

if(isset($_GET['vmoma_admin'])){

    $response = array();

    $sql = "SELECT * FROM vmoma_admin";

    $result = $conn->query($sql);

    if(!$result){
        echo $conn->error;
    } else {
        
        while($row = $result->fetch_assoc()){
        
            $arrayCollection = array('id'=>$row['id'],
                                     'admin_name'=>$row['user_name'],
                                     'admin_api_key'=>$row['comment']);
                    
                     array_push($response, $arrayCollection);
            }   
        
            echo json_encode($response);
    }
}
?>