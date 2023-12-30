<?php
session_start();


/*To redirect user to login page when user enters into upload page without logging in*/
if(!isset($_SESSION['UID'])){
    echo "
    <script>
        window.location.href='login_form.php';
    </script>
    ";
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post Your Product</title>

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
                            <h1 align="center"><u><b>POST YOUR AD</b></u></h1><br>
                            <form action="index.php" method="post" enctype="multipart/form-data">
                                <fieldset>
                                    <label for="ad">AD title</label>
                                    <input type="text" maxlength="255" placeholder="" class="form-control" id="adt" name="title" required><br>
                                    <label for="des">Description</label>
                                    <textarea maxlength="255" rows="4" cols="5" class="form-control"
                                        name="des" required></textarea><br>
                        
                                    <label for="price">Price</label>
                                    <input type="number"  placeholder="" min="0" class="form-control" name="price"
                                        id="price" required><br>
                                    <hr>
                                    <h3>UPLOAD A PHOTO</h3>
                                    <hr>
                                    <input type="file" placeholder="" class="form-control" name="img" id="upl" required><br>

                                    <button type="submit" class="btn btn-success" name="submit">Post now</button>

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