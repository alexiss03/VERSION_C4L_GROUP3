<?php
  session_start();
  include"session_check.php";
  include"menubar.php";
  if($_SESSION['Role']=='admin')
    $username = $_GET['username'];
  else if($_SESSION['Role']=='doctor')
    $username = $_SESSION['Username'];  
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
  $query = "SELECT * FROM doctor WHERE username = '".$username."';";
  $querySpecialization = "SELECT count(*) FROM doctor_specialization  WHERE username= '".$username."';";
  $querySchedule = "SELECT count(*) FROM doctor_schedule  WHERE username= '".$username."';";
  $result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
  $resultSpecialization = pg_query($connection, $querySpecialization) or die("Error in query: $query." . pg_last_error($connection));
  $resultSchedule = pg_query($connection, $querySchedule) or die("Error in query: $query." . pg_last_error($connection));
  $row = pg_fetch_object($result, 0);
  $row3 = pg_fetch_array($resultSpecialization);
  $row4 = pg_fetch_array($resultSchedule);
  if($row3[0]!=0)
  {
    $n=0;
    $stmt="SELECT * FROM  doctor_specialization WHERE username= '".$username."';";
    $result=pg_query($stmt);
    while ($rows=pg_fetch_assoc($result))
      $array[$n++] =  $rows['specialization'];
    //return $array;
    
  }
  if($row4[0]!=0){
    $o=0;
    $stmt="SELECT * FROM  doctor_schedule WHERE username= '".$username."';";
    $result=pg_query($stmt);
    while ($rows=pg_fetch_assoc($result)){
      $array3[$o] = $rows['taken'];
      $array2[$o++] =  $rows['grid'];
    }
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
<script type="text/javascript">
      function disableTextBox{
          document.getElementById("usernameDoctor").disabled=true;
      }
    </script>
  </head>
  <body>

    
    <!-- Start: MAIN CONTENT -->
    <div class="content">
      <div class="container">
        <div class="article">
          <div class="header">
            <h1>Edit Doctor</h1>
          </div>
          <div class="row-fluid">
            <form name="editDoctor" action="edit_doctor_process.php" method="post" enctype="multipart/form-data" id="editDoctor">
    <div id="leftable">
      <table border="1">
        <?php if($_SESSION['Role']=='admin'){
        echo"
        <tr>
          <td><label>Username:</label></td>
          <td><input type='label' name='Doctor' placeholder='New Name' disabled='disabled' required='required' value='$row->username'/></td>
          <input type='hidden' name='usernameDoctor' value='$row->username'>
        </tr>
        
        <tr>
          <td><label>Name:</label></td>
          <td><input type='text' name='nameDoctor' placeholder='New Name' required='required' value='$row->name' /></td>
        </tr>

        <tr>
          <td><label>Contact Number</label></td>
          <td><input type='text' name='contactNumberDoctor' placeholder='New Gender' required='required' value='$row->contact_number' /></td>
        </tr>   
        
        <tr>
          <td><label>Email Address:</label></td>
          <td><input type='email' name='emailAddressDoctor' required='required' value='$row->email' /></td>
        </tr>
        <tr>
          <td>
            Specialization:
          </td>
          <td>";
            
              $array_specialization = array('Anaesthetics','Pathology', 'Cardiology', 'Endocrinology', 'Gynaecology','Microbiology','Nephrology',
              'Neurosurgery', 'Oncology','Ophthalmology','Pediatrics','Psychiatry','Plastic surgery','Radiology','Rheumatology', 'Other');
              for($i=0; $i<sizeof($array_specialization); $i++){
                if(search($array_specialization[$i], $n, $array)!=-1) 
                  echo "<input type='checkbox' name='Specialization[]' value='$array_specialization[$i]' checked='true'>".$array_specialization[$i]."<br>";
                else 
                  echo "<input type='checkbox' name='Specialization[]' value='$array_specialization[$i]'>".$array_specialization[$i]."<br>";
              }
                
          
            
        echo"
          </td>
        </tr>";
        }
        ?>
        <?php
        echo "<tr>
        <td></td>
        <td>Monday</td>
        <td>Tuesday</td>
        <td>Wednesday</td>
        <td>Thursday</td>
        <td>Friday</td>
        </tr>";
        for($i=0; $i<12 ;$i++){
          echo "<tr><td>".returnTime($i)."</td>";
          
          for($j=0;$j<5;$j++){
            $k=search($i.",".$j, $o, $array2);
            if($k!=-1){
              if($array3[$k]=='t'){
                echo"
                <td>
                  <input type='checkbox' checked='true' disabled='disabled' name='Schedule[]' value='".$i.",".$j."'>
                </td>";
              }
              else{
                echo"
                <td>
                  <input type='checkbox' checked='true' name='Schedule[]' value='".$i.",".$j."'>
                </td>";
              
              }
            }
            else{
              echo"
              <td>
                <input type='checkbox' name='Schedule[]' value='".$i.",".$j."'>
              </td>";
            }
          }
          echo "</tr>";
        }?>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td><input type="submit"  value="Edit Details" name="confirmEdit" style="height: 30px; width: 165px"/></td>
        </tr>
  
      </table>
    </div>
    
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
      if($value == $array[$i])
        return $i;
    }
    return -1;
  }
  
?>


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