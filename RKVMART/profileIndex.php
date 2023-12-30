<?php
include "connection.php";

if (isset($_SESSION['UID'])){
  $UID = $_SESSION["UID"];
  $user_query = "SELECT * FROM users WHERE UID='$UID'";
  $user_query_result = mysqli_query($connection,$user_query);

  $user_products_query = "SELECT * FROM products WHERE UID='$UID'";
  $user_products_query_result = mysqli_query($connection,$user_products_query);

}
else{
  echo "
  <script>
    window.location.href='login_form.php';
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
    <title>Profile</title>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
  />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="profilestyle.css">

  <script src="https://code.jquery.com/jquery-3.6.1.min.js" 
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" 
    crossorigin="anonymous">
    </script>

  <!--jquery function to include header and footer-->
  <script>
        $(function () {
            $("#header").load("header.php");
            $("#footer").load("footer.html");
        });
    </script>

</head>
<body>
  <!-- Navbar Started -->
  <div id="header"></div>
    <!-- Navbar Ended -->
    <h2 class="mx-5">Profile Details</h2>
    <div class="container" >
      <div class="row">
        <center>
          <div class="container m-2 p-3 col-md-4 rounded">
            <?php while($row = mysqli_fetch_assoc($user_query_result)){ ?>
              <form action="profile.php" class="form-floating" METHOD="POST" id="form">

                  <div class="form-floating">
                    <input type="text" class="form-control box" id="name" name="username" value="<?php echo $row['username']; ?>" required />
                    <label for="name" class="form-label">Name:</label>
                  </div>

                  <div class="form-floating mt-3">
                    <input type="email" class="form-control box" id="email" name="email" value="<?php echo $row['email']; ?>" required />
                    <label for="email" class="form-label">Email:</label>
                  </div>

                  <div class="form-floating mt-3">
                    <input type="tel" class="form-control box" id="tel" name="phone" value="<?php echo $row['phone']; ?>" required/>
                    <label for="tel" class="form-label">Mobile:</label>
                  </div>
                  <br>
                  <button type="submit" class="btn-dark rounded-pill px-3 py-1">Update</button>
                </form>
            <?php }?>
          </div>
        </center>
      </div>
    </div>
    <br>
    <br>
    <h2 class="mx-5 my-2">YOUR ADS</h2>
    <div class="container p-5">
      <div class="row">
        <?php 
            while($rows = mysqli_fetch_assoc($user_products_query_result)){
        ?>
          <div class="col-sm-3 mb-3 d-flex align-items-stretch">
              <div class="card shadow-sm" style="width: 18rem;">
                  <img src="<?php echo $rows['imageUrl'] ?>" class="card-img-top" alt="<?php echo $rows['title'] ?>">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $rows['title'] ?></h5>
                    <p class="card-text">₹<?php echo $rows['price'] ?></p>
                    <p class="card-text"><?php echo $rows['dateAdded'] ?></p>
                  </div>
                  
                  <a  href="product.php?productID=<?php echo $rows['productID'] ?>" style="color: #ffffff;text-decoration: none">
                  <div class="card-footer bg-dark text-center">OPEN</div>
                </a>
                </div>
          </div>

        <?php 
            }
        ?>
      </div>
    </div>
    <!-- Navbar Started -->
    <div id="footer"></div>
    <!-- Navbar Ended -->
</body>
</html>