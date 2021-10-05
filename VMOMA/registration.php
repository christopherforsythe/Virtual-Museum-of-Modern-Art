<?php

/**
 * require_once keyword was learned from studying this link - stops program if file not found - reduces errors
 * https://www.w3schools.com/php/keyword_require_once.asp#:~:text=The%20require_once%20keyword%20is%20used,will%20not%20include%20it%20again.
 */

    session_start();
    include("conn.php");

    if(isset($_POST["submit"])){

        $name = $conn->real_escape_string($_POST['username']);
        $email = $conn->real_escape_string($_POST['email']);
        $pw = $conn->real_escape_string($_POST['password']);

        require_once 'conn.php';
        require_once 'functions.php';

        if(emptyInputSignup($name, $email, $pw) !== false){
            
            header("location: membership.php?error=emptyinput");
            exit();
        }

        if(invalidEmail($email) !== false){
            header("location: membership.php?error=invalidemail");
            exit();
        }

        if(userExists($conn, $name) !== false){
            header("location: membership.php?error=usernametaken");
            exit();
        }

        createUser($conn, $name, $email, $pw);
        
    } else {
        
        header("location: membership.php");
    }

        
   
    
 
?>



