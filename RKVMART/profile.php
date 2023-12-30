<?php
include 'connection.php';
if($_SERVER['REQUEST_METHOD']=="POST")
{
    if(isset($_FILES['profile']))
    {
        $filename=$_FILES['profile']['name'];
        $filesize=$_FILES['profile']['size'];
        $filetemp=$_FILES['profile']['tmp_name'];
        $allowed=array("jpg","jpeg","png");

        
        $email=$_POST['email'];
        echo"<br>";
        $mail  = $email;
        // Get the username by slicing string
        $username = strstr($mail, '.', true); 
        $png=".png";
        $filename="$username$png";
        // Display the username
        echo "$profile";

        
        $extension= pathinfo($filename,PATHINFO_EXTENSION);
        if(! in_array($extension,$allowed))
        {
              echo "select valid format image(jpg,jpeg)";
        }
        else if(file_exists('profileIMAGES/'.$filename))
            echo "already exist";
        else
        {
             move_uploaded_file($filetemp,'profileIMAGES/'.$filename);
             echo "uploaded successfully";
        }  
        echo "<br>";
        
        $dir= pathinfo('profileIMAGES/'.$filename,PATHINFO_DIRNAME);
        $path="$dir/$filename";
        echo "$path";

       
        /*
                $query="UPDATE users SET profile="$path" where Email="raghava";
        ";
         */
    
    }
    // else{
    //     echo "img not come";
    // }

    /*update details*/
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $UID = $_SESSION['UID'];

    $user_update_query = "UPDATE users SET username='$username', email='$email', phone='$phone' WHERE UID='$UID';";

    if($user_update_query_result = mysqli_query($connection,$user_update_query)){
        echo "
            <script>
            alert('PROFILE UPDATED SUCCESSFULLY');
            window.location.href='index.php';
            </script>
            ";
    }
}
else{
    echo "
    <script>
        window.location.href='index.php';
    </script>
    ";
}
?>
