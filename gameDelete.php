<?php
session_start();

if (!isset($_SESSION["username"])) {  //Check whether the admin has logged in
    header("Location: login.php"); 
}

include '../inc/dbConnection.php';

$dbConn = getDBConnection("Gamer_Store");


$sql = "DELETE FROM video_games
        WHERE gameID = " . $_GET['gameID'];
$stmt = $dbConn->prepare($sql);
$stmt->execute();

header("Location: mainPage.php");

?>