<?php
    function getGameInfo($gameID){
        global $conn;
        $sql = "SELECT * FROM video_games WHERE gameID = $gameID"; 
        $stmt = $conn -> prepare ($sql);
        $stmt -> execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        return $record;
        
    }
    
?>