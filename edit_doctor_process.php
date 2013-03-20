<?php
	if(isset($_POST['confirmEdit'])){
		echo "aaaaa";
	}
	session_start();
	include"session_check.php";
	
	if($_SESSION['Role']=='admin')
		$username = $_POST['usernameDoctor'];
	else if($_SESSION['Role']=='doctor')
		$username = $_SESSION['Username'];
	$name = $_POST['nameDoctor'];
	echo $name;
	$contactNumber = $_POST['contactNumberDoctor'];
	$emailAdd = $_POST['emailAddressDoctor'];
	$specialization = $_POST['Specialization'];
	
	// alter this as per your configuration
	$host = "localhost";
	$user = "postgres";
	$pass = "cmsc128";
	$db = "UHS_Information_Management_System";
	// open a connection to the database server
	$connection = pg_connect("host=$host port=5432 dbname=$db user=$user password=$pass");
	if (!$connection) die("Could not open connection to database server");
		
	if($_SESSION['Role']=='admin'){
	
		$query = "BEGIN WORK";
		$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
		
		$query = "UPDATE doctor SET name='$name',contact_number='$contactNumber',email='$emailAdd' WHERE username='$username' "; 
		$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
		$query = "COMMIT";
		$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
		
		$query = "DELETE FROM doctor_specialization  WHERE username= '$username';";
		//$query = "UPDATE doctor_specialization SET specialization='$specialization' WHERE username='$username' "; 
		$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
		$query = "COMMIT";
		$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
		
		foreach($_POST['Specialization'] as $special) {
				$query = "INSERT INTO doctor_specialization(username,specialization) VALUES('$username','$special')";
				$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
				$query = "COMMIT";
				$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
		}
	}

	$query = "DELETE FROM doctor_schedule  WHERE username= '$username' AND taken= 'f'";
	//$query = "UPDATE doctor_specialization SET specialization='$specialization' WHERE username='$username' "; 
	$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
	$query = "COMMIT";
	$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));

	foreach($_POST['Schedule'] as $schedule) {

			$query = "INSERT INTO doctor_schedule(username,grid,taken) VALUES('$username','$schedule','false')";
			$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
			$query = "COMMIT";
			$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
	}
	
	$query = "COMMIT";
	$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
	pg_close($connection);
	$_SESSION['success']=1;
	if($_SESSION['Role']=='doctor'){
		$var = "Location:view_doctor_profile.php?username=$username";
		header($var);
		}
	else
		header('Location:edit_doctor_main.php');



?>
