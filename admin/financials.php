<?php
session_start();

if( isset($_SESSION['sess_adm']) && $_SESSION['sess_adm']=="admin")
{
  echo "<h1 style='display:none' id='username'>".$_SESSION['username']."</h1>";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>TSMS-Admin Page | </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3-theme-amber.css">
    <link rel="stylesheet" href="css/style.css">
    <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/w3.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700">
    <link rel="stylesheet" href="../css/style.css">
    <script type='text/javascript' src='js/modernizr.js'></script>
    <script type='text/javascript' src='js/dynamicpage.js'></script>
    <script type='text/javascript' src='js/search.js'></script>
    <script type="text/javascript" language="javascript" src="http://code.jquery.com/jquery-1.12.4.js"></script>
    <script type='text/javascript' src='https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js'></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
</head>
<body class="w3-theme">
<!-- top navigation bar -->
<div style="position: fixed; width: 100%" class="w3-container w3-teal">
  <ul class="w3-navbar w3-container">
    <li class="w3-right" ><a href="destroy.php">Log Out</a></li>
    <li class="w3-right w3-dropdown-hover w3-hover-orange">
      <a class="w3-hover-orange" >Options<i class="fa fa-caret-down"></i></a>
      <div class="w3-dropdown-content w3-white w3-card-4">
        <a href="changepassword.php">change password</a>
      </div>
    </li>
    <li class="w3-right" ><a href="userprofile.php">User Profile</a></li>
    <li class="w3-right" ><a href="index.php">Home</a></li>
    <li class="w3-right" ><button class="w3-btn w3-black" id="sgo">Go</button></li>
    <li class="w3-right" ><input type="text" class="w3-input" id="text-search" placeholder="Search.."></li>
  </ul>
</div>
<!-- end of top navigation bar -->

<!-- start of side navigation bar -->
<div style="padding-top: 39px;">
  <nav class="w3-sidenav w3-light-grey w3-card-2" style="width:165px">
  <div class="w3-container">
    <h5>Menu</h5>
  </div>
  <a href="managevendors.php">Manage Vendors</a>
  <a href="managecourses.php">Manage Courses</a>
  <a href="manageBatches.php">Manage Batches</a>
  <a href="managestudents.php">Manage Students</a>
  <a href="manageadmin.php">Manage Admin</a>
  <a href="manageinstructors.php">Manage Instructors</a>
  <a href="financials.php">Financials</a>
  <a style="margin-top: 174%; margin-left: 2px;" class="w3-btn-floating-large w3-teal" href="addvendors.php"><label class="w3-display-middle">+</label></a>
</nav>
</div>
<!-- end of side navigation bar -->

    <section class="w3-row-padding w3-theme" style="margin-left:165px;" id="main-content">
		<div id="guts">
        <!-- TABLE TO SHOW THE DATA -->
        <div class="w3-container">
          <p>Student Financial Details...</p>
          <table id="myTable" class="display" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" width="100%">
            <thead>
              <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Course And Batch List</th>
                <th>Total Amount</th>
                <th>Deposited Amount</th>
                <th>Discount</th>
                <th>Due</th>
              </tr>
            </thead>
            <tbody>
              <?php
              mysql_connect("localhost", "root", "")or die("cannot connect to server"); 
              mysql_select_db("tsms")or die("cannot select DB");
              $sql = "select * from courses";
              $result = mysql_query($sql);
              while($row=mysql_fetch_assoc($result))
              {
              /*echo '<tr>
              <td id="co1"><div style="width:100%;height: 60px;margin: 0;padding: 0;overflow-y: scroll">'.$row["vendor_heading"].'</div></td>
              <td id="co2"><div style="width:100%;height: 60px;margin: 0;padding: 0;overflow-y: scroll">'.$row["pic_path"].'</div></td>          
              <td><div onclick="coursename(this)" id="co3" style="width:100%;height: 60px;margin: 0;padding: 0;overflow-y: scroll; cursor: pointer; color:red;">'.$row["name"].'</div></td>
              <td id="co4"><div style="width:100%;height: 60px;margin: 0;padding: 0;overflow-y: scroll">'.$row["code"].'</div></td> 
              <td id="co5"><div style="width:100%;height: 60px;margin: 0;padding: 0;overflow-y: scroll">'.$row["adding_date"].'</div></td>
              <td id="co6"><div style="width:100%;height: 60px;margin: 0;padding: 0;overflow-y: scroll">'.$row["details"].'</div></td>
              <td><button onclick="idna(this)">Add</button></td>
              </tr>';*/
              }
              ?>
            </tbody>
        </table>
		</div>
    </section>

<!-- messages section -->
<div id="id08" class="w3-modal w3-container">
  <div class="w3-modal-content w3-card-8 w3-animate-zoom" style=" margin-top: 30px; max-width:600px">
    <div id="panel" class="w3-panel w3-red">
      <span onclick="document.getElementById('id08').style.display='none'" class="w3-closebtn">&times;</span>
      <h3 id="panelheaing">Danger!</h3>
      <p id="panelbody">Red often indicates a dangerous or negative situation.</p>
    </div>
  </div>
</div>
<!-- end of messaging section -->

</body>
</html>
<?php
}
else
{
    header("location:../index.php");
}
?>