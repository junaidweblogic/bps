<?
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
include_once '../../common/ckeditor/ckeditor.php';

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}
$rid = $_GET[rid];

$query="select * from ".$tblpref."feedback_commend where fc_id='$rid'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);

admin_header('../../','Feedback & Commendation Report',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
?>
<script type="text/javascript" src="../../common/ckeditor/ckeditor.js"></script>
<SCRIPT LANGUAGE="JavaScript">
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


</SCRIPT>

<!--body start -->
<div class="adminbody">
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="index.php"><img src="../../images/back32.png" alt="Back"  title="Back" /></a></div>
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
        <h1 class="ico"><img src="icon/icon.png" alt="">Feedback & Commendation Report </h1>
    </div>
    </div> 
	<div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return validate();" action="submit_r.php">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<td> Location :     </td>
     </tr>
     <tr>
     <td><?=stripslashes($row_add[fc_loc_contact])?></td>
     </tr>
	 <tr class="even">
		<td> Reporter Email :     </td>
     </tr>
     <tr>
     <td><?=stripslashes($row_add[fc_email])?></td>
     </tr>
	  <tr class="even">
		<td> Your Response  :     </td>
     </tr>
     <tr>
     <td>
		<?php
				$ckeditor = new CKEditor();
				$ckeditor->basePath = '/ckeditor/';

				$ckeditor->config['filebrowserBrowseUrl'] = $ckpath.'/ckfinder/ckfinder.html';
				$ckeditor->config['filebrowserImageBrowseUrl'] = $ckpath.'/ckfinder/ckfinder.html?type=Images';
				$ckeditor->config['filebrowserFlashBrowseUrl'] = $ckpath.'/ckfinder/ckfinder.html?type=Flash';
				$ckeditor->config['filebrowserUploadUrl'] = $ckpath.'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
				$ckeditor->config['filebrowserImageUploadUrl'] = $ckpath.'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
				$ckeditor->config['filebrowserFlashUploadUrl'] = $ckpath.'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';				$ckeditor->editor('linkcontect',stripslashes($row_add[cms_desc]));			
				?>
	 </td>
     </tr>


															  	
		<? if($row_add[fc_email]!="") {?>	
		<tr class="even">
		<td>&nbsp;</td>
	 </tr>     
     <tr >
     	<td>
        <input type="submit" class="button" value="Submitt" name="submit">
		<input type="hidden" value="add" name="txtmode" >
		<input type="hidden" value="<?=$rid?>" name="rid" >
        </td>
     </tr>  
	 <? } else { ?>
	 <TR>
		<td align="center" colspan="2" >
		<FONT COLOR="#ff0000"><B>If the reporter did not include the email address the response will not be sent</B></FONT>
		</td>
		</tr>
		<? } ?>

     </table>
     
     </form>
     
     
     <p>&nbsp;</p>
    
     
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</div>
<?admin_footer()?>
