<?php
session_start();
$conn = mysqli_connect("localhost", "root", "","tsms")or die("cannot connect to server");
if(isset($_SESSION['sess_adm']) && $_SESSION['sess_adm']=="admin"){?>
  <h1 style='display:none' id='username'><?php echo $_SESSION['username']; ?></h1>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TSMS-Admin Page | </title>
  <?php include 'pageHead.php'; ?>
  <script src="js/mgInstructor.js" type="text/javascript" charset="utf-8" async defer></script>
</head>
<body class="w3-theme">
  <?php include 'pageSideNavigationBar.php'; ?>    
  <section class="w3-row-padding w3-theme" style="margin-left:165px;" id="main-content">
		<div id="guts">
      <a style=" margin-left: 88%;width: 11%;border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding" onclick="$('#addANewInstructor').show()">Add A Faculty</a><br>
      <p>Currently Available Faculty Details...</p>
      <table id="ifacultyDetailsTable" class="display nowrap" cellspacing="0" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" width="100%">
        <thead>
          <tr>
            <th style="display: none;" >id</th>
            <th>Faculty Name</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Course Name</th>
            <th>Batch Code</th>  
            <th>Profile Pic</th>
            <th>Company Name</th>
            <th>City</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Zip Code</th>
            <th>Nationality</th>
            <th>Sex</th>
            <th>Religion</th>
            <th>Blood Group</th>
            <th>Dob</th>
            <th>Faculty Activation Date</th>
            <th>Faculty Deactivation Date</th>
            <th>Button</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $sql = "SELECT * FROM faculties;";
          $result = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_assoc($result)){?>
          <tr>
              <td style="display: none;"><div><?php echo $row["id"]; ?></div></td>
              <td><div id="co3" onclick="facultyId(this)" class="cventablehead" ><?php echo $row["faculty_name"]; ?></div></td>
              <td><div><?php echo $row["first_name"]; ?></div></td> 
              <td><div><?php echo $row["last_name"]; ?></div></td>
              <?php
              $facultyName = $row["faculty_name"];
              $query = "SELECT course_name from batches where faculty_name='$facultyName'";
              $result4 = mysqli_query($conn, $query);
              $facultyAssignedCourses = "";
              while($row4 = mysqli_fetch_assoc($result4)){
                $facultyAssignedCourses = $facultyAssignedCourses ."</br>"."<a style='color:red;' href='managecourses.php#search=$row4[course_name]'>$row4[course_name]</a>" .",";
              }?>
              <td><div style="width: 130px;overflow-y: scroll;height: 70px;" ><?php echo $facultyAssignedCourses; ?></div></td>
              <?php
              $facultyName = $row["faculty_name"];
              $query = "SELECT batch_code from batches WHERE faculty_name='$facultyName';";
              $result1 = mysqli_query($conn, $query);
              $facultyAssignedBatches = "";
              while ($row1 = mysqli_fetch_assoc($result1)) {
                $facultyAssignedBatches = $facultyAssignedBatches ."</br>"."<a style='color:red;' href='manageBatches.php#search=$row1[batch_code]'>$row1[batch_code]</a>" .",";
              }?>
              <td><div style="width: 130px;overflow-y: scroll;height: 70px;"><?php echo $facultyAssignedBatches; ?></div></td>
              <td><div><img height="60px" width="80px" src="<?php echo $row["pic_path"]; ?>"></div></td>          
              <td><div><?php echo $row["company_name"]; ?></div></td>
              <td><div><?php echo $row["city"]; ?></div></td>
              <td><div><?php echo $row["phone_number"]; ?></div></td>
              <td><div><?php echo $row["email"]; ?></div></td>
              <td><div><?php echo $row["zip_code"]; ?></div></td>
              <td><div><?php echo $row["nationality"]; ?></div></td>
              <td><div><?php echo $row["sex"]; ?></div></td>
              <td><div><?php echo $row["religion"]; ?></div></td>
              <td><div><?php echo $row["blood_group"]; ?></div></td>
              <td><div><?php echo $row["dob"]; ?></div></td>
              <td><div><?php echo $row["faculty_activation_date"]; ?></div></td>
              <td><div><?php echo $row["faculty_inactivation_date"]; ?></div></td>
              <td><label class="cventablehead" onclick="deleteAFaculty(this)">Delete</label></td>
          </tr>
          <?php $facultyAssignedBatches = ""; $facultyAssignedCourses = ""; }?>
        </tbody>
      </table><br>
      <!-- SIGN Up design div -->
      <div id="addANewInstructor" class="w3-modal">
          <div class="w3-modal-content w3-card-8 w3-animate-zoom" style=" margin-top: -30px; max-width:600px">
            <div class="w3-center"><br>
              <span onclick="$('#addANewInstructor').hide()" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span><br>
            </div>
            <form id="iinstructorDetailsForm" name="instructorDetailsForm" class="w3-container" action="addNewInstructor.php" autocomplete="off" method="post" enctype="multipart/form-data">
              <label ><h2>Add A New Instructor</h2></label>
              <div class="w3-section">
                <img id="instructorDummyPic" src="../pic/avatar.jpg" alt="Avatar" style="margin-left: 175px;width:30%;" class="w3-circle w3-margin-top"><br>
                <label><b>UPLOAD PIC</b></label>
                <label class="w3-btn-block w3-green w3-section w3-padding">
                  <input type="file" onchange="readURL(this,'#instructorDummyPic')" id="iinstructorProfilePic" name="instructorProfilePic" style="display: none" accept="image/gif,image/jpeg,image/jpg" autocomplete="off">Choose a Pic*
                </label><br>            
                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="First name*" id="iifname" name="ifname" required autocomplete="off"></p>            
                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Last name*" id="iilname" onblur="checkFacultyName()" name="ilname" required autocomplete="off"></p>                     
                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Company name" id="iicname" name="icname"></p>           
                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="City*" id="iicity" name="icity" required autocomplete="off"></p>          
                <input class="w3-input w3-border w3-animate-input" type="number" onkeypress="aa4()" placeholder="Phone number*" id="iipnumber" name="ipnumber" required autocomplete="off">
                <label id="iipn" style="display: none;color: red;"></label></p>          
                <input class="w3-input w3-border w3-animate-input" type="email" onblur="checkInstructorEmail()" onkeypress="gg4()" placeholder="Email address*" id="iiemail" name="iemail" required autocomplete="off">
                <label id="iiem" style="display: none;color: red;"></label></p>                     
                <input class="w3-input w3-border w3-animate-input" type="number" onkeypress="uu4()" placeholder="Zip code" id="iizcode" name="izcode">
                <label id="iizc" style="display: none;color: red;"></label></p>           
                <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Nationality*" id="iinat" name="inat"></p>          
                <select required class="w3-input w3-border w3-animate-input" placeholder="Sex*" id="iisex" name="isex" autofocus="off">
                  <option disabled selected="selected"><span style="">Sex*</span></option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select></p>          
                <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Religion*" id="iirel" name="irel"></p>          
                <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Blood group*" id="iibgr" name="ibgr"></p>
                <input required autocomplete="off" type="text" class="span2" placeholder="Date of birth*" name="idpt" id="iidpt"><br></p>          
                <button class="w3-btn-block w3-green w3-section w3-padding"  onclick="submitANewInstructor()" id="isubmitInstructor" name="submitInstructor" type="button">Add</button>
              </div>
            </form>
            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
              <button onclick="$('#addANewInstructor').hide()" type="button" class="w3-btn w3-red">Cancel</button>
            </div>
          </div>
      </div>
      <!-- End Of SIGN Up design div -->
      <!-- Edit A instructor design div -->
      <div id="EditAInstructor" class="w3-modal">
          <div class="w3-modal-content w3-card-8 w3-animate-zoom" style=" margin-top: -30px; max-width:600px">
            <div class="w3-center"><br>
              <span onclick="$('#EditAInstructor').hide()" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span><br>
            </div>
            <form id="ieditInstructorDetailsForm" name="editInstructorDetailsForm" class="w3-container" action="editInstructor.php" autocomplete="off" method="post" enctype="multipart/form-data">
              <label style="display: none;" id="facultyId" name="nFacultyId"></label>
              <label ><h2>Edit Instructor Details</h2></label>
              <div class="w3-section">
                <img id="editInstructorDummyPic" src="../pic/avatar.jpg" alt="Avatar" style="margin-left: 175px;width:40%;height: 30%" class="w3-circle w3-margin-top"><br>
                <label><b>Profile PIC</b></label>
                <label class="w3-btn-block w3-green w3-section w3-padding">
                  <input type="file" onchange="readURL(this,'#editInstructorDummyPic')" id="ieditInstructorProfilePic" name="editInstructorProfilePic" style="display: none" accept="image/gif,image/jpeg,image/jpg" autocomplete="off">Change profile Pic
                </label><br> 
                <label><b>First Name</b></label>           
                <input style="color: red;" class="w3-input w3-border w3-animate-input" type="text" placeholder="First name*" id="ieifname" name="eifname" required autocomplete="off"></p>            
                <label><b>Last Name</b></label>
                <input style="color: red;" class="w3-input w3-border w3-animate-input" type="text" placeholder="Last name*" id="ieilname" name="eilname" required autocomplete="off"></p>
                <label><b>Instruct Name</b></label>
                <input style="color: red;" readonly class="w3-input w3-border w3-animate-input" type="text" placeholder="Instructor name*" id="ieinstructorname" name="einstructorname" required autocomplete="off"></p>                     
                <label><b>Company Name</b></label>
                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Company name" id="ieicname" name="eicname"></p>           
                <label><b>City</b></label>
                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="City*" id="ieicity" name="eicity" required autocomplete="off"></p>          
                <label><b>Phone Number</b></label>
                <input class="w3-input w3-border w3-animate-input" type="number" onkeypress="aa5()" placeholder="Phone number*" id="ieipnumber" name="eipnumber" required autocomplete="off">
                <label id="ieipn" style="display: none;color: red;"></label></p>          
                <label><b>Email Address</b></label>
                <input readonly class="w3-input w3-border w3-animate-input" type="email" onkeypress="gg5()" placeholder="Email address*" id="ieiemail" name="eiemail" required autocomplete="off">
                <label id="ieiem" style="display: none;color: red;"></label></p>                     
                <label><b>Zip Code</b></label>
                <input class="w3-input w3-border w3-animate-input" type="number" onkeypress="uu5()" placeholder="Zip code" id="ieizcode" name="eizcode">
                <label id="ieizc" style="display: none;color: red;"></label></p>           
                <label><b>Nationality</b></label>
                <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Nationality*" id="ieinat" name="einat"></p>          
                <label><b>Sex</b></label>
                <select required class="w3-input w3-border w3-animate-input" placeholder="Sex*" id="ieisex" name="eisex" autofocus="off">
                  <option disabled selected="selected"><span style="">Sex*</span></option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select></p>
                <label><b>Religion</b></label>          
                <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Religion*" id="ieirel" name="eirel"></p>          
                <label><b>Blood Group</b></label>
                <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Blood group*" id="ieibgr" name="eibgr"></p>
                <label><b>Date Of Birth</b></label>
                <input required autocomplete="off" type="text" class="span2" placeholder="Date of birth*" name="eidpt" id="ieidpt"></p>
                <label><b>Faculty Activation Date</b></label>
                <input autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Faculty Activation Date" id="iefactivationdate" name="iefactivationdate"></p>
                <label><b>Faculty Deactivation Date</b></label>
                <input autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Faculty Deactivation Date" id="iefdeactivationdate" name="efdeactivationdate"></p>
                <label><b>Faculty Activity</b></label>
                <select class="w3-input w3-border w3-animate-input" id="iefacultyactivation" name="efacultyactivation" autofocus="off">
                  <option disabled selected ><span>Faculty Activity</span></option>
                  <option value="active">Activate</option>
                  <option value="inactive">Inactive</option>
                </select></p>
                <div style="float: left;">
                  <label><b>Faculty Active In Courses</b></label>
                  <ul id="facultyActiveCoursesList" class="w3-ul w3-card-16" style="width:80%;"></ul>
                </div>
                <div style="float: right;">
                  <label><b>Faculty Active In Batches</b></label>
                  <ul id="facultyActiveBatchesList" class="w3-ul w3-card-16" style="width:80%"></ul>
                </div>
                <button class="w3-btn-block w3-green w3-section w3-padding" onclick="submitToEditInstructorDetails()" id="iesubmitInstructor" name="esubmitInstructor" type="button">Edit</button>
              </div>
            </form>
          <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
            <button onclick="$('#EditAInstructor').hide()" type="button" class="w3-btn w3-red">Cancel</button>
          </div>
        </div>
      </div>
      <!-- End Of Edit A instructor design div -->
		</div>
  </section>
  <?php include 'customPopupMessage.php'; ?>
</body>
</html>
<?php mysqli_close($conn); ?>
<?php } else { header("location:../index.php"); }?>