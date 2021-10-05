<?php

/**
 * functions using mysqli have been inspired by code from this link
 * https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php
 */

//check if admin in logged in
$adminLoggedIn = (isset($_SESSION['adminLoggedIn']));

function emptyInputSignup($name, $email, $pw){

    $result;

    if(empty($name) || empty($email) || empty($pw)){
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function invalidEmail($email){

    $result;
    //CHECK IF EMAIL IS VALID
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function userExists($conn, $name){

    //use prepared statement to send statement to database 
    $sql = "SELECT * FROM vmoma_users WHERE user_name = ?;";
    //initialise prepared statement - stop code being inserted into the database
    $stmt = mysqli_stmt_init($conn);
    //check for any mistakes
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: membership.php?error=stmtfailed");
        exit();
    } 
    
    mysqli_stmt_bind_param($stmt, "s", $name);
    
    mysqli_stmt_execute($stmt);

    //tie all together
    $resultdata = mysqli_stmt_get_result($stmt);

    //check if there is a result
    if($row = mysqli_fetch_assoc($resultdata)){
        //return all the data in db if user exists
        return $row;

    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $pw){

    //create prepared insert statement
    $sql = "INSERT INTO vmoma_users (user_name, user_email, user_password) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: membership.php?error=stmtfailed");
        exit();
    } 

    $hashedpw = password_hash($pw, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedpw);
    mysqli_stmt_execute($stmt);
    $userid = mysqli_insert_id($conn);
    mysqli_stmt_close($stmt);

    //send user to sign in page
    header("Location: signin.php");
    exit();
}


function insertReview($conn, $name, $comment, $rating){

    $sqlquery = "INSERT INTO vmoma_reviews (user_name, comment, rating) VALUES (?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: reviews.php?error=stmtfailed");
        exit();
    } 

    mysqli_stmt_bind_param($stmt, "ssi", $name, $email, $rating);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: allreviews.php");
    exit();
}

function emptyInputLogin($name, $pw){

    $result;

    if(empty($name) || empty($pw)){
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}


function loginUser($conn, $name, $pw){

    $userExists = userExists($conn, $name);

    if($userExists === false){

        header("location: signin.php?error=wronglogin");
        exit();
    }

    //check the assoc array and reference to the pwd col name
    $pwdHashed = $userExists["user_password"];
    $checkpw = password_verify($pw, $pwdHashed);

    //if false then no match
    if($checkpw === false){
        
        header("location: signin.php?error=wronglogin");
    
    } else if ($checkpw === true){

        session_start();
        $_SESSION['username'] = $name;
        header("location: index.php");
        exit();
    }

}














