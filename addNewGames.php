<?php
   session_start();
   
   if (!isset($_SESSION["username"])) {
    header("Location: login.php"); 
   }
   
    include '../inc/dbConnection.php';
    $conn = getDBConnection("Gamer_Store");

    include 'inc/gameInfo.php';
    
    function addGame(){
       global $conn;
       $sql = "INSERT INTO video_games (
                gameID,
                consoleID,
                name,
                price,
                genre,
                releaseMonth,
                releaseDay,
                releaseYear,
                consoleName,
                image
                )
                VALUES (
                :gameID, :consoleID, :name, :price, :genre, :releaseMonth,
                :releaseDay, :releaseYear, :consoleName, :image
                )";
    $nameOfarray = array() ;
    $nameOfarray[':gameID']= $_GET['gameIdentification'];
    $nameOfarray[':consoleID'] = $_GET['consoleIdentification'];
    $nameOfarray[':name'] = $_GET['nameGame'];
    $nameOfarray[':price'] = $_GET['precio'];    
    $nameOfarray[':genre'] = $_GET['category'];
    $nameOfarray[':releaseMonth'] = $_GET['month'];    
    $nameOfarray[':releaseDay'] = $_GET['day'];
    $nameOfarray[':releaseYear'] = $_GET['year'];
    $nameOfarray[':consoleName'] = $_GET['nameC'];
    $nameOfarray[':image'] = $_GET['picture'];
    
    $stmt = $conn -> prepare ($sql);
    $stmt -> execute($nameOfarray);
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Add New Video Game </title>
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
    <body>
        <br /><br />
        <a class="btn btn-default btn-sm" href="back.php" role="button">back</a>
        <br /><br />
        <?php
        if (isset($_GET['Submit'])){
            
            addGame();
            echo "The game was added sucessfully";
        }
        ?>
        <br />
        <h1> Add New Games</h1>
        
        <form>
            
            Game ID: <input type="text" name="gameIdentification" />
            <br> <br>
            <font color = "red"> WARNING! </font>&nbsp; For Console ID:Playstation 4 = 1001 <br />
            Xbox One = 1002 Nintendo Switch = 1003 Nintendo GameCube = 1004 Nintendo 64 = 1005  <br/>
            Console ID: <input type="text" name="consoleIdentification" />
            <br/> <br/>
            Name of Game: <input type="text" name="nameGame" />
            <br/> <br/>
            Price: <input type="text" name="precio"/>
            <br/> <br/>
            Genre: <input type="text" name="category"/>
            <br/> <br/>
            Release Month: <input type = "text" name="month"/>
            <br /> <br/>
            Release Day: <input type = "text" name="day"/>
            <br /> <br/>
            Release Year: <input type = "text" name="year"/>
            <br /> <br/>
            Name of Console: <input type = "text" name="nameC"/>
            <br /> <br/>
            Cover Image: <input type = "text" name="picture"/>
            <br /> <br/>
           
                <input type="submit" name="Submit"> 
        </form>
    
    
    </body>
</html>