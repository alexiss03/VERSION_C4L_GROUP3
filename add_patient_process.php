<?php
session_start();
include"session_check.php";
$host = "localhost";
$user = "postgres";
$pass = "cmsc128";
$db = "UHS_Information_Management_System";
// open a connection to the database server

	if(form_checker()){
	$connection = pg_connect("host=$host port=5432 dbname=$db user=$user password=$pass");
	if (!$connection)
	{
		die("Could not open connection to database server");
	}
	
	$image=$_FILES["image"]["name"];
	 if ((($_FILES["image"]["type"] == "image/gif")
		|| ($_FILES["image"]["type"] == "image/jpeg")
		|| ($_FILES["image"]["type"] == "image/pjpeg")
		|| ($_FILES["image"]["type"] == "image/png"))
		&& ($_FILES["image"]["size"] > 0))
	 {
		  if ($_FILES["image"]["error"] > 0)
		  {
			   echo "Return Code: " . $_FILES["image"]["error"] . "<br/>";
		  }
		  if (file_exists("/patients/" . $_FILES["image"]["name"]))
		  {
			   $exist=1;
		  }
		  else
		  {
		  move_uploaded_file($_FILES["image"]["tmp_name"],
		  "Patients/" . $_FILES["image"]["name"]);
		  }
		  
	 }
	 else
	 {
	 echo "Invalid file";
	 }
	 $password = md5($_POST['Password']);
	
	$query = "INSERT INTO patient (username,name,password,gender,age,photo, email, contact_number, address) VALUES('$_POST[Username]','$_POST[Name]','$password','$_POST[Gender]','$_POST[Age]','$image','$_POST[Email_address]','$_POST[Contact_number]','$_POST[Address]')"; 
	$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
	$query = "COMMIT";
	$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
	
						
	                    
	

	
	pg_close($connection);
	$_SESSION['newaccount'] = $_POST['Username'];
	header('Location:add_patient_medical_history.php');
	}
	
	//
?>
<html>
<body>



</body>
</html>

<?php

function form_checker(){
	$counter=0;
	$_SESSION['username_refill'] = $_POST['Username'];
	$_SESSION['password_refill'] = $_POST['Password'];
	$_SESSION['name_refill'] = $_POST['Name'];
	$_SESSION['contact_number_refill'] = $_POST['Contact_number'];
	$_SESSION['address_refill'] = $_POST['Address'];
	$_SESSION['email_refill'] = $_POST['Email_address'];
	$_SESSION['photo_refill'] = $_FILES["image"];
	
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
	
	$query = "SELECT count(*) FROM patient  WHERE username= '".$_POST['Username']."';";
	$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
	$row3 = pg_fetch_array($result);
	
	if($row3[0]!=0)
	{
		$_SESSION['username_duplicate_error']=1;
		$counter++;
	}
	
	
	if(strlen($_POST['Username'])==10){
		$year = substr($_POST['Username'],0,4);
		$number = substr($_POST['Username'],5,10);
	}
	
	
	if(strlen($_POST['Username'])!=10 || !ctype_digit($year) || !ctype_digit($number) || $_POST['Username'][4]!='-'){
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
	
	if(!ctype_alpha(str_replace('#','',(str_replace('.','',(str_replace(',','',(str_replace(' ', '', $_POST['Address']))))))))){
		$_SESSION['address_error']=1;
		$counter++;
	}
	
	if(!ctype_digit($_POST['Contact_number']) || strlen($_POST['Contact_number'])!=11 ){
		$_SESSION['contact_number_error']=1;
		$counter++;
	}
	
	if($counter!=0){
		$_SESSION['error']=1;
		echo $_SESSION['username_refill'];
		header('Location:add_patient.php');
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