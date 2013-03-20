<!DOCTYPE html>
<?php
	session_start();
	include"menubar.php";
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>UHS Information Management system</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/font-awesome-ie7.css" rel="stylesheet">
    <link href="css/boot-business.css" rel="stylesheet">

  </head>
  <body>


    <!-- Start: MAIN CONTENT -->
    <div class="content">
      <div class="container">
        <div class="article">
          <div class="header">
            <h1>Change Password</h1>
          </div>
          <div class="row-fluid">
             <?php
              
              include"session_check.php";
              if(isset($_GET['username']))
                $username = $_GET['username'];
              else
                $username = $_SESSION['error'];
              echo"<form method='post' action='change_password_patient_process.php'>
              <div class='span6'><table class='table'>
              <tr>
              	<td>Username: $username</td>
              	<td><input type='hidden' name='username' value=$username></td>
              </tr> 
              <tr>
              	<td>New Password:</td>
              	<td><input name='p1' type='password' required='required'></td>";
	              if(isset($_SESSION['password_error']))
	                echo "Password must be at least 6 characters";
	              else if(isset($_SESSION['password_match_error']))
	                echo "Passwords do not match";
	              echo"
	          </tr>
	          <tr>
	          	<td>Re-enter New Password:</td>
	          	<td><input name='p2' type='password' required='required'></tr>
	          </tr>
	          <tr>
					<td><input type='submit'></td>
					<td></td>
              </table>
              
              </form>
              </div>";
              unset($_SESSION['error']);
              unset($_SESSION['password_error']);
              unset($_SESSION['password_match_error']);
            ?>
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
