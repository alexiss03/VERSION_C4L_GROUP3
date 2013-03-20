   <?php 
   echo"
    <header>
      <!-- Start: Navigation wrapper -->
      <div class='navbar navbar-fixed-top'>
        <div class='navbar-inner'>
          <div class='container'>
            <a href='index.html' class='brand brand-bootbus'>UHS Information Management System</a>
      
            <!-- Below button used for responsive navigation -->
            <button type='button' class='btn btn-navbar' data-toggle='collapse' data-target='.nav-collapse'>
              <span class='icon-bar'></span>
              <span class='icon-bar'></span>
              <span class='icon-bar'></span>
            </button>
      

            <!-- Start: Primary navigation -->
			 <div class='nav-collapse collapse'>        
              <ul class='nav pull-right'>"
			;
			
			
				if($_SESSION['Role']!='admin' && isset($_SESSION['Username'])){
					$username = $_SESSION['Username'];
					if($_SESSION['Role']=='patient'){
						echo"
						 <li class='dropdown'>
						  <a href='view_patient_profile.php?username=$username'>$username</a>                
						</li>
						";
						
					}
					else if($_SESSION['Role']=='doctor'){
						echo"
						 <li class='dropdown'>
						  <a href='view_doctor_profile.php?username=$username'>$username</a>                
						</li>
						";
					}
						
				}	
			
			
			echo"
           
                <li><a href='home.php'>HOME</a></li>
				";
				
				
				
				
				
				if($_SESSION['Role']=='admin'){
				echo "
                <li class='dropdown'>
                  <a href='#' class='dropdown-toggle' data-toggle='dropdown'>ADD<b class='caret'></b></a>
                  <ul class='dropdown-menu'>
				  
                    <li><a href='add_patient.php'>Patient</a></li>
                    <li><a href='add_doctor.php'>Doctor</a></li>
                  </ul>                  
                </li>";
				}
				
				if($_SESSION['Role']=='admin'){
				echo "
                 <li class='dropdown'>
                  <a href='#' class='dropdown-toggle' data-toggle='dropdown'>EDIT<b class='caret'></b></a>
                  <ul class='dropdown-menu'>
                    <li class='dropdown-submenu'>
                      <a href='#'>Patient</a>
                      <ul class='dropdown-menu'>
                        <li>
                          <a href='edit_patient_main.php'>Edit Profile</a>
                        </li>
                        <li><a href='change_password_patient.php'>Change Password</a></li>
                      </ul> 
                    </li>
                    <li class='dropdown-submenu'>
                        <a href='#'>Doctor</a>
                      <ul class='dropdown-menu'>
                        <li class=>
                          <a href='edit_doctor_main.php'>Edit Profile</a>
                        </li>
                        <li><a href='change_password_doctor.php'>Change Password</a></li>
                      </ul> 
                    </li>
                  </ul>                  
                </li>";
				}
				if($_SESSION['Role']!='patient'){
				echo"
                 <li class='dropdown'>
                  <a href='#' class='dropdown-toggle' data-toggle='dropdown'>VIEW<b class='caret'></b></a>
                  <ul class='dropdown-menu'>";
				  if($_SESSION['Role']=='admin' || $_SESSION['Role']=='doctor')
					echo"
                    <li><a href='view_all_patients.php'>All Patient</a></li>";
				  if($_SESSION['Role']=='admin' || $_SESSION['Role']=='doctor')
					echo"
                    <li><a href='view_all_doctors.php'>All Doctor</a></li>";
				  if($_SESSION['Role']=='admin')
					echo"
                    <li><a href='view_all_appointments.php'>All Appointment</a></li>";
					echo"
                  </ul>                  
                </li>";
				}
				if($_SESSION['Role']=='admin'){
					echo"
					 <li class='dropdown'>
					  <a href='#' class='dropdown-toggle' data-toggle='dropdown'>DELETE<b class='caret'></b></a>
					  <ul class='dropdown-menu'>
						<li><a href='delete_patient.php'>Patient</a></li>
						<li><a href='delete_doctor.php'>Doctor</a></li>
					  </ul>                  
					</li>
					";
				}
				if($_SESSION['Role']=='patient'){
					echo"
					 <li class='dropdown'>
					  <a href='make_appointment.php'>MANAGE APPOINTMENT</a>                
					</li>
					";
				};
				if($_SESSION['Role']=='doctor'){
					echo"
					 <li class='dropdown'>
					  <a href='edit_doctor.php'>EDIT DOCTOR</a>                
					</li>
					";
				};
				
				
				echo"
                <li><a href='logout.php'>LOGOUT</a></li>
              </ul>
            </div>
            <!-- End Primary Navigation -->
          </div>
        </div>
      </div>
      <!-- End: Navigation wrapper -->   
    </header>
    <!-- End: HEADER -->
    <!-- Start: MAIN CONTENT -->";
	?>