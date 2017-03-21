<?php
session_start();
if($_SESSION['sess_adm']=="admin")
{
  echo '<h5>Loading,PLease wait...</h5>';
  echo '<p style="text-align: center;margin-top: 20%;"><img src="pic/ring.gif"> </p>';

  session_start();
	$user = $_REQUEST['uname'];
  $level = $_REQUEST['ulevel'];
  $filetmp = $_FILES["file_img"]["tmp_name"];
	$filename = $_FILES["file_img"]["name"];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	$filepath = "../profilepic/".$user.'.'.$ext;

	move_uploaded_file($_FILES["file_img"]["tmp_name"],$filepath);

	require_once("mysql-to-json.php");

	$sql = "UPDATE users SET pic_path='$filepath' WHERE username='$user'";

	$getvalue=InsertToDB($sql);

	if($getvalue == "true")
	  {
      header("Location:managestudents.php");     
	  }
  else
    {
        echo "<script>
        alert('Something went wrong! Try again after some time.');
        </script>";
        header("location:managestudents.php");  
    }
  }
  else{
          echo "<script>
          window.location.href='../index.php';
          </script>";
  }
?>