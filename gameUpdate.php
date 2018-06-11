<?php

session_start();

if(!isset($_SESSION['username'])){
   header("Location: login.php");
}
include '../inc/dbConnection.php';
    $conn = getDBConnection("Gamer_Store");
    include 'inc/gameInfo.php';


if(isset($_GET['submit'])) {  //admin has submitted the "update user" form
    
    $sql = "UPDATE video_games
            SET consoleID = :consoleID,
                name = :name,
                price = :price,
                genre = :genre,
                releaseMonth = :releaseMonth,
                releaseDay = :releaseDay,
                releaseYear = :releaseYear,
                consoleName = :consoleName,
                image = :image
            WHERE gameID = :gameID";
    $np = array();        
    $np[':gameID'] = $_GET['game'];       
    $np[':consoleID']  = $_GET['console'];
    $np[':name'] = $_GET['names'];
    $np[':price'] = $_GET['prices'];
    $np[':genre'] = $_GET['G'];
    $np[':releaseMonth'] = $_GET['releaseM'];
    $np[':releaseDay'] = $_GET['releaseD'];
    $np[':releaseYear'] = $_GET['releaseY'];
    $np[':consoleName'] = $_GET['system'];
    $np[':image'] = $_GET['images'];
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    echo " Record was updated!";
    $_GET['gameID'] = $np[':gameID'];
    
}    
if(isset($_GET['gameID'])) {
   
   $gameInfo = getGameInfo($_GET['gameID']);
   
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Game Update </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    </head>
    <style>
        @import url("/labs/lab6/css/styles.css");
    </style>
    <style>
        legend{
            color:blue;
        }
    </style>
    <body>
        <br /><br />
        <a class="btn btn-default btn-lg" href="back.php" role="button">back</a>
        <br /><br />
        <fieldset>
            <legend>Update User Info</legend>
            <form>
            <input type="text" name="game" value="<?=$gameInfo['gameID']   ?>" style = "display:none"/>
                <br><br>
                Console ID: <input type="text" name="console" value="<?=$gameInfo['consoleID']?>"/>
                <br/><br/>
                Video Game: <input type="text" name="names" value="<?=$gameInfo['name']?>"/>
                <br/><br/>
                Price: <input type="text" name="prices" value="<?=$gameInfo['price']?>"/>
                <br/><br/>
                Genre: <input type="text" name="G" value="<?=$gameInfo['genre']?>"/>
                <br/><br/>
                Month: <input type="text" name="releaseM" value="<?=$gameInfo['releaseMonth']?>"/>
                <br/><br/>
                Day: <input type="text" name="releaseD" value="<?=$gameInfo['releaseDay']?>"/>
                <br/><br/>
                Year:<input type="text" name="releaseY" value="<?=$gameInfo['releaseYear']?>"/>
                <br/><br/>
                Console Name:<input type="text" name="system" value="<?=$gameInfo['consoleName']?>"/>
                <br/><br/>
                 Image:<input type="text" name="images" value="<?=$gameInfo['image']?>"/>
                <br/><br/>
                <input type="submit" name="submit" value="Update">
                
            </form>
        </fieldset>

    </body>
</html>