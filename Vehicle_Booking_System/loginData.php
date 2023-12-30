<?php
include "connection.php";
if($connection){
    echo "connected";
    if(isset($_POST['submit'])){
    $emailid=$_POST['email'];
    $password=$_POST['pwd'];

    $query="select *  from  userlogin   where Email='$emailid'AND Password='$password'; ";

    $result=mysqli_query($connection,$query);

    if(mysqli_num_rows($result)>=1){
    ?>
    <script>
    	window.location="menu_bar2.html";
    </script>
    <?php
    }
    else{
        echo "";
            ?>
		    <script>
		    	alert('INVALID DETAILS');
		    	window.location="loginpage.html";
		    </script>
	    <?php
        exit();
    }
}
}
else{
    echo "no";
}
echo "<br>";


?>
