<?php
	session_start();
	include"session_check.php";
	$username = $_GET['username'];
	
	echo($username);	
	$host = "localhost";
	$user = "postgres";
	$pass = "cmsc128";
	$db = "UHS_Information_Management_System";
	// open a connection to the database server
	$connection = pg_connect("host=$host port=5432 dbname=$db user=$user password=$pass");
	if (!$connection)
	{
		die("Could not open connection to database server");
	}
	// generate and execute a query
	$querySpecialization = "DELETE FROM doctor_specialization  WHERE username= '".$username."';";
	$resultSpecialization = pg_query($connection, $querySpecialization) or die("Error in query: $query." . pg_last_error($connection));
	$query = "COMMIT";
	$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));

	$querySchedule = "DELETE FROM doctor_schedule  WHERE username= '".$username."';";
	$resultSchedule = pg_query($connection, $querySchedule) or die("Error in query: $query." . pg_last_error($connection));
	$query = "COMMIT";
	$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
	
	$query = "DELETE FROM doctor WHERE username = '".$username."';";
	$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
	$query = "COMMIT";
	$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));

	
	pg_close($connection);
	$_SESSION['success']=1;
	header('Location:delete_doctor_main.php');
?>
