<?php
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
//include("../../common/fckeditor/fckeditor_php5.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}
$rid = $_GET[rid];

$query="select * from ".$tblpref."askpolice where ap_id='$rid'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_connect_errno(); exit;}
$row_add=mysqli_fetch_array($result);

if($row_add[ap_status]=="New")
{
		$query = "UPDATE " . $tblpref . "askpolice SET ap_status = 'View' WHERE ap_id = '$rid'";
		if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_connect_errno(); exit;}

		if($row_add[ap_email]!="")
		{
		$queryau = "SELECT * FROM " . $tblpref . "autoresponders WHERE a_id = '3'";
		if(!($resultau=mysqli_query($connection,$queryau))){echo $queryau.mysqli_connect_errno(); exit;}
		$row_autoresp = mysqli_fetch_array($resultau);
			
		$msg = "Dear $row_add[ap_name], <br /> ";
		$msg .= "we have received your Ask the Police Report and we will get back to you as soon as possible<br />";
		$msg .= "<br /> You had wrote the Ask the Police Report as : <br /> $row_add[ap_askpolice]";

		$msg .= "<br /><br /><br />Regards - <br />Administrator <br/> $sitename";
		
		$mesheader =  "From: ".$row_autoresp[a_default]."\n" . "Reply-To: ". $row_autoresp[a_default] . "\r\n";
		$mesheader .= "MIME-Version: 1.0\n";
		$mesheader .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		
		
		@mail($row_add[ap_email],"Re : BPS : Ask the Police Report : From: $row_autoresp[a_default]",$msg,$mesheader);

		}
}

admin_header("../../","Ask the Police Report Management");
//admin_nav("../../");
?>
<!--body start -->
<div class="adminbody">
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="index.php"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>
<div class="gap"></div>
<div class="box">
    <div class="hdr">
	<? if($rid!=""){?><h1 class="ico-view">View</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt=""><?if($rid!=""){?>
            View Ask the Police Report
            <?}else{?>
            Ask the Police Report
            <?}?></h1>
    </div>
    </div> 
	<div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return fuelentry();" action="submit.php" enctype="multipart/form-data">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
			 <tr class="even">
				<td width="50%">Person Name  :     </td>
				<td width="50%"><?=stripslashes($row_add[ap_name])?></td>
			 </tr>
			 <tr class="">
				<td width="50%">Tel No :     </td>
				<td width="50%"><?=stripslashes($row_add[ap_tel])?></td>
			 </tr>
			 <tr>
			 <tr class="even">
				<td width="50%">Email Id :     </td>
				<td width="50%"><?=stripslashes($row_add[ap_email])?></td>
			 </tr>
			 <tr class="">
				<td width="50%">Ask the Police  :     </td>
				<td width="50%"><?=stripslashes($row_add[ap_askpolice])?></td>
			 </tr>
			 <tr>
			 <tr class="even">
				<td width="50%">Person IP Address :     </td>
				<td width="50%"><?=stripslashes($row_add[ap_ip])?></td>
			 </tr>
			 <tr>
			 <tr class="even">
		<td colspan="2">&nbsp;</td>
	 </tr>     
     <tr >
     	<td colspan="2">        
		<a href="index.php"><input type="button" class="button" value="Back" name="submit" ></a>
        </td>
     </tr>   
     </table>     
     </form>
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</div>
<?admin_footer()?>
