<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

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

    #app{
        margin-left: 35%;
        margin-top: 2.5%;
    }
    #inp-cover{
      border-radius: 50px;
    }
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
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link href="stylesLog.css" rel="stylesheet" type="text/css">

    <title>Your Indexes</title>
</head>
<body>

    	<header id="header" class="d-flex align-items-center">
		<div class="container d-flex align-items-center justify-content-between">

		<h1 class="logo"><a href="home.php">Civil Index</a></h1>
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
  


            <div id="app-cover">
        <div id="app">
            <form method="post" action="searchPage.php">
            <span>
            <div id="f-element">
                <div id="inp-cover"><input type="text" name="query" placeholder="Search for Localities.." autocomplete="off">
                <button type="submit" class="shadow"><i class="fas fa-search"></i></button>
            </div>
            </div>
            
  </span>
            </form>
        </div>
        </div>


        <?php
          if(isset($_POST["query"])){
            $query = $_POST['query'];

            $sql = "SELECT * from searchdb where locality LIKE '$query%'";
            // $result = mysqli_query($sql, $con);
            $result = $con->query($sql);

            

                if ($result->num_rows > 0){
            
                    echo "<table>
                    <tr>
                    <th>Locality</th>
                    <th>Type</th>
                    <th>Population</th>
                    <th>No of Houses</th>
                    <th>Index Rating</th>
                    </tr>";
                    while($row = $result->fetch_assoc()){
                      echo "<tr>";
                      echo "<td>" . $row["locality"] . "</td>";
                      echo "<td>" . $row["type"] . "</td>";
                      echo "<td>" . $row["population"] . "</td>";
                      echo "<td>" . $row["no_of_houses"] . "</td>";
                      echo "<td>" . $row["index"] . "</td>";
                   
                      echo "</tr>";
                      }
                      echo "</table>";
                    } else {
                        echo "Nothing found search again";
                }
              }else{
                echo " ";
              }

        ?>



</body>
</html>