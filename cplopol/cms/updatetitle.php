<?php 
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
include("../../common/fckeditor/fckeditor_php5.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

$query="select * from ".$tblpref."content_master where cms_id='$cid'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);
$row_add[cms_subtype];

$query1="select * from ".$tblpref."category where cat_type='cms'"; 
if(!($result1=mysqli_query($connection,$query1))){ echo $query1.mysqli_errno($connection); exit;}
admin_header('../../','Update Title',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
//admin_nav("../../");
?>
<script language="JavaScript">
function validate()
{
	   if(document.frmcmsadd.name.value=="")
		{
			alert("Please enter name");
			document.frmcmsadd.name.focus();
			return false;
		}

	  				
 return true;
}
</script>
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
	<? if($id!=""){?><h1 class="ico-edit">Edit</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt="">Update Title</h1>
    </div>
    </div> 

	<div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return currency();" action="submittitle.php">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<td> Name<font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td><input type="text" name="name" id="name" value="<?=stripslashes($row_add[cms_title])?>" onBlur="text(this.id);" class="smlinput" />
		<input type="hidden" name="txthide" value="<?php  echo $row_add[cms_id]?>">
	</td>
     </tr>
	 <tr >
     	<td>
        <input type="submit" class="button" value="Submitt" name="submit">
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