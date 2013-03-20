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
	if(form_checker()){
	$password = md5($_POST['Password']);
		$query = "INSERT INTO doctor (username,name,password,email,contact_number) VALUES('$_POST[Username]','$_POST[Name]','$password','$_POST[Email_address]','$_POST[Contact_number]')";
		$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
		$query = "COMMIT";
		$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));

		
		foreach($_POST['Specialization'] as $special) {
			if($special!='Other'){
				$query = "INSERT INTO doctor_specialization(username,specialization) VALUES('$_POST[Username]','$special')";
				$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
				$query = "COMMIT";
				$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
			}
			else{
				$others= "Others".$_POST[Others];
				$query = "INSERT INTO doctor_specialization(username,specialization) VALUES('$_POST[Username]','$others')";
				$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
				$query = "COMMIT";
				$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
			}
		}
		$_SESSION['Doctor']=$_POST['Username'];
		pg_close($connection);
		header('Location:add_doctor_schedule.php');
	}
	else{
		
		header('Location:add_doctor.php');
	}
	
?>
<html>
<body>
</body>
</html>

<?php

function form_checker(){
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
	$counter=0;
	$query = "SELECT count(*) FROM doctor WHERE username= '".$_POST['Username']."';";
	$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
	$row3 = pg_fetch_array($result);
	
	if($row3[0]!=0)
	{
		$_SESSION['username_duplicate_error']=1;
		$counter++;
	}



	;
	$_SESSION['name_refill']=$_POST['Name'];
	$_SESSION['password_refill']= $_POST['Password'];
	$_SESSION['username_refill']= $_POST['Username'];
	$_SESSION['contact_number_refill']=$_POST['Contact_number'];
	$_SESSION['email_refill']=$_POST['Email_address'];
	
	if(strlen($_POST['Username'])<6){
		$_SESSION['username_error']=1;
		$counter++;
	}
	if(strlen($_POST['Password'])<6){
		$_SESSION['password_error']=1;
		$counter++;
	}
	if(!ctype_alpha(str_replace(' ', '', $_POST['Name']))){
		$_SESSION['name_error']=1;
		$counter++;
	}
	if(count($_POST['Specialization'])==0){
		$_SESSION['specialization_error']=1;
		$counter++;
	}
	
	if(!ctype_digit($_POST['Contact_number']) || strlen($_POST['Contact_number'])!=11 ){
		$_SESSION['contact_number_error']=1;
		$counter++;
	}
	
	if($counter!=0){ 
		$_SESSION['error']=1;
		return false;
	}
	else {
		unset($_SESSION['name_refill']);
		unset($_SESSION['password_refill']);
		unset($_SESSION['username_refill']);
		unset($_SESSION['contact_number_refill']);
		unset($_SESSION['email_refill']);
		return true;
	}
}

?>

