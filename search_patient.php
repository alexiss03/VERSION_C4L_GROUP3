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

  </head>
  <body>

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
                <li><a href="home.php">HOME</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">ADD<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="add_patient.php">Patient</a></li>
                    <li><a href="add_doctor.php">Doctor</a></li>
                  </ul>                  
                </li>
                 <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">EDIT<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="edit_patient.php">Patient</a></li>
                    <li><a href="edit_patient.php">Doctor</a></li>
                  </ul>                  
                </li>
                 <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">VIEW<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="view_all_patients.php">All Patient</a></li>
                    <li><a href="view_all_doctors.php">All Doctor</a></li>
                    <li><a href="view_all_appointments.php">All Appointment</a></li>
                  </ul>                  
                </li>
                 <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">DELETE<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="delete_patient.php">Patient</a></li>
                    <li><a href="delete_doctor.php">Doctor</a></li>
                  </ul>                  
                </li>
                <li><a href="logout.php">LOGOUT</a></li>
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
        <div class="article">
          <div class="header">
            <h1>Search Patient</h1>
          </div>
          <div class="row-fluid">
            <form action='search_patient_results.php' method='post'>
      <input type='text' name='searchName' placeholder='Search' required='required'>
      <input type='submit'>
    </form>
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
