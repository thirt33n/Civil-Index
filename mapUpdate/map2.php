<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.html');
	exit;
}
?>



<html>
    <head>
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
		<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>        
		<link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.1.0/dist/geosearch.css"/>       
		<script src="https://unpkg.com/leaflet-geosearch@3.1.0/dist/bundle.min.js"></script>
		<!-- <link rel="stylesheet" href="./leaflet-search.css"/>
		<script src="./leaflet-search.js"></script>-->
		<script src="https://unpkg.com/jquery@3.3.1/dist/jquery.js"></script>
        <!-- <script src="./L.KML.js"></script>-->

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
        <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
        <link href="../assets/css/style.css" rel="stylesheet">
        <link href="../stylesLog2.css" rel="stylesheet" type="text/css">
        <title>Chennai Map </title>
    
    
    </head>
    <body onLoad="onBtClick();" class="Loggedin">
	
    <header id="header" class="d-flex align-items-center">
		<div class="container d-flex align-items-center justify-content-between">

		<h1 class="logo"><a href="../home.php">Civil Index</a></h1>
		<!-- Uncomment below if you prefer to use an image logo -->
		<!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

		<nav id="navbar" class="navbar">
			<ul>
			<a href="../+
			searchpage.php"><i class="fas fa-search"></i></a>
			<a href="../home.php"><i class="fas fa-home"></i>Home</a>
			<a href="../profile.php"><i class="fas fa-user-circle"></i> <?=$_SESSION['name']?></a>
            <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
			</ul>
			<i class="bi bi-list mobile-nav-toggle"></i>
		</nav><!-- .navbar -->

		</div>
	</header>

        <div style="width: 100vw; height: 100vh" id="map"></div>

        <script type="text/javascript">
		
		//var map = new L.Map('map', { center: new L.LatLng(< %=sLATITUDE%>, < %=sLONGITUDE%>), zoom: 15 });
		var map = L.map('map').setView([13.0827, 80.2707], 12);
		//var map = L.map('map').setView([11.19,78.22], 7);

		var empty=L.tileLayer('');
	
	var osm = L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
				   attribution: ''
				}).setZIndex(-1);
	var googleHybrid = L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
						maxZoom: 50,
						//subdomains:['mt0','mt1','mt2','mt3']
						subdomains:['mt2','mt3']
					}).setZIndex(-1);
	var googleStreets = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
						maxZoom: 50,
						//subdomains:['mt0','mt1','mt2','mt3']
						subdomains:['mt2','mt3']
					}).setZIndex(-1).addTo(map);
	var googleTerrain = L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
						maxZoom: 50,
					//	subdomains:['mt0','mt1','mt2','mt3']
						subdomains:['mt2','mt3']
					}).setZIndex(-1);
	
	var googleSat = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
						maxZoom: 50,
						//subdomains:['mt0','mt1','mt2','mt3']
						subdomains:['mt2','mt3']
					}).setZIndex(-1);	
					
			var baseLayers = {
				"No Basemap": empty,
				"Open Street": osm,
				"Google Streets":googleStreets,
				"Google Terrain":googleTerrain,
				"Google Hybrid":googleHybrid,
				"Google Satellite":googleSat,
	
			};
	
	var overlays = {
				//"Division":division,
				//"zone":zone
			};		
	var lctrl=L.control.layers(baseLayers, overlays,{collapsed:false}).addTo(map);
	
	
	var zone,division;
	
	var zoneStyle={
		fillColor: "yellow",
		weight: 2,
		opacity: 1,
		color: 'green',
		dashArray: '3',
		fillOpacity: 0.1
	  };
	  
	var zoneStyle_new={
		fillColor: "yellow",
		weight: 2,
		opacity: 1,
		color: 'red',
		dashArray: '3',
		fillOpacity: 0.1
	  };
	  
	var divStyle={
		fillColor: "white",
		weight: 1,
		opacity: 1,
		color: 'blue',
		dashArray: '3',
		fillOpacity: 0.1
	  };  
	
	var divStyle_new={
		fillColor: "white",
		weight: 1,
		opacity: 1,
		color: '#CC00CC',
		dashArray: '3',
		fillOpacity: 0.1
	  };  
	
	function onEachFeature(feature, layer){
			var popup = '';
			for (var clave in feature.properties) { 
			//if (feature.properties[clave].toUpperCase().indexOf("ID_")>=0 || feature.properties[clave].toUpperCase().indexOf("NAME")>=0) continue;
			  popup += clave +':'+ feature.properties[clave]+'<br />';
			  //console.log(feature.properties[clave].toUpperCase());
			}
			layer.bindPopup(popup);
		 }
	
	
	
	// $.getJSON("./assets/GCC_ZONE.geojson",function(data){
	// 	// add GeoJSON layer to the map once the file is loaded
	// 	zone=L.geoJson(
	// 	data,
	// 	{style: zoneStyle_new,
	// 	onEachFeature: onEachFeature,
	// 	 }
	// 	).addTo(map);
	// 	map.fitBounds(zone.getBounds());
	// 	lctrl.addOverlay(zone, "<span style='color:red;'>New Zone </span>");
		
	// });
	
	$.getJSON("./assets/GCC_ZONE2.geojson",function(data){
		// add GeoJSON layer to the map once the file is loaded
		zone=L.geoJson(
		data,
		{style: zoneStyle,
		onEachFeature: onEachFeature,
		 }
		).addTo(map);
		map.fitBounds(zone.getBounds());
		lctrl.addOverlay(zone, "<span style='color:green;'>Exist Zone</span>");
		
	});
	
	// $.getJSON("./assets/GCC_DIVISION.geojson",function(data){
	// 	// add GeoJSON layer to the map once the file is loaded
	//   division=L.geoJson(
	// 	data,
	// 	{style: divStyle,
	// 	onEachFeature: onEachFeature,
	// 	 }
	// 	).addTo(map);
	// 	lctrl.addOverlay(division, "<span style='color:blue;'>Exist Division </span> ");
	// });
								   

	// $.getJSON("./assets/GCC_DIVISION.geojson",function(data){
	// 	// add GeoJSON layer to the map once the file is loaded
	//   division=L.geoJson(
	// 	data,
	// 	{style: divStyle_new,
	// 	onEachFeature: onEachFeature,
	// 	 }
	// 	).addTo(map);
	// 	lctrl.addOverlay(division, "<span style='color:#CC00CC;'>New Division</span> ");
	// });
		
	
	
				function onBtClick()
				{
				//alert("H");
					
					var marker = L.marker([13.0827, 80.2707]);
					 //marker.bindPopup('Zone : MANALI , Div : 22,\r\n Puzhal UPHC Gandhi Main Road,Puzhal,Ch-66.').openPopup();
					marker.addTo(map);
					map.flyTo([ 13.0827, 80.2707], 15);


				}
				
				
				
				setTimeout(onBtClick, 1000);
        </script>
		
    </body>
</html>
