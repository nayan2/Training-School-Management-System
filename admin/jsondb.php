<?php
require_once("mysql-to-json.php");
if($_REQUEST['q']=="read"){
	$jsonData=getJSONFromDB($_REQUEST['sql']);
	echo $jsonData;
}
else if($_REQUEST['q']=="write"){
	$result=InsertToDB($_REQUEST['sql']);
	echo $result;
}
else if($_REQUEST['q']=="delete"){
	$result=InsertToDB($_REQUEST['sql']);
	echo $result;
}
else
	echo "invalid request";

?>