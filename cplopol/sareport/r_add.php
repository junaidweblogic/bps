<?php
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}
$rid = $_GET[rid];

$query="select * from ".$tblpref."susp_alleg where sa_id='$rid'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);

if($row_add[sa_status]=="New")
{
		$query = "UPDATE " . $tblpref . "susp_alleg SET sa_status = 'View' WHERE sa_id = '$rid'";
		if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}

		if($row_add[sa_email]!="")
		{
			$queryau = "SELECT * FROM " . $tblpref . "autoresponders WHERE a_id = '5'";
			if(!($resultau=mysqli_query($connection,$queryau))){echo $queryau.mysqli_errno($connection); exit;}
			$row_autoresp = mysqli_fetch_array($resultau);
				
			$msg = "Dear $row_add[sa_name], <br /> ";
			$msg .= "we have received your Crime Report/Incident report and we will get back to you as soon as possible<br />";
			$msg .= "<br /> You had wrote the Crime Report/Incident as : <br /> $row_add[sa_crimedet]";
			$msg .= "<br /><br /><br />Regards - <br />Administrator <br/> $sitename";		
			$mesheader =  "From: ".$row_autoresp[a_default]."\n" . "Reply-To: ".$row_autoresp[a_default]. "\r\n";
			$mesheader .= "MIME-Version: 1.0\n";
			$mesheader .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
			
			@mail($row_add[sa_email],"BPS : Crime Report/Incident : From $row_autoresp[a_default]",$msg,$mesheader);

		}
		
}
admin_header('../../','Report Crime/Incident ',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
?>
<!--body start -->
<div class="adminbody">
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="index.php"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>
<div class="gap"></div>
<?
$flag = $_REQUEST[flag];
if($flag=="exist"){?>
<p align="center" class="error">Record is already exist.</p>
<? } ?>	   

<div class="box">
    <div class="hdr">
	<? if($rid!=""){?><h1 class="ico-edit">Edit</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt="">Report Crime/ Incident </h1>
    </div>
    </div> 
	<div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return validate();" action="submit_r.php" enctype="multipart/form-data">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<td width="30%"> Reporter Name :     </td>
		<td><?=stripslashes($row_add[sa_name])?></td>
     </tr>
     <tr>
     <td width="30%"> Reporter Address :     </td>
		<td><?=stripslashes($row_add[sa_address])?></td>
	 </td>
     </tr>
	 <tr class="even">
		<td width="30%"> Tel No :     </td>
		<td><?=stripslashes($row_add[sa_tel])?></td>
     </tr>
     <tr>
     <td width="30%"> Email Id :     </td>
		<td><?=stripslashes($row_add[sa_email])?></td>
	 </td>
     </tr>
	  <tr class="even">
		<td width="30%"> Date of Report/Incident :     </td>
		<td><? 
		  $date1 = explode(" ",$row_add[sa_datetime]); 
		  echo dateformate($date1[0]);
		  ?></td>
     </tr>
     <tr>
     <td width="30%"> Time of Report Crime/ Incident :     </td>
		<td><? echo $date1[1]." ".$row_add[sa_timeset];?></td>
	 </td>
     </tr>
	 <tr class="even">
		<td width="30%"> Type of Report Crime/ Incident :     </td>
		<td><?=stripslashes($row_add[sa_typecrime])?></td>	 
     </tr>
     <tr>
     <td width="30%"> Location of Report Crime/ Incident :     </td>
		<td><?=stripslashes($row_add[sa_location])?></td>
	 </td>
     </tr>
	 <tr class="even">
		<td width="30%"> Report Crime/ Incident :     </td>
		<td><?=stripslashes($row_add[sa_crimedet])?></td>	 
     </tr>
     <tr>
     <td width="30%"> Person IP Address :     </td>
		<td><?=stripslashes($row_add[sa_ip])?></td>
	 </td>
     </tr>
	 <tr class="even">
		<td>&nbsp;</td>
	 </tr>     
     <tr >
     	<td>
        <a href="index.php"><input type="button" class="button" value="Back" name="submit"></a>
        </td>
     </tr>   
</table>
    </form>
     <p>&nbsp;</p>
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</div>
<?admin_footer()?>