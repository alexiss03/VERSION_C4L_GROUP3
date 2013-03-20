<?php
session_start();
include"menubar.php";
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
      <script type="text/javascript">
	  
	function enable_other(){
		var arr = document.getElementsByClassName("Schedule");
		var count=0;
		//alert(arr.length );
		for(i=0;i<arr.length;i++){
			if(arr[i].checked == true){
				count=count+1;
			}
		}
		
		for(i=0;i<arr.length;i++){
			if(count>=5){
				for(j=0;j<arr.length;j++){
					if(arr[j].checked==false)
						arr[j].disabled=true;
					}
				}else{
					for(j=0;j<arr.length;j++){
						arr[j].disabled=false;
					}
				}
		}
		//alert("hi");
	}
  
</script>
    <!-- Start: MAIN CONTENT -->
    <div class="content">
      <div class="container">
        <div class="article">
          <div class="header">
            <h1>Make Appointment</h1>
          </div>
          <div class="row-fluid">
          	<div class="span8">
            <?php
		    
		    include"session_check.php";
		    $username = $_GET['doctor'];
		    $patient = $_SESSION['Username'];
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
		    
		    $querySchedule = "SELECT count(*) FROM doctor_schedule  WHERE username= '".$username."';";
		    $resultSchedule = pg_query($connection, $querySchedule) or die("Error in query: $query." . pg_last_error($connection));
		    $row4 = pg_fetch_array($resultSchedule);
		    if($row4[0]!=0){
		      $o=0;
		      $stmt="SELECT * FROM  doctor_schedule WHERE username= '".$username."';";
		      $result=pg_query($stmt);
		      while ($rows=pg_fetch_assoc($result)){
		        $array[$o] = $rows['taken'];
		        $array1[$o] = $rows['patient'];
		        $array2[$o++] =  $rows['grid'];
		      }
		    }
		      echo "<form method='post' action='make_appointment_process.php'><table border='2px' class='table table-striped'><tr>
		        <input type='hidden' name='doctor' value=".$_GET['doctor'].">
		        <th width='90px'></th>
		        <th width='90px'>Monday</th>
		        <th width='90px'>Tuesday</th>
		        <th width='90px'>Wednesday</th>
		        <th width='90px'>Thursday</th>
		        <th width='90px'>Friday</th>
		        </tr>";
		        for($i=0; $i<12 ;$i++){
		          echo "<tr width='120px'><td><strong>".returnTime($i)."</strong></td>";
		          for($j=0;$j<5;$j++){
		            if(search($i.",".$j, $o, $array2)!=-1){
		              $k = search($i.",".$j, $o, $array2);
		              $query = "SELECT count(*) FROM doctor_schedule  WHERE username!= '".$username."' AND patient='$patient' AND grid='$array2[$k]' AND taken='t';";
		              $result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
		              $row5 = pg_fetch_array($result);
		              if($array[$k]=='f' && $row5[0]==0){
		                echo"
		                  <td>
		                    <input type='checkbox' class='Schedule' name='Schedule[]' value='".$i.",".$j."' onclick='enable_other();'>
		                  </td>";
		                
		              }
		              else{
		                if($array1[$k]==$patient){
		                  echo"
		                    <td>
		                      <input checked='checked' class='Schedule' type='checkbox' name='Schedule[]' value='".$i.",".$j."' onclick='enable_other();'>
		                    </td>";
		                }
		                else{
		                  echo"
		                  <td>
		                    <input type='checkbox' name='Schedule[]' disabled='disabled' value='".$i.",".$j."' onclick='enable_other();'>
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
		        echo "</table><input type='submit'></form>";
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