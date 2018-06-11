<?php
  session_start();  //start or resume an existing session
  include '../inc/dbConnection.php';
  $conn = getDBConnection("Gamer_Store");
  
  include 'inc/nav.html';
  
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
<script>
   function displaygameInfo(videoGameId) {
    
        $("#gameInfo").html("<img src=images/loading.gif alt='loading data' />");
        $.ajax({

            type: "GET",
            url: "api/userVideoGameInfo.php",
            dataType: "json",
            data: { "gameID": videoGameId},
            success: function(data,status) {
              //console.log(data);
              $("#gameInfo").html("<img src = " + data.image +"' width = '200' length = '200' />" + "<br><br><font color = 'blue'>Game Title: </font>" +
                            data.name +"<br><br><font color = 'blue'>Price: </font>$" + data.price + "<br><br><font color = 'blue'>Genre: </font>" +data.genre +
                            "<br><br><font color = 'blue'>Release Date: </font>" +data.releaseMonth + "&nbsp;" + data.releaseDay + ",&nbsp;"
                            + data.releaseYear + "<br><br><font color = 'blue'>Console: </font>" + data.consoleName);
            },
            error:function(status,data,error){
             console.log(data);
            },
            complete: function(data,status) { //optional, used for debugging purposes
             // alert(status);
            }
        
        });//ajax
    }
</script>  
  






<!DOCTYPE html>
<html>
    <head>
        <title>Welcome! </title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script>
         $(document).ready(function(){
             $("#record").attr("style", "display: none");
             $("#userHome").attr("class", "active");
            });
       </script>
    </head>
    <script>
      
    </script>
    <style>
    
      .carousel-inner > .item > img {
          margin: 0 auto;
      }
      .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus {
            color:#D4AF37;  /*Sets the text hover color on navbar*/
      }
      body{
        background-color:#eeeeee;
        text-align:center;
      }
      table, th, td {
        border: 1px solid black;
        padding: 5px;
        background-color:#b3f0ff;
      }
      h4{
        color:red;
      }
      .jumbotron{
        background-color:green;
      }
      
    </style>
    <body>
      <div class = "jumbotron">
         <h1>Hello User</h1>
      </div>
      
    <!------------------------------------------------------------------------------------------------->
        
        
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
    <!--------------------------------------------------------------------------------- end carousel  -->  
    <form>
      <strong>Search:</strong> <input type="text" name = "Game" class="form-control" placeholder="Search games" maxlength="20">
      <input type="submit" value="Search" />
    </form>
    <br /> <br /> <br />
    <h3>Here are the list of video games available!</h3>
    <div id="parent" style="display: flex">
    <?php
  
    
    $games = productSearch();
        echo "<div width = '50%' style = 'align:left; padding-left: 20%'>";
        echo "<table cell spacing = '40' border = '6'>";
        echo "<th>Game Cover</th><th>Game</th><th>Console</th>";
        foreach($games as $game){
          
          echo "<tr>
         <td><img src = '". $game['image']. "' height='150' width='150'/></td><td><strong>
         <a data-toggle='modal' data-target='#myModal' href='#' onclick='displaygameInfo(\"".$game['gameID']."\")'>".$game['name'] . "</a></strong></td><td><strong>". $game['consoleName'] ."</strong></td></tr>";
                   
          }
        echo "</table>";     
        echo "</div>";  
    
    ?>
      <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"> AVAILABLE!! </h4>
          </div>
          <div class="modal-body">
            
              <div id="gameInfo"></div>
            
          </div>

      </div>
    </div>
    </div>
    
  
    </body>
</html>