<?php
include "connection.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Client Details</title>
        <style>
            *{
                margin:0px;
                padding: 0px;
            }
            body{
                margin-top: 20px;
                margin-left: 20px;
                background-image: url(1.jpg);
                background-size: 100%;
            }
            /* Logo Styling 
            .logo{
                color: #ff7301;
                font-size: 35px;
                font-family: Arial;
                padding-left: 20px;
                float: left;
                padding-top: 10px;
                margin-top: 5px
            } */
            ul li a{
                text-decoration: none;
                color: rgb(255, 6, 6);
            }
            ul{
                list-style-type: none;
            }
            ul li:hover{
                background-color: rgba(229, 245, 6, 0.027);
                color: rgb(253, 215, 0);

            }
            ul li{float:left;
                    width: 200px;
                    height: 40px;
                    line-height: 40px ;
                    background-color: rgb(251, 254, 255);
                    text-align: center ;
                    font-size: 22px;
                    border-radius: 20px;
                    opacity : 0.7;}
            ul li ul{
                display:none;
            }
            ul li:hover > ul {
                display: block;
            }
            ul li ul li{
                position: relative;
            }
            ul li ul li ul{
                position: absolute;
                margin-left: 200px;
                top:0px;
            }
            .form{
                    width: 250px;
                    height: 100px;
                    background: linear-gradient(to top, rgba(0,0,0,0.8)50%,rgba(0,0,0,0.8)50%);
                    position: absolute;
                    top: 250px;
                    left: 1000px;
                    transform: translate(0%,-5%);
                    border-radius: 10px;
                    padding: 25px;
                }

            .body{
               background-image: url(Benz_glc_6.jpg);
               background-repeat: no-repeat;
               background-attachment: fixed;
            }
            .button{
                background-color: rgb(218, 21, 7);
                border-radius: 5px;
                width: 75px;
                height: 40px;
            }
            .col{
                border-radius: 10px;
                /*background-color: rgb(78, 165, 93);
                /*background-image: url(BMD_F40_03.jpg);*/
            }
            
            .info{
                border-radius: 20px;
            }

            .rate{
                background-color: aqua;
                border-radius: 5px;
                width: 75px;
                height: 40px;
            }


        </style>
        <link rel="stylesheet" href="bootstrap.css">
    </head>
    <body class="body">
        <div class="cotainer"><b>
        <marquee scrollamount="8" direction="right"><font size="8" color="yellow">🏍️ 🚲️ 🏎️VEHICLES BOOKING🏎️ 🚲️ 🏍️</font></marquee>
        <ul>
            <li><a href="admin.html"> Home </a></li>
        </ul>
        </b>
        </div>

    </p> <br><br><br><br><br>
    
        <div class="container">
            <div class="row">
                <div class="col">
                    <?php
                    	$res=mysqli_query($connection,"SELECT * from userlogin ");
			if(mysqli_num_rows($res)==0)
			{
				echo "Sorry! No Clients are registered.";
			}
			else
			{
				echo "<table class='table table-bordered table-hover' >";
				echo "<tr style='background-color:white;'>";
					//Table header
					echo "<th>"; echo "UserName";	echo "</th>";
					echo "<th>"; echo "phone";  echo "</th>";
					echo "<th>"; echo "Email";  echo "</th>";
					echo "<th>"; echo "Password";  echo "</th>";
				echo "</tr>";	

				while($row=mysqli_fetch_assoc($res))
				{
					echo "<tr style='color:white;'>";
					echo "<td>"; echo $row['UserName']; echo "</td>";
					echo "<td>"; echo $row['phone']; echo "</td>";
					echo "<td>"; echo $row['Email']; echo "</td>";
					echo "<td>"; echo $row['Password']; echo "</td>";
					echo "</tr>";
				}
			echo "</table>";
			}
                    ?>
                    
                </div>
            </div>
        </div>
        <br><br><br><br><br>
        
    

    </body>
</html>








