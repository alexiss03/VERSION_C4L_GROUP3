<?php //views all he database contents
  // database access parameters
  // alter this as per your configuration
  session_start();
  include"session_check.php";
  include"menubar.php";
  if(isset($_SESSION['Username'])){
  $_SESSION['module']='view';
  $host = "localhost";
  $user = "postgres";
  $pass = "cmsc128";
  $db = "UHS_Information_Management_System";
  // open a connection to the database server
  $connection = pg_connect("host=localhost port=5432 dbname=UHS_Information_Management_System user=postgres password=cmsc128");
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

  </head>
  <body>

    <!-- Start: MAIN CONTENT -->
    <div class="content">
      <div class="container">
        <div class="article">
          <div class="header">
            <h1>List of Appointments</h1>
          </div>
          <div class="row-fluid">
            <?php
            $query = "SELECT * FROM doctor_schedule where taken='t'";
            $result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
            $rows = pg_num_rows($result); // get the number of rows in the resultset
            
            
            if ($rows > 0){
              echo "<center><table class='table' cellpadding=5 cellspacing=0>
              
              <tr>  
                <th></th>
                
              </tr>
              ";
                  for ($i=0; $i<$rows; $i++){
                    $row = pg_fetch_object($result, $i);
                    
                  echo"

                  <tr>
                      <td>$row->patient has made an appointment with $row->username at ". returnDate($row->grid)."</td>
                      
                  
            
                  </tr>";
                  }
                  
                  
          echo"</table></center><br><br><br>";
            }
            else echo "<br><br><center>No result found!</center><br><br><br>";
            unset($_SESSION['searchpatient']);
            
            
            
            
            ?>
            

        <?php

        }
        else{
          echo "Not logged in!";
        }
        ?>
          </div>
        </div>
      </div><br><br><br>
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

        function returnDate($character){
                //function returnDate which returns the date and time of a specified coordinate
        $pairs = explode(',', $character);
         
        $char1 = $pairs[1];
        $char2 = $pairs[0];
          switch($char1){
          case 0: $output = "Monday ". returnTime($char2);
              break;
          case 1: $output = "Tuesday ". returnTime($char2);
              break;
          case 2: $output = "Wednesday ". returnTime($char2);
              break;
          case 3: $output = "Thursday ". returnTime($char2);
              break;
          case 4: $output = "Friday ". returnTime($char2);
              break;
          case 5: $output = "Saturday ". returnTime($char2);
              break;
          case 6: $output = "Sunday ". returnTime($char2);
              break; 
          }
          return $output;
        }

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
