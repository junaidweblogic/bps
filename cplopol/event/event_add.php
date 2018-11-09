<?php 
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
include_once '../../common/ckeditor/ckeditor.php';
 include("../../common/diffrence.php"); 

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}
$id=$_GET[pid];
$query="select * from ".$tblpref."content_master where cms_id='$pid'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result); 

admin_header('../../','Event',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
?>
<script type="text/javascript" src="../../common/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../../js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../js/daterangepicker.jQuery.js"></script>
<link rel="stylesheet" href="../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />

<script type="text/javascript"> 
$(function(){
  $('#datepicker').daterangepicker({
	posX:250,
	posY: 350
  }); 
});
</script>
<style type="text/css">
.ui-daterangepickercontain {
	top:220px;
	left:400px;
	position: absolute;
	z-index: 999;
}
</style>
<!--body start -->
<div class="adminbody">
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="index.php"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>
<div class="gap"></div>
<?
$flag = $_REQUEST[flag];
if($flag=="exists"){?>
<p align="center" class="error">Event already exists.</p>
<? }
if($flag=="imgsize"){?>
	<p align="center" class="error">Image resolution exceeded.</p>
	<?php  } 
	if($flag=="noimg"){?>
		<p align="center" class="error">Upload Image Only!.</p>
	<?php  } 
	if($flag=="nodoc"){?>
		<p align="center" class="error">Upload only Document.</p>
	<?php  }
	if($flag=="filesize"){?>
		<p align="center" class="error">File size is not more then 2 MB.</p>
	<?php  }?>	   

<div class="box">
    <div class="hdr">
	<? if($id!=""){?><h1 class="ico-edit">Edit</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt="">Event</h1>
    </div>
    </div> 
	<div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return validate();" action="submit_event.php" enctype="multipart/form-data">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<td> Event Title<font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td>
		<input type="text" name="event" id="event" class="smlinput" value="<?php  echo stripslashes($row_add[cms_title])?>" onblur="empty(this.id);">
	</td>
     </tr>
	 <tr class="even">
		<td> Date&nbsp;Of&nbsp;Event<font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td>
		<?php  if($row_add[cms_subdate]!=""){
								$datepicker=dateformate($row_add[cms_subdate]);
							}?>
		<input type="text" value="<?php  echo $datepicker; ?>" name="datepicker" id="datepicker" class="smlinput">
	</td>
     </tr>
	 <tr class="even">
		<td> Description :     </td>
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
		<td> Image Upload: :     </td>
     </tr>
     <tr>
     <td>
		<input type="file" name="fileeventimage" value="<?php  echo $row_add[cms_file] ?>" class="smlinput">
					<?php if($row_add[cms_file] !=""){?>					
					<a href="#"  onclick="open('../../possbpser/<?php  echo $row_add[cms_file]?>','barcode','scrollbars=1,toolbar=0,location=0,resizable=0,width=500,height=520')"> View Image</a> 
					<?php }?><strong> Upload Only Image !</strong> 
	</td>
     </tr>
	 <tr class="even">
		<td> Document Upload :     </td>
     </tr>
     <tr>
     <td>
		<input type="file" name="fileeventdoc" value="<?php  echo $row_add[cms_file1] ?>" class="smlinput">
					<?php if($row_add[cms_file1] !=""){?>					
					<a href="#"  onclick="open('../../possbpser/<?php  echo $row_add[cms_file1]?>','barcode','scrollbars=1,toolbar=0,location=0,resizable=0,width=500,height=520')"> View Document</a> 
					<?php }?><strong> Upload Only  Document !</strong> 
	</td>
     </tr>
	 <tr >
     	<td>
        <input type="submit" class="button" value="Submitt" name="submit">
		<?if($pid==""){?>
		<input type="hidden" value="add" name="txtmode" >
		<?}else{?>
		<input type="hidden" value="<?=$pid?>" name="pid" >
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
	var error = true;
	   if(document.frmcmsadd.event.value=="")
		{
			document.getElementById('eevent').innerHTML = "Please Enter Title !";
			document.frmcmsadd.event.focus();
			error =  false;
		 }
		 
		if(document.frmcmsadd.datepicker.value=="" || document.frmcmsadd.datepicker.value=="--")
		{
			document.getElementById('edatepicker').innerHTML = "Please Enter Event Date!";
			document.frmcmsadd.datepicker.focus();
			error =  false;
		 }
		
					
		if (error != true)
		{
		
			return false;
		}
		else
		{
			return true;
		}
}
</script>