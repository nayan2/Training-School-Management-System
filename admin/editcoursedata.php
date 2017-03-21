<?php
session_start();
if($_SESSION['sess_adm']=="admin")
{

    echo '<h5>Loading,PLease wait...</h5>';
    echo '<p style="text-align: center;margin-top: 20%;"><img src="../pic/ring.gif"> </p>';

	$coursename=$_REQUEST['corname'];
	$coursecode=$_REQUEST['couc'];
	$vendorname=$_REQUEST['cbvn'];
	$courseaddingdate=$_REQUEST['cad'];
	$coursedetails=$_REQUEST['coudetails'];

	if(empty(($_FILES['file_img1']['name'])))
	{
		    require_once("mysql-to-json.php");

			$sql = "UPDATE courses set code='".$coursecode."',vendor_heading='".$vendorname."',adding_date='".$courseaddingdate."',details='".$coursedetails."' where name='".$coursename."';";

	        $getvalue=InsertToDB($sql);

	        if($getvalue=="true")
	        {
					echo "<script>
					window.location.href='managecourses.php';
					</script>";
	        }
	        else
	        {
					echo "<script>
					alert('Something went wrong!try again after some time.');
					window.location.href='managecourses.php';
					</script>";
	        }
		
	}
	else
	{
		$filetmp = $_FILES['file_img1']['tmp_name'];
	    $filename = $_FILES['file_img1']['name'];
	    $ext = pathinfo($filename, PATHINFO_EXTENSION);
	    $filepath ="../coursespic/".$coursename.'.'.$ext;
	
	    move_uploaded_file($filetmp,$filepath);

	    require_once("mysql-to-json.php");
	    
	    $sql = "UPDATE courses set pic_path='".$filepath."',code='".$coursecode."',vendor_heading='".$vendorname."',adding_date='".$courseaddingdate."',details='".$coursedetails."' where name='".$coursename."';";

	    $getvalue=InsertToDB($sql);

	    if($getvalue=="true")
	    {
					echo "<script>
					window.location.href='managecourses.php';
					</script>";
	    }
	    else
	    {
					echo "<script>
					alert('Something went wrong!try again after some time.');
					window.location.href='managecourses.php';
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
