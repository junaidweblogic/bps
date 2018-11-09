<?php 
include("../common/cploconfig.php");

$struname=trim($txtuname);
$stremail=trim($txtemail);

if($struname=="" and $stremail=="")
{
    header("Location:forgot_pass.php?flag=blank");
    exit;
}
if($struname!="" && $stremail!="")   
{
        $query = "SELECT password,admin_email,username FROM ".$tblpref."admin WHERE username = '$struname' AND admin_email = '$stremail'";
        $stru=3;
}
elseif($struname!="")   
{
        $query = "SELECT password,admin_email,username FROM ".$tblpref."admin WHERE username = '$struname'";
        $stru=1;
}
elseif($stremail!="")
{
      $query = "SELECT password,admin_email,username FROM ".$tblpref."admin WHERE admin_email = '$stremail'";
       $stru=0;
}
if (!($result = mysqli_query($connection,$query))) { echo $query .mysqli_connect_errno();  exit; }

    if (mysqli_num_rows($result)>0)
    {
        $row=mysqli_fetch_object($result);
        $strmemail=$row->admin_email;
		
        $strpassword=$row->password;
		$struname=$row->username;
        $strmesstype="Password Found";
	    $ouremail="$sitename";

	    $strdetail="Dear $struname,\r\nWe are pleased to inform that your Password had been found.\r\n\nYour Username is - $struname\r\nYour Password is - $strpassword\r\n\nRegards\r\nSite Admin\r\$sitename\r\n";	
		@mail($strmemail,"$strmesstype-$HTTP_HOST",$strdetail,"from:$ouremail\nmime-version: 1.0\ncontent-type: text/plain");
		header("Location:index.php?flag=sent");
		exit;
               
	}
	else
	{
		if ($stru==1)
		{ 
			header("Location:forgot_pass.php?flag=un");
			exit;
		
		}
		elseif($stru==0)
		{
			header("Location:forgot_pass.php?flag=en");
			exit;
		} 
		elseif($stru==3)
		{
			header("Location:forgot_pass.php?flag=ue");
			exit;
		} 
	}
?>