<?php
	session_start();
	include"session_check.php";
	if(isset($_POST['confirmEdit'])){
		echo "aaaaa";
	}
	$username = $_POST['usernamePatient'];
	$name = $_POST['namePatient'];
	$gender = $_POST['genderPatient'];
	$age = $_POST['agePatient'];
	$newAddress = $_POST['newAddressPatient'];
	$contactNumber = $_POST['contactNumberPatient'];
	$emailAdd = $_POST['emailAddressPatient'];
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
	if($_FILES["image"]["name"]!=NULL){
			$imagename = $_FILES["image"]["name"];
			$query = "UPDATE patient SET photo='$imagename' WHERE username='$username' "; 
			$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
			$query = "COMMIT";
			$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
			move_uploaded_file($_FILES["image"]["tmp_name"],
			"Patients/" . $_FILES["image"]["name"]);
	}
	
	
	$query = "UPDATE patient SET name='$name', gender='$gender', age='$age', medical_history='$medHistory', address='$newAddress', email='$emailAdd', contact_number='$contactNumber', weight='$weight', height='$height', present_health='$presenthealth', nonprescription='$nonprescription', prescription='$prescription', recreational='$recreational', care_physician='$carephysician' WHERE username='$username' "; 
	$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
	$query = "COMMIT";
	$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
	
	
	$query = "DELETE FROM patient_family_illness  WHERE username= '$username'";
	//$query = "UPDATE doctor_specialization SET specialization='$specialization' WHERE username='$username' "; 
	$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
	$query = "COMMIT";
	$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));

	foreach($_POST['Illness'] as $illness) {

			$query = "INSERT INTO patient_family_illness(username,illness) VALUES('$username','$illness')";
			$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
			$query = "COMMIT";
			$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
	}
	
	
	
	$query = "COMMIT";
	$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
	pg_close($connection);
	$_SESSION['success']=1;
	header('Location:edit_patient_main.php');



?>
