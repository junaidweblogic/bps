<?php
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

$query="select * from ".$tblpref."askpolice where ap_id='$rid'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_connect_errno(); exit;}
$row_add=mysqli_fetch_array($result);

admin_header("../../","Ask the Police Report Management");
//admin_nav("../../");
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
<div class="adminbody">
		<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
		<div class="frt" style="padding-right:5px;"><a href="index.php"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>
		<div class="gap"></div>

		<div class="box">
		<div class="hdr">
		<? if($rid!=""){?><h1 class="ico-edit">Edit</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
			<div class="rtheading">
					 <h1 class="ico"><img src="icon/icon.png" alt=""><?if($id!=""){?>Send Response Of Ask the Police Report<?}else{?>Add New Ask the Police Report<?}?></h1>
			</div>
		</div>       
	    <div class="padtb">
		<form name="frmcmsadd" method="POST" onsubmit="return validate();" action="submit_r.php" enctype="multipart/form-data"> 
		
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		 	<tr class="even">
					<td>Reporter Name :</td>
			</tr>
			<tr>
					<td>
							<?=stripslashes($row_add[ap_name])?>
					</td>
			</tr>
			<tr class="even">
					<td>Reporter Email :</td>
			</tr>
			<tr>
					<td>
							<?=stripslashes($row_add[ap_email])?>
					</td>
			</tr>
			<tr class="even">
					<td>Your Response :</td>
			</tr>
			<tr>
					<td>
							<?						$ckeditor = new CKEditor();
							$ckeditor->basePath = '/ckeditor/';
							$ckeditor->config['filebrowserBrowseUrl'] = $ckpath.'/ckfinder/ckfinder.html';
							$ckeditor->config['filebrowserImageBrowseUrl'] = $ckpath.'/ckfinder/ckfinder.html?type=Images';
							$ckeditor->config['filebrowserFlashBrowseUrl'] = $ckpath.'/ckfinder/ckfinder.html?type=Flash';
							$ckeditor->config['filebrowserUploadUrl'] = $ckpath.'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
							$ckeditor->config['filebrowserImageUploadUrl'] = $ckpath.'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
							$ckeditor->config['filebrowserFlashUploadUrl'] = $ckpath.'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';			$ckeditor->editor('linkcontect',stripslashes($row_add[r_response]));?>
			</td>
					</td>
			</tr>
			<?php
			if($row_add[ap_email]!="") 
			{ ?>
			<tr class="even">
					<td>
							<input type="submit" class="button" value="Submit" name="submit">
							<?if($rid=="")
							{?>
							<input type="hidden" value="add" name="mode" >
<?						}
							else{?>
							<input type="hidden" value="<?=$rid?>" name="rid" >
							<input type="hidden" value="edit" name="mode" >
							<?}?>
					</td>
			</tr> 
			<?php
			}
			else
			{?>
			<tr class="even">
					<td>
							<div class="error"><B>If the reporter did not include the email address the response will not be sent</B></div>
					</td>
			</tr> 
			<?php
			} ?>
</table>
     
     </form>   
     
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</div>
<?admin_footer()?>
