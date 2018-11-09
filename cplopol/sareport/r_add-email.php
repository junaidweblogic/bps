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

$query="select * from ".$tblpref."susp_alleg where sa_id='$rid'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);

admin_header('../../','Crime Report/Incident',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
?>

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
<script type="text/javascript" src="../../common/ckeditor/ckeditor.js"></script>

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
        <h1 class="ico"><img src="icon/icon.png" alt="">Crime Report/Incident</h1>
    </div>
    </div> 

<div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return validate();" action="submit_r.php" enctype="multipart/form-data">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<td> Reporter Name :     </td>
     </tr>
     <tr>
     <td>
		<?=stripslashes($row_add[sa_name])?>
	 </td>
     </tr>
	 <tr class="even">
		<td> Reporter Email :     </td>
     </tr>
     <tr>
     <td>
		<?=stripslashes($row_add[sa_email])?>
	 </td>
     </tr>
	 <tr class="even">
		<td> Your Response :     </td>
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
			$ckeditor->config['filebrowserFlashUploadUrl'] = $ckpath.'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';				$ckeditor->editor('linkcontect',stripslashes($row_add[sa_response]));		
		?>
	 </td>
     </tr>
	 <tr class="even">
		<td>&nbsp;</td>
	 </tr>   
	 <? if($row_add[sa_email]!="") {?>
     <tr >
     	<td>
        <input type="submit" class="button" value="Submitt" name="submit">
		<?if($rid==""){?>
		<input type="hidden" value="add" name="txtmode" >
		<?}else{?>
		<input type="hidden" value="<?=$rid?>" name="rid" >
		<?}?>
		<input type="hidden" name="sendresponse" value="yes" />
        </td>
     </tr>   
	 <?php
		}
		else
		{ ?>
		<tr>
		<td>
			<div class="error">If the reporter did not include the email address the response will not be sent</div>
			</td>
			</tr>
		<?php
		} ?>

     </table>
    </form>
     <p>&nbsp;</p>
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</div>
<?admin_footer()?>