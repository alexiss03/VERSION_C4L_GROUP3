 <?php
  session_start();
  include"session_check.php";
  $newaccount = $_SESSION['newaccount'];
  
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
    <script>
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

          <div class="span7">
          <div class="header">
            <h1>Add Doctor</h1>
          </div>
          <div class="row-fluid">
            <form method='post' action='add_patient_medical_history_process.php'>
              <table class="table table-hover">
                <tr>
                  <td>
                    Height(cm)
                  </td>
                  <td>
                    <input type="number" id="Height" name="Height" required='required' placeholder=''>
                    <input type='hidden' name="Username" value="<?php echo $newaccount?>">
                  </td>
                </tr>
                <tr>
                  <td>
                    Weight(kg)
                  </td>
                  <td>
                    <input type="number" id="Weight" name="Weight" required='required' placeholder=''>
                  </td>
                </tr>
                
                <tr>
                  <td>Family Illness
                  </td>
                  <td>
                  <?php
                  $illness = array('Diabetes','HighBloodPressure','Stroke','HeartTrouble','Easy Bleeding','Jaundice','Alcoholism','Tuberculosis','Obesity','Gout','Asthma','PsychiatricIllness','Allergy','HighBloodFats','None');
                  for($i=0;$i< count($illness); $i++){
                    if($illness[$i] !="None"){
                      echo "<input type='checkbox' class='Illness' name='Illness[]' value=$illness[$i]> $illness[$i] <br>";
                      
                      }
                    else{
                      echo "<input type='checkbox' class='Illness' name='Illness[]' value=$illness[$i] onclick='enable_other();'> $illness[$i]<br>";
                    }
                  }
                  ?>
                  </td>
                </tr>
                <tr>
                  <td>Your statement of Present Health
                  </td>
                  <td>
                  <input type="radio" value="Excellent" name="PresentHealth" required='required'>Excellent<br>
                  <input type="radio" value="Good" name="PresentHealth" required='required'>Good<br>
                  <input type="radio" value="Poor" name="PresentHealth" required='required'>Poor<br>
                  </td>
                </tr>
                <tr>
                  <td>
                  Do you take non-prescription drugs routinely?
                  </td>
                  <td>
                  <input type="radio" value="Yes" name="NonPrescription" required='required'>Yes<br>
                  <input type="radio" value="No" name="NonPrescription" required='required'>No<br>
                  </td>
                </tr>
                <tr>
                  <td>
                    Do you take prescription drugs routinely?
                  </td>
                  <td>
                  <input type="radio" value="Yes" name="Prescription" required='required'>Yes<br>
                  <input type="radio" value="No" name="Prescription" required='required'>No<br>
                  </td>
                </tr>
                <tr>
                  <td>
                    Do you take recreational drugs?
                  </td>
                  <td>
                  <input type="radio" value="Yes" name="Recreational" required='required'>Yes<br>
                  <input type="radio" value="No" name="Recreational" required='required'>No<br>
                  </td>
                </tr>
                <tr>
                  <td>
                    Are you under the care of a physician now?
                  </td>
                  <td>
                    <input type="radio" value="Yes" name="CarePhysician" required='required'>Yes<br>
                    <input type="radio" value="No" name="CarePhysician" required='required'>No<br>
                  </td>
                </tr>
                <tr>
                  <td>
                  	<input type='submit' onclick='return validate();'>
                  </td>
                  <td>
                    
                  </td>
                </tr>
                
              </table>
            </form>
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
