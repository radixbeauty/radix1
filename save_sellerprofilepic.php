<?php
include_once("config.php");
session_set_cookie_params(3600);
//ini_set('session.gc_maxlifetime',60*60);
//ini_set('session.gc_probability',1);
//ini_set('session.gc_divisor',1);
session_start();

/*if(!isset($_SESSION['username']))
{
	echo "<script>alert('You are not authorised to view this page, please login for authentication.');</script>";
	echo "<script>window.location.href='index.php'</script>";
}*/
$username=$_SESSION['username'];
if(!isset($_SESSION['username']))
{
	echo "<script>alert('You are not authorised to view this page, please login for authentication.');</script>";
	echo "<script>window.location.href='index.php'</script>";
}
date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");
$time = date("h:i:sa");



if($_POST)
{	
	$id=$_POST['id_prfpic'];
$id=base64_decode($id);
$fp=addslashes(file_get_contents($_FILES['prfpic']['tmp_name']));
	
		if($fp == '')
	{
	
	die("Please Select Image!");
	}
else
{
$qry="insert into gallery(image,sellerid,imagedate,imagetime) values('".$fp."','".$id."','".$date."','".$time."')";
mysql_query($qry);
die("Saved!");
	}
}
?>