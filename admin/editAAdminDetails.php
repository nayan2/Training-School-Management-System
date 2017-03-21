<?php
session_start();
if($_SESSION['sess_adm']=="admin")
{

    echo '<h5>Loading,PLease wait...</h5>';
    echo '<p style="text-align: center;margin-top: 20%;"><img src="../pic/ring.gif"> </p>';

        $userName=$_POST['eauname'];
		$filetmp = $_FILES['editAdminProfilePic']['tmp_name'];
	    $filename = $_FILES['editAdminProfilePic']['name'];
	    $filetype = $_FILES['editAdminProfilePic']['type'];
	    $filepath = "../profilepic/".$filename;
	
	    move_uploaded_file($filetmp,$filepath);

	    require_once("mysql-to-json.php");

        $filepath = "profilepic/".$filename;	    
	    
	    $sql = "UPDATE users set pic_path='".$filepath."' where username='".$userName."';";

	    $getvalue=InsertToDB($sql);

	    if($getvalue=="true")
	    {
					echo "<script>
					window.location.href='manageadmin.php';
					</script>";
	    }
	    else
	    {
					echo "<script>
					alert('Something went wrong!try again after some time.');
					window.location.href='manageadmin.php';
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
