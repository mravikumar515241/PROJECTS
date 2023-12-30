<?php
session_start();

include 'connection.php';

if(isset($_POST['updatedtitle'])){

    /*form data */
    $title = $_POST['updatedtitle'];
    $des = $_POST['des'];
    $price = $_POST['price'];
    $productID = $_POST['productID'];

    date_default_timezone_set("Asia/Kolkata");
    $date = date("d/m/Y");

    $image = $_FILES['img'];

    /*user ID from session*/
    $UID = $_SESSION['UID'];


    /*uploaded image details */
    $imagename = $image['name'];
    $error = $image['error'];
    $imgtmp = $image['tmp_name'];

    $separate = explode('.',$imagename);
    $file_ext = strtolower(end($separate));


    $allowed_extensions = array('jpg','png','jpeg');

    if(in_array($file_ext,$allowed_extensions)){

        /* upload image into images folder */
        $upload_directory = 'productsImages/';

        if(!(file_exists($upload_directory) AND is_dir($upload_directory))){
            mkdir($upload_directory);
            mkdir($upload_directory.$UID.'/');
        }
        else if(!(file_exists($upload_directory.$UID.'/') AND is_dir($upload_directory.$UID.'/'))){
            mkdir($upload_directory.$UID.'/');
        }

        /*replacing space with hypen to store image with title name */
        $new_image_name = str_replace(" ","-",$title);

        $upload_img = $upload_directory.$UID.'/'.$new_image_name.'.'.$file_ext;
        move_uploaded_file($imgtmp,$upload_img);

        /*insert data into table */
        $product_update_query = "UPDATE products SET title='$title', description='$des', price='$price', dateAdded='$date', imageUrl='$upload_img',UID='$UID' WHERE productID=$productID";
        if($product_update_result = mysqli_query($connection,$product_update_query)){
            echo "
            <script>
            alert('UPDATED SUCCESSFULLY');
            window.location.href='product.php?productID=$productID';
            </script>
            ";
        }
        else{
            echo "
            <script>
            alert('Something went wrong!');
            window.location.href='product.php?productID=$productID'
            </script>
            ";
        }

    }
    else{
        echo "
            <script>
            alert('Use only one of these photo formats: jpg,png or jpeg');
            window.location.href='product.php?productID=$productID'
            </script>
            ";
    }

}

?>