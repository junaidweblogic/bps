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
admin_header('../../','FAQ',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);

$faqid = $_GET[faqid];
$query="select * from ".$tblpref."content_master where cms_id='$faqid' ";
if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);
?>

<script type="text/javascript" src="../../cal_js/daterangepicker1.jQuery.js"></script>
<link rel="stylesheet" href="../../css/ui.daterangepicker1.css" type="text/css" />
<script type="text/javascript">	
	$(function(){
		  $('#txtdate').daterangepicker({
			posX: null,
			posY: null
		  }); 
	 });
</script>
		
		<!-- from here down, demo-related styles and scripts -->
<style type="text/css">
	body { font-size: 62.5%; }
	
</style>
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
	<? if($faqid!=""){?><h1 class="ico-edit">Edit</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt="">FAQ</h1>
    </div>
    </div> 
	<div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return validate();" action="submit_faq.php" enctype="multipart/form-data">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<td> Question<font color="#ff0000">* </font> :     </td>
     </tr>
	 <tr>
     <td>
		<input type="text" name="txtname"  id="txtname" class="smlinput" value="<?php  echo stripslashes($row_add[cms_title])?>" onchange="empty(this.id);">
	</td>
    </tr>
	<tr class="even">
		<td> Answer :     </td>
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
	<tr class="even">
					<td>&nbsp;</td>
				</tr>     
     <tr >
     	<td>
        <input type="submit" class="button" value="Submitt" name="submit">
		<?if($faqid==""){?>
		<input type="hidden" value="add" name="txtmode" >
		<?}else{?>
		<input type="hidden" value="<?=$faqid?>" name="txtid" >
		<input type="hidden" value="edit" name="txtmode" >
		<?}?>
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
<script language="JavaScript">
empty = function (id)
{
		eid = "e" + id;
		var obj = document.getElementById(id).value;

		if (obj != "")
		{
			document.getElementById(eid).innerHTML = "";
			return;
		}	
		else
		{
			document.getElementById(eid).innerHTML = "Please Enter!";	
			document.getElementById(id).focus();
		}
}
function validate()
{		
		
		var warning = true;
		if (document.frmcmsadd.txtname.value=="")
		 { 
  			document.getElementById('etxtname').innerHTML = "Please Enter Question!";
		  	document.frmcmsadd.txtname.focus();
			warning =  false;
		 }
		 
		if (warning != true)
		{
			return false;
		}
		
}
</script>