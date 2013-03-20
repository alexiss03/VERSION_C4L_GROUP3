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
          font-size:10px;
        }
    </style>
  </head>
  <body>
    <script>
      function check_form(){`
        return validateForm();
      }
   </script>

    <div class="content">
      <div class="container">
        <div class="article">
          <div class="span7">
          <div class="header">
            <h1>Add Patient</h1>
          </div>
          <div class="row-fluid">
            <form action="add_patient_process.php" method="post" name='form1' id='form1' enctype='multipart/form-data'>
              <table class="table table-hover">
                <tr>
                  <td>
                    Photo
                  </td>
                  <td>
                  <?php
                    if(isset($_SESSION['error']))
                      echo "<input type='file' name='image' required='required' size='30' value=$_SESSION[photo_refill]>";
                    else
                      echo "<input type='file' name='image' required='required' size='30'>";
                  ?>
                  </td>
                </tr>
                <tr>
                  <td>
                    Desired Username:
                  </td>
                  <td>
                    <?php
                      if(isset($_SESSION['error'])){
                        echo "<input type='text' name='Username' required='required' value=$_SESSION[username_refill]>";
                        if(isset($_SESSION['username_error']))
                          echo "<div id='error'>Wrong username. Enter student number</div>";
                        else if(isset($_SESSION['username_duplicate_error']))
                        echo "<div id='error'>Username already exists</div>";
                      } 
                      else{
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
                    Gender:
                  </td>
                  <td>
                    <input type="radio" value="Male" name="Gender" required='required'> Male<br>
                    <input type="radio" value="Female" name="Gender" required='required'> Female <br><br>
                  </td>
                </tr>
                <tr>
                  <td>
                    Age:
                  </td>
                  <td>
                    <input type="number" name="Age" required='required' min='14' max='60' step='1' placeholder='14'>
                  </td>
                </tr>
                
                <tr>
                  <td>
                    Address:
                  </td>
                  <td>
                    <?php 
                    if(isset($_SESSION['error'])){
                        echo "<textarea rows='5' cols='20' name='Address' wrap='physical' required='required' value='$_SESSION[address_refill]'></textarea>";
                        if(isset($_SESSION['address_error'])){
                          echo "<div id='error'>Invalid characters in the address</div>";
                        }
                      } 
                      else{
                        echo "<textarea rows='5' cols='20' name='Address' wrap='physical' required='required'></textarea>";
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
                  <td colspan="2">
                    <input type="submit" onclick=" return validateForm();" value='Next'>
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
  unset($_SESSION['error']);
  unset($_SESSION['username_error']);
  unset($_SESSION['username_duplicate_error']);
  unset($_SESSION['username_refill']);
  unset($_SESSION['password_error']);
  unset($_SESSION['password_refill']);
  unset($_SESSION['name_error']);
  unset($_SESSION['name_refill']);
  unset($_SESSION['contact_number_refill']);
  unset($_SESSION['contact_number_error']);
  unset($_SESSION['address_refill']);
  unset($_SESSION['address_error']);
  unset($_SESSION['email_refill']);
?>