<?php
include_once("config.php");

session_set_cookie_params(3600);
//ini_set('session.gc_maxlifetime',60*60);
//ini_set('session.gc_probability',1);
//ini_set('session.gc_divisor',1);
session_start();


$username=$_SESSION['username'];
$usertype = $_SESSION['usertype'];
if(!isset($_SESSION['username']))
{
	echo "<script>alert('You are not authorised to view this page, please login for authentication.');</script>";
	echo "<script>window.location.href='index.php'</script>";
}

date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");

if($_POST)
{	
	$q="select * from members where emailid='".trim($_POST['emailid'])."'";
	$q1=mysql_query($q);
	$q2=mysql_num_rows($q1);
	while($q3=mysql_fetch_array($q1))
	{
	$q4 = $q3['name'];
	}
	
	
	
	
	if($_POST['name'] == '')
	{
		

				
					die("Please Enter Name!");
			
	}
	if($_POST['emailid'] == '')
	{
		

				
					die("Please Enter Email Id!");
			
	}
	if($_POST['contactno'] == '')
	{
		

				
					die("Please Enter Contact No!");
			
	}
	if($_POST['gender'] == '')
	{
		

				
					die("Please Select Gender!");
			
	}
	if($_POST['pincode'] == '')
	{
		

				
					die("Please Enter Pincode!");
			
	}
	if($_POST['city'] == '')
	{
		

				
					die("Please Select City!");
			
	}
	if($q2 > 0)
	{
	die("Email Id already exists");
	}
	
	
	if($q2 < 1)
	{
	$random = rand();
	$randomnew = $random;
	$emailidnew = trim($_POST['emailid']);
	$referid = base64_decode(trim($_POST['referid']));
	$qry="insert into members(name,emailid,contactno,gender,password,confirmation_code,confirmation,registration_date,	referalid,pincode,city) values('".trim($_POST['name'])."','".trim($_POST['emailid'])."','".trim($_POST['contactno'])."','".trim($_POST['gender'])."','".$randomnew."','".$random."','No','".$date."','".$referid."','".trim($_POST['pincode'])."','".trim($_POST['city'])."')";
	mysql_query($qry);
	$random = base64_encode($random);
	$email_to = trim($_POST['emailid']);
    $email_subject = "Radix Beauty New Registration";
     
     
   
     
    $error_message = "";

    $email_message = "You received this message because someone requested an email registration for '".trim($_POST['emailid'])."' to Radix Beauty. If you did not make this request, please ignore the rest of this message.

Hello there,

You recently requested an email registration to Radix Beauty. We can't wait to send the updates you want via email, so please click the following link to activate your registration immediately:

https://radixbeauty.com/mailconfirm.php?k=$random

(If the link above does not appear clickable or does not open a browser window when you click it, copy it and paste it into your web browser's Location bar.)

Login Details are below

Website - http://radixbeauty.com
Username - $emailidnew
Password - $randomnew

--
This message was sent to you by Radix Beauty (radixbeauty.com)
If you received this in error, please disregard.  Do not reply directly to this email.";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    
    $emailfrom = 'info@radixbeauty.com';
     
// create email headers
$headers = 'From: '.$emailfrom."\r\n".
$headers .= 'Cc: connectcityindia@gmail.com.com ' . "\r\n";
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
	die("Saved!");
	}
}
?>