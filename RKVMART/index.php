<?php 
include "connection.php";

if(!$connection){
  die("Connection failed: " . mysqli_connect_error());
}


/* PRODUCT FETCH*/
$product_query = "SELECT * FROM products WHERE isVerified=1 ORDER BY productID DESC ;";
$product_result = mysqli_query($connection, $product_query);


if(!isset($_SESSION['UID'])){
  
  include "register.php";
  include "login.php";

}

if(isset($_POST['title'])){
  include "upload_product.php";
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOME - RKVMart</title>

    <link rel="stylesheet" href="indexstyle.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" 
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" 
    crossorigin="anonymous">
    </script>

    <!--jquery function to include header and footer-->
    <script> 
      $(function(){
        $("#header").load("header.php"); 
        $("#footer").load("footer.html"); 
      });
    </script>
  
  </head>
  <body>
    <!-- Navbar Started -->
    <div id="header"></div>
    <!-- Navbar Ended -->

    <!-- Recently Added Section Started-->
    <div class="recentsection p-5">
    <div class="row">
      <?php 
          while($rows = mysqli_fetch_assoc($product_result)){
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
    <!-- Recently Added Section Ended-->

    <!-- Footer Started-->
    <div id="footer"></div>
    <!-- Footer Ended -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script>
      if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
      }
    </script>
  </body>
</html>