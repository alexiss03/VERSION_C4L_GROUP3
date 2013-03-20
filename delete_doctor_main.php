<?php //views all he database contents
  // database access parameters
  // alter this as per your configuration
  session_start();
  include"session_check.php";
  include"menubar.php";
  if(isset($_SESSION['Username'])){
  $host = "localhost";
  $user = "postgres";
  $pass = "cmsc128";
  $db = "UHS_Information_Management_System";
  $_SESSION['module']="delete";
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
function delete_me(){
  var r=confirm("Are you sure you want to delete this account?");
  return r;
}

</script>
   
    <!-- Start: MAIN CONTENT -->
    <div class="content">
      <div class="container">
        <div class="article">
          <div class="header">
            <h1>Delete Doctor</h1>
          </div>
          <div class="row-fluid">
          	<div class="span6">
                   
            <form action='search_doctor_results.php' method='post'>
              <input type='text' name='searchName' placeholder='Search' required='required'>
              <input type='submit'>
            </form>
             <?php
              	if(isset($_SESSION['success']))
                	echo "Delete successful!<br>";
              	unset($_SESSION['success']);
            	?>
            <?php
			    if(isset($_SESSION['searchdoctor'])){
			    
			    $search_query = $_SESSION['searchdoctor'];
			    $query = "SELECT * FROM doctor where username like '%$search_query%' OR lower(name) like '%$search_query%' OR name like '%$search_query%'";
			    $result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
			    $rows = pg_num_rows($result); // get the number of rows in the resultset
			    
			    
			    if ($rows > 0){
			      echo "<table class='table table'cellpadding=5 cellspacing=0>
			      <h3>Results:</h3>
			      <tr>  
			        <th>Username</th>
			        <th>Name</th>
			      </tr>
			      ";
			          for ($i=0; $i<$rows; $i++){
			            $row = pg_fetch_object($result, $i);
			            
			          echo"

			          <tr>
			              <td>$row->name</td>
			              <td>$row->name</td>
			              <td><a href='delete_doctor.php?username=$row->username&submit=Submit' onclick='return delete_me();'>Delete</a></td>
			          </tr>";
			          }
			          
			          
			  echo"</table><br><br><br>";
			    }
			    else echo "<br><br> No result found! <br><br><br>";
			    unset($_SESSION['searchdoctor']);
			    }
			    
			    
			    
			    ?>
			    
			   </div>
			   <div class='span6'><br><br>
			   	<h3> List of all doctors</h3>
			<?php

			  // generate and execute a query
			  $query = "SELECT * FROM doctor ORDER BY username";
			  $result = pg_query($connection, $query) or die("Error in query: $query." . pg_last_error($connection));
			  $rows = pg_num_rows($result); // get the number of rows in the resultset
			  
			//  echo "There are currently $rows records in the database.";
			  
			  // if records present
			  if ($rows > 0){
			  // iterate through resultset

			    echo "<table class='table' id='data' cellpadding=5 cellspacing=0><tr>  
			      <th>Username</th>
			      <th>Name</th>
			      <th></th>
			    </tr>";
			    for ($i=0; $i<$rows; $i++){
			      $row = pg_fetch_object($result, $i);
			      
			?>

			<tr><?php echo"

			          <tr>
			              <td>$row->username</td>
			              <td>$row->name</td>
			              <td><a href='delete_doctor.php?username=$row->username&submit=Submit' onclick='return delete_me();'>Delete</a></td>
			          </tr>";
			  ?>
			</tr>
			<?php
			    }
			    
			?></table></div>
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
