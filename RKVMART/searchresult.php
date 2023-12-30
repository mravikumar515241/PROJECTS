<?php 
include "connection.php";

if(!$connection){
  die("Connection failed: " . mysqli_connect_error());
}



$search = '';
$resultRows = array();


if(isset($_GET['search'])){
    if(!empty($_GET['search']))
    {
        $search = $_GET['search'];

        $query = "SELECT * FROM products WHERE title LIKE '%$search%' OR description LIKE '%$search%' ORDER BY productID DESC ;";
        $result = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($result)){
          array_push($resultRows,$row);
        }
      
    }
    else
    {
        $resultRows = array();
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search for "<?php echo $search; ?>"</title>
    <link rel="stylesheet" href="searchresultstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" 
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" 
    crossorigin="anonymous">
    </script>

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

      <h5 class="pt-4 ps-4">Search Results for "<?php echo $search ?>"</h5>

    <!-- Recently Added Section Started-->
    <div class="resultsection pt-3 ps-4">
    <div class="row">
      <?php
        if(!count($resultRows) == 0){
          foreach($resultRows as $key=>$row){
      ?>
        <div class="col-sm-3 mb-3 d-flex align-items-stretch">
            <div class="card shadow-sm" style="width: 18rem;">
                <img src="<?php echo $row['imageUrl'] ?>" class="card-img-top" alt="<?php echo $row['title'] ?>">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $row['title'] ?></h5>
                  <p class="card-text">₹ <?php echo $row['price'] ?></p>
                  <p class="card-text"><?php echo $row['dateAdded'] ?></p>
      
                </div>
            
                <a href="product.php?productID=<?php echo $row['productID'] ?>" style="color:white;text-decoration:none">
                <div class="card-footer bg-dark text-center">OPEN</div>
              </a>
              </div>
        </div>

      <?php 
          }
        }
        else{
      ?>

      <center>
      <h4>Sorry! No mathches for your search</h4>
      </center>
      
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
  </body>
</html>
