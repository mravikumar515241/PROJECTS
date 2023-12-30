<?php
require('connection.php');

$email = $_GET['email'];
$verificationCode = $_GET['v_code'];


if(isset($_GET['email']) && isset($_GET['v_code']) ){
    $query = "SELECT * FROM users WHERE email='$email' AND verificationCode='$verificationCode';";
    $result = mysqli_query($connection, $query);
    if($result){
        if(mysqli_num_rows($result) == 1){

            $result_fetch = mysqli_fetch_assoc($result);
            $change = 1;
            if($result_fetch['isVerified']==0){
                $update_query = "UPDATE users SET isVerified='$change' WHERE email='$email' ;";
                if(mysqli_query($connection,$update_query)){
                    echo"
                        <script>
                        alert('Email verified successfully! now login');
                        window.location.href='login_form.php'
                        </script>
                    ";
                }
                else{
                    echo"
                        <script>
                        alert('VERIFICATION FAILED');
                        </script>
                    ";
                }
            }
            else{
                echo"
                    <script>
                    alert('Email already verified');
                    </script>
                ";
            }
        }
        else{
            echo"
                <script>
                alert('rows more than 1');
                
                </script>
            ";
        }
    }
    else{
        echo"
            <script>
            alert('Cannot run query');
            window.location.href='login_form.php'
            </script>
		";
        echo "ERROR: ".mysqli_error($connection);
    }
}