<?php 
@session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
include_once '../../common/ckeditor/ckeditor.php';
include("../../common/diffrence.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}
$id=$_GET[nid];
$query="select * from ".$tblpref."content_master where cms_id='$nid'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);

admin_header('../../','News',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
?>
<script type="text/javascript" src="../../common/ckeditor/ckeditor.js"></script>
<script language="JavaScript" src="../../common/date-picker.js"></script>	
<!--body start -->
<div class="adminbody">
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="index.php"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>
<div class="gap"></div>
<?
$flag = $_REQUEST[flag];
if($flag=="filesize"){?>
<p align="center" class="error">File size is not more then 2 MB.</p>
<? }
if($flag=="exists"){?>
<p align="center" class="error">News Name already exists.</p>
<? }
if($flag=="imgsize"){?>
<p align="center" class="error">Image resolution exceeded.</p>
<? } ?>	   
<div class="box">
    <div class="hdr">
	<? if($id!=""){?><h1 class="ico-edit">Edit</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt="">News</h1>
    </div>
    </div> 
	<div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return validateform1();" action="submit_news.php" enctype="multipart/form-data">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<td> News Title<font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td>
		<input type="text" name="name" id="name" value="<?php  echo stripslashes($row_add[cms_title])?>" onchange="empty(this.id);" class="smlinput" >
	 </td>
     </tr>
	  <tr class="even">
		<td> Archived :     </td>
     </tr>
     <tr>
     <td>		
		<input type="checkbox" name="chkarchieve" value="1" <?php if($row_add[cms_archived]=="yes"){?>checked<?php }?>>
	 </td>
     </tr>
	 <?php  if($nid!=""){?>
	 <tr class="even">
		<td> Age: :     </td>
     </tr>
     <tr>
     <td>		
		 <?php  differencedate($row_add[cms_date]." ".$row_add[cms_time]); ?> 
	 </td>
     </tr>
	 <?php  }?>
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
		<td> Image <font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td>
			<input type="file" name="filenewsimage" value="<?php  echo $row_add[cms_file] ?>" class="smlinput">
			<?php if($row_add[cms_file] !=""){?>					
			<a href="#"  onclick="open('../../possbpser/<?php  echo $row_add[cms_file]?>','barcode','scrollbars=1,toolbar=0,location=0,resizable=0,width=600,height=600')"> View Image</a> 
			<?php }?>
			<label class="error">Image size must be 600px X 600px </label>
	 </td>
     </tr>
	  <tr class="even">
		<td> Show on Home <font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td>
			<input type="checkbox" name="chkshow"  <?php if($row_add[cms_featured]=="yes"){?>checked<?php }?>>
	 </td>
     </tr>
	 <tr class="even">
		<td>&nbsp;</td>
	 </tr>     
     <tr >
     	<td>
        <input type="submit" class="button" value="Submitt" name="submit">
		<?if($nid==""){?>
		<input type="hidden" value="add" name="txtmode" >
		<?}else{?>
		<input type="hidden" value="<?=$nid?>" name="nid" >
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

function validateform1()
{		
		var error = true;
		
		if (document.frmcmsadd.name.value=="")
		 { 
  			document.getElementById('name').innerHTML = "Please Enter Title !";
		  	document.frmcmsadd.name.focus();
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
