<?php
include 'connection.php';

    if(isset($_POST['approve'])){
        //approve product here
        $productID = $_POST['approve'];
        $approve_query = "UPDATE products SET isVerified=1 WHERE productID=$productID";
        if(mysqli_query($connection,$approve_query)){
            echo "
            <script>
                alert('Approved Successfully');
                window.location.href='admin.php';
            </script>
            ";
        }
        else{
            $error = mysqli_error($connection);
            echo "
            <script>
                alert('ERROR:');
                window.location.href='admin.php';
            </script>
            " ;
        }
        
    }
    else{
        echo "
            <script>
                window.location.href='admin.php';
            </script>
        ";
    } 
?>