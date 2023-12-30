<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<?php
include 'connection.php';
if($connection)
{
	echo ""."<br>";
}
else
{
	echo "Error:".mysqli_error($connection)."<br>";
}
$name=$_POST['uname'];
$rating=$_POST['rating'];
$feedback=$_POST['feedback'];


$query="SELECT * FROM FEEDBACK;";
$check=mysqli_query($connection,$query);
if($check){
	echo " ";/* FEEDBACK table is already exist */
}
else{

	$query="CREATE TABLE FEEDBACK(UserName VARCHAR(40) , Rating INT , Suggestions VARCHAR(1000));";
	
	if(mysqli_query($connection,$query))
	{
		echo "FEEDBACK table is  created"."<br>";
	}
	else
	{
		echo "error:".$query.mysqli_error($connection);
	}
}
echo "<br>";
$query="INSERT INTO FEEDBACK VALUES('$name','$rating','$feedback');";
if(mysqli_query($connection,$query))
{
	echo " "."<br>";/*record inserted*/
	?>
	<script>
		alert("THANK YOU FOR YOUR FEED BACK");
		window.location='menu_bar2.html';
	</script>
	<?php
    //echo "Request Accepted Successfully"."<br>";
    //echo "your Request is ".$vehicle." and ".$vehicle." model is " .$model."<br>";
    //echo "We Will Contact You Soon ";
}
else
{
	echo "error:".$query.mysqli_error($connection)."<br>";
}


?>
<br><br><br><br>
<button > <a href="menu_bar2.html">Go Back To Home</a></button>
</body>
</html>

