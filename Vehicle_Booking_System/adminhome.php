<?php
include "connection.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            ADMIN HOME PAGE
        </title>
        <link rel="stylesheet" href="style1.css">
    </head>
    <style tytpe="text/css">
        ul li:hover{
            background-color:black;
            border:4px solid lime;
            border-radius: 20px;
            padding:2px 12px
        }
    </style>
    <body>
        <div class="wrapper">
        <header class="head6">
        <div class="logo">
            <img src="benz_logo_3.png" alt="right" height="60px" width="100px">
            <h1 style="color: white;">VEHICLES BOOKING</h1>
        </div>
            <nav>
                <ul>
                    <li><a href="booking.php">BOOKED-VEHICLES</a></li>
                    <li><a href="requested.php">REQUESTED-VEHICLES</a></li>
                    <li><a href="feedback.php">FEEDBACK</a></li>
                    <li><a href="home.html">LOGOUT</a></li>
                </ul>
            </nav>
        </header>
        <section>
            <div class="sec4-img">
                
                </div>
        </section>
        <footer>
            <p style="color: white;text-align:center">
             Emailno:online.libray@133gmail.com<br><br>
             mobile no:9381429278
            </p>
        </footer>
        </div>
    </body>
</html>
