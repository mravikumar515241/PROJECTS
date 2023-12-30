<?php


if(isset($_POST['loginemail'])){

  $email=$_POST['loginemail'];
  $pass=$_POST['pwd'];

  $password_query = "select * from users where email='$email' ;";

  if($password_query_result = mysqli_query($connection,$password_query)){

    while($row = mysqli_fetch_assoc($password_query_result)){

      if($row['password'] == $pass){

        if($row['isVerified'] == 1){
          $_SESSION['UID'] = $row['UID'];
        }
        else{
          echo "
              <script>
                alert('Please verify your email ! check inbox');
                window.location.href='login_form.php';
              </script>
            ";
        }
      }
      else{
        echo "
        <script>
        alert('Wrong Password Entered!');
        window.location.href='login_form.php';
        </script>
        ";
      }
    }

  }
  else{
    echo "
      <script>
      alert('Email doesn't exit!Please register');
      window.location.href='login_form.php';
      </script>
      ";
  }

  
}


?>
