<?php
include_once("config.php");
session_set_cookie_params(3600);
session_start();
$username=$_SESSION['username'];
if(!isset($_SESSION['username']))
{
	echo "<script>alert('You are not authorised to view this page, please login for authentication.');</script>";
	echo "<script>window.location.href='index.php'</script>";
}
date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");
$time = date("h:i:sa");

if(isset($_POST['user_name']))
{	

	$name = base64_decode($_POST['user_name']);
	
	$q="select * from gallery where sellerid='".$name."' order by id desc";
	$q1=mysql_query($q);
	$q2=mysql_num_rows($q1); 
	if($q2 > 0)

  {

  $count = 0;
$q=0;
  while($q3=mysql_fetch_array($q1))

  {

  $count = $count+1;

  $id = base64_encode($q3['id']);
	
     echo '<tr data-index='.$q.'><td style="">'.$count.'</td><td style="">'.$q3["imagedate"].'</td><td style="">'.$q3['imagetime'].'</td><td style=""><img src="data:image/jpeg;base64,'.base64_encode($q3['image']). ' " width="120px" height="120px"/></td><td style=""><a href="deleteSellermyimage.php?id='.base64_encode($q3['id']).'">Delete</a></td></tr>';
   $q=$q+1;
	}
	}
	 else
  {
 
  echo '<tr class="no-records-found">
                        <td colspan="5">You have not added any Image Yet!</td></tr>';
  
  }
	
   
    
	
}	
	
	
	
?>