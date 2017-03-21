<?php
session_start();
if($_SESSION['sess_adm']=="admin")
{
	echo '<h5>Loading,PLease wait...</h5>';
    echo '<p style="text-align: center;margin-top: 20%;"><img src="../pic/ring.gif"> </p>';

    $vendorheading=$_REQUEST['vendorName'];
	$coursename=$_REQUEST['nocou'];
    $coursecode=$_REQUEST['cocou'];
    $coursedetails=$_REQUEST['docou'];

    $filetmp = $_FILES["file_img2"]["tmp_name"];
	$filename = $_FILES["file_img2"]["name"];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	$filepath = "../coursespic/".$coursename.'.'.$ext;
	$date=date("Y-m-d");
	
	move_uploaded_file($_FILES["file_img2"]["tmp_name"],$filepath);

    require_once("mysql-to-json.php");

    $sql = "INSERT INTO courses (vendor_heading,name,code,pic_path,adding_date,details) VALUES ('$vendorheading','$coursename','$coursecode','$filepath','$date','$coursedetails')";

	$getvalue=InsertToDB($sql);

	if($getvalue=="true")
	{
		echo "<script>
		window.location.href='managevendors.php';
		</script>";
	}
	else
	{
		echo "<script>
		alert('Something went wrong!try again after some time.');
		window.location.href='managevendors.php';
		</script>";
	}
}
else
{
                    echo "<script>
					window.location.href='../index.php';
					</script>";
}

?>