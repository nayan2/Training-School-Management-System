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
    <script type="text/javascript">
      //onclick="idna(this)"
      // $(document).ready(function(){
      // $("#myTable td").hover(function() {     
      //     var column_num = parseInt( $(this).index());
      //     var row_num = parseInt( $(this).parent().index());
      //     addcourse(row_num,column_num);
      // });
      // });
      // if class is idna5
      // $(function(){
      //   $('button.idna5').on('click',function(){
      //       alert($(this).closest('tr').index())
      //     })  
      //   })
      $(document).ready(function() {
        var searchHash = location.hash.substr(1).replace("%20"," "),
        searchString = searchHash.substr(searchHash.indexOf('search='))
          .split('&')[0]
          .split('=')[1];
        $('#vendorsTable').dataTable( {
          mark: { element: 'span', className: 'highlight' },
          "oSearch": { "sSearch": searchString },
          "scrollX": true
        });
      });
      function idna(el){
        var rownumber = $(el).closest('tr').index();
        getvendornameforcourse(document.getElementById("vendorsTable").rows[rownumber+1].cells[0].textContent);
      }
      function getval(cell) {
        value(cell.innerHTML);
      }
    </script>
  </head>
  <body class="w3-theme">
    <?php include 'pageSideNavigationBar.php'; ?>
    <section class="w3-row-padding w3-theme" style="margin-left:165px;" id="main-content">
      <div id="guts">
        <a autocomplete="off" required style=" margin-left: 88%;width: 11%;border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding" href="addvendors.php">Add Vendors</a>
        <!-- TABLE TO SHOW THE DATA -->
        <div class="w3-container">
          <p>Available vendors details..</p>
          <table width="100%" id="vendorsTable" class="display" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" width="100%">
            <thead>
              <tr>
                <th>Vendor Heading</th>
                <th>Vendor Pic</th>
                <th data-orderable="false">Vendor Adding Date</th>
                <th>Vendor Body</th>
                <th>Add A Course</th>
              </tr>
            </thead>
            <tbody>
              <?php
      				$conn=mysqli_connect("localhost", "root", "")or die("cannot connect to server"); 
      				mysqli_select_db($conn,"tsms")or die("cannot select DB");
      				$sql = "select * from vendors";
      				$result = mysqli_query($conn,$sql);
      				while($row=mysqli_fetch_assoc($result))
      				{?>
        			<tr>
                <td><div onclick="getval(this)" class="cventablehead" id="ventablehead" ><?php echo $row["heading"]; ?></div></td>
          			<td><div ><img height="60px" width="80px" src="<?php echo $row["pic_path"]; ?>"></div></td>             
          			<td><?php echo $row["adding_date"]; ?></td>
          			<td><div style="width:100%;height: 60px;margin: 0;padding: 0;overflow-y: scroll"><?php echo $row["body"]; ?></div></td>
          			<td><a id="addCourseFromVendorPage" onclick="idna(this)">Add</a></td>
        			</tr>
              <?php
      				}
			        ?>
            </tbody>
          </table><br>
        </div>
        <!-- start of floating display view and edit details of vendors-->
        <div id="id02" class="w3-modal">
          <div class="w3-modal-content w3-card-8 w3-animate-zoom" style=" margin-top: -30px; max-width:600px">
            <div class="w3-center"><br>
              <span onclick="document.getElementById('id02').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
            </div>
            <form id="xxxx" name="editorremovevendor" class="w3-container" method="post" action="editdata.php" method="post" enctype="multipart/form-data">
              <div class="w3-section">
                <h2 class="w3-text-black">Edit or remove vendor</h2></p>      
                <img style="height: 250px;width: 250px;margin-left: 27%;" id="nayan1" src="" class=""><br>
                <label style="border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding">
                <input style="display: none;" type="file" autocomplete="off" name="file_img1" onchange="readURL(this,'#nayan1')">Change Pic</label>     
                <label class="w3-text-black"><b>Vendor Name</b></label><br>
                <textarea required autocomplete="off" name="novendor" id="nayan2" class="w3-input w3-border" type="text" style="width:100%" readonly></textarea><br>    
                <label class="w3-text-black"><b>Vendor Details</b></label><br>
                <textarea required  autocomplete="off" name="adovendor" class="w3-input w3-border" id="nayan3" type="text" style="width:100%;"></textarea>
                <button style="width: 45%;border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding" id="isubmitedit" onclick="editx()" name="submitedit" type="submit">EDIT</button>
                <button style="float: right;width: 45%;border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding"  onclick="deletex()" name="submitdelete" type="button">DELETE</button>
              </div>
            </form>
            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
              <button onclick="$('#id02').hide()" type="button" id="id02cancle" class="w3-btn w3-red">Cancel</button>
            </div>
          </div>
        </div>
        <!-- end of floating display view and edit details of vendors-->
        <!-- stsrt of floating display of add a course-->
        <div id="id03" class="w3-modal">
          <div class="w3-modal-content w3-card-8 w3-animate-zoom" style=" margin-top: -30px; max-width:600px">
            <div class="w3-center"><br>
              <span onclick="document.getElementById('id03').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
            </div>
            <form id="iaddcourse" name="addcourse" class="w3-container" method="post" action="bind.php" method="post" enctype="multipart/form-data">
              <div class="w3-section">
                <input style="display: none;" class="w3-input w3-border w3-animate-input" type="text" id="ihidecourseinvendor" name="hidecourseinvendor">
                <h2 id="courseinvendor" class="w3-text-black"></h2></p>      
                <img style="height: 250px;width: 250px;margin-left: 27%;border-radius: 3px;" id="inayan2" src="../pic/avatar.jpg" class="nayan2"><br>
                <label style="border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding">
                <input style="display: none;" type="file" autocomplete="off" name="file_img2" id="ifile_img2" onchange="readURL(this,'#inayan2')">Choose A Pic*</label>
                <input class="w3-input w3-border w3-animate-input" type="text" onkeyup="uppercase(this)" onblur="checkcoursename()" placeholder="Course Name*" id="inocou" name="nocou" required autocomplete="off"><br>
                <input class="w3-input w3-border w3-animate-input" type="text" placeholder="Course Code*" id="icocou" name="cocou" required autocomplete="off"><br>
                <textarea required autocomplete="off" name="docou" id="idocou" class="w3-input w3-border" type="text" style="float:right;width:100%" placeholder="Course Details*"></textarea>
                <button style="float: right;width: 45%;border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding" onclick="addcou()" name="submitcou" type="button">Add</button>
              </div>
            </form>
            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
              <button onclick="document.getElementById('id03').style.display='none'" type="button" id="id02cancle" class="w3-btn w3-red">Cancel</button>
            </div>
          </div>
        </div>
        <!-- end of floating display of add a course -->
      </div>
    </section>
    <?php include 'customPopupMessage.php'; ?>
  </body>
</html>
<?php } else{ header("location:../index.php"); }?>
