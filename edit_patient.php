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
    while ($rows=pg_fetch_assoc($result))
      $array[$n++] =  $rows['illness'];
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

  </head>
  <body>
  <style>
	input[type=number]{
		height:30px;
		
	}
  </style>
<script type="text/javascript">
  
    
      function enable_other(){
      var arr = document.getElementsByClassName("Illness");
      if(arr.length!=0){
        if(arr[0].disabled==0){
          for(i=0;i<arr.length-1;i++)
            arr[i].disabled=1;  
          }
        else{
          for(i=0;i<arr.length-1;i++)
            arr[i].disabled=0;  
          }
        return;
        }
      }
      
      function validate(){
        var arr = document.getElementsByClassName("Illness");
        for(i=0;i<arr.length;i++)
          if(arr[i].checked==1)
            return true;
        alert("Please check at least one on the Family Illness");
        return false;
        
      }
    </script>
   
    <!-- Start: MAIN CONTENT -->
    <div class="content">
      <div class="container">
        <div class="article">
          <div class="header">
            <h1>Edit Doctor</h1>
          </div>
          <div class="row-fluid">
            <form name="editPatient" action="edit_patient_process.php" method="post" enctype="multipart/form-data" id="editPatient">
    <div id="leftable">
      <table >
      
        <tr>
          <td><label>Photo:<img src='Patients/<?php echo $row->photo?>' style="height:200px;"></label></td>
          <td><input type='file' name='image' placeholder='New Photo'/></td>
        </tr>
        
        <tr>
          <td><label>Username:</label></td>
          <td><input type='text'  placeholder='New Name' required='required' disabled="disabled" value="<?php echo $row->username; ?>" id="usernamePatient" onclick="disableTextBox()"/></td>
          <input type='hidden' name="usernamePatient" value="<?php echo $row->username?>">
        </tr>
        
        <tr>
          <td><label>Name:</label></td>
          <td><input type='text' name='namePatient' placeholder='New Name' required='required' value="<?php echo $row->name; ?>"/></td>
        </tr>
        
        <tr>
          <td><label>Gender:</label></td>
          <td><input type='text' name='genderPatient' placeholder='New Gender' required='required' value="<?php echo $row->gender; ?>"/></td>
        </tr>   
        
        <tr>
          <td><label>Age:</label></td>
          <td><input type='number' min='0' max='80' name='agePatient' required='required' value="<?php echo $row->age; ?>"/></td>
        </tr>
            
        <tr>
          <td><label>New Address:</label></td>
          <td><input type='text' name='newAddressPatient' placeholder='New Address' required='required' value="<?php echo $row->address; ?>"/></td>
        </tr> 
        
        <tr>
          <td><label>Contact Number:</label></td>
          <td><input name='contactNumberPatient' required='required' value="<?php echo $row->contact_number; ?>"/></td>
        </tr>
          
        <tr>
          <td><label>Email Address:</label></td>
          <td><input type='email' name='emailAddressPatient' placeholder='New Email Address' required='required' value="<?php echo $row->email; ?>"/></td>
        </tr>       
        
        
  
      </table>
      
      <table>
        <tr>
          <td>
          </td>
        </tr>
        <tr>
        </tr>
        
        <tr>
          <td>
            Height(cm)
          </td>
          <td>
            <input type="number" id="Height" name="Height" required='required' value='<?php echo $row->height?>'>
          </td>
        </tr>
        <tr>
          <td>
            Weight(kg)
          </td>
          <td>
            <input type="number" id="Weight" name="Weight" required='required' value='<?php echo $row->weight?>'>
          </td>
        </tr>
        <tr>
          <td>
          Family Illness
          </td>
          <td>
          <?php
          $array_illness = array('Diabetes','HighBloodPressure','Stroke','HeartTrouble','Easy Bleeding','Jaundice','Alcoholism','Tuberculosis','Obesity','Gout','Asthma','PsychiatricIllness','Allergy','HighBloodFats','None');
                for($i=0; $i<sizeof($array_illness); $i++){
                  $k = search($array_illness[$i], $n, $array);
                  if($k!=-1) {
                    if($array_illness[$i] !="None" && search('None', $n, $array)!=-1){
                      echo "<input type='checkbox' class='Illness' name='Illness[]' value='$array_illness[$i]' checked='true'>".$array_illness[$i]."<br>";
                    }
                    else{
                      echo "<input type='checkbox' class='Illness' name='Illness[]' value='$array_illness[$i]' checked='true' onclick='enable_other();' onload='enable_other();'>".$array_illness[$i]."<br>";
                      }
                  }
                  else{
                    if($array_illness[$i] !="None" && search('None', $n, $array)==-1){
                      echo "<input type='checkbox' class='Illness' name='Illness[]' value='$array_illness[$i]'>".$array_illness[$i]."<br>";
                      
                    }
                    else if($array_illness[$i] !="None" && search('None', $n, $array)!=-1)
                      echo "<input type='checkbox' disabled='disabled' class='Illness' name='Illness[]' value='$array_illness[$i]'>".$array_illness[$i]."<br>";
                    else{
                      echo "<input type='checkbox' class='Illness' name='Illness[]' value='$array_illness[$i]' onclick='enable_other();' >".$array_illness[$i]."<br>";
    
                    }
                  }
                }
          ?>
          </td>
        </tr>
        
        <tr>
          <td>Your statement of Present Health
          </td>
          <td>
          <?php
            if($row->present_health=='Excellent')
              echo "<input type='radio' value='Excellent' name='PresentHealth' required='required' checked='checked'>Excellent<br>";
            else
              echo "<input type='radio' value='Excellent' name='PresentHealth' required='required'>Excellent<br>";
            
            if($row->present_health=='Good')
              echo "<input type='radio' value='Good' name='PresentHealth' required='required' checked='checked'>Good<br>";
            else
              echo "<input type='radio' value='Good' name='PresentHealth' required='required'>Good<br>";
            
            if($row->present_health=='Poor')
              echo "<input type='radio' value='Poor' name='PresentHealth' required='required' checked='checked'>Poor<br>";
            else
              echo "<input type='radio' value='Poor' name='PresentHealth' required='required'>Poor<br>";
          ?>
          </td>
        </tr>
        <tr>
          <td>Do you take non-prescription drugs routinely?
          </td>
          <td>
          <?php
            if($row->nonprescription=='Yes')
              echo "<input type='radio' value='Yes' name='NonPrescription' required='required' checked='checked'>Yes<br>";
            else
              echo "<input type='radio' value='Yes' name='NonPrescription' required='required'>Yes<br>";
            
            if($row->nonprescription=='No')
              echo "<input type='radio' value='No' name='NonPrescription' required='required' checked='checked'>No<br>";
            else
              echo "<input type='radio' value='No' name='NonPrescription' required='required'>No<br>";
          ?>
          </td>
        </tr>
        <tr>
          <td>Do you take prescription drugs routinely?
          </td>
          <td>
          <?php
            if($row->prescription=='Yes')
              echo "<input type='radio' value='Yes' name='Prescription' required='required' checked='checked'>Yes<br>";
            else
              echo "<input type='radio' value='Yes' name='Prescription' required='required'>Yes<br>";
            
            if($row->prescription=='No')
              echo "<input type='radio' value='No' name='Prescription' required='required' checked='checked'>No<br>";
            else
              echo "<input type='radio' value='No' name='Prescription' required='required'>No<br>";
          ?>
          </td>
        </tr>
        <tr>
          <td>
            Do you take recreational drugs?
          </td>
          <td>
          <?php
            if($row->recreational=='Yes')
              echo "<input type='radio' value='Yes' name='Recreational' required='required' checked='checked'>Yes<br>";
            else
              echo "<input type='radio' value='Yes' name='Recreational' required='required'>Yes<br>";
            
            if($row->recreational=='No')
              echo "<input type='radio' value='No' name='Recreational' required='required' checked='checked'>No<br>";
            else
              echo "<input type='radio' value='No' name='Recreational' required='required'>No<br>";
          ?>
          </td>
        </tr>
        <tr>
          <td>
            Are you under the care of a physician now?
          </td>
          <td>
          <?php
            if($row->care_physician=='Yes')
              echo "<input type='radio' value='Yes' name='CarePhysician' required='required' checked='checked'>Yes<br>";
            else
              echo "<input type='radio' value='Yes' name='CarePhysician' required='required'>Yes<br>";
            
            if($row->care_physician=='No')
              echo "<input type='radio' value='No' name='CarePhysician' required='required' checked='checked'>No<br>";
            else
              echo "<input type='radio' value='No' name='CarePhysician' required='required'>No<br>";
          ?>
          </td>
        </tr>
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
      if(strpos($array[$i],$value)!==false)
        return $i;
    }
    
    return -1;
  }
  
?>
