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

 $input = filter_input_array(INPUT_POST);

 $permit='';

 if($input['action'] == 'edit')
 {
    $permit.="approval='".$input['approval']."'";
    // $con->query()
    $query1 = "UPDATE cindex SET $permit WHERE id = '".$input["id"]."'";
    mysqli_query($con,$query1) or die ("database error:". mysqli_error($con));
 }

 if($input["action"] === 'delete')
{
 $query = "
 DELETE FROM cindex 
 WHERE id = '".$input["id"]."'
 ";
 mysqli_query($con, $query);
}

echo json_encode($input);

?>



