<?php
session_start();
if($_SESSION['sess_adm']=="admin")
{

    echo '<h5>Loading,PLease wait...</h5>';
    echo '<p style="text-align: center;margin-top: 20%;"><img src="../pic/ring.gif"> </p>';

	$vendorname=$_REQUEST['novendor'];
	$vendordetails=$_REQUEST['adovendor'];

	if(empty(($_FILES['file_img1']['name'])))
	{
		    require_once("mysql-to-json.php");

			$sql = "UPDATE vendors set body='".$vendordetails."' where heading='".$vendorname."';";

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
		$filetmp = $_FILES['file_img1']['tmp_name'];
	    $filename = $_FILES['file_img1']['name'];
	    $filetype = $_FILES['file_img1']['type'];
	    $filepath = "../vendorspic/".$filename;

	    //echo $filepath;
	
	    move_uploaded_file($filetmp,$filepath);

	    require_once("mysql-to-json.php");
	    
	    $sql = "UPDATE vendors set pic_path='".$filepath."',body='".$vendordetails."' where heading='".$vendorname."';";

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
}
else
{
                    echo "<script>
					window.location.href='../index.php';
					</script>";
}
?>
