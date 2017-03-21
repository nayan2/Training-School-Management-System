<?php
session_start();
if($_SESSION['sess_adm']=="admin")
{
    echo '<h5>Loading,PLease wait...</h5>';
    echo '<p style="text-align: center;margin-top: 20%;"><img src="../pic/ring.gif"> </p>';

    $facultyId=$_POST['nFacultyId'];

	$filetmp = $_FILES['editInstructorProfilePic']['tmp_name'];
	$filename = $_FILES['editInstructorProfilePic']['name'];
	$filetype = $_FILES['editInstructorProfilePic']['type'];
	$filepath = "../profilepic/".$filename;
	
	move_uploaded_file($filetmp,$filepath);

	require_once("mysql-to-json.php");

    $filepath = "profilepic/".$filename;	    
	    
	$sql = "UPDATE faculties set pic_path='".$filepath."' where id='".$facultyId."';";

	$getvalue=InsertToDB($sql);

	if($getvalue=="true")
	{
		echo "<script>
		window.location.href='managestudents.php';
		</script>";
	}
	else
	{
		echo "<script>
		alert('Something went wrong!try again after some time.');
		window.location.href='managestudents.php';
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
