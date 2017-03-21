<?php
session_start();
if($_SESSION['sess_adm']=="admin")
{

    echo '<h5>Loading,PLease wait...</h5>';
    echo '<p style="text-align: center;margin-top: 20%;"><img src="../pic/ring.gif"> </p>';

    $userName=$_POST['suname'];

	$filetmp = $_FILES['studentProfilePic']['tmp_name'];
	$filename = $_FILES['studentProfilePic']['name'];
	$filetype = $_FILES['studentProfilePic']['type'];
	$filepath = "../profilepic/".$filename;
	
	move_uploaded_file($filetmp,$filepath);

	require_once("mysql-to-json.php");

    $filepath = "../profilepic/".$filename;	    
	    
	$sql = "UPDATE users set pic_path='".$filepath."' where username='".$userName."';";

	$getvalue=InsertToDB($sql);

	if($getvalue=="true")
	{?>
		<script>
			window.location.href='managestudents.php';
	    </script>
    <?php
	}
	else
	{?>
		<script>
			alert('Something went wrong!try again after some time.');
			window.location.href='managestudents.php';
		</script>
	<?php				
	}
}
else
{?>
    <script>
		window.location.href='../index.php';
	</script>
<?php
}
?>
