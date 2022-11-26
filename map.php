<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
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
    <link href="stylesLog2.css" rel="stylesheet" type="text/css">
    <title>Chennai Map </title>
</head>
<body class="Loggedin">
    <header id="header" class="d-flex align-items-center">
		<div class="container d-flex align-items-center justify-content-between">

		<h1 class="logo"><a href="#">Civil Index</a></h1>
		<!-- Uncomment below if you prefer to use an image logo -->
		<!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

		<nav id="navbar" class="navbar">
			<ul>
			<a href="home.php"><i class="fas fa-home"></i>Home</a>
			<a href="profile.php"><i class="fas fa-user-circle"></i> <?=$_SESSION['name']?></a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
			</ul>
			<i class="bi bi-list mobile-nav-toggle"></i>
		</nav><!-- .navbar -->

		</div>
	</header>
    <iframe scrolling="no" style="height: 100%;width: 100%;" id="map" src="https://chennaicorporation.gov.in/gcc/citizen-details/location-service-lb/find_zone_map.jsp" title="Chennai Ward Map"></iframe>

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
            <h4>Credits</h4>
            <p>Chennai Corporation</p>
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