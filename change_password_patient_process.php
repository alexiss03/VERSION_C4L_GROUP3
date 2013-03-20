<?php	//views all he database contents
	// database access parameters
	// alter this as per your configuration
	session_start();
	include"session_check.php";
	if(isset($_SESSION['Username'])){
	$_SESSION['module']='view';
	$host = "localhost";
	$user = "postgres";
	$pass = "cmsc128";
	$db = "UHS_Information_Management_System";
	// open a connection to the database server
	$connection = pg_connect("host=localhost port=5432 dbname=UHS_Information_Management_System user=postgres password=cmsc128");
	if (!$connection)
	{
	die("Could not open connection to database server");
	}
	$username = $_POST['username'];
	if(form_checker($username)){
	
	$password = md5($_POST['p1']);
	echo $_POST['p1'];
	echo $password;
	echo $username;
	$query = "UPDATE patient SET  password='$password' WHERE username='$username' "; 
	$result = pg_query($connection,$query) or die("Error in query: $query. " . pg_last_error($connection));
	$query = "COMMIT";
	$result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
	header('Location:change_password_patient.php');
	}
	}
	function form_checker($username){
		$counter=0;
		if(strlen($_POST['p1'])<6){
			$_SESSION['password_error']=1;
			$counter++;
		}
		else if($_POST['p2']!=$_POST['p1']){
			$_SESSION['password_match_error']=1;
			$counter++;
		}
		
		if($counter!=0){
			$_SESSION['error']=$username;
			header('Location:change_password_patient_proper.php');
		} 	
		else
			return true;
	}
	
?>


