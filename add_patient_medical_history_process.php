<?php
include"session_check.php";	
	$username = $_POST['Username'];
	$height= $_POST['Height'];
	$weight = $_POST['Weight'];
	$presenthealth = $_POST['PresentHealth'];
	$nonprescription = $_POST['NonPrescription'];
	$prescription = $_POST['Prescription'];
	$recreational = $_POST['Recreational'];
	$carephysician = $_POST['CarePhysician'];
	
	// alter this as per your configuration
	$host = "localhost";
	$user = "postgres";
	$pass = "cmsc128";
	$db = "UHS_Information_Management_System";
	// open a connection to the database server
	$connection = pg_connect("host=$host port=5432 dbname=$db user=$user password=$pass");
	if (!$connection) die("Could not open connection to database server");
		
	$query = "BEGIN WORK";
	$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));

	
	$query = "UPDATE patient SET height='$height', weight='$weight', present_health='$presenthealth', nonprescription='$nonprescription', prescription='$prescription', recreational='$recreational', care_physician='$carephysician' WHERE username='$username' "; 
	$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
	$query = "COMMIT";
	$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
	
	foreach($_POST['Illness'] as $illness) {
			$query = "INSERT INTO patient_family_illness(username,illness) VALUES('$_POST[Username]','$illness')";
			$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
			$query = "COMMIT";
			$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
		}
	
	$query = "COMMIT";
	$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
	pg_close($connection);
	header('Location:add_patient.php');



?>
