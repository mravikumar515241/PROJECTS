<?php

session_start();

if(isset($_SESSION['UID'])){
  echo "
  <script>
    window.location.href='index.php';
  </script>
  ";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css” />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="login.css">
</head>

<body>
  <div class="container">
    <div class="row">
      <center>
        <div class="col-md-4">
          <h2 style="color:#000000;font-weight:bold">Log in</h2>
          <form action="index.php" class="form-floating" METHOD="POST" id="form">
            <div class="form-floating m-3">
              <input type="email" class="form-control box" id="email" name="loginemail" placeholder="" required />
              <label for="email" class="form-label">Email</label>
            </div>

            <div class="form-floating m-3">
              <input type="password" class="form-control box" id="pass" name="pwd" placeholder="" required />
              <label for="password" class="form-label">password</label>
            </div>
            <!-- <span type="button" class="eye" onclick="myFunction()"></span> -->

            <button class="btn bt button px-5 rounded-pill text-white" style="font-weight:bold"
              type="submit">Login</button>
            <p class="text-secondary m-3">Don't have an account?<a href="../register.html">Register</a>
            </p>


          </form>
        </div>
      </center>
    </div>
  </div>

  <script>
    function myFunction() {
      var x = document.getElementById("pass");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
</body>

</html>