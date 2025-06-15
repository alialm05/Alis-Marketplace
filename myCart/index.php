<?php
// initialize session
    session_start();    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="../index.css?v=1.0">
        <script src="./cart.js" type="module"></script>
    </head>
    <body>
        
        <h1 class="header">
            Ali's Marketplace
        </h1>

        <nav class="navbar">
            <ul>
                <li>
                    <a href="../home">Home</a>
                </li>
                <li>
                    <a href="../myCart">My Cart</a>
                </li>

                <!-- check if user is logged in --> 
                <?php

                    if (!isset($_SESSION['email'])) {
                        echo '<li> <a href="../login">Login</a> </li>';
                        echo '<li> <a href="../signup">Signup</a> </li>';
                    }else {
                        echo '<li> <a href="../login/logout.php">Logout</a> </li>';
                    }
                ?>

            </ul>
        </nav>

        <div class="cart">

        </div>
        
    </body>
</html>
