<?php
session_start();
$_SESSION['sess_adm'] = "";
$_SESSION['username']="";
$_SESSION['userid']="";
session_destroy();
header("Location:../index.php");
?>