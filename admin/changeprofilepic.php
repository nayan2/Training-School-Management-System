<?php
session_start();
if($_SESSION['sess_adm']=="admin")
{
	echo '<h5>Loading,PLease wait...</h5>';
    echo '<p style="text-align: center;margin-top: 20%;"><img src="../pic/ring.gif"> </p>';

    $user = $_SESSION['username'];

    $conn = mysqli_connect("localhost", "root", "","tsms") or mysqli_connect_error();
	
	$result = mysqli_query($conn, "SELECT username from users where username='$user' or id='$user' ")or die(mysqli_error());
	while($row = mysqli_fetch_assoc($result)) {
		$user=$row["username"];
	}

    $filetmp = $_FILES["file_img"]["tmp_name"];
	$filename = $_FILES["file_img"]["name"];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	$filepath = "../profilepic/".$user.'.'.$ext;

    move_uploaded_file($_FILES["file_img"]["tmp_name"],$filepath);
 
	require_once("mysql-to-json.php");

	$filepathn = "profilepic/".$user.'.'.$ext;

    $sql = "UPDATE users SET pic_path='$filepathn' WHERE username='$user' or id='$user'";

	$getvalue=InsertToDB($sql);

    if($getvalue == "true")
	{
		echo "<script>
		window.location.href='userprofile.php';
		</script>";
	}
	else
	{
		echo "<script>
		alert('Something went wrong!try again after some time.');
		window.location.href='userprofile.php';
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