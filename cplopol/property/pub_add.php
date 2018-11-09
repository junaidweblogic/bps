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

	$query="select * from ".$tblpref."content_master where cms_id='$puid'"; 
	if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
	$row_add=mysqli_fetch_array($result);

admin_header('../../','Recovered Property',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
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
posX:230,
posY: 400
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
if($flag=="filesize"){?>
<p align="center" class="error">File size is not more then 100 KB.</p>
<? }
if($flag=="exists"){?>
<p align="center" class="error">Recovered Property Name already exists.</p>
<? }?>	   

<div class="box">
    <div class="hdr">
	<? if($puid!=""){?><h1 class="ico-edit">Edit</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt="">Recovered Property </h1>
    </div>
    </div> 
	<div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return country();" action="submit_pub.php" enctype="multipart/form-data">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<td> Category<font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td>
		<select name="pub_cat" id="pub_cat" class="smlinput" onchange="empty(this.id);">
		<option value="">Please Select</option>
		<?php  $query1="select * from ".$tblpref."category WHERE cat_type = 'property'"; 
		if(!($result1=mysqli_query($connection,$query1))){ echo $query.mysqli_errno($connection); exit;}
		while($row=mysqli_fetch_array($result1)){?>
		<option value="<?php  echo $row[cat_id]?>" <?php if($row[cat_id]==$row_add[cms_subtype]){?>selected <?php }?>><?php  echo $row[cat_title]?> </option>
		<?php }?>
		</select>
	 </td>
     </tr>
	  <tr class="even">
		<td> Recovered Property:<font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td>
		<input type="text" name="pub_name" id="pub_name" class="smlinput" value="<?php  echo stripslashes($row_add[cms_title])?>" onchange="empty(this.id);">
	 </td>
     </tr>
	  <tr class="even">
		<td> Show Till Date<font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td>
		<input type="text" name="datepicker" id="datepicker" value="<?php  echo dateformate($row_add[cms_subdate])?>" onchange="empty(this.id);" class="smlinput">
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
		<td> Picture Upload:<font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td>
		<input type="file" name="upload" value="<?php  echo $row_add[cms_file] ?>" class="smlinput">
		<?php if($row_add[cms_file] !=""){?>						
		<a href="#" onclick="open('../../possbpser/<?php  echo $row_add[cms_file]?>','barcode','scrollbars=1,toolbar=0,location=0,resizable=0,width=500,height=520')"> View Image</a> 
		<?php }?>
	 </td>
     </tr>
	  <tr class="even">
		<td>&nbsp;</td>
	 </tr>     
     <tr >
     	<td>
        <input type="submit" class="button" value="Submitt" name="submit" onclick="return val();">
		<?if($puid==""){?>
		<input type="hidden" value="add" name="txtmode" >
		<?}else{?>
		<input type="hidden" value="<?=$puid?>" name="puid" >
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
<script language="javascript">
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
function val()
{
	var warning = true;
	if (document.frmpubadd.pub_cat.value=="")
	{ 
			
  		document.getElementById('epub_cat').innerHTML = "Please Select Publications Category !";
		document.frmpubadd.pub_cat.focus();
		warning =  false;
	}
		
	if (document.frmpubadd.pub_name.value=="")
	{ 
  		document.getElementById('epub_name').innerHTML = "Please Enter Publications Name !";
		document.frmpubadd.pub_name.focus();
		warning =  false;
	}

	if (document.frmpubadd.datepicker.value=="" || document.frmpubadd.datepicker.value=="--")
	{ 
  		document.getElementById('edatepicker').innerHTML = "Please Enter Show Till Date !";
		document.frmpubadd.datepicker.focus();
		warning =  false;
	}


return warning;
}
</script>