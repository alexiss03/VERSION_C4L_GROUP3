<?php
	session_start();
	include"session_check.php";
	if(isset($_SESSION['Username'])){
			$search_query = $_POST['searchName'];
			$_SESSION['searchpatient'] = $search_query;
			if(isset($_SESSION['module'])){
				if($_SESSION['module']=="edit") header('Location:edit_patient_main.php');
				if($_SESSION['module']=="delete") header('Location:delete_patient_main.php');
				if($_SESSION['module']=="view") header('Location:view_all_patients.php');
			}
			else{
				
			}
	}
	else{
		header('Location:login.php');
	}
	
	


