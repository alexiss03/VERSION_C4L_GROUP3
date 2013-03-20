<?php
	session_start();
	
	if(isset($_SESSION['Username']))
			header('Location:home.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>UHS Information Management system</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap responsive -->
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/font-awesome-ie7.css" rel="stylesheet">
    <!-- Bootbusiness theme -->
    <link href="css/boot-business.css" rel="stylesheet">
	
	 <style type='text/css'>
			#error{
				color:red;
				font-size:16px;
			}
		</style>
  </head>
  <body>
		<?php
		$db=pg_connect("host=localhost port=5432 dbname=UHS_Information_Management_System user=postgres password=cmsc128");
		?>
    <!-- Start: HEADER -->
    <header>
      <!-- Start: Navigation wrapper -->
      <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container">
            <a href="index.html" class="brand brand-bootbus">UHS Information Management System</a>
            <!-- Below button used for responsive navigation -->
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!-- Start: Primary navigation -->
            <div class="nav-collapse collapse">        
              <ul class="nav pull-right">
                <li><a href="index.php">HOME</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="developers.php">DEVELOPER</a></li>
                <li><a href="login.php">LOGIN</a></li>

              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- End: Navigation wrapper -->   
    </header>
    <!-- End: HEADER -->
    <!-- Start: MAIN CONTENT -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="span6 offset3"><br><br><br><br>
            <h4 class="widget-header"><i class="icon-lock"></i> Log in to access the system!</h4>
            <div class="widget-body">
              <div class="center-align">
			  <?php if(!isset($_SESSION['Username'])){
		echo"
		<div id='menu'>
		</div>
		<div id='log-in'>
			<form name='log-in' method='post' action='loginvalidation.php' class='form-horizontal form-signin-signup'>
				
         <input type='text' name='Username' placeholder='Username'>
				 <input type='password' name='Password' placeholder='Password'><br>
						";
			if(isset($_SESSION['login_error'])){
					echo" Username and password do not match! " ;
			}			
		echo"
						<br><br><input type='submit' value='Log In' class='btn btn-primary btn-large'><br>
			</form>
			
		
	
		</div>

		<div id='menu1'>
		</div>";
		}
		else{
			echo "<div id='log-in'><h2><p>Hello ".$_SESSION['Username']."!"."</p><a href='logout.php'>Logout</a></h2></div>";
		}
		?>
               

            </div>
          </div>
        </div>
      </div>
    </div>
     <br> <br> <br> <br> <br> <br><br><br>
    <!-- End: MAIN CONTENT -->
    <!-- Start: FOOTER -->
    <footer>
      <div class="container">
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
	unset($_SESSION['login_error']);
?>