<?php
session_start();
if($_SESSION['sess_adm']=="admin")
{
  echo '<h5>Loading,PLease wait...</h5>';
  echo '<p style="text-align: center;margin-top: 20%;"><img src="pic/ring.gif"> </p>';

  session_start();
	$InstructorEmail = $_REQUEST['iemail'];
  $filetmp = $_FILES["instructorProfilePic"]["tmp_name"];
	$filename = $_FILES["instructorProfilePic"]["name"];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	$filepath = "../profilepic/".$InstructorEmail.'.'.$ext;

	move_uploaded_file($_FILES["instructorProfilePic"]["tmp_name"],$filepath);

	require_once("mysql-to-json.php");

	$sql = "UPDATE faculties SET pic_path='$filepath' WHERE email='$InstructorEmail'";

	$getvalue=InsertToDB($sql);

	if($getvalue == "true")
	  {
      header("Location:manageinstructors.php");     
	  }
  else
    {
        echo "<script>
        alert('Something went wrong! Try again after some time.');
        </script>";
        header("location:manageinstructors.php");  
    }
  }
  else{
          echo "<script>
          window.location.href='../index.php';
          </script>";
  }
?>