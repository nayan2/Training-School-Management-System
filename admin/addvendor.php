<?php
session_start();
if($_SESSION['sess_adm']=="admin")
{
	echo '<h5>Loading,PLease wait...</h5>';
    echo '<p style="text-align: center;margin-top: 20%;"><img src="../pic/ring.gif"> </p>';

    $vendorname=$_REQUEST['novendor'];
	$vendordetails=$_REQUEST['adovendor'];
   	$filetmp = $_FILES["file_img"]["tmp_name"];
	$filename = $_FILES["file_img"]["name"];
	$filetype = $_FILES["file_img"]["type"];
	$filepath = "../vendorspic/".$filename;
	$date=date("Y-m-d");
	
	move_uploaded_file($filetmp,$filepath);

    require_once("mysql-to-json.php");

    $sql = "INSERT INTO vendors (pic_path,heading,adding_date,body) VALUES ('$filepath','$vendorname','$date','$vendordetails')";

	$getvalue=InsertToDB($sql);

	if($getvalue=="true")
	{
		echo "<script>
		window.location.href='index.php';
		</script>";
	}
	else
	{
		echo "<script>
		alert('Something went wrong!try again after some time.');
		window.location.href='index.php';
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