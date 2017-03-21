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
  <script src="js/mgAdmin.js" type="text/javascript"></script>
</head>
<body class="w3-theme">
  <?php include 'pageSideNavigationBar.php'; ?>
  <section class="w3-row-padding w3-theme" style="margin-left:165px;" id="main-content">
		<div id="guts">
      <a style=" margin-left: 88%;width: 11%;border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding" onclick="$('#adminDetails').show()">Add A Admin</a><br>
      <p>Currently Available Admin Details...</p>
      <table id="iadminDetailsTable" class="display nowrap" cellspacing="0" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" width="100%">
        <thead>
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
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
            <th>Password</th>
            <th>User Activation Date</th>
            <th>User Deactivation Date</th>
            <th>Button</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $conn = mysqli_connect("localhost", "root", "","tsms")or die("cannot connect to server"); 
          $sql = "SELECT * FROM users where level='admin';";
          $result = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_assoc($result)){?>
          <tr>
            <td><div><?php echo $row["first_name"]; ?></div></td> 
            <td><div><?php echo $row["last_name"]; ?></div></td>
            <td><div onclick="changeAdminDetails(this)" id="co3" class="cventablehead"><?php echo $row["username"]; ?></div></td>
            <td><div style="width:100%;height: 60px;margin: 0;padding: 0;"><img  height="60px" width="80px" src="<?php echo $row["pic_path"] ?>"></div></td>          
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
            <td><label  class="cventablehead" onclick="getAdminUsername(this)">Delete</label></td>
          </tr>
          <?php }?>
        </tbody>
      </table><br>
      <!-- SIGN Up design div -->
      <div id="adminDetails" class="w3-modal">
        <div class="w3-modal-content w3-card-8 w3-animate-zoom" style=" margin-top: -30px; max-width:600px">
          <div class="w3-center"><br>
            <span onclick="document.getElementById('adminDetails').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span><br>
          </div>
          <form id="iadminDetailsForm" name="adminDetailsForm" class="w3-container" action="addNewAdmin.php" autocomplete="off" method="post" enctype="multipart/form-data">
            <div class="w3-section">
              <img id="adminDummyPic" src="../pic/avatar.jpg" alt="Avatar" style="margin-left: 175px;width:30%;" class="w3-circle w3-margin-top"><br>
              <label><b>UPLOAD PIC</b></label>
              <label class="w3-btn-block w3-green w3-section w3-padding">
                <input type="file" onchange="readURL(this,'#adminDummyPic')" id="iadminProfilePic" name="adminProfilePic" style="display: none" accept="image/gif,image/jpeg,image/jpg" autocomplete="off">Choose a Pic*
              </label><br>
              <select required class="w3-input w3-border w3-animate-input" placeholder="User level*" id="iaulevel" name="aulevel" autofocus="off">
                <option disabled selected>User Level*</option>
                <option value="admin">Admin</option>
              </select></p>
              <input class="w3-input w3-border w3-animate-input" type="text" id="iauname" onblur="CheckAdminUserName()" placeholder="User name*" name="auname" required autocomplete="off"></p>            
              <input class="w3-input w3-border w3-animate-input" type="text" placeholder="First name*" id="iafname" name="afname" required autocomplete="off"></p>            
              <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Last name*" id="ialname" name="alname" required autocomplete="off"></p>                     
              <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Company name" id="iacname" name="acname"></p>           
              <input class="w3-input w3-border w3-animate-input" type="text" placeholder="City*" id="iacity" name="acity" required autocomplete="off"></p>          
              <input class="w3-input w3-border w3-animate-input" type="number" onkeypress="aa2()" placeholder="Phone number*" id="iapnumber" name="apnumber" required autocomplete="off">
              <label id="iapn" style="display: none;color: red;"></label></p>          
              <input class="w3-input w3-border w3-animate-input" type="email" onkeypress="gg2()" placeholder="Email address*" id="iaemail" name="aemail" required autocomplete="off">
              <label id="iaem" style="display: none;color: red;"></label></p>                     
              <input class="w3-input w3-border w3-animate-input" type="number" onkeypress="uu2()" placeholder="Zip code" id="iazcode" name="azcode">
              <label id="iazc" style="display: none;color: red;"></label></p>           
              <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Nationality*" id="ianat" name="anat"></p>          
              <select required class="w3-input w3-border w3-animate-input" placeholder="Sex*" id="iasex" name="asex" autofocus="off">
                <option disabled selected="selected"><span style="">Sex*</span></option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select></p>          
              <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Religion*" id="iarel" name="arel"></p>          
              <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Blood group*" id="iabgr" name="abgr"></p>
              <input required autocomplete="off" type="text" class="span2" placeholder="Date of birth*" name="adpt" id="iadpt"><br></p>          
              <input class="w3-input w3-border w3-animate-input" type="password" placeholder="Enter Password*" id="iapass" name="apass" required autocomplete="off"></p>          
              <input class="w3-input w3-border w3-animate-input" type="password" placeholder="Confirm Password*" onkeyup="check_confirm_pass_for_admin()" id="iacpass" name="acpass" required autocomplete="off">
              <label id="iancp" style="display: none;color: red;"></label>
              <button class="w3-btn-block w3-green w3-section w3-padding"  onclick="submitANewAdmin()" id="isubmitAdmin" name="submitAdmin" type="button">Add</button>
            </div>
          </form>
          <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
            <button onclick="document.getElementById('adminDetails').style.display='none'" type="button" class="w3-btn w3-red">Cancel</button>
          </div>
        </div>
      </div>
      <!-- End Of SIGN Up design div -->
      <!-- Edit admin details design div -->
      <div id="editAdminDetails" class="w3-modal">
        <div class="w3-modal-content w3-card-8 w3-animate-zoom" style=" margin-top: -30px; max-width:600px">
          <div class="w3-center"><br>
            <span onclick="$('#editAdminDetails').hide()" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span><br>
          </div>
          <form id="ieditAAdminDetailsForm" name="editAAdminDetailsForm" class="w3-container" action="editAAdminDetails.php" autocomplete="off" method="post" enctype="multipart/form-data">
            <div class="w3-section">
              <img id="editAdminDummyProfilePic" src="../pic/avatar.jpg" alt="Avatar" style="margin-left: 175px;width:250px;height: 200px;" class="w3-circle w3-margin-top"><br>
              <label><b>UPLOAD PIC</b></label>
              <label class="w3-btn-block w3-green w3-section w3-padding">
                <input type="file" onchange="readURL(this,'#editAdminDummyProfilePic')" id="ieditAdminProfilePic" name="editAdminProfilePic" style="display: none" accept="image/gif,image/jpeg,image/jpg" autocomplete="off">Choose a Pic*
              </label><br>
              <label><b>User Level</b></label>
              <select required class="w3-input w3-border w3-animate-input" placeholder="User level*" id="ieaulevel" name="eaulevel" autofocus="off">
                <option selected disabled>Choose One*</option>
                <option value="admin">Admin</option>
              </select></p>
              <label><b>User Name</b></label>
              <input readonly class="w3-input w3-border w3-animate-input" type="text" id="ieauname" placeholder="User name*" name="eauname" required autocomplete="off"></p>
              <label><b>First Name</b></label>            
              <input class="w3-input w3-border w3-animate-input" type="text" placeholder="First name*" id="ieafname" name="eafname" required autocomplete="off"></p>
              <label><b>Last Name</b></label>            
              <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Last name*" id="iealname" name="ealname" required autocomplete="off"></p>
              <label><b>Company Name</b></label>                     
              <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Company name" id="ieacname" name="eacname"></p>
              <label><b>City</b></label>           
              <input class="w3-input w3-border w3-animate-input" type="text" placeholder="City*" id="ieacity" name="eacity" required autocomplete="off"></p>
              <label><b>Phone Number</b></label>          
              <input class="w3-input w3-border w3-animate-input" type="number" onkeypress="aa3()" placeholder="Phone number*" id="ieapnumber" name="eapnumber" required autocomplete="off">
              <label id="ieapn" style="display: none;color: red;"></label></p>
              <label><b>Email Address</b></label>          
              <input class="w3-input w3-border w3-animate-input" type="email" onkeypress="gg3()" placeholder="Email address*" id="ieaemail" name="eaemail" required autocomplete="off">
              <label id="ieaem" style="display: none;color: red;"></label></p>
              <label><b>Zip Code</b></label>                     
              <input class="w3-input w3-border w3-animate-input" type="number" onkeypress="uu3()" placeholder="Zip code" id="ieazcode" name="eazcode">
              <label id="ieazc" style="display: none;color: red;"></label></p>
              <label><b>Nationality</b></label>           
              <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Nationality*" id="ieanat" name="eanat"></p>
              <label><b>Sex</b></label>          
              <select required class="w3-input w3-border w3-animate-input" placeholder="Sex*" id="ieasex" name="easex" autofocus="off">
                <option disabled selected="selected"><span style="">Sex*</span></option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select></p>
              <label><b>Religion</b></label>          
              <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Religion*" id="iearel" name="earel"></p>
              <label><b>Blood Group</b></label>          
              <input required autocomplete="off" class="w3-input w3-border w3-animate-input" type="text" placeholder="Blood group*" id="ieabgr" name="eabgr"></p>
              <label><b>Date Of Birth</b></label>
              <input required autocomplete="off" type="text" class="span2" placeholder="Date of birth*" name="eadpt" id="ieadpt"><br></p>          
              <label id="isncp" style="display: none;color: red;"></label>
              <button class="w3-btn-block w3-green w3-section w3-padding" onclick="editAAdminDetails()" id="isubmitEditAdminDetails" name="submitEditAdminDetails" type="button">Edit</button>
            </div>
          </form>
          <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
            <button id="editAdminDetailsPanelCancleButton" onclick="$('#editAdminDetails').hide()" type="button" class="w3-btn w3-red">Cancel</button>
          </div>
        </div>
      </div>
      <!-- End Of Edit admin details design div -->
		</div>
  </section>
  <?php include 'customPopupMessage.php'; ?>
</body>
</html>
<?php } else { header("location:../index.php"); }?>