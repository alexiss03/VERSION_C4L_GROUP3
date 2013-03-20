<?php
	
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
    
  </head>
  <body>
    <script type='text/javascript'>
      $(".alert").alert();
    </script>
   
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
            <h1>Add Doctor Schedule</h1>
          </div>
          <div class="row-fluid">
          	<div class="span6">
             <?php
              session_start();
              include"session_check.php";
              echo "<table border='2px' class='table table-hover'><form action='add_doctor_schedule_process.php' method='post' name='form2'>";
              echo "<tr>
              <td></td>
              <td width='9%'><center><strong>MON</strong></center></td>
              <td width='9%'><center><strong>TUES</strong></center></td>
              <td width='9%'><center><strong>WED</strong></center></td>
              <td width='9%'><center><strong>THURS</strong></center></td>
              <td width='9%'><center><strong>FRI</strong></center></td>
              </tr>";
              for($i=0; $i<12 ;$i++){
                echo "<tr><td width='3%' ><center><strong>".returnTime($i)."</strong></center></td>";
                  
                for($j=0;$j<5;$j++){
                  echo"
                  <td>
                    <center><input type='checkbox' id='Schedule' name='Schedule[]' value='".$i.",".$j."'></center>
                  </td>";
                }
                echo "</tr>";
              }
              echo"
              <tr>
                <td><input type='submit' onclick='return validateSchedule();'></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              </form></table>";
            ?>
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
  function returnTime($char2){          //function returnTime which is invoke within the function returnDate
    switch($char2){
      case 0: return "7-8";
          break;        
      case 1: return "8-9";
          break;        
      case 2:   return "9-10";
          break;        
      case 3:   return "10-11";
          break;        
      case 4:   return "11-12";
          break;        
      case 5:   return "12-1";
          break;        
      case 6:   return "1-2";
          break;        
      case 7:   return "2-3";
          break;        
      case 8:   return "3-4";
          break;        
      case 9:   return "4-5";
          break;        
      case 10:  return "5-6";
          break;        
      case 11:  return "6-7";
          break;        
      case 12:  return "7-8";
    }
  }
?>