<?php
session_start();
if($_SESSION['sess_adm']=="admin")
{
  echo '<h5>Loading,PLease wait...</h5>';
  echo '<p style="text-align: center;margin-top: 20%;"><img src="pic/ring.gif"> </p>';

  session_start();
	$user = $_REQUEST['auname'];
  $level = $_REQUEST['aulevel'];
  $filetmp = $_FILES["adminProfilePic"]["tmp_name"];
	$filename = $_FILES["adminProfilePic"]["name"];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	$filepath = "../profilepic/".$user.'.'.$ext;

	move_uploaded_file($_FILES["adminProfilePic"]["tmp_name"],$filepath);

	require_once("mysql-to-json.php");

	$sql = "UPDATE users SET pic_path='$filepath' WHERE username='$user'";

	$getvalue=InsertToDB($sql);

	if($getvalue == "true")
	  {
      header("Location:manageadmin.php");     
	  }
  else
    {
        echo "<script>
        alert('Something went wrong! Try again after some time.');
        </script>";
        header("location:manageadmin.php");  
    }
  }
  else{
          echo "<script>
          window.location.href='../index.php';
          </script>";
  }
?>