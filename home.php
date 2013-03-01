<?php
	session_start();
?>

<html>
	<head>
		<title>
			University of the  Philippines Health Service
		</title>
	</head>
	<body>
		<?php
		$db=pg_connect("host=localhost port=5432 dbname=UHS_Information_Management_System user=postgres password=cmsc128");
		?>
		<link rel='stylesheet' type='text/css' href='home.css'>
		<script type = "text/javascript" src = "javascripts/jquery.js"></script>
		<script type = "text/javascript" src= "javascripts/home.js"></script>
			<div id='box1'>
			HISTORY
			
			</div>
			<div id='box2'>
			NEWS
			</div>
			<div id='box3'>
			ABOUT
			</div>
		<?php if(!isset($_SESSION['Username'])){
		echo"
		<div id='log-in'>
			<form name='log-in' method='post' action='loginvalidation.php'>
				<table>
					<tr>
						<td>
							<label for='Username'>Username: hohoho </label>
						</td>
						<td>
							<input type='text' id='Username' name='Username' /></td>
						</td>
						<td colspan='2'>
						<input type='submit' value='Log-in' title='Log-in' name='Log-in'/>
						</td>
						
					</tr>
					<tr>
						<td>
							<label for='Password'>Password: </label>
						</td>
						<td>
							<input type='password' id='Password' name='Password' /></td>
						</td>
						<td>
						</td>
						
					</tr>
				</table>		
			</form>
		</div>";
		}
		else{
			echo "<div id='log-in'><h2><p>Hello ".$_SESSION['Username']."!"."</p><a href='logout.php'>Logout</a></h2></div>";
		}
		?>
		
		<div id='historydiv'>
		<p>
		History
		<p>The University Health Service is headed by the Medical Director, assisted by the Deputy Director, and the heads of each department.</p>

<p>Medical Director: Dr. Marilyn P. Reaño<br>
Deputy Director	:	Dr. Ma. Victoria Turalba<br><br>

The hospital functions are categorized into:<br><br>

1.MEDICAL – involves the treatment and management of patients<br>
Head	 :	Dr. Ma. Victoria Turalba<br>
Medical Staff	:	Dr. Marlina Almeda<br>
Dr. Jessie Imelda Foronda<br>
Dr. Ma. Teresa Pineda<br>
Dr. Teresita Tolentino (casual)<br>
Dr. Roland Lotoc (casual)<br><br>

2. ANCILLARY – rendering direct patient care<br>

a) Nursing Service<br>
Head Nurse	 :	Ms. Marlene Cachuela<br>
Nursing Staff	 :	14 nurses (4 casuals & 1 NGW), 2 midwives, 9 nursing attendants (1 casual & 1 NGW)<br><br>

b) Dietary<br>
Dietitian/Nutritionist	:	Ms. Normahita Gordoncillo<br>
Dietary Staff	 :	3 cooks, 1 utility worker<br><br>

c.) X-RAY<br>
Head Radiologic	Technologist	:	Mr. William Tanamor<br>
Staff	 :	1 registered Radiologic Technologist (casual)<br><br>

d) Pharmacy<br>
Head Pharmacist	 :	Ms. Corazon Andres<br>
Staff	 :	2 registered Pharmacists (1 casual)<br><br>

e) Laboratory<br>
Head Med Tech	 :	Ms. Lilia A. Soliven<br>
Staff	 :	2 registered Med Techs (1 casual)<br><br>

f) Dental<br>
Head Dentist	 :	Dr. Myla Avena<br>
Staff	 :	Dr. Noel Altamirano, 1 Dental Aide (NGW)<br><br>

3. ADMINISTRATIVE – concerns the execution of policies and support service in the area of finance, supply and property, housekeeping, laundry, transport and maintenance.<br><br>

Administrative Officer	:	Ms. Elena Llaguna<br>
Staff	 :	1 Record Officer<br>
2 Philhealth clerks<br>
1 Property Officer<br>
2 Ambulance drivers<br>
2 Laundry workers<br>
4 Utility workers<br>
(1 NGW)<br>
(1 casual, 1 NGW)<br>
</p>
		</p>
		</div>
		
		<div id='newsdiv'>
		<p>
		News
		</p>
		</div>
		
		<div id='aboutdiv'>
		<p>
		About
		</p>
		</div>

	</body>
</html>