<?php

  echo '<h5>Loading,PLease wait...</h5>';
  echo '<p style="text-align: center;margin-top: 20%;"><img src="pic/ring.gif"> </p>';

  session_start();
	$user = $_REQUEST['uname'];
  $level = $_REQUEST['ulevel'];


		if($level == "student")
    {
      $_SESSION['sess_stu']="student";
      $_SESSION['username']=$user;
      $_SESSION['userid']=$user;
      header("Location:student/student.php");
    }
    else if($level == "admin")
    {
      $_SESSION['sess_adm']="admin";
      $_SESSION['username']=$user;
      $_SESSION['userid']=$user;
      header("Location:admin/index.php");
    }
    else
    {
        echo "<script>
        alert('Something went wrong! Try again after some time.');
        </script>";
        header("location:index.php");  
    }
?>