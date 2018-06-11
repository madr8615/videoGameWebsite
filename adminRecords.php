<?php
include '../inc/dbConnection.php';

$conn = getDBConnection("Gamer_Store");
include 'inc/nav.html';

?>
   


<!DOCTYPE html>
<html>
    <head>
        <title>Admin Report </title>
        
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <!-- Latest compiled and minified CSS -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     <!-- Optional theme -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
     <!-- Latest compiled and minified JavaScript -->
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <style>
        .jumbotron{
          background-color:green;
      }
      body{
          background-color:gray;
          
      }
    </style>
    <body>
       <div class = "jumbotron">
       <h1><center>Admin Report</center></h1>
       </div>
               <br />
               <a class="btn btn-default btn-lg" href="back.php" role="button">back</a>
            <br />
        <h2><u>Report 1: The total sum from each game with their respective system</u></h2>
        <br />
        <?php
          $sql = "SELECT consoleName, SUM( ROUND( price, 2 ) ) AS total_price
          FROM video_games
          GROUP BY consoleName
          ORDER BY total_price ASC ";
          
    $stmt = $conn->query($sql);	
    $results = $stmt->fetchAll();
    foreach ($results as $record) {
	echo "<h3>" .$record['consoleName'] . "	&nbsp;	&nbsp;	&nbsp;	&nbsp;"."$" .$record['total_price'] . "</h3><br/>";
    }

        ?>
         <br />
        <h2><u>Report 2: The total number of games for each console</u></h2>
        <br />
        <?php
          $sql = "SELECT consoleName, COUNT( consoleID ) AS totalGames
                  FROM video_games
                  GROUP BY consoleName
                  ORDER BY totalGames";
          
    $stmt = $conn->query($sql);	
    $results = $stmt->fetchAll();
    foreach ($results as $record) {
	echo "<h3>" .$record['consoleName'] . "	&nbsp;	&nbsp;	&nbsp;	&nbsp;". $record['totalGames'] . "&nbsp; game(s)</h3><br/>";
    }

        ?>    
          <br />
        <h2><u>Report 3: Total number of games that were release in a certain year</u></h2>
        <br />
        <?php
          $sql = "
                SELECT releaseYear, COUNT( releaseYear ) AS YEAR
                FROM video_games
                GROUP BY releaseYear
                ORDER BY releaseYear ASC ";
          
    $stmt = $conn->query($sql);	
    $results = $stmt->fetchAll();
    foreach ($results as $record) {
	echo "<h3>Year:&nbsp;" .$record['releaseYear'] . "	&nbsp;	&nbsp;	&nbsp;	&nbsp;". $record['YEAR'] . "&nbsp; game(s)</h3><br/>";
    }

        ?>        
    
    
    
    </body>
</html>