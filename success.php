<?php
    include 'inc/nav.html';

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Success</title>
        <script>
            $(document).ready(function(){ //hides records webpage from the user
            $("#record").attr("style", "display: none");
            });
        </script>
    </head>
    <style>
        body{
            text-align:center;
            background-color:#4ea2c9;
        }
    </style>
    <body>
        <h1>Transaction Complete!</h1>
        
        <h2>Here is your confirmation number:</h2>
        <?php
        

            function randomNum(){
                $confirmationNum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $pass = array();
                $confirmationLength = strlen($confirmationNum) - 1;
                for($i = 0; $i < 15; $i++){
                    $n = rand(0, $confirmationLength);
                    $pass[] = $confirmationNum[$n];
                }
                return implode($pass);
   
            }

            echo  "<font color = 'red'> " . randomNum() . "</font>";
            ?>
        <br /> <br />
        <p style ="font-size:20px">Your transaction has been processed and your purchased items will be ready to be shipped.<br />
        Please allow <strong>6-10 days</strong> for your purchased items to be shipped. <br />Thank you
        and have a good day!</p>
         <br /> <br />
        
        
        
    </body>