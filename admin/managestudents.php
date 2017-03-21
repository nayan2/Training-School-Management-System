<?php
session_start();
if(isset($_SESSION['sess_adm']) && $_SESSION['sess_adm']=="admin"){
  	echo "<h1 style='display:none' id='username'>".$_SESSION['username']."</h1>";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TSMS-Admin Page | </title>
  	<?php include 'pageHead.php'; ?>
  	<script src="js/mgStudents.js" type="text/javascript"></script>
</head>
<body class="w3-theme">
  <?php include 'pageSideNavigationBar.php'; ?>
  <section class="w3-row-padding w3-theme" style="margin-left:165px;" id="main-content">
	<div id="guts">
        <a style=" margin-left: 88%;width: 11%;border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding" onclick="$('#signup').show()">Add A Student</a>
     	<p>Students Details...</p>
        <table width="100%" id="example" class="display nowrap" cellspacing="0" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" width="100%">
            <thead>
            	<tr>
	                <th>first name</th>
	                <th>last name</th>
	                <th>username</th>
	                <th>Assigned Courses</th>
	                <th>Assigned Batches</th>
	                <th>Student Pic</th>  
	                <th>company name</th>
	                <th>city</th>
	                <th>phone number</th>
	                <th>email</th>
	                <th>zip code</th>
	                <th>nationality</th>
	                <th>sex</th>
	                <th>religion</th>
	                <th>blood group</th>
	                <th>dob</th>
	                <th>password</th>
	                <th>user activation date</th>
	                <th>user deactivation date</th>
	                <th>Button</th>
	            </tr>
            </thead>
            <tbody>
            <?php
            $conn = mysqli_connect("localhost", "root", "","tsms") or die("cannot connect to server"); 
            $sql = "SELECT * FROM users where level='student';";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_assoc($result)){ ?>
              	<tr>
	                <td><div><?php echo $row["first_name"]; ?></div></td> 
	                <td><div><?php echo $row["last_name"]; ?></div></td>
	                <td><div class="cventablehead" onclick="changeUserDetails(this)" id="co3"><?php echo $row["username"]; ?></div></td>
	                <?php
	                $conn2 = mysqli_connect("localhost", "root", "", "tsms") or die("cannot connect to Database");
	                $userName = $row["username"];
	                $query2 = "SELECT course_name from studentassignbatches WHERE username ='$userName';";
	                $result2 = mysqli_query($conn2, $query2);
	                $courses = "";
                	while ($row2 = mysqli_fetch_assoc($result2)) {
                  		$courses = $courses ."</br>"."<a href='managecourses.php#search=$row2[course_name]' style='color:red;'>$row2[course_name]</a>".",";
                	}?>
                	<td><div style="width: 130px;overflow-y: scroll;height: 70px;" ><?php echo $courses; ?></div></td>
                	<?php
                	$conn1 = mysqli_connect("localhost", "root", "", "tsms") or die("cannot connect to Database");
                	$userName = $row["username"];
                	$query1 = "SELECT batch_code from studentassignbatches WHERE username ='$userName';";
                	$result1 = mysqli_query($conn1, $query1);
                	$batches = "";
                	while ($row1 = mysqli_fetch_assoc($result1)) {
                  		$batches = $batches ."</br>". "<a href='manageBatches.php#search=$row1[batch_code]' style='color:red;'>$row1[batch_code]</a>" .",";
                	}?>
	                <td><div style="width: 130px;overflow-y: scroll;height: 70px;" ><?php echo $batches; ?></div></td>
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
	                <td><div><?php echo $row["password"]; ?></div></td>
	                <td><div><?php echo $row["user_activation_date"]; ?></div></td>
	                <td><div><?php echo $row["user_inactivation_date"]; ?></div></td>
	                <td><a class="cventablehead" onclick="idna(this)">Delete</a></td>            
              	</tr>
              	<?php $batches = ""; }?>
            </tbody>
        </table><br>
        <!-- SIGN Up design div -->
        <div id="signup" class="w3-modal">
          	<div class="w3-modal-content w3-card-8 w3-animate-zoom" style=" margin-top: -30px; max-width:600px">
            	<div class="w3-center"><br>
              		<span onclick="document.getElementById('signup').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>     <br>
            	</div>
            	<form id="xxxx" name="signup_tsms" class="w3-container" action="addnewuser.php" autocomplete="off" method="post" enctype="multipart/form-data">
              		<div class="w3-section">
                		<img id="blah" src="../pic/avatar.jpg" alt="Avatar" style="margin-left: 175px;width:30%;" class="w3-circle w3-margin-top"><br>
                		<label><b>UPLOAD PIC</b></label>
                		<label class="w3-btn-block w3-green w3-section w3-padding">
                  			<input type="file" onchange="readURL(this,'#blah')" id="iprofilepic" name="file_img" style="display: none" accept="image/gif,image/jpeg,image/jpg" autocomplete="off">Choose a Pic*
                		</label><br>
                		<select required class="w3-input w3-border w3-animate-input" placeholder="User level*" id="iulevel" name="ulevel" autofocus="off">
                  			<option disabled selected>User Level*</option>
                  			<option value="student">Student</option>
                		</select></p>
                		<select onchange="fillChooseACourse()" class="w3-border w3-input" name="chooseAVendor" id="ichooseAVendor" autofocus="off">
                  			<option disabled selected >Choose A Vendor</option>
		                  	<?php
		                  	$conn=mysqli_connect("localhost", "root", "","tsms")or die("cannot connect to server or ubale to select db"); 
		                  	$sql = "SELECT heading from vendors;";
		                  	$result = mysqli_query($conn,$sql);
		                  	while($row=mysqli_fetch_assoc($result)){?>
		                  		<option value="<?php echo $row['heading']; ?>"><?php echo $row['heading']; ?></option>';
		                  	<?php }?>
                		</select><br>
                		<select onchange="fillChooseABatch()" class="w3-border w3-input" name="chooseACourse" id="ichooseACourse" autofocus="off">
                  			<option disabled selected >Choose A Course</option>
                		</select><br>
                		<select class="w3-border w3-input" name="chooseABatch" id="chooseABatch" autofocus="off">
                  			<option disabled selected >Choose A Batch</option>
                		</select><br>
		                <input class="w3-input w3-border w3-animate-input" type="text" id="iuname" onblur="CheckUserName()" placeholder="User name*" name="uname" required autocomplete="off"></p>            
		                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="First name*" id="iufname" name="ufname" required autocomplete="off"></p>            
		                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Last name*" id="iulname" name="ulname" required autocomplete="off"></p>                     
		                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Company name" id="icname" name="cname"></p>           
		                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="City*" id="icity" name="city" required autocomplete="off"></p>          
		                <input class="w3-input w3-border w3-animate-input" type="number" onkeypress="aa()" placeholder="Phone number*" id="ipnumber" name="pnumber" required autocomplete="off">
		                <label id="ipn" style="display: none;color: red;"></label></p>          
		                <input class="w3-input w3-border w3-animate-input" type="email" onkeypress="gg()" placeholder="Email address*" id="iemail" name="email" required autocomplete="off">
		                <label id="iem" style="display: none;color: red;"></label></p>                     
		                <input class="w3-input w3-border w3-animate-input" type="number" onkeypress="uu()" placeholder="Zip code" id="izcode" name="zcode">
		                <label id="izc" style="display: none;color: red;"></label></p>           
		                <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Nationality*" id="inat" name="nat"></p>          
                		<select required class="w3-input w3-border w3-animate-input" placeholder="Sex*" id="isex" name="sex" autofocus="off">
                  			<option disabled selected="selected"><span style="">Sex*</span></option>
                  			<option value="male">Male</option>
                  			<option value="female">Female</option>
                  			<option value="other">Other</option>
                		</select></p>          
		                <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Religion*" id="irel" name="rel"></p>          
		                <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Blood group*" id="ibgr" name="bgr"></p>
		                <input required autocomplete="off" type="text" class="span2" placeholder="Date of birth*" name="dpt" id="idpt"><br></p>          
		                <input class="w3-input w3-border w3-animate-input" type="password" placeholder="Enter Password*" id="ipass" name="pass" required autocomplete="off"></p>          
		                <input class="w3-input w3-border w3-animate-input" type="password" placeholder="Confirm Password*" onkeyup="check_confirm_pass()" id="icpass" name="cpass" required autocomplete="off">
		                <label id="incp" style="display: none;color: red;"></label>
		                <button class="w3-btn-block w3-green w3-section w3-padding"  onclick="mama()" id="isubmitsignup" name="submitsignup" type="button">Add</button>
              		</div>
            	</form>
            	<div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
              		<button onclick="document.getElementById('signup').style.display='none'" type="button" class="w3-btn w3-red">Cancel</button>
            	</div>
          	</div>
        </div>
        <!-- End Of SIGN Up design div -->
        <!-- Edit student details design div -->
        <div id="editStudentDetails" class="w3-modal">
          	<div class="w3-modal-content w3-card-8 w3-animate-zoom" style=" margin-top: -30px; max-width:600px">
            	<div class="w3-center"><br>
              		<span onclick="$('#editStudentDetails').hide()" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span><br>
            	</div>
            	<form id="isubmitEditStudentDetails" name="submitEditStudentDetails" class="w3-container" action="editStudentDetails.php" autocomplete="off" method="post" enctype="multipart/form-data">
              		<div class="w3-section">
                	<img id="studentProfilePicture" src="../pic/avatar.jpg" alt="Avatar" style="margin-left: 175px;width:250px;height: 200px;" class="w3-circle w3-margin-top"><br>
                	<label><b>UPLOAD PIC</b></label>
                	<label class="w3-btn-block w3-green w3-section w3-padding"><input type="file" onchange="readURL(this,'#studentProfilePicture')" id="istudentProfilePic" name="studentProfilePic" style="display: none" accept="image/gif,image/jpeg,image/jpg" autocomplete="off">Choose a Pic*</label><br>
                	<label><b>User Level</b></label>
                	<select required class="w3-input w3-border w3-animate-input" placeholder="User level*" id="isulevel" name="sulevel" autofocus="off">
                  		<option value="student">Student</option>
                	</select></p>
                	<div>
	                	<div style="float: left;">
	                    	<label><b>Assign Batches</b></label>
	                    	<ul id="studentAssignBatchesList" class="w3-ul w3-card-16" style="width:80%"></ul>
	              		</div>
	                	<div style="float: right;">
	                    	<label><b>Assign Courses</b></label>
	                    	<ul id="studentAssignCoursesList" class="w3-ul w3-card-16" style="width:80%;"></ul>
	                	</div>
		                </div></br></br></br></br></br>
		                <label><b>User Name</b></label>
		                <input readonly class="w3-input w3-border w3-animate-input" type="text" id="isuname" placeholder="User name*" name="suname" required autocomplete="off"></p>
		                <label><b>First Name</b></label>            
		                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="First name*" id="isufname" name="sufname" required autocomplete="off"></p>
		                <label><b>Last Name</b></label>            
		                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Last name*" id="isulname" name="sulname" required autocomplete="off"></p>
		                <label><b>Company Name</b></label>                     
		                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Company name" id="iscname" name="scname"></p>
		                <label><b>City</b></label>           
		                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="City*" id="iscity" name="scity" required autocomplete="off"></p>
		                <label><b>Phone Number</b></label>          
		                <input class="w3-input w3-border w3-animate-input" type="number" onkeypress="aa1()" placeholder="Phone number*" id="ispnumber" name="spnumber" required autocomplete="off">
		                <label id="ispn" style="display: none;color: red;"></label></p>
		                <label><b>Email Address</b></label>          
		                <input class="w3-input w3-border w3-animate-input" type="email" onkeypress="gg1()" placeholder="Email address*" id="isemail" name="semail" required autocomplete="off">
		                <label id="isem" style="display: none;color: red;"></label></p>
		                <label><b>Zip Code</b></label>                     
		                <input class="w3-input w3-border w3-animate-input" type="number" onkeypress="uu1()" placeholder="Zip code" id="iszcode" name="szcode">
		                <label id="iszc" style="display: none;color: red;"></label></p>
		                <label><b>Nationality</b></label>           
		                <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Nationality*" id="isnat" name="snat"></p>
		                <label><b>Sex</b></label>          
                		<select required class="w3-input w3-border w3-animate-input" placeholder="Sex*" id="issex" name="ssex" autofocus="off">
                  			<option disabled selected="selected"><span style="">Sex*</span></option>
		                  	<option value="male">Male</option>
		                 	<option value="female">Female</option>
		                  	<option value="other">Other</option>
                		</select></p>
                		<label><b>Religion</b></label>          
                		<input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Religion*" id="isrel" name="srel"></p>
		                <label><b>Blood Group</b></label>          
		                <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Blood group*" id="isbgr" name="sbgr"></p>
		                <label><b>Date Of Birth</b></label>
		                <input required autocomplete="off" type="text" class="span2" placeholder="Date of birth*" name="sdpt" id="isdpt"><br></p>          
		                <label id="isncp" style="display: none;color: red;"></label>
		                <button class="w3-btn-block w3-green w3-section w3-padding"  onclick="validEditStudentDetails()" id="isubmitsignup" name="submitsignup" type="button">Edit</button>
              		</div>
            	</form>
            	<div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
              		<button id="editStudentDetailsPanelCancleButton" onclick="document.getElementById('editStudentDetails').style.display='none'" type="button" class="w3-btn w3-red">Cancel</button>
            	</div>
          	</div>
        </div>
        <!-- End Of Edit student details design div -->
	</div>
    </section>
    <?php include 'customPopupMessage.php'; ?>
</body>
</html>
<?php mysqli_close($conn); ?>
<?php } else { header("location:../index.php"); }?>