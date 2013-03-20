<?php //views all he database contents
  // database access parameters
  // alter this as per your configuration
  session_start();
  include"session_check.php";
  include"menubar.php";

  if(isset($_SESSION['Username'])){
  $username = $_SESSION['Username'];
  $_SESSION['module']='makeappointment';
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
<script>
function cancel_appointment(){
  var r=confirm("Are you sure you want to cancel this appointment?");
  return r;
}

</script>
   
    <!-- Start: MAIN CONTENT -->
    <div class="content">
      <div class="container">
        <div class="article">
          <div class="header">
            <h1>Make Appointments</h1>
          </div>
          <div class="row-fluid">
          <div class="span5">

          	            <?php
    
    $querySchedule = "SELECT count(*) FROM doctor_schedule where patient='$username'";
    $resultSchedule = pg_query($connection, $querySchedule) or die("Error in query: $query." . pg_last_error($connection));
    $row4 = pg_fetch_array($resultSchedule);
    if($row4[0]!=0){
      $o=0;
      $stmt="SELECT * FROM  doctor_schedule WHERE patient= '".$username."';";
      $result=pg_query($stmt);
      while ($rows=pg_fetch_assoc($result)){
        $array[$o] = $rows['taken'];
        $array1[$o] = $rows['patient'];
        $array2[$o] =  $rows['grid'];
        $array3[$o++] = $rows['username'];
      }
    
      echo "<form method='post' action='make_appointment_process.php'><table border='2px' class='table table-striped'>
      <tr>
        <th>Monday</th>
        <th>Tuesday</th>
        <th>Wednesday</th>
        <th>Thursday</th>
        <th>Friday</th>
        </tr>";
        for($i=0; $i<12 ;$i++){
          echo "<tr>";
          for($j=0;$j<5;$j++){
            if(search($i.",".$j, $o, $array2)!=-1){
              $k = search($i.",".$j, $o, $array2);
              if($array[$k]=='f'){
                echo"
                  <td>
                    <input type='checkbox' name='Schedule[]' value='".$i.",".$j."'>
                  </td>";
                
              }
              else{
                if($array1[$k]==$username){
                  echo"
                    <td>
                      $array3[$k]<a href='cancel_appointment.php?doctor=$array3[$k]&grid=$array2[$k]' onclick='return cancel_appointment();' style='color:red;font-weight:bold;font-size:10px;'> X</a>
                    </td>";
                }
                else{
                  echo"
                  <td>
                    <input type='checkbox' name='Schedule[]' disabled='disabled' value='".$i.",".$j."'>".$i.$j."
                  </td>";
                }
              }
            }
            else
              echo"
              <td>
                
              </td>";
          }
          echo "</tr>";
        }
        echo "</table></form>";
    
      }
      else{
        echo "No appointment yet!<br>";
      }
    
    
    ?>
    </div>
	 <div class="span6">
 <h1>List of doctors</h1>
    <form action='search_doctor_results.php' method='post'>
      <input type='text' name='searchName' placeholder='Search' required='required'>
      <input type='submit'>
    </form>
    
    
    <?php
    if(isset($_SESSION['searchdoctor'])){
    $search_query = $_SESSION['searchdoctor'];
    $query = "SELECT * FROM doctor where username like '%$search_query%' OR lower(name) like '%$search_query%' OR name like '%$search_query%'";
    $result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
    $rows = pg_num_rows($result); // ge the number of rows in the resultset
    
    
    if ($rows > 0){
      echo "<center><table class='table'cellpadding=5 cellspacing=0>
      <h3>Results:</h3>
      <tr>  
        <th>Username</th>
        <th>Name</th>
        <th></th><th></th>
      </tr>
      ";
          for ($i=0; $i<$rows; $i++){
            $row = pg_fetch_object($result, $i);
            
          echo"

          <tr>
              <td>$row->username</td>
              <td>$row->name</td>
              <td><a href='view_doctor_profile.php?username=$row->username' submit='Submit' >View Profile</a></td>
              <td><a href='make_appointment_schedule.php?doctor=$row->username' submit='Submit' >Schedule appointment</a></td>
          
    
          </tr>";
          }
          
          
  echo"</table></center><br><br><br>";
    }
    else echo "<br><br><center>No result found!</center><br><br><br>";
    unset($_SESSION['searchdoctor']);
    }
    
    
    
    ?>

<?php

  // generate and execute a query
  $query = "SELECT * FROM doctor ORDER BY username";
  $result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
  $rows = pg_num_rows($result); // get the number of rows in the resultset
  
//  echo "There are currently $rows records in the database.";
  
  // if records present
  if ($rows > 0){
  // iterate through resultset

    echo "<center><table class='table'id='data' cellpadding=5cellspacing=0><tr>  
      <th>Username</th>
      <th>Name</th>
      <th></th>
      <th></th>
    </tr>";
    for ($i=0; $i<$rows; $i++){
      $row = pg_fetch_object($result, $i);
      
?>

<tr>
    <td><?php echo $row->username?></td>
    <td><?php echo $row->name?></td>
    <td><a href="view_doctor_profile.php?username=<?php echo $row->username;?>&submit=Submit" >View Profile</a></td>
    <td><a href="make_appointment_schedule.php?doctor=<?php echo $row->username;?>&submit=Submit" >Schedule appointment</a></td>
</tr>
<?php
    }
    
?></table></center>
<?php   
// if no records present
// display message
}
  else{
?>
  <font size="-1">No data available.</font>
<?php
  }
// close database connection
pg_close($connection);
}
else{
  echo "Not logged in!";
}
?>
</div>
          </div>
        </div>
      </div><br><br>
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
      if($value == $array[$i])
        return $i;
    }
    return -1;
  }
  
?>