<?php

/**
 * require_once keyword was learned from studying this link - stops program if file not found - reduces errors
 * https://www.w3schools.com/php/keyword_require_once.asp#:~:text=The%20require_once%20keyword%20is%20used,will%20not%20include%20it%20again.
 */

include("conn.php");


if(isset($_POST["submit"])){
   
    $name = $_POST['username'];
    //$email = $_POST['email'];
    $pw = $_POST['password'];

    require_once 'conn.php';
    require_once 'functions.php';

    if(emptyInputLogin($name, $pw) !== false){
        header("location: signup.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $name, $pw);

} else {

    header("location: signin.php");
    exit();
}
