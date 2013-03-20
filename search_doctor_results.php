<?php
	session_start();
	include"session_check.php";
	if(isset($_SESSION['Username'])){
			$search_query = $_POST['searchName'];
			$_SESSION['searchdoctor'] = $search_query;
			if(isset($_SESSION['module'])){
				if($_SESSION['module']=="edit"){ 
					header('Location:edit_doctor_main.php');
					
				}
				if($_SESSION['module']=="delete") header('Location:delete_doctor_main.php');
				if($_SESSION['module']=="view") header('Location:view_all_doctors.php');
				if($_SESSION['module']=="makeappointment") header('Location:make_appointment.php');
			}
			else{
			}
	}
	else{
		header('Location:login.php');
	}
	
	


