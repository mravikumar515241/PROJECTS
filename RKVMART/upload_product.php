<?php
session_start();

include 'connection.php';

if(isset($_POST['title'])){

    /*form data */
    $title = $_POST['title'];
    $des = $_POST['des'];
    $price = $_POST['price'];

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

        $temp_query="SELECT productID FROM products limit 1;";
        $check=mysqli_query($connection,$temp_query);


        if(!$check){

            /*if not table created */

            $product_create_query="CREATE TABLE products(
                productID int NOT NULL AUTO_INCREMENT,
                title VARCHAR(50),
                description VARCHAR(255),
                price VARCHAR(10),
                dateAdded varchar(20),
                imageUrl varchar(255),
                isVerified bool,
                PRIMARY KEY (productID),
                UID INT
                );";
            
            $product_alter_query = "ALTER TABLE products AUTO_INCREMENT=10000001";
            $add_foreign_key_query = "ALTER TABLE products ADD FOREIGN KEY (UID) REFERENCES users(UID)";
            
            if(mysqli_query($connection,$product_create_query) && mysqli_query($connection,$product_alter_query) && mysqli_query($connection,$add_foreign_key_query) )
            {
                echo "products table is  created"."<br>";
            }
            else
            {
                echo "error:".$query.mysqli_error($connection);
            }
        }

        /*insert data into table */
        $product_insert_query = "INSERT INTO products(title,description,price,dateAdded,imageUrl,UID,isVerified) VALUES('$title','$des',$price,'$date','$upload_img',$UID,0)";
        $product_insert_result = mysqli_query($connection,$product_insert_query);

    }
    else{
        echo "CHOOSE ONE OF THESE FILE FORMATS: $allowed_extensions";
    }

}

?>