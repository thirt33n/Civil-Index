<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
else{
    if(($_SESSION['name'])!=='Officer')
    {
      header('Location:userhistory.php');
      exit;
    }
}
// if(isset($_SESSION['name'])!=="Officer"){
//   header('Location: index.html');
//   exit;

// }



// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre>';

 // Change this to your connection info.
 $DATABASE_HOST = 'localhost';
 $DATABASE_USER = 'root';
 $DATABASE_PASS = '';
 $DATABASE_NAME = 'civilindex_db';
 // Try and connect using the info above.
 $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
 if ( mysqli_connect_errno() ) {
     // If there is an error with the connection, stop the script and display the error.
     exit('Failed to connect to MySQL: ' . mysqli_connect_error());
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
    table {
      border-radius:3%/3%;
      /* border-style: solid;
      border-color: coral; */
      margin-top:7%;
      margin-bottom:7%;
      margin-left:5%;
      border-collapse: collapse;
      background-color: white;
      width: 90%;
      justify-content:center;
      opacity: 0.9;
      
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
      align-items: center;
    }

    tr:hover {background-color: #d01414;}
    .button {
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
    }

    .button1 {background-color: #D70040;} /* Red */
    .button2 {background-color: #008CBA;} /* Blue */
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
		<link href="assets/vendor/aos/aos.css" rel="stylesheet">
		<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
		<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
		<link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
		<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
		<link href="assets/css/style.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src = "jquery.tabledit.min.js"></script>
		<link href="stylesLog.css" rel="stylesheet" type="text/css">

    <title>Your Indexes</title>
</head>
<body>

    	<header id="header" class="d-flex align-items-center">
		<div class="container d-flex align-items-center justify-content-between">

		<h1 class="logo"><a href="admin.php">Civil Index</a></h1>
		<!-- Uncomment below if you prefer to use an image logo -->
		<!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

		<nav id="navbar" class="navbar">
			<ul>
			<a href="profile.php"><i class="fas fa-user-circle"></i> <?=$_SESSION['name']?></a>
			<a href="./mapUpdate/map2.php"><i class="fas fa-sign-out-alt"></i> Map</a>
			<a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
			</ul>
			<i class="bi bi-list mobile-nav-toggle"></i>
		</nav><!-- .navbar -->

		</div>
	</header>
    
    
    <!-- </table> -->
   
    <?php

        $username = $con->real_escape_string($_SESSION['name']);
        $sql = "SELECT id,area,counter,floor,locality,user,indexer,approval from cindex where approval='Pending'" ;
        $sql1 = "SELECT id,area,counter,floor,locality,user,indexer,approval from cindex where approval!='Pending'" ;
        $results = $con->query($sql);
        $results1 = $con->query($sql1);

        if ($results->num_rows > 0){
          echo '<table id="adminTable">
          <tr>
          <th>id</th>
          <th>Area in sq.m</th>
          <th>People per floor</th>
          <th>Number of floors</th>
          <th>Locality</th>
          <th>User</th>
          <th>Index</th>
          <th>Approval</th>

          </tr>';
            while($row = $results->fetch_assoc()){
              echo "<tr>";
              echo "<td>" . $row["id"] . "</td>";
              echo "<td>" . $row["area"] . "</td>";
              echo "<td>" . $row["counter"] . "</td>";
              echo "<td>" . $row["floor"] . "</td>";
              echo "<td>" . $row["locality"] . "</td>";
              echo "<td>" . $row["user"] . "</td>";
              echo "<td>" . $row["indexer"] . "</td>";
              echo "<td>" . $row["approval"] . "</td>";
              // echo '<td>  <form method="post"> <input type="submit" name="approver" class="button2" value=""> </form> </td>';
              // echo '<td> <form method="post"> <input  type="submit" name="denier" class="button1" value="Deny"> </form> </td>';
            
              echo "</tr>";
              }
            while($row1 = $results1->fetch_assoc()){
              echo "<tr>";
              echo "<td>" . $row1["id"] . "</td>";
              echo "<td>" . $row1["area"] . "</td>";
              echo "<td>" . $row1["counter"] . "</td>";
              echo "<td>" . $row1["floor"] . "</td>";
              echo "<td>" . $row1["locality"] . "</td>";
              echo "<td>" . $row1["user"] . "</td>";
              echo "<td>" . $row1["indexer"] . "</td>";
              echo "<td>" . $row1["approval"] . "</td>";
              // echo '<td>  <form method="post"> <input type="submit" name="approver" class="button2" value=""> </form> </td>';
              // echo '<td> <form method="post"> <input  type="submit" name="denier" class="button1" value="Deny"> </form> </td>';
            
              echo "</tr>";
              }
              echo "</table>";
            } else {
                echo "0 records  $username";
        }
        echo "</table>"
    ?>


<!-- 
        <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="footer-info">
              <h3>Civil Index</h3>
              <p>
                VIT Chennai <br>
                India<br><br>
                <strong>Phone:</strong> +91 1234567890<br>
                <strong>Email:</strong> shyaam.s2020@vitstudent.ac.in<br>
              </p>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Directions</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="logout.php">Log Out</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="map.php">Map</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="profile.php">Profile</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Civil Index</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer> -->


<footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="footer-info">
              <h3>Civil Index</h3>
              <p>
                VIT Chennai <br>
                India<br><br>
                <strong>Phone:</strong> +91 1234567890<br>
                <strong>Email:</strong> shyaam.s2020@vitstudent.ac.in<br>
              </p>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Directions</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="logout.php">Log Out</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="map.php">Map</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="profile.php">Profile</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Civil Index</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer>
  </body>
</html>
<script>
    $(document).ready(function(){  
     $('#adminTable').Tabledit({
      url:'action.php',
      editButton: false,
      hideIdentifier: false,
      columns:{
       identifier:[0, "id"],
       editable:[[7, "approval"]]
      },
      restoreButton:false,
      onSuccess:function(data, textStatus, jqXHR)
      {
       if(data.action == 'delete')
       {
        $('#'+data.id).remove();
       }
      }
     });
 
});  
  
</script>