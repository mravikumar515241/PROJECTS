<?php
include "connection.php";
if($connection){
    echo "";/*connected*/
    if(isset($_POST['submit'])){
    $emailid=$_POST['email'];
    $password=$_POST['pwd'];

    $query="select *  from  adminlogin   where UserName='$emailid'AND Password='$password'; ";

    $result=mysqli_query($connection,$query);

    if(mysqli_num_rows($result)>=1){
    ?>
    <script>
    	window.location="admin.html";
    </script>
    <?php
    }
    else{
        echo "";
            ?>
		    <script>
		    	alert('INVALID DETAILS');
		    	window.location="adminloginpage.html";
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
