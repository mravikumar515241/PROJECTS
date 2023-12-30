<?php
include "connection.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            .search
            {
                padding-left:1500px;
            }
      
        </style>
        <title>
            BOOKS
        </title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
    </head>
    <style tytpe="text/css">
		ul li:hover{
            background-color:black;
            border:4px solid aqua;
            border-radius: 20px;
            padding:2px 12px
        }
         input:hover{
            background-color:lightseagreen;
            border:4px solid cyan;
        }
    </style>
    <body style="background-color:rgb(196, 236, 255)">
        
        <div class="wrapper">
        <header class="head3">
        <div class="logo">
            <img src="logo1.png" alt="right" height="60px" width="100px">
            <h1 style="color: magenta;">ONLINE DOCUMENTS VIEW SYSTEM</h1>
        </div>
            <nav>
                <ul>
                    <li><a href="../index.php">HOME</a></li>
                    <li><a href="books.php">BOOKS</a></li>
                </ul>
            </nav>
        </header>
        <section><br><br>
        <div class="srch">
		<form class="navbar-form" method="post" name="form1">
			
				<input class="form-control" type="text" name="search" placeholder="search books.." required="">
				<button style="background-color: #6db6b9e6;" type="submit" name="submit" class="btn btn-default">
					<span class="glyphicon glyphicon-search"></span>
				</button>
		</form>
	</div>
    <h2 style="color: purple;">List Of Books</h2>
	<?php

		if(isset($_POST['submit']))
		{
			$res=mysqli_query($dp,"SELECT * from books where bookname like '%$_POST[search]%' ");

			if(mysqli_num_rows($res)==0)
			{
				echo "Sorry! No book found. Try searching again.";
			}
			else
			{
		echo "<table class='table table-bordered table-hover' >";
			echo "<tr style='background-color: #6db6b9e6;'>";
				//Table header
				echo "<th>"; echo "Book-Name";  echo "</th>";
				echo "<th>"; echo "Authors Name";  echo "</th>";
				echo "<th>"; echo "Edition";  echo "</th>";
				echo "<th>"; echo "Department";  echo "</th>";
			echo "</tr>";	

			$pdfDirectory = '../pdf/';

			while($row=mysqli_fetch_assoc($res))
			{
				echo "<tr>";
				echo "<td>"."<a download='".$row['bookname'].".pdf'href='$pdfDirectory".$row['bookname']."'>"; echo $row['bookname']."</a>"; echo "</td>";
				echo "<td>"; echo $row['author']; echo "</td>";
				echo "<td>"; echo $row['edition']; echo "</td>";
				echo "<td>"; echo $row['department']; echo "</td>";

				echo "</tr>";
			}
		echo "</table>";
			}
		}
			/*if button is not pressed.*/
		else
		{
			$res=mysqli_query($dp,"SELECT * FROM books ORDER BY books.bookname ASC;");

		echo "<table class='table table-bordered table-hover' >";
			echo "<tr style='background-color: gray;'>";
				//Table header
				echo "<th>"; echo "Book-Name";  echo "</th>";
				echo "<th>"; echo "Authors Name";  echo "</th>";
				echo "<th>"; echo "Edition";  echo "</th>";
				echo "<th>"; echo "Department";  echo "</th>";
			echo "</tr>";	
			$pdfDirectory = '../pdf/';
			while($row=mysqli_fetch_assoc($res))
			{
				echo "<tr>";
				echo "<td>"."<a download='".$row['bookname'].".pdf'href='$pdfDirectory".$row['bookname']."'>"; echo $row['bookname']."</a>"; echo "</td>";
				echo "<td>"; echo $row['author']; echo "</td>";
				echo "<td>"; echo $row['edition']; echo "</td>";
				echo "<td>"; echo $row['department']; echo "</td>";

				echo "</tr>";
			}
		echo "</table>";
		}
        ?>
        </section>
    </body>
</html>
