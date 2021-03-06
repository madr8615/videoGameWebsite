<?php
  include 'inc/nav.html';
  
  session_start();  //start or resume an existing session
  include '../inc/dbConnection.php';
  $conn = getDBConnection("Gamer_Store");
  
  if(!isset($_SESSION['gamesInCart'])){
        $gamesInCart = array();
        $_SESSION['gamesInCart'] = $gamesInCart;
  }
  
   if(isset($_GET['addToCart']) && isset($_SESSION['gamesInCart'])){
        if(!in_array($_GET['addToCart'],  $_SESSION['gamesInCart'])){
            array_push($_SESSION['gamesInCart'], $_GET['addToCart']);
            
            //echo "The movie " . $_GET['addToCart'] . " was added to the cart";
            
        } //else {
           // echo "The movie " . $_GET['addToCart'] . " is already in the cart";
       // }
    }
  
  
  
  if(isset($_GET['ViewCart']) && isset($_SESSION['gamesInCart'])){
        echo "<strong><u><font color = 'red'>" . "List of added items: " . "</font></u></strong>";
        
        getCart();
  }
  function getCart(){
    foreach($_SESSION['gamesInCart'] as $key=>$value){
        echo "<p>" . $value . "</p>";
    }
  }
  function gamesInCart($name){
    if(in_array($movieTitle, $_SESSION['gamesInCart'])){
        return "disabled ";
    }
}
  
  function Nswitch(){
      global $conn;
      
      $sql = "SELECT image, name, price
              FROM  `video_games` 
              WHERE consoleID =1003";
              
      $stmt = $conn -> prepare ($sql);
      $stmt -> execute();
      $videoGames = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
      return $videoGames;
  }
   function nSwitchSystem(){
     global $conn;
     $sql = " SELECT fotos, Console_Name, precio
            FROM  `consoles` 
            WHERE consoleId =1003";
            
     $stmt = $conn -> prepare ($sql);
     $stmt -> execute();
     $video = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
      return $video;
  }
 
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Nintendo Switch</title>
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
            $("#nsw").attr("class", "active");
        }); 
        
    </script>
    
    </head>
    <style>
         body{
            text-align:center;
            background-image:url("/final_projects/images/nSwitchBack.png");
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }
        table, th, td {
        border: 1px solid black;
        padding: 5px;
        background-color:#e8dadb;
        color:green;
      }
       .jumbotron{
          background-color:#d33b0c;
      }
    </style>
    <body>
        <div class = "jumbotron">
            <h1>Nintendo Switch</h1>
        </div>
    <?php
 
        $games = Nswitch();
        echo "<div width = '50%' style = 'align:left; padding-left: 20%'>";
        echo "<table cell spacing = '40' border = '6'>";
        echo "<th>Image</th><th>Game</th><th>Price</th><th>Cart</th>";
        foreach($games as $game){
          
          
         // echo "<tr><td><img src = '". $game['image']. "' height = '150' width = '150'/></td><td>".$game['name'] . "</td><td>". $game['price'] ."</td><td>".
         //  "<a href='nSwitch.php?addToCart= ".$game['name']."&nbsp&nbsp $" .$game['price']."'><button " . gamesInCart($game['name'])."type=\"button\" class=\"btn btn-default btn-sm\">
          //               <span class=\"glyphicon glyphicon-shopping-cart\" aria-hidden=\"true\"></span> add to cart
          //               </button></a>" . "</td></tr>";
        
          echo "<tr><td><img src = '". $game['image']. "' height = '150' width = '150'/></td><td>".$game['name'] . "</td><td>". $game['price'] ."</td><td>".
           "<a href='nSwich.php?addToCart= ".$game['name']."&nbsp&nbsp $" .$game['price']."'><button " . gamesInCart($game['name'])."type=\"button\" class=\"btn btn-default btn-sm\">
                         <span class=\"glyphicon glyphicon-shopping-cart\" aria-hidden=\"true\"></span> add to cart
                         </button></a>" . "</td></tr>";
             
        }
        echo "</table>";
        echo "</div>";  
    
         echo "<br />";
        $systems = nSwitchSystem();
        echo "<div width = '50%' style = 'align:left; padding-left: 20%'>";
        echo "<table cell spacing = '40' border = '6'>";
        echo "<th>Image</th><th>System</th><th>Price</th><th>Cart</th>";
        foreach($systems as $system){
          
          
          echo "<tr><td><img src = '". $system['fotos']. "' height = '150' width = '150'/></td><td>".$system['Console_Name'] . "</td><td>". $system['precio'] ."</td><td>".
           "<a href='nSwich.php?addToCart= ".$system['Console_Name']."&nbsp&nbsp $" .$system['precio']."'><button " . gamesInCart($system['Console_Name'])."type=\"button\" class=\"btn btn-default btn-sm\">
                         <span class=\"glyphicon glyphicon-shopping-cart\" aria-hidden=\"true\"></span> add to cart
                         </button></a>" . "</td></tr>";
        
                  
        }
        echo "</table>";
        echo "</div><br /><br />";  
    
    
    ?>
        
    </body>
</html>