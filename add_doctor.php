<?php
  session_start();
  include"session_check.php";
  include"menubar.php";
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
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>UHS Information Management system</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/font-awesome-ie7.css" rel="stylesheet">
    <link href="css/boot-business.css" rel="stylesheet">

      <style type='text/css'>
      #error{
        color:red;
        font-size:14px;
      }
    </style>
  </head>
  <body>

    <script type="text/javascript">
  function enable_other(){
    if(document.getElementById('Others').disabled==1)
      document.getElementById('Others').disabled=0; 
    else{
      document.getElementById('Others').value="";
      document.getElementById('Others').disabled=1;
      }
    return;
  }
</script>
   
    <!-- Start: MAIN CONTENT -->
    <div class="content">
      <div class="container">
        <div class="article">
          <div class="header">
            <h1>Add Doctor</h1>
          </div>
          <div class="row-fluid">
          	<div class="span6">
            <form action="add_doctor_process.php" method="post" name='form1'>
			  <table class="table table-hover">
			    <tr>
			      <td>
			        Desired Username: 
			      </td>
			      <td>
			        
			        <?php 
			          if(isset($_SESSION['error'])){
			            echo "<input type='text' class='span3' name='Username' required='required' value=$_SESSION[username_refill]>";
			            if(isset($_SESSION['username_error']))
			              echo "<div id='error'>Username too short. Minimum of 6 characters</div>";
			            if(isset($_SESSION['username_duplicate_error'])){
			              echo "<div id='error'>Username already exists</div>";
			            }
			          } 
			          else 
			          {
			            echo "<input type='text' name='Username' required='required'>";
			          }
			        ?>
			        
			      </td>
			    </tr>
			    <tr>
			      <td>
			        Password:
			      </td>
			      <td>
			          <?php
			            if(isset($_SESSION['error'])){
			              echo "<input type='password' name='Password' required='required' value=$_SESSION[password_refill]>";
			              if(isset($_SESSION['password_error'])){
			                if(isset($_SESSION['password_error'])) echo "<div id='error'>Password too short. Minimum of 6 characters</div>";
			              }
			            } 
			            else{
			              echo "<input type='password' name='Password' required='required'>";
			            }
			          ?>

			      </td>
			    </tr>
			    <tr>
			      <td>
			        Full Name:
			      </td>
			      <td>
			        <?php 
			          if(isset($_SESSION['error'])){
			            
			            echo "<input type='text' name='Name' placeholder='FN MI LN' required='required'>";
			            if(isset($_SESSION['name_error'])){
			              echo "<div id='error'>Letters and spaces only allowed</div>";
			            }
			          } 
			          else{
			            echo "<input type='text' name='Name' required='required'>";
			          }
			        ?>
			        
			        
			      </td>
			    </tr>
			    <tr>
			      <td>
			        Specialization:
			      </td>
			      <td>
			        
			        <input type="checkbox" id="Specialization" name="Specialization[]" value="Anaesthetics" > Anaesthetics<br>
			        <input type="checkbox" id="Specialization" name="Specialization[]" value="Cardiology" > Cardiology<br>
			        <input type="checkbox" id="Specialization" name="Specialization[]" value="Endocrinology" > Endocrinology<br>
			        <input type="checkbox" id="Specialization" name="Specialization[]" value="Gynaecology" > Gynaecology<br>
			        <input type="checkbox" id="Specialization" name="Specialization[]" value="Microbiology" > Microbiology<br>
			        <input type="checkbox" id="Specialization" name="Specialization[]" value="Nephrology" > Nephrology<br>
			        <input type="checkbox" id="Specialization" name="Specialization[]" value="Neurosurgery" > Neurosurgery<br>
			        <input type="checkbox" id="Specialization" name="Specialization[]" value="Oncology" > Oncology<br>
			        <input type="checkbox" id="Specialization" name="Specialization[]" value="Ophthalmology" > Ophthalmology<br>
			        <input type="checkbox" id="Specialization" name="Specialization[]" value="Pathology" > Pathology<br>
			        <input type="checkbox" id="Specialization" name="Specialization[]" value="Pediatrics" > Pediatrics<br>
			        <input type="checkbox" id="Specialization" name="Specialization[]" value="Plastic surgery" > Plastic surgery<br>
			        <input type="checkbox" id="Specialization" name="Specialization[]" value="Psychiatry" > Psychiatry<br>
			        <input type="checkbox" id="Specialization" name="Specialization[]" value="Radiology" > Radiology<br>
			        <input type="checkbox" id="Specialization" name="Specialization[]" value="Rheumatology" > Rheumatology<br>
			        <input type="checkbox" id="Specialization" name="Specialization[]" value="Other" onclick="return enable_other();"> Other  <input type='text' name ="Others" id="Others" disabled='disabled' ><br>
			      
			        <?php 
			          if(isset($_SESSION['specialization_error'])){
			            echo "<div id='error'>Choose at least one specialization</div>";
			          } 
			        ?>
			      </td>
			    </tr>
			    <tr>
			      <td>
			        Contact Number:
			      </td>
			      <td>
			        <?php 
			          if(isset($_SESSION['error'])){
			            echo "<input type='text' name='Contact_number'  required='required' value=$_SESSION[contact_number_refill]>";
			            if(isset($_SESSION['contact_number_error'])){
			              echo "<div id='error'>Wrong contact number format</div>";
			            }
			          } 
			          else{
			            echo "<input type='text' name='Contact_number' required='required'>";
			          }
			        ?>
			        
			        
			        
			      </td>
			    </tr>
			    <tr>
			      <td>
			        E-mail Address:
			      </td>
			      <td>
			        <?php 
			          if(isset($_SESSION['error'])){
			            echo "<input type='email' name='Email_address' required='required' value=$_SESSION[email_refill]>";
			          } 
			          else{
			            echo "<input type='email' name='Email_address' required='required'>";
			          }
			        ?>      
			        
			      </td>
			    </tr>
			    <tr>
			      <td colspan='2'>
			        <!--<input type="submit"value='Next' onclick="return validateForm();">-->
			        <input type="submit" value='Next' class="btn">
			      </td>
			      <td>
			      </td>
			    </tr>
			  </table>
			</form>
		</div>
          </div>
        </div>
      </div>
    </div>
    <!-- End: MAIN CONTENT -->
    <!-- Start: FOOTER -->
    <footer>
      <div class="container">
        <div class="row">
        
        </div>
      </div>
      <hr class="footer-divider">
      <div class="container">
        <p>
          &copy; 2013 | University Health Service Information Management System | All Rights Reserved.
        </p>
      </div>
    </footer>
    <!-- End: FOOTER -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/boot-business.js"></script>
  </body>
</html>


<?php
  unset($_SESSION['username_duplicate_error']);
  unset($_SESSION['error']);
  unset($_SESSION['username_error']);
  unset($_SESSION['username_refill']);
  unset($_SESSION['password_error']);
  unset($_SESSION['password_refill']);
  unset($_SESSION['name_error']);
  unset($_SESSION['name_refill']);
  unset($_SESSION['specialization_error']);
  unset($_SESSION['contact_number_refill']);
  unset($_SESSION['contact_number_error']);
  unset($_SESSION['email_refill']);
?>
