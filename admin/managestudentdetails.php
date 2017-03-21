<?php
session_start();
$batchCode = "";
$courseName = "";
if(isset($_REQUEST['batchCode'])){
	$batchCode = $_REQUEST['batchCode'];
	$userName = $_REQUEST['userName'];
}
if(isset($_REQUEST['courseName'])){
	$courseName = $_REQUEST['courseName'];
	$userName = $_REQUEST['userName'];
}
$conn = mysqli_connect("localhost", "root", "","tsms") or die("cannot connect to server");
$query = "SELECT * from users where username='$userName'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
if(isset($_SESSION['sess_adm']) && $_SESSION['sess_adm']=="admin"){?>
	<h1 style='display:none' id='username'><?php echo $_SESSION['username']; ?></h1>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>TSMS-Admin Page | </title>
	<?php include 'pageHead.php'; ?>
	<script type="text/javascript">
	function deleteACourseFromStudent () {
		alert('You Cant delete this course until there is a batch assigned under this course!');
	}
	</script>
</head>
<body class="w3-theme">
	<?php include 'pageSideNavigationBar.php'; ?>
	<section class="w3-row-padding w3-theme" style="margin-left:165px;" id="main-content">
		<div id="guts">
			<center>
				<label><b style="color: red;" id="initialText"></b></label></br></br>
				<table>
					<tbody>
							<?php
							if($batchCode != ""){
							?>
							<script>
								$('#initialText').html('Delete Assign Batch From A Student');
							</script>
							<tr>
								<td>Batch Code:</td>
								<td id="batchCode" ><?php echo $batchCode; ?></td>
							</tr>
							<tr></tr>
							<tr>
								<td>Course Name:</td>
								<?php
								$query = "SELECT course_name from studentassignbatches WHERE batch_code ='$batchCode';";
								$result1 = mysqli_query($conn, $query);
								$row1 = mysqli_fetch_assoc($result1);
								$courseNameFromBatch = $row1['course_name'];
								?>
								<td id="courseName" ><?php echo $row1['course_name']; ?></td>
							</tr>
							<tr></tr>
							<tr>
								<td>Vendor Name:</td>
								<?php
								$query = "SELECT vendor_heading from courses WHERE name='$courseNameFromBatch';";
								$result2 = mysqli_query($conn, $query);
								$row2 = mysqli_fetch_assoc($result2);
								?>
								<td><?php echo $row2['vendor_heading']; ?></td>
							</tr>
							<tr></tr>
							<tr>
								<td>Student Name:</td>
								<td id="studentName" ><?php echo $row['first_name']." ".$row['last_name']; ?></td>
							</tr>
							<tr></tr>
							<tr>
								<td>Student Username:</td>
								<td id="userName" ><?php echo $userName; ?></td>
							</tr>
							<tr></tr>
							<tr>
								<td><a style="width: 50%;border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding" onclick="deleteABatchFromAStudent()">Delete</a></td>
							</tr>
							<?php
							}else{?>
							<script>
								$('#initialText').html('Delete Assign Course From A Student');
							</script>
							<tr>
								<td>Course Name:</td>
								<td id="courseName" ><?php echo $courseName; ?></td>
							</tr>
							<tr></tr>
							<tr>
								<td>Vendor Name:</td>
								<?php
								$query = "SELECT vendor_heading from courses WHERE name='$courseName';";
								$result3 = mysqli_query($conn, $query);
								$row3 = mysqli_fetch_assoc($result3);
								?>
								<td><?php echo $row3['vendor_heading']; ?></td>
							</tr>
							<tr></tr>
							<tr>
								<td>Student Name:</td>
								<td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
							</tr>
							<tr></tr>
							<tr>
								<td>Student Username:</td>
								<td id="userName" ><?php echo $userName; ?></td>
							</tr>
							<tr></tr>
							<tr>
								<td><a style="width: 50%;border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding" onclick="deleteACourseFromStudent()">Delete</a></td>
							</tr>
							<?php
							}
							?>
					</tbody>
				</table>
			</center>
		</div>
	</section>
</body>
<?php  mysqli_close($conn); ?>
</html>
<?php } else { header("location:../index.php"); }?>