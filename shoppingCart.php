<?php
  include 'inc/nav.html';
  
  session_start();  //start or resume an existing session
  include '../inc/dbConnection.php';
  $conn = getDBConnection("Gamer_Store");
  
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart </title>
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
             $("#cart").attr("class", "active");
            });
       </script>
    </head>
    <style>
        .jumbotron{
            
            background-image:url("/final_projects/images/shopping_cart_.jpg");
            color:blue;
        }
        body{
            background-color:#72d3a4;
        }
    </style>
    <body>
    <div class = "jumbotron">  
        <h1>My Cart</h1>
    </div> 
        <?php
  
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
  
  function ps4Games(){
      global $conn;
      
      $sql = "SELECT image, name, price
              FROM  `video_games` 
              WHERE consoleID =1001";
              
      $stmt = $conn -> prepare ($sql);
      $stmt -> execute();
      $videoGames = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
      return $videoGames;
  }
  
?>
<?php
 echo "<h3>". getCart() . "</h3>";
?>
 <br /> 
 <a class="btn btn-success btn-lg" href="success.php" role="button">Place your order</a>      
    </body>
</html>




