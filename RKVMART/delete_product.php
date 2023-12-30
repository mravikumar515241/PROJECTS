<?php

include "connection.php";

if(isset($_POST['delete'])){
    $productID = $_POST['delete'];
    $delete_query = "DELETE FROM products WHERE productID = $productID";
    if(mysqli_query($connection,$delete_query)){
        echo "
        <script>
            alert('DELETED SUCCESSFULLY');
            window.location.href='product.php?productID=$productID';
        </script>
        ";
    }
}

?>