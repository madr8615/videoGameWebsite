<?php
session_start();  //start or resume an existing session

include '../inc/dbConnection.php';

$conn = getDBConnection("Gamer_Store");

$username = $_POST['username'];
$password = sha1($_POST['password']);   //hash("sha1",$_POST['password']);

//USE NAMEDPARAMETERS TO PREVENT SQL INJECTION

$sql = "SELECT * FROM Users WHERE username = :username AND password = :password";

$namedParameters[':username'] = $username;
$namedParameters[':password'] = $password;


$statement = $conn->prepare($sql);
$statement->execute($namedParameters);
$record = $statement->fetch(PDO::FETCH_ASSOC);

 if (empty($record)) { //wrong credentials
     
     header("Location: login.php?msg=failed"); // msg=failed will show in url and it will be implemented in login.php
     
 } else {
     // Determine whether user has admin rights or not. By using 'isAdmin' column. 
     
    $_SESSION['isAdmin'] = $record['isAdmin'];
     
    $_SESSION["Name"] = $record['firstName'] . " " . $record['lastName'];
    $_SESSION["username"]  = $record['username'];
    
    
    if($_SESSION['isAdmin'] == 1) 
        //echo "Admin";
        header("Location: mainPage.php"); //redirect to the main admin program
    else{
        //echo "user;";
       // header("Location: ps4.php"); //redirect regular user to main page. 
        header("Location: userMainPage.php"); //redirect regular user to main page.
    }
 }
?>