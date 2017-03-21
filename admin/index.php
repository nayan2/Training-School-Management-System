<?php
session_start();
if(isset($_SESSION['sess_adm']) && $_SESSION['sess_adm']=="admin"){?>
	<h1 style='display:none' id='username'><?php echo $_SESSION['username']; ?></h1>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TSMS-Admin Page | Home</title>
  	<?php include 'pageHead.php'; ?>
</head>
<body class="w3-theme">
  	<?php include 'pageSideNavigationBar.php'; ?>
  	<section class="w3-row-padding w3-theme" style="min-height: 100%;margin-left:165px;" id="main-content">
		<div id="guts">
      		<div class="w3-container w3-padding-32 w3-theme-d1"><h1>Vendors List......</h1></div>
      		<!-- start of card of vendors details -->
      		<div class="w3-row-padding w3-theme">
			    <?php
			    $conn = mysqli_connect("localhost", "root", "","tsms")or die("Cannot Connect to Database Server"); 
			    $sql = "select * from vendors";
			    $result = mysqli_query($conn,$sql);
			    while($row = mysqli_fetch_assoc($result)){?>
			    <div style="width:25%;margin-right:20px;margin-left:10px;cursor:pointer;" class="w3-third w3-section home_vendorslist" id="homemaindiv" onclick="gethead(this)">
			        <div class="w3-card-4">
			            <img src="<?php echo $row["pic_path"] ?>" style="height: 200px;width: 100%">
			            <div style="position: relative;" class="w3-container w3-white">
			              	<h4 class="w3-center venpichead cventablehead"><?php echo $row["heading"]; ?></h4>
			              	<p style="height: 100px;overflow: auto;"><?php echo $row["body"]; ?></p>
			              	<a href="managevendors.php#search=<?php echo $row["heading"]; ?>"><button class="w3-btn-block w3-red w3-section" style="border-radius: 3px; height: 5%; width: 40%;text-align: center;display: inline-block;" type="button">Manage</button></a>
			              	<a href="deletevendor.php?vendorName=<?php echo $row["heading"]; ?>"><button class="w3-btn-block w3-red w3-section" style="border-radius: 3px; height: 5%; width: 40%; margin-left: 17%; text-align: center;display: inline-block;" type="button">Delete</button></a>
			            </div>
			        </div>
			    </div>
		        <?php }?>
		    </div>
		</div>
  	</section>
  	<?php include 'customPopupMessage.php'; ?>
</body>
</html>
<?php } else{ header("location:../index.php"); }?>