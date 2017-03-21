<?php
session_start();
$batchCode = "";
$courseName = "";
if(isset($_REQUEST['batchCode'])){
	$batchCode = $_REQUEST['batchCode'];
	$facultyName = $_REQUEST['facultyName'];
}
if(isset($_REQUEST['courseName'])){
	$courseName = $_REQUEST['courseName'];
	$facultyName = $_REQUEST['facultyName'];
}
$conn = mysqli_connect("localhost", "root", "","tsms") or die("cannot connect to server");
$query = "SELECT * FROM faculties WHERE faculty_name='$facultyName';";
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
								$('#initialText').html('Delete Assign Batch From A Faculty');
							</script>
							<tr>
								<td>Batch Code:</td>
								<td id="batchCode" ><?php echo $batchCode; ?></td>
							</tr>
							<tr></tr>
							<tr>
								<td>Course Name:</td>
								<?php
								$query = "SELECT course_name from batches WHERE batch_code='$batchCode' and faculty_name='$facultyName';";
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
								<td id="vendorName" ><?php echo $row2['vendor_heading']; ?></td>
							</tr>
							<tr></tr>
							<tr>
								<td>Faculty Name:</td>
								<td id="facultyName" ><?php echo $row['first_name']." ".$row['last_name']; ?></td>
							</tr>
							<tr></tr>
							<tr>
								<td>Faculty Id:</td>
								<td id="facultyId" ><?php echo $row['id']; ?></td>
							</tr>
							<tr></tr>
							<tr>
								<td><a style="width: 90%;border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding" onclick="deleteABatchFromAFaculty()">Delete</a></td>
							</tr>
							<?php
							}else{?>
							<script>
								$('#initialText').html('Delete Assign Course From A Faculty');
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
								<td id="vendorName" ><?php echo $row3['vendor_heading']; ?></td>
							</tr>
							<tr></tr>
							<tr>
								<td>Faculty Name:</td>
								<td id="facultyName" ><?php echo $row['first_name']." ".$row['last_name']; ?></td>
							</tr>
							<tr></tr>
							<tr>
								<td>Faculty Id:</td>
								<td id="facultyId" ><?php echo $row['id']; ?></td>
							</tr>
							<tr></tr>
							<tr>
								<td><a style="width: 90%;border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding" onclick="deleteACourseFromAFaculty()">Delete</a></td>
							</tr>
							<?php
							}
							?>
					</tbody>
				</table>
			</center>
		</div>
	</section>
	<?php include 'customPopupMessage.php'; ?>
</body>
<?php  mysqli_close($conn); ?>
</html>
<?php } else { header("location:../index.php"); }?>