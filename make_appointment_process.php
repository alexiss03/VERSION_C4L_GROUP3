<?php
session_start();
include"session_check.php";
$username = $_SESSION['Username'];

	// alter this as per your configuration
	$doctor = $_POST['doctor'];
	$host = "localhost";
	$user = "postgres";
	$pass = "cmsc128";
	$db = "UHS_Information_Management_System";
	// open a connection to the database server
	$connection = pg_connect("host=$host port=5432 dbname=$db user=$user password=$pass");
	if (!$connection) die("Could not open connection to database server");
	
	$query = "UPDATE doctor_schedule SET taken='f' WHERE patient='$username' AND username='$doctor'"; 
	//$query = "UPDATE doctor_specialization SET specialization='$specialization' WHERE username='$username' "; 
	$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
	$query = "COMMIT";
	$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
	
	$query = "UPDATE doctor_schedule SET patient=NULL WHERE patient='$username' AND username='$doctor'"; 
	//$query = "UPDATE doctor_specialization SET specialization='$specialization' WHERE username='$username' "; 
	$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
	$query = "COMMIT";
	$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
	
	foreach($_POST['Schedule'] as $schedule) {
			$query = "UPDATE doctor_schedule SET taken='t' WHERE username='$doctor' AND grid='$schedule'"; 
			$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
			$query = "COMMIT";
			$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
			
			$query = "UPDATE doctor_schedule SET patient='$username' WHERE username='$doctor' AND grid='$schedule'"; 
			$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
			$query = "COMMIT";
			$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
	}
	
	header('Location:make_appointment.php');

?>