<?php

include "connection.php";

session_start();

if(isset($_POST['editproduct'])){
    $productID = $_POST['editproduct'];

    $query = "SELECT * FROM products WHERE productID=$productID;";
    $result = mysqli_query($connection, $query);

    $productTitle = "";
    $productDescription = "";
    $productPrice = 0;
    $productImageUrl = '';

    while($rows = mysqli_fetch_assoc($result)){
        $productTitle = $rows['title'];
        $productDescription = $rows['description'];
        $productPrice = $rows['price'];
        $productImageUrl = $rows['imageUrl'];
    }

}
else{
    echo "NOT FROM POST METHOD";
}



?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Your Product</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


    <!--Jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous">
    </script>

    <!--jquery function to include header and footer-->
    <script>
        $(function () {
            $("#header").load("header.php");
            $("#footer").load("footer.html");
        });
    </script>

    <style>
        body{
            color: white;
        }
    </style>

</head>

<body>
    <!-- Navbar Started -->
    <div id="header"></div>
    <!-- Navbar Ended -->

    <div class="container" align="center">
        <div class="col-md-7">
            <div class="container " align="center">
                <div class="container bg-dark p-3">
                    <div class="container  m-2">
                        <div class="col-md-7">
                            <h1 align="center"><b>UPDATE YOUR AD</b></h1><br>
                            <form action="edit_product_success.php" method="post" enctype="multipart/form-data">
                                <fieldset>
                                    <h3>PRODUCT PHOTO</h3>                                    
                                    <div class="container-fluid">
                                    <img height="100" width="100" src="<?php echo $productImageUrl ?>" alt="<?php echo $productImageUrl ?>">
                                    <input type="file" placeholder="" class="form-control" name="img" id="upl" required><br>
                                    </div>    
                                    <label for="ad">Title *</label>
                                    <input type="text" placeholder="" class="form-control" id="adt" name="updatedtitle" value="<?php echo $productTitle ?>" ><br>
                                    <label for="des">Description *</label>
                                    <textarea maxlength="255" rows="4" cols="5" class="form-control" name="des"><?php echo $productDescription ?></textarea><br>

                                    <label for="price">Price *</label>
                                    <input type="number" placeholder="" min="0" class="form-control" name="price" id="price" value="<?php echo $productPrice ?>"><br>
                                    <input type="hidden" name="productID" value=<?php echo $productID?>>
                                    <button type="submit" class="btn btn-success" name="submit">UPDATE</button>

                                    </button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Started-->
    <div class="pt-4" id="footer"></div>
    <!-- Footer Ended -->
</body>

</html>