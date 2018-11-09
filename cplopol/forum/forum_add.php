<?
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

$query="select * from ".$tblpref."forum where f_id='$id'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);

admin_header('../../','Forum',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
?>
<!--body start -->
<div class="adminbody">
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="index.php"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>
<div class="gap"></div>
<div class="box">
    <div class="hdr">
	<? if($id!=""){?><h1 class="ico-view">View</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt="">Forum</h1>
    </div>
    </div> 
<div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return country();" action="submit.php">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<td width="30%"> Name : </td>
		<td><?=$row_add[f_name]?></td>
     </tr>
     <tr>
		<td> Date : </td>
		<td><? $date = explode(" ",$row_add[f_date]); echo dateformate($date[0]);?>&nbsp;&nbsp;<?php echo $date[1]?></td>
     </tr>
	 <tr class="even">
		<td> Poster IP Address : </td>
		<td><?=$row_add[f_ip]?></td>
     </tr>
     <tr>
		<td> Status : </td>
		<td><?=$row_add[f_status]?></td>
     </tr>
	  <tr class="even">
		<td> Comments : </td>
		<td><?=$row_add[f_post]?></td>
     </tr>
	 <tr class="even">
		<td colspan="2">&nbsp;</td>
	 </tr>     
     <tr >
     	<td colspan="2">
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