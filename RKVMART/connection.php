<?php 
   
   session_start();
   
  $servername = "localhost";
  $username = "root";
  $password = "iiits123";
  $databasename = "BUYLO2";
  

  $connection = mysqli_connect($servername, 
    $username, $password, $databasename);

?>
