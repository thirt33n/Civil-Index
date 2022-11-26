<?php
session_start();
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

$username= $con->real_escape_string($_SESSION['name']);
//create a triggr:
//CREATE OR REPLACE TRIGGER mySQLTRIGGER1 BEFORE INSERT ON cindex FOR EACH ROW SET NEW.indexer = New.area/100;

if ($stmt = $con->prepare('INSERT INTO cindex (area,counter,floor,locality,user) VALUES (?, ?, ?, ?, ?)')) {
    $stmt->bind_param('sssss', $_POST['area'], $_POST['counter'], $_POST['floor'], $_POST['locality'],$username);
    $stmt->execute();
    echo "Data Successfuly stored";
    header("refresh:3;url=home.php"); //BUild a new page and redrect it to home.php
   
}
else{
    echo "Could not store data! Try later!";
}
$stmt->close();
$con->close();

?>