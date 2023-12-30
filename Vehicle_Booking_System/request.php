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
	echo " "."<br>";/*connection established */
}
else
{
	echo "Error:".mysqli_error($connection)."<br>";
}
$name=$_POST['uname'];
$email=$_POST['mail'];
$phone=$_POST['phone'];
$vehicle=$_POST['vehicle'];
$model=$_POST['model'];


$query="SELECT * FROM REQUEST;";
$check=mysqli_query($connection,$query);
if($check){
	echo " ";/*REQUEST table is already exist */
}
else{

	$query="CREATE TABLE REQUEST(UserName VARCHAR(25) ,Email VARCHAR(35),phone VARCHAR(10) , Vehicle VARCHAR(15) , Model VARCHAR(30));";
	
	if(mysqli_query($connection,$query))
	{
		echo "REQUEST table is  created"."<br>";
	}
	else
	{
		echo "error:".$query.mysqli_error($connection);
	}
}
echo "<br>";
$query="INSERT INTO REQUEST VALUES('$name','$email','$phone','$vehicle','$model');";
if(mysqli_query($connection,$query))
{
	echo " "."<br>";/*record inserted*/
	
	?>
	<script>
		alert("Request Accepted Successfully \n\n your Request is  <?php echo "$vehicle"?> and <?php echo "$vehicle"?> model is <?php echo "$model"?> \n\nWe Will Contact You Soon ");
		window.location='more.html';
	</script>
	<?php
	
 /*   echo "Request Accepted Successfully"."<br>";
    echo "your Request is ".$vehicle." and ".$vehicle." model is " .$model."<br>";
    echo "We Will Contact You Soon ";*/
}
else
{
	echo "error:".$query.mysqli_error($connection)."<br>";
}


?>
<br><br><br><br>
<button > <a href="Registration.html">Go Back To Home</a></button>
</body>
</html>
