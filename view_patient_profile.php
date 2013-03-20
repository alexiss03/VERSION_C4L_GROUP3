<?php
  session_start();
  include"session_check.php";
  include"menubar.php";
  $username = $_GET['username'];
  
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
  // generate and execute a query
  $query = "SELECT * FROM patient WHERE username = '".$username."';";
  $result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
  $row = pg_fetch_object($result, 0);
  
  $queryIllness = "SELECT count(*) FROM patient_family_illness  WHERE username= '".$username."';";
  $resultIllness = pg_query($connection, $queryIllness) or die("Error in query: $query." . pg_last_error($connection));
  $row3 = pg_fetch_array($resultIllness);
  
    if($row3[0]!=0)
  {
    $n=0;
    $stmt="SELECT * FROM  patient_family_illness WHERE username= '".$username."';";
    $result=pg_query($stmt);
    while ($rows=pg_fetch_assoc($result)){
      $array[$n++] =  $rows['illness'];
    }
    //return $array;
    
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
    <script type="label/javascript">
      function disablelabelBox{
          document.getElementById("usernamePatient").disabled=true;
      }
    </script>
    
  </head>
  <body>

   
    <!-- Start: MAIN CONTENT -->
    <div class="content">
      <div class="container">
        <div class="article">
          <div class="header">
            <h1>Patient's Information</h1>
          </div>
          <div class="row-fluid">
            <form name="editPatient" action="edit_patient_process.php" method="post" enctype="multipart/form-data" id="editPatient">
              <div class="span6">
              	<h3> Personal Information </h3>
                <table class="table table-hover">
                
                  <tr>
                    <td>
                    	Picture:
                    </td>
                    <td>
                      <img src="patients/<?php echo $row->photo?>" height="200" width="200px">
                    </td>
                    `
                  </tr>
                  
                  <tr>
                    <td><label>Username:</label></td>
                    <td><?php echo $row->username; ?></td>
                  </tr>
                  
                  <tr>
                    <td><label>Name:</label></td>
                    <td><?php echo $row->name; ?></td>
                  </tr>

                  <tr>
                    <td><label>Gender:</label></td>
                    <td><?php echo $row->gender; ?></td>
                  </tr>   
                  
                  <tr>
                    <td><label>Age:</label></td>
                    <td><?php echo $row->age; ?></td>
                  </tr>
                      
                  <tr>
                    <td><label>Address:</label></td>
                    <td><?php echo $row->address; ?></td>
                  </tr> 
                  
                  <tr>
                    <td><label>Contact Number:</label></td>
                    <td><?php echo $row->contact_number; ?></td>
                  </tr>
                    
                  <tr>
                    <td><label>Email Address:</label></td>
                    <td><?php echo $row->email; ?>
                  </tr>       
                </table>
                </div>
                
                <?php
                if($_SESSION['Role'] =='admin' || $username==$_SESSION['Username'] || $_SESSION['Role'] =='doctor'){
                echo"
                <div class='span6'>
                <table class='table table-hover'>
                  	<h3>Medical History</h3>
                  <tr>
                    <td>Height
                    </td>
                    <td>
                    $row->height cm
                    </td>
                  </tr>
                  <tr>
                    <td>Weight
                    </td>
                    <td>
                    $row->weight kgs
                    </td>
                  </tr>
                  <tr>
                    <td>Family Illness
                    </td>
                    <td>
                  ";
                      
                          $array_illness = array('Diabetes','HighBloodPressure','Stroke','HeartTrouble','Easy Bleeding','Jaundice','Alcoholism','Tuberculosis','Obesity','Gout','Asthma','PsychiatricIllness','Allergy','HighBloodFats','None');
                          for($i=0; $i<sizeof($array_illness); $i++){
                            $k = search($array_illness[$i], $n, $array);
                            if($k!=-1) {
                              echo "".$array_illness[$i]."<br>";
                              //echo "<input type='checkbox' disabled='disabled' name='Illness[]' value='$array_illness[$i]' checked='true'>".$array_illness[$i]."<br>";
                            }
                            //else 
                            //  echo "<input type='checkbox' disabled='disabled' name='Illness[]' value='$array_illness[$i]'>".$array_illness[$i]."<br>";
                          }
                        
                          
                    echo "
                    </td>
                  </tr>
                  <tr>
                    <td>Present Health
                    </td>
                    <td>
                      $row->present_health
                    </td>
                  </tr>
                  <tr>
                    <td>Taking non-prescription drugs routinely
                    </td>
                    <td>
                      $row->nonprescription
                    </td>
                  </tr>
                  <tr>
                    <td>Taking prescription drugs routinely
                    </td>
                    <td>
                      $row->prescription
                    </td>
                  </tr>
                  <tr>
                    <td>Taking recreational drugs
                    </td>
                    <td>
                      $row->recreational
                    </td>
                  </tr>
                  <tr>
                    <td>Under the care of a physician now
                    </td>
                    <td>
                      $row->care_physician
                    </td>
                  </tr>
                </table></div>";
                }
                ?>
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


<?php
  function search($value, $n, $array){
    for($i=0;$i<$n;$i++){
      if(strpos($array[$i],$value)!==false)
        return $i;
    }
    
    return -1;
  }
  
?>
