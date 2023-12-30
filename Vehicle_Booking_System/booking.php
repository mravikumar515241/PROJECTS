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
	echo " "."<br>";
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


$query="SELECT * FROM sample;";
$check=mysqli_query($connection,$query);
if($check){
	echo " ";
	
}
else{

	$query="CREATE TABLE sample(UserName VARCHAR(25) ,Email VARCHAR(35),phone VARCHAR(10) , Vehicle VARCHAR(15) , Model VARCHAR(30));";
		
	if(mysqli_query($connection,$query))
	{
		echo "sample table is  created"."<br>";
	}
	else
	{
		echo "error:".$query.mysqli_error($connection);
	}
}
echo "<br>";
$query="INSERT INTO sample VALUES('$name','$email','$phone','$vehicle','$model');";
if(mysqli_query($connection,$query))
{
	echo " "."<br>";/*record inserted*/
   	/*echo "your order is ".$vehicle." and ".$vehicle." model is " .$model;*/
   	?>
   	<script>
   	var x="your order is  <?php echo "$vehicle"?> and <?php echo "$vehicle"?> model is <?php echo "$model"?>";
	alert(x);
	window.location='menu_bar2.html';
	</script>
   	
   	<?php
   	
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
