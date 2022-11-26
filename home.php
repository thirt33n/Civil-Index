<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
else{
	if($_SESSION['name']=='Officer'){
	header('Location: admin.php');
	exit;
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		
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
		
	
	</head>
	<body class="Loggedin">

		<header id="header" class="d-flex align-items-center">
		<div class="container d-flex align-items-center justify-content-between">

		<h1 class="logo"><a href="#">Civil Index</a></h1>
		<!-- Uncomment below if you prefer to use an image logo -->
		<!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

		<nav id="navbar" class="navbar">
			<ul>
			<a href="searchpage.php"><i class="fas fa-search"></i></a>
			<a href="profile.php"><i class="fas fa-user-circle"></i> <?=$_SESSION['name']?></a>
			
			<a href="./mapUpdate/map2.php"><i class="fas fa-sign-out-alt"></i> Map</a>
			<a href="userhistory.php"><i class="fa-sharp fa-solid fa-i"></i>Index</a>
			<a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
			</ul>
			<i class="bi bi-list mobile-nav-toggle"></i>
		</nav><!-- .navbar -->

		</div>
	</header>
		
		<div class="content">
			<h2>Welcome Home, <?=$_SESSION['name']?>! </h2>
		</div>
		
		<div class="container">
		<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Enter Details</h3>
			</div>
			<div class="card-body">
				<form action="addinfo.php" method="post" autocomplete="off">
					<div class="input-group form-group">
						<div class="input-group-prepend" for="Area">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="number" name="area" id="area" class="form-control" placeholder="Enter Area" required>
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend" for="Number of People">
							<span class="input-group-text"><i class="fas fa-lock"></i></span>
						</div>
						<input type="number" name="counter" class="form-control" placeholder="Number of people per floor" id="counter" required>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend" for="floor">
							<span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
						</div>
						<input type="number" name="floor" id="floor"  class="form-control" placeholder="Number of Floors" required>
					</div>

					<div class="input-group form-group">
						<div class="input-group-prepend" for="locality">
							<span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
						</div>
						<input type="text" name="locality" id="locality"  class="form-control" placeholder="Locality" required>
					</div>
					
					<div class="form-group">
						<input type="submit" value="Submit" class="btn float-right login_btn">
					</div>
				</form>
			</div>
		</div>
		</div>
	</div>


	

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