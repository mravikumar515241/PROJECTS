<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendVerificationEmail($email,$verificationCode){
	require ("PHPMailer/PHPMailer.php");
	require ("PHPMailer/SMTP.php");
	require ("PHPMailer/Exception.php");

	$mail = new PHPMailer(true);

	try {
		//Server settings
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'dudismail123@gmail.com';                     //SMTP username
		$mail->Password   = 'pdazfvcntsaylvwf';                               //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
		$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		//Recipients
		$mail->setFrom('dudismail123@gmail.com', 'BUYLO');
		$mail->addAddress($email);//Add a recipient

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = 'Email Verification from Buylo';
		$mail->Body    = "
		Thanks for registration!
		Click the link below to verify the email address
		<a href='http://localhost:8000/email_verify.php?email=$email&v_code=$verificationCode'>Verify</a>
		";
		$mail->send();
		return true;
	} catch (Exception $e) {
		return false;
	}


}


if(isset($_POST['email'])){

	$UID = 0;
	$name=$_POST['user'];
	$email=$_POST['email'];
	$pass=$_POST['pwd'];
	$mobile=$_POST['mobile'];
	$isVerified=0;
	$accType="user";
	$verificationCode = bin2hex(random_bytes(16));


	$users_query="SELECT UID FROM users;";
	$check=mysqli_query($connection,$users_query);

	if(!$check){

		/*if not table created */

		$create_query="CREATE TABLE users(
			UID int NOT NULL AUTO_INCREMENT,
			username VARCHAR(30),email VARCHAR(30) NOT NULL,
			password VARCHAR(15),phone VARCHAR(10),
			accountType VARCHAR(10),
			verificationCode char(64),
			isVerified INT,
			imageUrl varchar(255),
			PRIMARY KEY (UID)
			);";
		
		$alter_query = "ALTER TABLE users AUTO_INCREMENT=10000001";
		
		if(mysqli_query($connection,$create_query) && mysqli_query($connection,$alter_query))
		{
			echo "users table is  created"."<br>";
		}
		else
		{
			echo "error:".$query.mysqli_error($connection);
		}
	}

	$email_query = "SELECT COUNT(*) FROM users WHERE  email='$email';";
	$email_query_result = mysqli_query($connection,$email_query);
	$email_count = mysqli_fetch_assoc($email_query_result)['COUNT(*)'];

	if($email_count != 1){
		/* Insert user details*/
	$insert_query="INSERT INTO users(username,email,password,phone,accountType,verificationCode,isVerified) VALUES('$name','$email','$pass','$mobile','$accType','$verificationCode',$isVerified);";

	if(mysqli_query($connection,$insert_query) && sendVerificationEmail($email,$verificationCode)){
		/* record inserted successfully */

		echo"
		<script>
		alert('Registration successfull! please confirm email to proceed  (Also check spam folder!)');
		</script>
		";

		// $user_query = "SELECT UID FROM users WHERE email = '$email';";
		// if($user_result = mysqli_query($connection,$user_query)){

		// 	$resulted_row = mysqli_fetch_assoc($user_result);
		// 	$_SESSION['UID'] = $resulted_row['UID'];

		// }
		// else{
		// 	echo "error: ".mysqli_error($connection);
		// }
	}
	else
	{
		echo "error:".$insert_query.mysqli_error($connection)."<br>";
	}

	}
	else{
		echo"
		<script>
		alert('Email Already exists! Please use another email or login');
		window.location.href = 'register.html';
		</script>
		";
	}

}
?>
