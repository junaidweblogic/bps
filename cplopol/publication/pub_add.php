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
$flg = $_REQUEST['flag'];
$puid = $_REQUEST['puid'];
if($flg=="type")
{
	$pub_name = $_REQUEST['pub_name'];
	$pub_cat = $_REQUEST['pub_cat'];
	$publication = $_REQUEST['publication'];
	$linkcontect = $_REQUEST['linkcontect'];
	$author = $_REQUEST['author'];

}
	$query="select * from ".$tblpref."content_master where cms_id='$puid'"; 
	if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
	$row_add=mysqli_fetch_array($result);

if($flg=="type")
{
	$linkcnt = $linkcontect;
}
else
{
	$linkcnt = stripslashes($row_add[cms_desc]);
}

admin_header('../../','Publications',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
?>
<script type="text/javascript" src="../../common/ckeditor/ckeditor.js"></script>
<!--body start -->
<div class="adminbody">
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="index.php"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>
<div class="gap"></div>
<?
$flag = $_REQUEST[flag];
if($flag=="exists"){?>
<p align="center" class="error">Record is already exist.</p>
<? }
if($flag=="filesize"){?>
<p align="center" class="error">File size is not more then 100 KB.</p>
<? }
if($flag=="type"){?>
<p align="center" class="error">Document type must be PDF only.</p>
<? } ?>

<div class="box">
    <div class="hdr">
	<? if($puid!=""){?><h1 class="ico-edit">Edit</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt="">Publications</h1>
    </div>
    </div> 
<div class="padtb">
     <form name="frmcmsadd" method="POST" action="submit_pub.php" enctype="multipart/form-data">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<td> Publications Category<font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td>
		<select name="pub_cat" id="pub_cat" class="smlinput" onchange="empty(this.id);">
		<option value="" >Please Select</option>
		<?php  $query1="select * from ".$tblpref."category WHERE cat_type = 'Publication'"; 
		if(!($result1=mysqli_query($connection,$query1))){ echo $query.mysqli_errno($connection); exit;}
		while($row=mysqli_fetch_array($result1)){?>
		<option value="<?php  echo $row[cat_id]?>" <?php if($row[cat_id]==$row_add[cms_subtype]){?>selected <?php }?>><?php  echo $row[cat_title]?> </option>
		<?php }?>
		</select>
	 </td>
     </tr>
	 <tr class="even">
		<td> Publications Category<font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td>
		<input type="text" name="pub_name" id="pub_name" class="smlinput"  value="<?php if($flg=="type"){
			echo $pub_name;}else{echo stripslashes($row_add[cms_title]);}?>" onchange="empty(this.id);">
	 </td>
     </tr>
	 <tr class="even">
		<td> Author<font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td>
		<input type="text" name="author" id="author" value="<?php  if($flg=="type"){
			echo $author;}else{echo stripslashes($row_add[cms_page_title]);}?>" onchange="empty(this.id);" class="smlinput">
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
		<td> Picture Upload :     </td>
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
		<td> Pdf  Upload :     </td>
     </tr>
     <tr>
     <td>
		<input type="file" name="upload1" value="<?php  echo $row_add[cms_file1] ?>" class="smlinput">
		<?php if($row_add[cms_file1] !=""){?>						
		<a href="#" onclick="open('../../possbpser/<?php  echo $row_add[cms_file1]?>','barcode','scrollbars=1,toolbar=0,location=0,resizable=0,width=500,height=520')"> View Document</a> 
		<?php }?>
	 </td>
     </tr>
	  <tr class="even">
		<td>&nbsp;</td>
	 </tr>     
     <tr >
     	<td>
        <input type="submit" class="button" value="Submitt" name="submit">
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

	if (document.frmpubadd.author.value=="")
	{ 
  		document.getElementById('eauthor').innerHTML = "Please Enter Author Name!";
		document.frmpubadd.author.focus();
		warning =  false;
	}
return warning;
}
</script>