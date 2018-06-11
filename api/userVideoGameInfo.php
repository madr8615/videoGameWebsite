<?php

     include '../../inc/dbConnection.php';
    $conn = getDBConnection("Gamer_Store");    
    $sql = "SELECT image, name, price, genre,
            releaseMonth, releaseDay, releaseYear,
            consoleName from video_games
            WHERE gameID = :gameID";
    $stmt = $conn -> prepare($sql);
    $stmt -> execute(array("gameID"=>$_GET['gameID']));
    $resultSet = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultSet);






?>