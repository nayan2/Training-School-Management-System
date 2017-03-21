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
  <?php include 'pageHead.php';  ?>
</head>
<body class="w3-theme" onload="cnayan()">
  <?php include 'pageSideNavigationBar.php'; ?>
  <section class="w3-row-padding w3-theme" style="margin-left:165px;" id="main-content">
    <div id="guts"> 
      <div class="w3-container w3-padding-32 w3-theme-d1"><h1>User Profile</h1></div>
      <div id="login">
        <form name='form-login' method="post" action="changeprofilepic.php" enctype="multipart/form-data">
          <h2 style="color: #808080;display: inline;">Profile: </h2>
          <h1 style="display: inline;" id="pronameofuser"></h1><br></p></br>
          <label style="position: absolute;margin-top: 260px;width: 15%;border-radius: 4px;margin-left: 24px" class="w3-btn w3-green">
            <input autocomplete="off" required  name="file_img" id="ifile_img" accept="image/gif,image/jpeg,image/jpg" onchange="readURL(this,'#venpic')" type="file" style="display: none;">Change Pic
          </label>
          <div class="clearfix float-my-children">
            <img style="display:inline;border-radius: 3px;height: 250px;width: 250px;" id="venpic" src="../pic/avatar.jpg"> 
            <h2 style="margin-left: 20px;margin-top: -10px;">Account Information</h2>
            <div style="margin-top: 40px;margin-left: -525px;">  
              <div class="block">
                <label>User Id:</label>
                <h6 id="User_Id"></h6><hr>
              </div>
              <div class="block">
                <label>User Level:</label>
                <h6 id="User_Level"></h6><hr>
              </div>
              <div class="block">
                <label>UserName:</label>
                <h6 id="UserName"></h6><hr>
              </div>
              <div class="block">
                <label>First Name:</label>
                <h6 id="First_Name"></h6><hr>
              </div>
              <div class="block">
                <label>Last Name:</label>
                <h6 id="Last_Name"></h6><hr>
              </div>
              <div class="block">
                <label>Company Name:</label>
                <h6 id="Company_Name"></h6><hr>
              </div>
              <div class="block">
                <label>City:</label>
                <h6 id="City"></h6><hr>
              </div>
              <div class="block">
                <label>Phone Number:</label>
                <h6 id="Phone_Number"></h6><hr>
              </div>
              <div class="block">
                <label>Email:</label>
                <h6 id="Email"></h6><hr>
              </div>
              <div class="block">
                <label>Zip Code:</label>
                <h6 id="Zip_Code"></h6><hr>
              </div>
              <div class="block">
                <label>Nationality:</label>
                <h6 id="Nationality"></h6><hr>
              </div>
              <div class="block">
                <label>Sex:</label>
                <h6 id="Sex"></h6><hr>
              </div>
              <div class="block">
                <label>Religion:</label>
                <h6 id="Religion"></h6><hr>
              </div>
              <div class="block">
                <label>Blood Group:</label>
                <h6 id="Blood_Group"></h6><hr>
              </div>
              <div class="block">
                <label>Date of Birth:</label>
                <h6 id="Date_of_Birth"></h6><hr>
              </div>
              <div class="block">
                <label>User Activation Date:</label>
                <h6 id="User_Activation_Date"></h6><hr>
              </div>
              <div class="block">
                <label>User Deactivation Date:</label>
                <h6 id="User_Deactivation_Date"></h6><hr>
              </div>                                  
            </div>
          </div></p>
          <input style="margin-top: 10px;margin-left: 80.8%;width: 15%;border-radius: 4px;" class="w3-btn w3-green" type="submit" name="sub" value="Apply"> 
        </form>
      </div>
    </div>
  </section>
  <?php include 'customPopupMessage.php'; ?>
</body>
</html>
<?php } else{ header("location:../index.php"); }?>