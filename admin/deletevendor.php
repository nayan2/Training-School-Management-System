<?php
session_start();
$vendorName = "";
if(isset($_REQUEST['vendorName'])){
	$vendorName = $_REQUEST['vendorName'];
}
$conn = mysqli_connect("localhost", "root", "","tsms") or die("cannot connect to server");
$query = "SELECT * from vendors where heading='$vendorName'";
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
	<script>
		function deleteAVendorFromIndexPage () {
			if(confirm('If you delete this vendor named : '+$('#vendorName').html()+'! All the course and batches against this vendor will be deleted. CONFIRM?') == true){
				str = "DELETE FROM vendors WHERE heading = '"+$('#vendorName').html()+"'";
		        var xmlhttp = new XMLHttpRequest();
		        xmlhttp.onreadystatechange = function() {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                resp = xmlhttp.responseText;
		                if (resp == "true") {
		                    messagebox('w3-panel w3-green', 'Success!', 'Vendor successfully deleted.');
		                    window.location.href = 'index.php';
		                } else if (resp == "false") {
		                    messagebox('w3-panel w3-red', 'Error!', 'Something went wrong!try again after some time.');
		                }
		            }
		        };
		        var url = "jsondb.php?q=delete&sql=" + str;
		        xmlhttp.open("GET", url, true);
		        xmlhttp.send();
			}
		}
	</script>
</head>
<body class="w3-theme">
	<?php include 'pageSideNavigationBar.php'; ?>
	<section class="w3-row-padding w3-theme" style="margin-left:165px;" id="main-content">
		<div id="guts">
			<center>
				<label><b style="color: red;" id="initialText">Delete A Vendor</b></label></br></br>
				<img src="<?php echo $row['pic_path']; ?>" height="300px" width="300px"></br></br>
				<label style="display: none;" id="vendorName"><?php echo $row['heading']; ?></label>
				<tr>
					<td><b>Vendor Name:</b></td>
					<td ><?php echo $row['heading']; ?></td>
				</tr><br><br>
				<tr>
					<td><b>Vendor Adding Date:</b></td>
					<td><?php echo $row['adding_date']; ?></td>
				</tr><br><br>
				<tr>
					<td><b>About Vendor:</b></td>
					<td><?php echo $row['body']; ?></td>
				</tr><br><br>
				<tr>
					<td><a style="width: 50%;border-radius: 2px;" class="w3-btn-block w3-green w3-section w3-padding" onclick="deleteAVendorFromIndexPage()">Delete</a></td>
				</tr>
			</center>
		</div>
	</section>
	<?php include 'customPopupMessage.php'; ?>
</body>
<?php  mysqli_close($conn); ?>
</html>
<?php } else { header("location:../index.php"); }?>