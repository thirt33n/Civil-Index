<?php
//db credentials
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'civilindex_db';
//connecting
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// Return error if connection is refused
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
	// Data couldnt be fethched
	exit('Please complete the registration form!');
}

if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
	// Empty values
	exit('Please complete the registration form');
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	exit('Email is not valid!');
}

if (strlen($_POST['password']) < 8) {
	exit('Password must be more than 8 characters long!');
}

// if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {		

	$username = mysqli_real_escape_string($con, $_POST['username']);
	$email = mysqli_real_escape_string($con, $_POST['email']);

	
	$rsUsers = mysqli_query($con,"SELECT id,password FROM accounts WHERE username = '".$username."'");
	$rsEmails = mysqli_query($con,"SELECT id,password FROM accounts WHERE email = '".$email."'");

	$numUsers = mysqli_num_rows($rsUsers);
	$numEmails = mysqli_num_rows($rsEmails);
	// Store the result so we can check if the account exists in the database.
	if ($numUsers > 0 || $numEmails > 0) {
		// Username already exists
		echo 'User already exists!';
		header("refresh:2;url=register.html");
		
	} else {
		if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {
            // Hash check
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);		//Hash function
            $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
            $stmt->execute();
            echo 'You have successfully registered, you can now login!';
			header("refresh:2;url=login.html");
	}
	$stmt->close();
    }
// else {
// 	// Incorrect SQL query
// 	echo 'Wrong SQL statement';
// }
$con->close();
?>