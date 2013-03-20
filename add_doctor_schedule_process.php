<?php
session_start();
include"session_check.php";
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
		foreach($_POST['Schedule'] as $schedule) {
			$query = "INSERT INTO doctor_schedule(username,grid,taken) VALUES('$_SESSION[Doctor]','$schedule','false')";
			$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
			$query = "COMMIT";
			$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
		}
		unset($_SESSION['Doctor']);
		header('Location:add_doctor.php');

?>