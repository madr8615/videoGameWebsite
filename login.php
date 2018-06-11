<?php
  session_start();  //start or resume an existing session
  include '../inc/dbConnection.php';
  $conn = getDBConnection("Gamer_Store");
  
  function productSearch(){
    
    global $conn;
    
   
    $sql = "SELECT image, gameID ,name, consoleName
                FROM  `video_games` 
                JOIN consoles ON video_games.consoleID = consoles.ConsoleId WHERE 1";
                
    
    if(isset($_GET['Game'])){
        $sql .=" AND name LIKE :Game";
        $namedParameters[':Game'] = '%' . $_GET['Game'] . '%';
    }
    
    $stmt = $conn -> prepare ($sql);
    $stmt -> execute($namedParameters);
    $videoGames = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $videoGames;
    
  }


?>


<!DOCTYPE html>
<html>
    <head>
        <title>Login Page </title>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    </head>
   
    <style>
        
        @import url("/final_projects/css/styles.css");
        body{
            text-align:center;
            background-color:#DCDCDC;
        }
        h2{
            color:red;
        }
      .carousel-inner > .item > img {
          margin: 0 auto;
      }
      .jumbotron{
          background-image:url("/final_projects/images/mario.jpg");
          background-size: 100% 100%;
          background-repeat: no-repeat;
      }
       table, th, td {
        border: 1px solid black;
        padding: 5px;
        background-color:#99b3ff;
      }
      h3{
          color:red;
      }
    </style>
    
  
    <body>
        <div class = "jumbotron">
          <h1>Exclusive Video Games Online Store</h1>
        </div>
        <h2>Welcome to the videogame shop! <br/>
        Please login to begin shopping for your favorite videogames!</h2>
        <br />
         <form method="post" action="userRecords.php">
            
            Username: <input type="text" name="username">  <br /> <br />
            
            Password: <input type="password" name="password"> 
            <br /> <br />
        
            <input type="submit" value="login"/>
            
        </form>
        <br /> <br />
        <?php

            if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {
                echo '<span style = "color:red;">  Wrong username or password!  </span>'; // colors text in red (css)
            }

        ?>
        <br /> <br/>
        <div id="carouselCointainer">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        <li data-target="#carousel-example-generic" data-slide-to="3"></li> 
        <li data-target="#carousel-example-generic" data-slide-to="4"></li>
        
        
      </ol>
    
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="images/ps4.jpg" alt="PS4">
          <div class="carousel-caption">
            ...
          </div>
        </div>
        <div class="item">
          <img src="images/Xbox-One-Console.jpg" alt="Xbox">
          <div class="carousel-caption">
            ...
          </div>
        </div>
        <div class="item">
          <img src="images/NS-System.jpg" alt="Nswitch">
          <div class="carousel-caption">
            ...
          </div>
        </div>
        <div class="item">
          <img src="images/GameCube.png" alt="NGC">
          <div class="carousel-caption">
            ...
          </div>
        </div>
        <div class="item">
          <img src="images/nintendo-64.jpg" alt="N64">
          <div class="carousel-caption">
            ...
          </div>
        </div>
        
      </div>
    
      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    </div>    
    <!-- //carousel -->
    
    <form>
      <strong>Search:</strong> <input type="text" name = "Game" class="form-control" placeholder="Search games" maxlength="20">
      <input type="submit" value="Search" />
    </form>
    <br /> <br /> <br />
    <h3><u>Here are the list of video games available!</u></h3>
    <div id="parent" style="display: flex">
    <?php
  
    
    $games = productSearch();
        echo "<div width = '50%' style = 'align:left; padding-left: 20%'>";
        echo "<table cell spacing = '40' border = '6'>";
        echo "<th>Game Cover</th><th>Game</th><th>Console</th>";
        foreach($games as $game){
          
          
        //  echo "<tr><td><a href='gameUpdate.php?gameID=".$game['gameID']. "'><button type=\"button\"class=\"btn btn-default btn-lg\"><span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span> 
        //  Update</button></a></td><td><img src = '". $game['image']. "' height='150' width='150'/></td><td>".$game['name'] . "</td><td>". $game['consoleName'] ."</td></tr>";
         
         
          
            echo "<tr>  <td><img src = '". $game['image']. "' height='150' width='150'/></td><td><strong>".$game['name'] . "</strong></td><td><strong>". $game['consoleName'] ."</strong></td></tr>";
                   
          }
        echo "</table>";
        echo "</div>";  
    
    ?>
    </div>
    
       
    </body>
</html>