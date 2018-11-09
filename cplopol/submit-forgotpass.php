<?php
include("../common/cploconfig.php");
include("../common/app_function.php");

$struname=trim(stripslashes($_POST[username]));
$stremail=trim(stripslashes($_POST[emailid]));


if($struname=="" and $stremail=="")
{
    header("Location:forgotpass.php?flag=blank");
    exit;
}
//admin_id 	username 	password 	admin_email
if($struname!="" && $stremail!="")   
{
	$query = sprintf("SELECT username,admin_email FROM ".$tblpref."admin WHERE username = '%s' AND admin_email = '%s'", $struname, $stremail);
 }
elseif($struname!="")   
{
		$query = sprintf("SELECT username,admin_email FROM ".$tblpref."admin WHERE username = '%s'", $struname);
}
elseif($stremail!="")
{
	  $query = sprintf("SELECT username,admin_email FROM ".$tblpref."admin WHERE admin_email = '%s'", $stremail);
}
if(!($result = mysqli_query($connection,$query))) { echo $query.mysqli_connect_errno();  exit; }

if(mysqli_num_rows($result)>0)
{
	$row=mysqli_fetch_object($result);
	
	$strmemail=$row->admin_email;	
	//$strpassword=$row->a_pass;
	$struname=$row->username;
	
	$nwpwd = str_rand();
	$nwpwdhsh_first = md5($nwpwd);
	$nwpwdhsh = sha1($nwpwdhsh_first);

	$query_up = sprintf("UPDATE ".$tblpref."admin SET password='%s' WHERE admin_email = '%s'", $nwpwdhsh, $strmemail);
	if(!($result_up = mysqli_query($connection,$query_up))) { echo $query_up.mysqli_connect_errno();  exit; }

	$strmesstype="Password Found";
	$ouremail=$adminemail;

	$strdetail="Dear ".$struname.",\r\n";
	$strdetail .="We are pleased to inform that your Password had been found.\r\n\n";
	$strdetail .="Your Username is - ".$struname."\r\n";
	$strdetail .="Your Password is - ".$nwpwd."\r\n\n\n";
	$strdetail .="Regards\r\n";
	$strdetail .="\r\nSite Admin\r\n".$sitename."\r\n";	

	$from   = "From: Chobe Gem <".$ouremail .">\r\n";
	$reply 	= "Reply-To: " . $ouremail . "\r\n";    
	$params = "MIME-Version: 1.0\r\n";
	$params .= 'Content-type: text/plain; charset=iso-8859-1' . "\r\n";
	$message;
	$mesheader = $from.$reply.$params;
					
	@mail($strmemail,$strmesstype,$strdetail,$mesheader);
	header("Location:forgotpass.php?flag=sent");
	exit;
		   
}
else
{
	header("Location:forgotpass.php?flag=invalid");
	exit; 
}
?>