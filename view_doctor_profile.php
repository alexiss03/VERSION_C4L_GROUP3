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
  if (!$connection) die("Could not open connection to database server");

  $query = "SELECT * FROM doctor WHERE username = '".$username."';";
  $result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
  $row = pg_fetch_object($result, 0);
  
  $querySpecialization = "SELECT count(*) FROM doctor_specialization  WHERE username= '".$username."';";
  $resultSpecialization = pg_query($connection, $querySpecialization) or die("Error in query: $query." . pg_last_error($connection));
  $row3 = pg_fetch_array($resultSpecialization);
  
    if($row3[0]!=0)
  {
    $n=0;
    $stmt="SELECT * FROM  doctor_specialization WHERE username= '".$username."';";
    $result=pg_query($stmt);
    while ($rows=pg_fetch_assoc($result)){
      $array[$n++] =  $rows['specialization'];
    }
    //return $array;
    
  }
  
  $querySchedule = "SELECT count(*) FROM doctor_schedule  WHERE username= '".$username."';";
  $resultSchedule = pg_query($connection, $querySchedule) or die("Error in query: $query." . pg_last_error($connection));
  $row4 = pg_fetch_array($resultSchedule);
  if($row4[0]!=0){
    $o=0;
    $stmt="SELECT * FROM  doctor_schedule WHERE username= '".$username."';";
    $result=pg_query($stmt);
    while ($rows=pg_fetch_assoc($result)){
      $array2[$o] =  $rows['grid'];
      $array3[$o] = $rows['taken'];
      $array4[$o++] = $rows['patient'];
      
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

  </head>
  <body>

     
    <!-- Start: MAIN CONTENT -->
    <div class="content">
      <div class="container">
        <div class="article">
          <div class="header">
            <h1>Doctor's Information</h1>
          </div>
          <div class="row-fluid">
            <form name="viewDoctorsProfile" action="#" method="post" enctype="multipart/form-data" id="viewDoctorsProfile">
    		<div class="span6"><br>
    		<h3>Personal Information</h3>
    		<table class = "table table-hover">
			  <tr>
			  	<td>Username: </td>
			  	<td><?php echo $row->username; ?> </td>
			  </tr>
			  <tr>
			  	<td>Name: </td>
			  	<td><?php echo $row->name; ?> </td>
			  </tr> 
			  <tr>
			  	<td>Contact Number:</td>
			  	<td><?php echo $row->contact_number; ?></td>
			  </tr>
			  <tr>
			  	<td>Email Address: </td>
			  	<td><?php echo $row->email; ?> </td>
			  </tr>
          	  <tr>
          	  	<td>
            		Specialization:
          		</td>
				<td>
	            <?php 
	            
	                $array_specialization = array('Anaesthetics','Pathology', 'Cardiology', 'Endocrinology', 'Gynaecology','Microbiology','Nephrology',
	                'Neurosurgery', 'Oncology','Ophthalmology','Pediatrics','Psychiatry','Plastic surgery','Radiology','Rheumatology', 'Other');
	                for($i=0; $i<sizeof($array_specialization); $i++){
	                  $k = search($array_specialization[$i], $n, $array);
	                  if($k!=-1) {
	                    echo "".$array_specialization[$i]."<br>";
	                    //echo "<input type='checkbox' disabled='disabled' name='Specialization[]' value='$array_specialization[$i]' checked='true'>".$array_specialization[$i]."<br>";
	                    if($array_specialization[$i]=='Other'){
	                      $stri = $array[$k];
	                      echo substr($stri,6,strlen($stri));
	                      }
	                  }
	    
	                    //echo "<input type='checkbox' disabled='disabled' name='Specialization[]' value='$array_specialization[$i]'>".$array_specialization[$i]."<br>";
	                }
	              
	                
	            ?>
		      </td>
		     </table>
			</div>
			<div class="span5"><br>
          <?php if($_SESSION['Role']!='patient'){
        echo "<h3>Schedule</h3><table class='table table-hover'><tr>
        <td></td>
        <td>Monday</td>
        <td>Tuesday</td>
        <td>Wednesday</td>
        <td>Thursday</td>
        <td>Friday</td>
        </tr>";
        for($i=0; $i<12 ;$i++){
          echo "<tr><td><strong>".returnTime($i)."<strong></td>";
          for($j=0;$j<5;$j++){
            $k = search($i.",".$j, $o, $array2);
            if($_SESSION['Role']=='admin' || $_SESSION['Username']==$username){
              if($k!=-1){
                if($array3[$k]=='t'){
                  
                  echo"
                  <td>
                    <input type='checkbox' disabled='disabled' checked='true' name='Schedule[]' value='".$i.",".$j."'><a href='view_patient_profile.php?username=$array4[$k]'>".$array4[$k]."
                  </td>";
                  }
                else{
                  echo"
                  <td>
                    <input type='checkbox' disabled='disabled' checked='true' name='Schedule[]' value='".$i.",".$j."' style='background-color:red;'>
                  </td>";
                  
                  }
              }
              else{
                echo"
                <td>
                </td>";
              }
            }
            else{
              if($k!=-1){
                  echo"
                    <td>
                      <input type='checkbox' disabled='disabled' checked='true' name='Schedule[]' value='".$i.",".$j."' >
                    </td>";     
                }
              else{
                echo"
                <td>
                </td>";
              }
            }
          }
          echo "</tr>";
          }
        }?>
           </table>
       </div>
          
          
<?php
  function search($value, $n, $array){
    for($i=0;$i<$n;$i++){
      if(strpos($array[$i],$value)!==false)
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
