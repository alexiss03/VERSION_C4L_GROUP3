<?php
	session_start();
	include"session_check.php";
	if(isset($_POST['Username'])){	
		$Username = $_POST['Username'];
		$Password = $_POST['Password'];
		$db=pg_connect("host=localhost port=5432 dbname=UHS_Information_Management_System user=postgres password=cmsc128");
		$stmt="SELECT * FROM admin WHERE Username='$Username' and Password='$Password';";
		$result = pg_query($stmt);
		if($row=pg_fetch_assoc($result)){
			$_SESSION['Username']=$_POST['Username'];
			$_SESSION['Role']='admin';
			header( 'Location: home.php' );
		}
		else{
			$Password = md5($Password);
			$stmt="SELECT * FROM patient WHERE Username='$Username' and Password='$Password';";
			$result = pg_query($stmt);
			if($row=pg_fetch_assoc($result)){
				$_SESSION['Username']=$_POST['Username'];
				$_SESSION['Role']='patient';
				header( 'Location: home.php' );
			}
			else{
				$stmt="SELECT * FROM doctor WHERE Username='$Username' and Password='$Password';";
				$result = pg_query($stmt);
				if($row=pg_fetch_assoc($result)){
					$_SESSION['Username']=$_POST['Username'];
					$_SESSION['Role']='doctor';
					header( 'Location: home.php' ) ;
				}
				else{
					$_SESSION['login_error']=1;
					header( 'Location: login.php' ) ;
				}
			}
		}
	}
	else{
		header( 'Location: login.php' ) ;
	}
	
?>