<?php
session_start();
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
    <script src="js/mgCourses.js" type="text/javascript"></script>
  </head>
  <body class="w3-theme">
    <?php include 'pageSideNavigationBar.php'; ?>
    <section class="w3-row-padding w3-theme" style="margin-left:165px;" id="main-content">
      <div id="guts">
        <a style=" margin-left: 88%;width: 11%;border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding" onclick="$('#addACourse').show()">Add A Course</a><br>
        <!-- TABLE TO SHOW THE DATA -->
        <div class="w3-container">
          <p>Available Course details....</p>
          <table id="myTable" class="display" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" width="100%">
            <thead>
              <tr>
                <th>Course Name</th>
                <th>Vendor Name</th>
                <th>Course Pic</th>
                <th>Course Code</th>
                <th data-orderable="false">Course Adding Date</th>
                <th>course Details</th>
                <th>Delete Course</th>
                <th>Add A Batch</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $conn=mysqli_connect("localhost", "root", "")or die("cannot connect to server"); 
              mysqli_select_db($conn,"tsms")or die("cannot select DB");
              $sql = "select * from courses";
              $result = mysqli_query($conn,$sql);
              while($row=mysqli_fetch_assoc($result)){?>
              <tr>
                <td><div class="courseFunctionalButton" onclick="coursename(this)" id="co3"><?php echo $row["name"]; ?></div></td>
                <td id="co1"><div><?php echo $row["vendor_heading"]; ?></div></td>
                <td id="co2"><div><img height="60px" width="80px" src="<?php echo $row["pic_path"]; ?>"></div></td>          
                <td id="co4"><div><?php echo $row["code"]; ?></div></td> 
                <td id="co5"><div><?php echo $row["adding_date"]; ?></div></td>
                <td id="co6"><div><?php echo $row["details"]; ?></div></td>
                <td ><a class="courseFunctionalButton" onclick="sendCourseNameToDeleteACourse(this)">Delete</a></td>
                <td><a class="courseFunctionalButton" onclick="idna(this)">Add</a></td>
              </tr>
              <?php }?>
            </tbody>
          </table><br>
        </div>
        <!-- stsrt of floating display of add a course-->
        <div id="addACourse" class="w3-modal">
          <div class="w3-modal-content w3-card-8 w3-animate-zoom" style=" margin-top: -30px; max-width:600px">
            <div class="w3-center"><br>
              <span onclick="$('#addACourse').hide()" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
            </div>
            <form id="iaddcourse" name="addcourse" class="w3-container" method="post" action="bind2.php" method="post" enctype="multipart/form-data">
              <div class="w3-section">
                <input style="display: none;" class="w3-input w3-border w3-animate-input" type="text" id="ihidecourseinvendor" name="hidecourseinvendor">
                <h2 id="courseinvendor" class="w3-text-black"></h2></p>      
                <img style="height: 250px;width: 250px;margin-left: 27%;border-radius: 3px;" id="inayan2" src="../pic/avatar.jpg" class="nayan2"><br>
                <label style="border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding">
                  <input style="display: none;" type="file" autocomplete="off" name="file_img2" id="ifile_img2" onchange="readURL(this,'#inayan2')">Choose A Pic*
                </label>
                <select class="w3-border w3-input" name="vendorName" id="ivendorName" autofocus="off">
                  <option disabled selected >Choose A Vendor*</option>
                  <?php
                  $conn=mysqli_connect("localhost","root","") or die("Unable to connect database server.");
                  mysqli_select_db($conn,'tsms') or die("Unable to select DB.");
                  $sql="SELECT heading from vendors;";
                  $result=mysqli_query($conn,$sql);
                  while ($row=mysqli_fetch_assoc($result)) {?>
                  <option><?php echo $row["heading"]; ?></option>
                  <?php }?>
                </select></br>
                <input class="w3-input w3-border w3-animate-input" type="text" onkeyup="uppercase(this)" onblur="checkcoursename()" placeholder="Course Name*" id="inocou" name="nocou" required autocomplete="off"><br>
                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Course Code*" id="icocou" name="cocou" required autocomplete="off"><br>
                <textarea required placeholder="Details Of Course" autocomplete="off" name="docou" id="idocou" class="w3-input w3-border" type="text" style="float:right;width:100%" placeholder="Course Details*"></textarea>
                <button style="float: right;width: 45%;border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding" onclick="addCourse()" name="submitcou" type="button">Add</button>
              </div>
            </form>
            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
              <button onclick="$('#addACourse').hide()" type="button" id="id02cancle" class="w3-btn w3-red">Cancel</button>
            </div>
          </div>
        </div>
        <!-- end of floating display of add a course -->
        <!-- start of floating display view and edit details of couses-->
        <div id="id02" class="w3-modal">
          <div class="w3-modal-content w3-card-8 w3-animate-zoom" style=" margin-top: -30px; max-width:600px">
            <div class="w3-center"><br>
              <span onclick="$('#id02').hide()" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
            </div>
            <form id="icourseeditform" name="courseeditform" class="w3-container" method="post" action="editcoursedata.php" method="post" enctype="multipart/form-data">
              <div class="w3-section">
                <h2 class="w3-text-black">Edit or remove Course</h2></p>      
                <label class="w3-text-black"><b>Picture</b></label></br></br>
                <img style="height: 250px;width: 250px;margin-left: 27%;" id="icoup" src="" class="coup"></br>
                <label style="border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding">
                  <input style="display: none;" type="file" autocomplete="off" name="file_img1" onchange="readURL(this,'#icoup')">Change Pic
                </label></p>      
                <label class="w3-text-black"><b>Course Name</b></label></br>
                <input class="w3-input w3-border w3-animate-input" type="text" id="icorname" name="corname" readonly></br>      
                <label class="w3-text-black"><b>Course Belong Vendor</b></label></br>
                <input class="w3-input w3-border w3-animate-input" type="text" id="icbvn" name="cbvn"></br>
                <label class="w3-text-black"><b>Course Code</b></label>
                <input class="w3-input w3-border w3-animate-input" type="text" id="icouc" name="couc"></br>
                <label class="w3-text-black"><b>Course Adding date</b></label></br>
                <input type="text" class="span2" name="cad" id="icad"></br></br>
                <label class="w3-text-black"><b>Course details</b></label>
                <textarea required  autocomplete="off" name="coudetails" class="w3-input w3-border" id="icoudetails" type="text" style="float:right;width:100%;"></textarea>
                <button style="float: right;width: 45%;border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding"  onclick="coudeletex()" name="submitdeletecou" type="button">DELETE</button>
                <button style="border-radius: 2px;width: 45%" class="w3-left w3-btn-block w3-green w3-section w3-padding" onclick="coueditx()" name="submiteditcou" type="button">Edit</button>
              </div>
            </form>
            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
              <button onclick="$('#id02').hide()" type="button" id="id02cancle" class="w3-btn w3-red">Cancel</button>
            </div>
          </div>
        </div>
        <!-- end of floating display view and edit details of courses-->
        <!-- start of floating display to add a batch into a couses-->
        <div id="id09" class="w3-modal">
          <div class="w3-modal-content w3-card-8 w3-animate-zoom" style=" margin-top: -30px; max-width:600px">
            <div class="w3-center"><br>
              <span onclick="$('#id09').hide()" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
            </div>
            <form id="iaddABatch" name="addABatch" class="w3-container" method="post" enctype="multipart/form-data">
              <div class="w3-section">
                <input style="display: none;" type="text" value="" id="ihcourseName" name="hcourseName">
                <h2 class="w3-text-black" id="addABatchPanelHeading"></h2></p>      
                <input class="w3-input w3-border w3-animate-input" type="text" onblur="checkBatchCode()" placeholder="Batch Code*" id="ibatchCode" name="batchCode" required autocomplete="off"></br>
                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Batch Starting Date*" id="ibatchStartingDate" name="batchStartingDate" required autocomplete="off"></br>
                <input onkeypress="$('#limitDayExitWarning').show(),$('#limitDayExitWarning').html('Plase insert a value [1|2].Means, how many day of this batch class will be held in one Week')" onfocus="$('#limitDayExitWarning').show(),$('#limitDayExitWarning').html('Plase insert a value [1|2].Means, how many day of this batch class will be held in one Week')" class="w3-input w3-border w3-animate-input" type="number" placeholder="Day In A Week*" id="idayInAWeek" name="dayInAWeek" autocomplete="off">
                <label id="limitDayExitWarning" style="display: none;color: red;"></label></br>
                <div>
                  <select style="display: none;width: 30%;margin-right: 4%;" class="w3-border w3-input" name="batchDay" id="ibatchDay" autofocus="off">
                    <option disabled selected >Choose A Day*</option>
                    <option>Saturday</option>
                    <option>Sunday</option>
                    <option>Monday</option>
                    <option>Tuesday</option>
                    <option>Wednesday</option>
                    <option>Thursday</option>
                    <option>Friday</option>
                  </select>
                  <select style="display: none;width: 30%;" class="w3-border w3-input" name="day1StartTime" id="iday1StartTime" autofocus="off">
                    <option disabled selected >Choose A Time*</option>
                  </select>
                  <span id="toIndicator" style="display: none;">To</span>
                  <select style="display: none;width: 30%;margin-bottom: 20px;" class="w3-border w3-input" name="day1EndTime" id="iday1EndTime" autofocus="off">
                    <option disabled selected >Choose A Time*</option>
                  </select>
                  <select style="display: none;width: 30%;margin-right: 4%;" class="w3-border w3-input" name="batch2Day" id="ibatch2Day" autofocus="off">
                    <option disabled selected >Choose A Day*</option>
                    <option>Saturday</option>
                    <option>Sunday</option>
                    <option>Monday</option>
                    <option>Tuesday</option>
                    <option>Wednesday</option>
                    <option>Thursday</option>
                    <option>Friday</option>
                  </select>
                  <select style="display: none;width: 30%;" class="w3-border w3-input" name="day2StartTime" id="iday2StartTime" autofocus="off">
                    <option disabled selected >Choose A Time*</option>
                  </select>
                  <span id="to2Indicator" style="display: none;">To</span>
                  <select style="display: none;width: 30%;margin-bottom: 20px;" class="w3-border w3-input" name="day2EndTime" id="iday2EndTime" autofocus="off">
                    <option disabled selected >Choose A Time*</option>
                  </select>
                </div>
                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Room Number*" id="ibatchRoomNumber" name="batchRoomNumber" required autocomplete="off"><br>
                <select class="w3-input w3-border w3-animate-input" name="assignABatchFaculty" id="iassignABatchFaculty" required autofocus="off">
                  <option disabled selected >Choose A Faculty*</option>
                  <?php
                  $conn=mysqli_connect("localhost", "root", "","tsms")or die("Cannot Connect To Database Server"); 
                  $sql = "SELECT faculty_name from faculties;";
                  $result = mysqli_query($conn,$sql);
                  while($row=mysqli_fetch_assoc($result)){?>
                    <option value="'.$row['faculty_name'].'"><?php echo $row['faculty_name']; ?></option>';
                  <?php }?>
                </select><br>
                <input class="w3-input w3-border w3-animate-input " type="number" placeholder="Amount*" id="ibatchAmount" name="batchAmount" required autocomplete="off"><br>
                <textarea autocomplete="off" name="batchDetails" id="ibatchDetails" class="w3-input w3-border" type="text" style="width:100%" placeholder="Batch Details"></textarea>
                <button style="float: right;width: 45%;border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding" onclick="addANewBatch()" name="submitBatch" type="button">Add</button>
              </div>
            </form>
            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
              <button onclick="$('#id09').hide()" type="button" id="id02cancle" class="w3-btn w3-red">Cancel</button>
            </div>
          </div>
        </div>
        <!-- end of floating display to add a batch into a courses-->
      </div>
    </section>
    <?php include 'customPopupMessage.php'; ?>
  </body>
</html>
<?php } else { header("location:../index.php"); }?>
