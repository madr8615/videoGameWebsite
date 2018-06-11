<?php

session_start();  //start or resume an existing session

include '../inc/dbConnection.php';

$conn = getDBConnection("Gamer_Store");

header("Location: mainPage.php");




?>