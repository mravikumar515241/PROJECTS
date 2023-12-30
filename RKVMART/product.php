<?php
include "connection.php";

if(!$connection){
    die("Connection failed: " . mysqli_connect_error());
  }

$productID = $_GET['productID'];

$query = "SELECT * FROM products WHERE productID=$productID;";
$result = mysqli_query($connection, $query);

$productTitle = "";
$productDescription = "";
$productPrice = 0;
$productDateAdded = "00-00-0000";
$productImageUrl = "";

/*Product Owner Details */
$productOwnerUID = 0;
$ownerName  = '';
$ownerMobile = '';
$ownerImageUrl = '';


while($rows = mysqli_fetch_assoc($result)){
    $productTitle = $rows['title'];
    $productDescription = $rows['description'];
    $productPrice = $rows['price'];
    $productDateAdded = $rows['dateAdded'];
    $productImageUrl = $rows['imageUrl'];
    $productOwnerUID = $rows['UID'];
}



/*Fetch Owner details */
$owner_query = "SELECT * FROM users WHERE UID=$productOwnerUID ;";
$owner_query_result = mysqli_query($connection, $owner_query);

while($owner_rows = mysqli_fetch_assoc($owner_query_result)){
    $ownerName = $owner_rows['username'];
    $ownerMobile = $owner_rows['phone'];
    $ownerImageUrl = $owner_rows['imageUrl'];
}


$logged_in_user = $_SESSION['UID'];
$usertype_query = "SELECT accountType FROM users WHERE UID=$logged_in_user;";
$usertype_query_result = mysqli_query($connection,$usertype_query);
$usertype_row = mysqli_fetch_assoc($usertype_query_result);
$is_admin_loggin = false;
if($usertype_row['accountType'] == 'admin'){
    $is_admin_loggin = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $productTitle?></title>


    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" 
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" 
    crossorigin="anonymous">
    </script>

    <!--Bootstrap cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

    <script> 
      $(function(){
        $("#header").load("header.php"); 
        $("#footer").load("footer.html"); 
      });
    </script>

</head>
<body style="background-color: rgba(255, 250, 255)">

    <!-- Navbar Started -->
    <div id="header"></div>
    <!-- Navbar Ended -->

    <!--Product detail section-->
    <div class="row p-3">

        <!--IMAGE & DESCRIPTION-->
        <div class="col-sm-8">
            <!--IMAGE-->
            <div class="container-fluid shadow-sm p-3 mb-2 bg-body rounded border">
                <img src="<?php echo $productImageUrl; ?>" class="img-fluid mx-auto d-block" alt="<?php $productTitle; ?>">
            </div>

            <!--DESCRIPTION-->
            <div class="container-fluid shadow-sm p-3 mb-6 bg-body rounded border">
                <h4>Description</h4>
                <p><?php echo $productDescription; ?></p>
            </div>

        </div>

        <!--Details Section-->
        <div class="col-sm-4">
            <!--PRICE & TITLE-->
            <div class="container-fluid shadow-sm p-3 mb-2 bg-body rounded border">
                <h1>₹ <?php echo $productPrice; ?></h1>
                <h6><?php echo $productTitle; ?></h6>
            </div>

            <?php

                if( isset($_SESSION['UID']) && ($productOwnerUID == $_SESSION['UID'] || $is_admin_loggin) ){
            ?>
                <div class="container-fluid shadow-sm p-3 mb-2 bg-body rounded border">
                <h4>Modify</h4>
                <form id="editform" action="edit_product.php" method="POST">                    
                    <input type="hidden" name="editproduct" value="<?php echo $productID ?>" >
                    <Button type="submit" class="btn btn-outline-dark"><i class="fa fa-pen-to-square"></i> Edit</Button>
                </form>
                <form id="deleteform" action="delete_product.php" method="post">                    
                    <input type="hidden" name="delete" value=<?php echo $productID ?> >
                    <Button type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i> Delete</Button>
                </form>
                </div>
            <?php
                }
                else{
            ?>

                <!--User Details-->
            <div class="container-fluid shadow-sm p-3 mb-2 bg-body rounded border">
                <h4>Seller Details</h4>
                <h6 class="mt-3 mb-3"><?php echo $ownerName ?></h6>
                <button type="button" class="btn btn-outline-dark">Chat with Seller</button>
            </div>

              <!--Contact Owner-->
                <div class="container-fluid shadow-sm p-3 mb-2 bg-body rounded border">
                    <h4>Contact </h4>
                    <a href="https://wa.me/<?php echo $ownerMobile ?>?text=I'm%20interested%20in%20your%20product%20<?php echo $productTitle; ?>%20for%20sale%20in%20rkvmart" class="btn btn-outline-success"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                    <a href="phone:<?php echo $ownerMobile ?>" class="btn btn-outline-dark"><i class="fa fa-phone"></i> Phone</a>
                </div>  

            <?php
                }
            ?>

        </div>
    </div>
    <!--Product detail section-->

    <!-- Footer Started-->
    <div id="footer"></div>
    <!-- Footer Ended -->

    <script>
        let form=document.getElementById('deleteform');
        form.addEventListener("submit", (event) => {
        event.preventDefault();
        confirmation();
      });

      function confirmation(){
        if(confirm("Are you sure to delete your product?")){
            form.submit();
        }
      }
    </script>
</body>
</html>