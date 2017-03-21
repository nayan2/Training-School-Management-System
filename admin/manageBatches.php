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
    <?php require_once 'pageHead.php'; ?>
    <script src="js/mgBatches.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function(){
        $('#ibatchStartingDate , #iebatchStartingDate').fdatepicker({
          format: 'yyyy-mm-dd',
          disableDblClickSelection: true,
          language: 'vi',
        });
      });
    </script>
  </head>
  <body class="w3-theme">
    <?php include 'pageSideNavigationBar.php'; ?>
    <section class="w3-row-padding w3-theme" style="margin-left:165px;" id="main-content">
      <div id="guts">
        <a style=" margin-left: 88%;width: 11%;border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding" onclick="$('#addABatch').show()">Add A Batch</a><br>
        <!-- TABLE TO SHOW THE DATA -->
        <div class="w3-container">
          <p>Available Batch details....</p>
          <table id="myTable" class="display" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" width="100%">
            <thead>
              <tr>
                <th>Batch Code</th>
                <th>Course Name</th>
                <th data-orderable="false">Batch Starting Date</th>
                <th>Faculty Name</th>
                <th>Room Number</th>
                <th>Amount</th>
                <th>Routine</th>
                <th>Delete Batch</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $conn=mysqli_connect("localhost", "root", "") or die("unable to connected database server");
              mysqli_select_db($conn,"tsms") or die("unable to select db");
              $sql="SELECT * from Batches;";
              $result=mysqli_query($conn, $sql) or die("Unable to execute query;");
              while ($row=mysqli_fetch_array($result)) {?>
              <tr>
                <td class="batchUnderline" onclick="idna(this)"><?php echo $row["batch_code"]; ?></td>
                <td class="batchUnderline" ><a href="managecourses.php#search=<?php echo $row["course_name"]; ?>"><?php echo $row["course_name"]; ?></a></td>
                <td><?php echo $row["batch_starting_date"]; ?></td>
                <td class="batchUnderline" style="width: 150px;"><a href="manageinstructors.php#search=<?php echo $row["faculty_name"];?>"><?php echo $row["faculty_name"];?></a></td>
                <td><?php echo $row["room_number"]; ?></td>
                <td><?php echo $row["amount"]; ?></td>
                <td><?php echo $row["routine"]; ?></td>
                <td class="batchUnderline" ><a onclick="sendBatchCodeToDelete(this)">Delete</a></td>
              </tr>
              <?php }?>
            </tbody>
          </table><br>
        </div>  
        <!-- start of showing student list depends on batch -->
        <p>Available Batch list....</p>
        <select onchange="studentDetailsAgainstBatch()" style="text-align: right;" class="w3-border w3-input" name="batchListAgainstStudent" id="batchListAgainstStudent" autofocus="off">
          <option disabled selected >Select A Batch To View Student List</option>
          <?php
          $conn = mysqli_connect("localhost", "root", "", "tsms") or die("Cannot Connect To Database Server");
          $query = "SELECT batch_code FROM batches;";
          $result = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_assoc($result)) {?>
          <option value="<?php echo $row["batch_code"]; ?>"><?php echo $row["batch_code"]; ?></option>
          <?php } ?>
        </select>
        <p>Available Student Details.....</p>
          <table id="studentDetails" class="display" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" width="100%">
            <thead>
              <tr>
                <th>first name</th>
                <th>last name</th>
                <th>Username</th>
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
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Username</td>
                <td>Pic</td>
                <td>Company Name</td>
                <td>City</td>
                <td>Phone Number</td>
                <td>Email</td>
                <td>Zip Code</td>
                <td>Nationality</td>
                <td>Sex</td>
                <td>Religion</td>
                <td>Blood Group</td>
                <td>Date Of Birth</td>
              </tr>
            </tbody>
          </table>
        <!-- end of showing student list depends on batch -->
        <!-- start of floating display to add a batch into a couses-->
        <div id="addABatch" class="w3-modal">
          <div class="w3-modal-content w3-card-8 w3-animate-zoom" style=" margin-top: -30px; max-width:600px">
            <div class="w3-center"><br>
              <span onclick="document.getElementById('addABatch').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
              <h2>Add A New Batch</h2>
            </div>
            <form id="iaddABatchForm" name="addABatchForm" class="w3-container" method="post" enctype="multipart/form-data">
              <div class="w3-section">      
                <select onchange="fillChooseACourse()" class="w3-border w3-input" name="chooseAVendor" id="ichooseAVendor" autofocus="off">
                  <option disabled selected >Choose A Vendor*</option>
                  <?php
                  $conn=mysqli_connect("localhost", "root", "","tsms")or die("cannot connect to server or ubale to select db"); 
                  $sql = "SELECT heading from vendors;";
                  $result = mysqli_query($conn,$sql);
                  while($row=mysqli_fetch_assoc($result)){?>
                  <option value="<?php echo $row['heading']; ?>"><?php echo $row['heading']; ?></option>';
                  <?php }?>
                </select><br>
                <select style="" class="w3-border w3-input" name="chooseACourse" id="ichooseACourse" autofocus="off">
                  <option disabled selected >Choose A Course*</option>
                </select><br>
                <input class="w3-input w3-border w3-animate-input" type="text" onblur="checkBatchCode()" placeholder="Batch Code*" id="ibatchCode" name="batchCode" required autocomplete="off"><br>
                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Batch Starting Date*" id="ibatchStartingDate" name="batchStartingDate" required autocomplete="off"></br>
                <input onkeypress="$('#limitDayExitWarning').show(),$('#limitDayExitWarning').html('Plase insert a value [1|2].Means, how many day of this batch class will be held in one Week')" onfocus="$('#limitDayExitWarning').show(),$('#limitDayExitWarning').html('Plase insert a value [1|2].Means, how many day of this batch class will be held in one Week')" class="w3-input w3-border w3-animate-input" type="number" placeholder="Day In A Week*" id="idayInAWeek" name="dayInAWeek" autocomplete="off">
                <label id="limitDayExitWarning" style="display: none;color: red;"></label><br>
                <script type="text/javascript">
                  $('#idayInAWeek').keyup(function(){
                    dayInAWeek = $(this).val();
                    if(dayInAWeek == 1){
                      $('#limitDayExitWarning').hide();
                      $('#limitDayExitWarning').html("");
                      $("#ibatchDay,#iday1StartTime,#iday1EndTime,#toIndicator").show();
                      $("#ibatchDay,#iday1StartTime,#iday1EndTime,#toIndicator").css('display','inline');
                    }
                    else if(dayInAWeek == 2)
                    {
                      $('#limitDayExitWarning').hide();
                      $('#limitDayExitWarning').html("");
                      $("#ibatchDay,#iday1StartTime,#iday1EndTime,#toIndicator,#ibatch2Day,#iday2StartTime,#iday2EndTime,#to2Indicator").show();
                      $("#ibatchDay,#iday1StartTime,#iday1EndTime,#toIndicator,#ibatch2Day,#iday2StartTime,#iday2EndTime,#to2Indicator").css('display','inline');
                    }
                    else if(dayInAWeek == "")
                    {
                      $('#limitDayExitWarning').hide();
                      $('#limitDayExitWarning').html("");
                      $("#ibatchDay,#iday1StartTime,#iday1EndTime,#toIndicator").hide();
                      $("#ibatchDay,#iday1StartTime,#iday1EndTime,#toIndicator,#ibatch2Day,#iday2StartTime,#iday2EndTime,#to2Indicator").hide();
                    }
                    else
                    {
                      $('#limitDayExitWarning').show();
                      $('#limitDayExitWarning').html('Not applicable more than Two');
                    }
                  });
                </script>
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
                  <script type="text/javascript">
                    for(var i = 10; i <= 20; i+=.30)
                    {
                      var ij=i.toFixed(2);
                      var jk=(i % 1).toFixed(1);
                      if(jk == .6){
                        ij=+ij + +.40;
                        i=+i + +.40;
                      }
                      if(i >= 12)
                      {
                        if(i >= 13)
                        {
                          ij= (+ij - +12).toFixed(2);
                        }
                        val=ij+' PM';
                        tex=ij+' PM';
                      }
                      else
                      {
                        val=ij+' AM';
                        tex=ij+' AM';
                      }
                      $('#iday1StartTime').append($('<option>', {
                        value: val,
                        text: tex
                      }));
                    }
                    $('#iday1StartTime').change(function(){
                      var originialValueOfDay1StartTime=$(this).val().split(' ')[0];
                      $('#iday1EndTime option').remove();
                      $('#iday1EndTime').append("<option disabled selected >"+'Choose A Time*'+"</option>");

                      for(var i = +originialValueOfDay1StartTime + .30; i <= 20; i += .30){
                        var modifyedi=i.toFixed(2);
                        var afterDotOfi=(modifyedi.split('.')[1]).split('')[0];

                        if(afterDotOfi == 6){
                          modifyedi = +modifyedi + .40; 
                          i = +i + .40;
                        }
                        if(+modifyedi >= 13){
                          modifyedi = (+modifyedi - 12).toFixed(2);
                        }
                        if(+originialValueOfDay1StartTime <= 8 && +originialValueOfDay1StartTime >= 1){
                          if(+modifyedi == 8.30){
                            break;
                          }
                        }
                        if(+modifyedi <= 8 && +modifyedi >= 1){
                          modifyedi = modifyedi + ' PM';
                        }else if(+modifyedi >= 10 && +modifyedi <= 11.30){
                          modifyedi = modifyedi + ' AM';
                        }else{
                          modifyedi = modifyedi + ' PM';
                        }
                        $('#iday1EndTime').append("<option>"+modifyedi+"</option>");
                      }
                    });
                  </script>
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
                  <script type="text/javascript">
                    for(var i = 10; i <= 20; i+=.30)
                    {
                      var ij=i.toFixed(2);
                      var jk=(i % 1).toFixed(1);
                      if(jk == .6){
                        ij=+ij + +.40;
                        i=+i + +.40;
                      }
                      if(i >= 12)
                      {
                        if(i >= 13)
                        {
                          ij= (+ij - +12).toFixed(2);
                        }
                        val=ij+' PM';
                        tex=ij+' PM';
                      }
                      else
                      {
                        val=ij+' AM';
                        tex=ij+' AM';
                      }
                      $('#iday2StartTime').append($('<option>', {
                        value: val,
                        text: tex
                      }));
                    }
                    $('#iday2StartTime').change(function(){
                      var originialValueOfDay2StartTime=$(this).val().split(' ')[0];
                      $('#iday2EndTime option').remove();
                      $('#iday2EndTime').append("<option disabled selected >"+'Choose A Time*'+"</option>");

                      for(var i = +originialValueOfDay2StartTime + .30; i <= 20; i += .30){
                        var modifyedi=i.toFixed(2);
                        var afterDotOfi=(modifyedi.split('.')[1]).split('')[0];

                        if(afterDotOfi == 6){
                          modifyedi = +modifyedi + .40; 
                          i = +i + .40;
                        }
                        if(+modifyedi >= 13){
                          modifyedi = (+modifyedi - 12).toFixed(2);
                        }
                        if(+originialValueOfDay2StartTime <= 8 && +originialValueOfDay2StartTime >= 1){
                          if(+modifyedi == 8.30){
                            break;
                          }
                        }
                        if(+modifyedi <= 8 && +modifyedi >= 1){
                          modifyedi = modifyedi + ' PM';
                        }else if(+modifyedi >= 10 && +modifyedi <= 11.30){
                          modifyedi = modifyedi + ' AM';
                        }else{
                          modifyedi = modifyedi + ' PM';
                        }
                        $('#iday2EndTime').append("<option>"+modifyedi+"</option>");
                      }
                    });
                  </script>
                  <span id="to2Indicator" style="display: none;">To</span>
                  <select style="display: none;width: 30%;margin-bottom: 20px;" class="w3-border w3-input" name="day2EndTime" id="iday2EndTime" autofocus="off">
                    <option disabled selected >Choose A Time*</option>
                  </select>
                </div>
                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Room Number*" id="ibatchRoomNumber" name="batchRoomNumber" required autocomplete="off"><br>
                <select class="w3-input w3-border w3-animate-input" name="assignABatchFaculty" id="iassignABatchFaculty" required autofocus="off">
                  <option disabled selected >Choose A Faculty*</option>
                  <?php
                  $conn=mysqli_connect("localhost", "root", "")or die("cannot connect to server"); 
                  mysqli_select_db($conn,"tsms")or die("cannot select DB");
                  $sql = "SELECT faculty_name from faculties;";
                  $result = mysqli_query($conn,$sql);
                  while($row=mysqli_fetch_assoc($result)){?>
                  <option value="<?php echo $row['faculty_name']; ?>"><?php echo $row['faculty_name']; ?></option>
                  <?php }?>
                </select><br>
                <input class="w3-input w3-border w3-animate-input " type="number" placeholder="Amount*" id="ibatchAmount" name="batchAmount" required autocomplete="off"><br>
                <textarea autocomplete="off" name="batchDetails" id="ibatchDetails" class="w3-input w3-border" type="text" style="width:100%" placeholder="Batch Details"></textarea>
                <button style="float: right;width: 45%;border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding" onclick="addANewBatchFromBatchPanel()" name="submitBatch" type="button">Add</button>
              </div>
            </form>
            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
              <button onclick="$('#addABatch').hide()" type="button" id="id02cancle" class="w3-btn w3-red">Cancel</button>
            </div>
          </div>
        </div>
        <!-- end of floating display to add a batch into a courses-->
        <!-- start of floating display to edit a batch -->
        <div id="editABatch" class="w3-modal">
          <div class="w3-modal-content w3-card-8 w3-animate-zoom" style=" margin-top: -30px; max-width:600px">
            <div class="w3-center"><br>
              <span onclick="$('#editABatch').hide(),showDayTime('','');" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
              <h2>Edit A Batch</h2>
            </div>
            <form id="ieditABatchForm" name="editABatchForm" class="w3-container" method="post" enctype="multipart/form-data">
              <div class="w3-section">
                <label><b>Vendor Name</b></label> 
                <select onchange="fillToEditACourse()" style="" class="w3-border w3-input" name="chooseToEditAVendor" id="ichooseToEditAVendor" autofocus="off">
                  <option disabled selected >Choose A Vendor*</option>
                  <?php
                  $conn=mysqli_connect("localhost", "root", "","tsms")or die("cannot connect to server or ubale to select db"); 
                  $sql = "SELECT heading from vendors;";
                  $result = mysqli_query($conn,$sql);
                  while($row=mysqli_fetch_assoc($result)){?>
                  <option value="<?php echo $row['heading']; ?>"><?php echo $row['heading']; ?></option>';
                  <?php } ?>
                </select><br>
              <label><b>Course Name</b></label>
              <select style="" class="w3-border w3-input" name="chooseToEditACourse" id="ichooseToEditACourse" autofocus="off">
                <option disabled selected >Choose A Course*</option>
              </select><br>
              <label><b>Batch Code</b></label>
              <input class="w3-input w3-border w3-animate-input" type="text" onblur="checkToEditBatchCode()" placeholder="Batch Code*" id="iebatchCode" name="ebatchCode" required autocomplete="off"><br>
              <label><b>Batch Starting Date</b></label>
              <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Batch Starting Date*" id="iebatchStartingDate" name="ebatchStartingDate" required autocomplete="off"><br>
              <label><b>Batch Routine</b></label>
              <input onclick="if($('#iebatchRoutine').val().indexOf('and') > -1){showDayTime(2,$('#iebatchRoutine').val());}else{showDayTime(1,$('#iebatchRoutine').val());}" readonly class="w3-input w3-border w3-animate-input" type="text" placeholder="Batch Routine" id="iebatchRoutine" name="batchRoutine" autocomplete="off"></br>
              <script type="text/javascript">
                function showDayTime(dayInAWeek,text){
                    if($("#iebatchDay,#ieday1StartTime,#ieday1EndTime,#etoIndicator,#iebatch2Day,#ieday2StartTime,#ieday2EndTime,#eto2Indicator,#iebatchDay,#ieday1StartTime,#ieday1EndTime,#etoIndicator,#iebatch2Day,#ieday2StartTime,#ieday2EndTime,#eto2Indicator").css("display") == "none"){
                      var day1,day2,day1Day,day1StartTime,day1EndTime,day2Day,day2StartTime,day2EndTime="";

                      if(dayInAWeek == 1){
                        $('#elimitDayExitWarning').hide();
                        $('#elimitDayExitWarning').html("");
                        $("#iebatchDay,#ieday1StartTime,#ieday1EndTime,#etoIndicator").show();
                        $("#iebatchDay,#ieday1StartTime,#ieday1EndTime,#etoIndicator").css('display','inline');

                        day1Day=$.trim(text.split('-')[0]);
                        day1StartTime=$.trim((text.split('-')[1]).split('to')[0]);
                        day1EndTime=$.trim((text.split('-')[1]).split('to')[1]);

                        $('#iebatchDay').val(day1Day);
                        
                        $('#ieday1StartTime').val(day1StartTime);
                        $('#ieday1StartTime').trigger('change');
                        $('#ieday1EndTime').val(day1EndTime);
                      }
                      else if(dayInAWeek == 2)
                      {
                        $('#elimitDayExitWarning').hide();
                        $('#elimitDayExitWarning').html("");
                        $("#iebatchDay,#ieday1StartTime,#ieday1EndTime,#etoIndicator,#iebatch2Day,#ieday2StartTime,#ieday2EndTime,#eto2Indicator").show();
                        $("#iebatchDay,#ieday1StartTime,#ieday1EndTime,#etoIndicator,#iebatch2Day,#ieday2StartTime,#ieday2EndTime,#eto2Indicator").css('display','inline');
                        
                        var day1=$.trim(text.split("and")[0]);
                        var day2=$.trim(text.split("and")[1]);

                        day1Day=$.trim(day1.split("-")[0]);
                        day1StartTime=$.trim((day1.split("-")[1]).split('to')[0]);
                        day1EndTime=$.trim((day1.split("-")[1]).split('to')[1]);

                        day2Day=$.trim(day2.split("-")[0]);
                        day2StartTime=$.trim((day2.split("-")[1]).split('to')[0]);
                        day2EndTime=$.trim((day2.split("-")[1]).split('to')[1]);


                        $('#iebatchDay').val(day1Day);
                        $('#iebatch2Day').val(day2Day);

                        $('#ieday1StartTime').val(day1StartTime);
                        $('#ieday1StartTime').trigger('change');
                        $('#ieday1EndTime').val(day1EndTime);

                        $('#ieday2StartTime').val(day2StartTime);
                        $('#ieday2StartTime').trigger('change');
                        $('#ieday2EndTime').val(day2EndTime);

                      }
                      else if(dayInAWeek == "")
                      {
                        $('#elimitDayExitWarning').hide(); 
                        $('#elimitDayExitWarning').html("");
                        $("#iebatchDay,#ieday1StartTime,#ieday1EndTime,#etoIndicator").hide();
                        $("#iebatchDay,#ieday1StartTime,#ieday1EndTime,#etoIndicator,#iebatch2Day,#ieday2StartTime,#ieday2EndTime,#eto2Indicator").hide();
                      }
                      else
                      {
                        $('#elimitDayExitWarning').show();
                        $('#elimitDayExitWarning').html('Not applicable more than Two');
                      }
                    }
                    else
                    {
                      $("#iebatchDay,#ieday1StartTime,#ieday1EndTime,#etoIndicator,#iebatch2Day,#ieday2StartTime,#ieday2EndTime,#eto2Indicator,#iebatchDay,#ieday1StartTime,#ieday1EndTime,#etoIndicator,#iebatch2Day,#ieday2StartTime,#ieday2EndTime,#eto2Indicator").hide();
                    }
                  }
              </script>
              <div>
                <select style="display: none;width: 30%;margin-right: 4%;" class="w3-border w3-input" name="ebatchDay" id="iebatchDay" autofocus="off">
                  <option disabled selected >Choose A Day*</option>
                  <option>Saturday</option>
                  <option>Sunday</option>
                  <option>Monday</option>
                  <option>Tuesday</option>
                  <option>Wednesday</option>
                  <option>Thursday</option>
                  <option>Friday</option>
                </select>
                <select style="display: none;width: 30%;" class="w3-border w3-input" name="eday1StartTime" id="ieday1StartTime" autofocus="off">
                  <option disabled selected >Choose A Time*</option>
                </select>
                <script type="text/javascript">
                  for(var i = 10; i <= 20; i+=.30)
                  {
                    var ij=i.toFixed(2);
                    var jk=(i % 1).toFixed(1);
                    if(jk == .6){
                      ij=+ij + +.40;
                      i=+i + +.40;
                    }
                    if(i >= 12)
                    {
                      if(i >= 13)
                      {
                        ij= (+ij - +12).toFixed(2);
                      }
                      val=ij+' PM';
                      tex=ij+' PM';
                    }
                    else
                    {
                      val=ij + ' AM';
                      tex=ij + ' AM';
                    }
                    $('#ieday1StartTime').append($('<option>', {
                      value: val,
                      text: tex
                    }));
                  }
                  $('#ieday1StartTime').change(function(){
                    var originialValueOfDay1EditStartTime=$(this).val().split(' ')[0];
                    $('#ieday1EndTime option').remove();
                    $('#ieday1EndTime').append("<option disabled selected >"+'Choose A Time*'+"</option>");

                    for(var i = +originialValueOfDay1EditStartTime + .30; i <= 20; i += .30){
                      var modifyedi=i.toFixed(2);
                      var afterDotOfi=(modifyedi.split('.')[1]).split('')[0];

                      if(afterDotOfi == 6){
                        modifyedi = +modifyedi + .40; 
                        i = +i + .40;
                      }
                      if(+modifyedi >= 13){
                        modifyedi = (+modifyedi - 12).toFixed(2);
                      }
                      if(+originialValueOfDay1EditStartTime <= 8 && +originialValueOfDay1EditStartTime >= 1){
                        if(+modifyedi == 8.30){
                          break;
                        }
                      }
                      if(+modifyedi <= 8 && +modifyedi >= 1){
                        modifyedi = modifyedi + ' PM';
                      }else if(+modifyedi >= 10 && +modifyedi <= 11.30){
                        modifyedi = modifyedi + ' AM';
                      }else{
                        modifyedi = modifyedi + ' PM';
                      }
                      $('#ieday1EndTime').append("<option>"+modifyedi+"</option>");
                    }
                  });
                </script>
                <span id="etoIndicator" style="display: none;">To</span>
                <select style="display: none;width: 30%;margin-bottom: 20px;" class="w3-border w3-input" name="eday1EndTime" id="ieday1EndTime" autofocus="off">
                  <option disabled selected >Choose A Time*</option>
                </select>
                <select style="display: none;width: 30%;margin-right: 4%;" class="w3-border w3-input" name="ebatch2Day" id="iebatch2Day" autofocus="off">
                  <option disabled selected >Choose A Day*</option>
                  <option value="Saturday">Saturday</option>
                  <option value="Sunday">Sunday</option>
                  <option value="Monday">Monday</option>
                  <option value="Tuesday">Tuesday</option>
                  <option value="Wednesday">Wednesday</option>
                  <option value="Thursday">Thursday</option>
                  <option value="Friday">Friday</option>
                </select>
                <select style="display: none;width: 30%;" class="w3-border w3-input" name="eday2StartTime" id="ieday2StartTime" autofocus="off">
                  <option disabled selected >Choose A Time*</option>
                </select>
                <script type="text/javascript">
                  for(var i = 10; i <= 20; i+=.30)
                  {
                    var ij=i.toFixed(2);
                    var jk=(i % 1).toFixed(1);
                    if(jk == .6){
                      ij=+ij + +.40;
                      i=+i + +.40;
                    }
                    if(i >= 12)
                    {
                      if(i >= 13)
                      {
                        ij= (+ij - +12).toFixed(2);
                      }
                      val=ij+' PM';
                      tex=ij+' PM';
                    }
                    else
                    {
                      val=ij+' AM';
                      tex=ij+' AM';
                    }
                    $('#ieday2StartTime').append($('<option>', {
                      value: val,
                      text: tex
                    }));
                  }
                  $('#ieday2StartTime').change(function(){
                    var originialValueOfDay2EditStartTime=$(this).val().split(' ')[0];
                    $('#ieday2EndTime option').remove();
                    $('#ieday2EndTime').append("<option disabled selected >"+'Choose A Time*'+"</option>");

                    for(var i = +originialValueOfDay2EditStartTime + .30; i <= 20; i += .30){
                      var modifyedi=i.toFixed(2);
                      var afterDotOfi=(modifyedi.split('.')[1]).split('')[0];

                      if(afterDotOfi == 6){
                        modifyedi = +modifyedi + .40; 
                        i = +i + .40;
                      }
                      if(+modifyedi >= 13){
                        modifyedi = (+modifyedi - 12).toFixed(2);
                      }
                      if(+originialValueOfDay2EditStartTime <= 8 && +originialValueOfDay2EditStartTime >= 1){
                        if(+modifyedi == 8.30){
                          break;
                        }
                      }
                      if(+modifyedi <= 8 && +modifyedi >= 1){
                        modifyedi = modifyedi + ' PM';
                      }else if(+modifyedi >= 10 && +modifyedi <= 11.30){
                        modifyedi = modifyedi + ' AM';
                      }else{
                        modifyedi = modifyedi + ' PM';
                      }
                      $('#ieday2EndTime').append("<option>"+modifyedi+"</option>");
                    }
                  });
                </script>
                <span id="eto2Indicator" style="display: none;">To</span>
                <select style="display: none;width: 30%;margin-bottom: 20px;" class="w3-border w3-input" name="eday2EndTime" id="ieday2EndTime" autofocus="off">
                  <option disabled selected >Choose A Time*</option>
                </select>
              </div>
              <label><b>Room Number</b></label>
              <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Room Number*" id="iebatchRoomNumber" name="ebatchRoomNumber" required autocomplete="off"><br>
              <label><b>Faculty Name</b></label>
              <select class="w3-input w3-border w3-animate-input" name="eassignABatchFaculty" id="ieassignABatchFaculty" required autofocus="off">
                <option disabled selected >Choose A Faculty*</option>
                <?php
                $conn=mysqli_connect("localhost", "root", "")or die("cannot connect to server"); 
                mysqli_select_db($conn,"tsms")or die("cannot select DB");
                $sql = "SELECT faculty_name from faculties;";
                $result = mysqli_query($conn,$sql);
                while($row=mysqli_fetch_assoc($result)){?>
                <option value="<?php echo $row['faculty_name']; ?>"><?php echo $row['faculty_name']; ?></option>
                <?php }?>
              </select><br>
              <label><b>Amount</b></label>
              <input class="w3-input w3-border w3-animate-input " type="number" placeholder="Amount*" id="iebatchAmount" name="ebatchAmount" required autocomplete="off"><br>
              <label><b>Batch Details</b></label>
              <textarea autocomplete="off" name="ebatchDetails" id="iebatchDetails" class="w3-input w3-border" type="text" style="width:100%" placeholder="Batch Details"></textarea>
              <button style="float: right;width: 45%;border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding" onclick="editANewBatchFromBatchPanel()" name="submitBatch" type="button">Edit</button>
            </div>
          </form>
          <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
            <button onclick="$('#editABatch').hide(),showDayTime('','');" type="button" id="editBatchcancle" class="w3-btn w3-red">Cancel</button>
          </div>
        </div>
      </div>
      <!-- end of floating display to edit a batch -->
    </div>
  </section>
  <?php include 'customPopupMessage.php'; ?>
</body>
</html>
<?php } else { header("location:../index.php"); }?>