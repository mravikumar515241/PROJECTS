<?php
include 'connection.php';

$C_UID = $_SESSION['UID'];
if(isset($C_UID)){
    $admin_query = "SELECT * FROM users WHERE accountType='admin' && UID=$C_UID";
    if(mysqli_num_rows(mysqli_query($connection,$admin_query)) == 0){
        echo "
            <script>
                window.location.href='index.php';
            </script>
        ";
    }

}
else{
    echo "
        <script>
            window.location.href='login_form.php';
        </script>
    ";
}

//total products
$products_query = "SELECT * FROM products;";
$products_query_result = mysqli_query($connection,$products_query);

//unlisted products
$unlisted_query = "SELECT *FROM products WHERE isVerified=0 ;";
$unlisted_query_result  = mysqli_query($connection,$unlisted_query);


//users count
$users_query = "SELECT * FROM users;";
$users_query_result = mysqli_query($connection,$users_query);






?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN PORTAL</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" 
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" 
    crossorigin="anonymous">
    </script>

    <style>
body{
    background-color:   #f2f2f2;
}
table, th, td {
  
}
th, td{
    padding : 15px;
}
th{
    background-color: black;
    color: white;
}
tr{
    border-bottom: 1px solid grey;
}
tr:nth-child(even){
    background-color: white;
}
a{
    text-decoration: none;
    color: black;
}
.detailrow{
    color: white
}
    </style>
</head>

<body>
    <center>
        <div class="row my-5 mx-2 detailrow">
            <div class="col-md-3 mx-1 bg-dark rounded">
                <div class="container rounded">
                    <h5>Total Ads</h5>
                    <h1><?php echo mysqli_num_rows($products_query_result);?></h1>
                </div>
            </div>
            <div class="col-md-3 mx-1 bg-dark rounded">
                <h5>Unlisted Ads</h5>
                <h1><?php echo mysqli_num_rows($unlisted_query_result);?></h1>
            </div>
            <div class="col-md-3 mx-1 bg-dark rounded">
                <h5>Users</h5>
                <h1><?php echo mysqli_num_rows($users_query_result);?></h1>
            </div>
        </div>
    </center>
    <center>
        <h2 class="mx-3">Pending Ads</h2>
        <table style="width:90%">
            
            <tr>
                <th>TITLE</th>
                <th>PRICE</th>
                <th>UID</th>
                <th>DATE</th>
                <th>isVerfied</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($unlisted_query_result)){ ?>
                <tr>
                    <td><a href="product.php?productID=<?php echo $row['productID']?>"><?php echo $row['title'] ?></a></td>
                    <td>₹<?php echo $row['price'] ?></td>
                    <td><?php echo $row['UID'] ?></td>
                    <td><?php echo $row['dateAdded'] ?></td>
                    <td>
                        <form action='approve_product.php' id="confirm"method="post">
                            <input type="hidden" name="approve" value=<?php echo $row['productID'] ?>>
                            <button type='submit'  class='btn btn-success'>Approve</button>
                        </form>
                        
                    </td>
                </tr>
           <?php } ?>
        </table>
        <h2 class="mx-3 mt-5">Total Ads</h2>
        <table style="width:90%">
            
            <tr>
                <th>TITLE</th>
                <th>PRICE</th>
                <th>UID</th>
                <th>DATE</th>
                <th>isVerfied</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($products_query_result)){ ?>
                <tr>
                    <td><a href="product.php?productID=<?php echo $row['productID']?>"><?php echo $row['title'] ?></a></td>
                    <td>₹<?php echo $row['price'] ?></td>
                    <td><?php echo $row['UID'] ?></td>
                    <td><?php echo $row['dateAdded'] ?></td>
                    <td><?php echo $row['isVerified'] ?></td>
                </tr>
           <?php } ?>
        </table>
    </center>
</body>
<script>
    let form=document.getElementById('confirm');
        form.addEventListener("submit", (event) => {
        event.preventDefault();
        confirmation();
      });

      function confirmation(){
        if(confirm("Are you sure to approve this product?")){
            form.submit();
        }
      }
</script>
<script>
      if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
      }
    </script>

</html>