<?php 
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}
include("../../common/fckeditor/fckeditor_php5.php");

admin_header('../../','Media Release',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);

$query="SELECT * FROM ".$tblpref."content_master WHERE cms_id='$mid' ";
	if(!($result=mysqli_query($connection,$query))){echo mysqli_error($query); exit;}
	$row_add=mysqli_fetch_array($result);

$query1="select * from ".$tblpref."media where med_id='$row_add[cms_subtype]'"; 
if(!($result1=mysqli_query($connection,$query1))){ echo $query1.mysqli_errno($connection); exit;}
$row1=mysqli_fetch_array($result1);

include("funfile1.php");   
?>
<script type="text/javascript" src="../../js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../js/daterangepicker.jQuery.js"></script>
<link rel="stylesheet" href="../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />

<script type="text/javascript"> 
$(function(){
  $('#datepicker').daterangepicker({
posX:470,
posY: 180
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
<p align="center" class="error">File size should not  be more than 15 MB.</p>
<? } 
if($flag=="type"){?>
<p align="center" class="error">File type should be only DOC or PDF.</p>
<? }
if($flag=="exists"){?>
<p align="center" class="error">Media Name already exists.</p>
<? }
if($flag=="print"){?>
<p align="center" class="error">Please upload any of JPEG/ JPG/ PNG/ GIF image.</p>
<? }
if($flag=="audio"){?>
<p align="center" class="error">Please upload any of WMA / WAV Audio / MP3 .</p>
<? }
if($flag=="video"){?>
<p align="center" class="error">Please upload any of MPEG /MPG/ AVI Video.</p>
<? }
if($flag=="newsletter"){?>
<p align="center" class="error">Please upload any of pdf /doc/ docx Document.</p>
<? } ?>	
<div class="box">
    <div class="hdr">
	<? if($mid!=""){?><h1 class="ico-edit">Edit</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt="">Media Release</h1>
    </div>
    </div> 

	<div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return validateform();" action="submit-media.php" enctype="multipart/form-data">
     <table width="100%" border="0" cellspacing="0" cellpadding="0" >
     <tr class="even">
		<td> Publisher<font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td>
		<?php   $query1="select * from ".$tblpref."media"; 
             if(!($result1=mysqli_query($connection,$query1))){ echo $query1.mysqli_errno($connection); exit;}?>
	 <select name="tencat" id="tencat" class="smlinput" onchange="putMedia(this.value); empty(this.id);">
			<option value="">Please Select</option>
			<?php  while($row=mysqli_fetch_array($result1))
			{?>
			<option value="<?php  echo $row[med_id]?>" <?php if($row[med_id]==$row_add[cms_subtype]){?>selected <?php }?>><?php  echo $row[med_pub]?> </option>
			<?php }
			 mysqli_free_result($result1);
			 ?>
			</select>
			<input type="hidden" name="med_type" id="med_type" value="" /></td>
     </tr>
	 <tr class="even">
		<td> Media Release Title<font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
		<td>			
			<input type="text" name="med_name" id="med_name" class="smlinput" value="<?php  echo stripslashes($row_add[cms_title])?>" onchange="empty(this.id);">			
		</td>
     </tr>

	<tr class="even">
		<td> Date of publishing<font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
		<td>	
			<?php  if($row_add[cms_date]!=""){
				$datepicker=dateformate($row_add[cms_date]);
							} ?>
			<input type="text" value="<?php  echo $datepicker?>" name="datepicker" id="datepicker" class="smlinput">
		</td>
     </tr>

	<? if($row1[med_type]!='Video media') {
			$dis = "block";
			} else { $dis = "none"; } ?>
     <tr>
		<td>	
			<div id="checkup" style="display:<?=$dis?>;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" >
			 <tr class="even">
				<td> Upload:     </td>
			 </tr>
			 <tr>
				<td>
			<input type="file" name="produ_image" id="produ_image"  class="smlinput">
			<?php if(  $row_add[cms_file]!=""){?><a href="#" onclick="open('../../possbpser/<?php  echo $row_add[cms_file]?>','barcode','scrollbars=0,toolbar=0,location=0,resizable=0,width=600,height=600')">View Media</a><?php }?>
			</td>
			</tr>
			</table>
			</div>
		</td>
     </tr>
	 <? if($row1[med_type]!='Video media') {
			$dis = "none";
			} else { $dis = "block"; } ?>
			 <tr>
		<td>	
			<div id="checkup1" style="display:<?=$dis?>;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" >
			 <tr class="even">
				<td> Description / Embed Code from YouTube Video :  </td>
			 </tr>
			 <tr>
				<td>
					<textarea name="comment"  class="smlinput"><?php  echo stripslashes($row_add[cms_desc]);?></textarea>
				</td>
			</tr>
			</table>
			</div>
		</td>
     </tr>


			
			
		
			<? if($row1[med_type]!='Video media') {
			$dis = "none";
			} else { $dis = "block"; } ?>
			<tr>
		    <td colspan="2">
			<div id="checkup1" style="display:<?=$dis?>;">
			<table width="100%">
			<tr>
					<td align="right" width="30%" class="tbborder">Description / Embed Code from YouTube Video :</td>
					<td align="left" style="padding-left:5px;" class="tbborder">
					<textarea name="comment" cols="75" rows="10"><?php  echo stripslashes($row_add[cms_desc]);?></textarea></td>
					</tr>
				</table>
			</div>
			</td>
			</tr>	
			<tr class="even">
		<td>&nbsp;</td>
	 </tr>     
     <tr >
     	<td>
        <input type="submit" class="button" value="Submitt" name="submit">
		<?if($mode=="add"){?>
		<input type="hidden" value="add" name="txtmode" >
		<?}else{?>
		<input type="hidden" value="edit" name="txtmode" >
		<input type="hidden" value="<?php  echo $mid?>" name="medid" ><?php }?>
		<input type="hidden" value="<?php  echo $status?>" name="status" >
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
            



<script type="text/javascript">
function putMedia(media) {
		var url;
		url = "view_Test2.php?media="+media;
		var xmlHttp;
		try
		{  
		// Firefox, Opera 8.0+, Safari 
			 xmlHttp=new XMLHttpRequest();  
		}
		catch (e)
		{ 
		 // Internet Explorer  
			try
			{    
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");    
			}
			catch (e)
			{    
				try
				{     	
					xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");      
				}
				 catch (e)
				 {      
					  alert("Your browser does not support AJAX!");
					  return false;  
				 }
			}
		  }
		  xmlHttp.onreadystatechange=function()
		  {
			if(xmlHttp.readyState==4)
			{
				xx=xmlHttp.responseText;
	
				if(xx == "p")
				{
					document.getElementById('checkup').style.display="block";
					document.getElementById('checkup1').style.display="none";
					document.getElementById('WarningMsg').innerHTML = 'Please upload any of JPEG/ JPG/ PNG/ GIF/ PDF/ DOC/ XLS';
				}
				if(xx == "a")
				{

					document.getElementById('checkup').style.display="block";
					
					document.getElementById('checkup1').style.display="none";
					document.getElementById('WarningMsg').innerHTML = 'Please upload any of WMA / WAV Audio / MP3 max 10MB';
				}
				if(xx == "v")
				{
					document.getElementById('checkup').style.display="none";
					document.getElementById('checkup1').style.display="block";
					document.getElementById('WarningMsg').innerHTML = 'Please upload any of MPEG /MPG/ AVI Video max 10MB';
				}
				if(xx == "n")
				{
					document.getElementById('checkup').style.display="block";
					document.getElementById('checkup1').style.display="none";
					document.getElementById('WarningMsg').innerHTML = 'Please upload any of pdf /doc/ docx Document max 10MB';
				}
				if(xx == "")
				{
					document.getElementById('checkup').style.display="block";
					document.getElementById('checkup1').style.display="none";					
					document.getElementById('WarningMsg').innerHTML = '';
				document.getElementById('med_type').value = xx;

				}
			}
		  }
		  xmlHttp.open("Get",url,true);
		  xmlHttp.send(null);	
}
</script>

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
function validateform()
{	
 	var tencat = document.frmcmsadd.tencat.value;
	var med_name = document.frmcmsadd.med_name.value;
	var datepicker = document.frmcmsadd.datepicker.value;

	var error=true;
	 
	if (tencat == "")
	{
		document.getElementById('etencat').innerHTML = "Please Enter Select the Publisher!";
		document.frmcmsadd.tencat.focus();
		error = false;
	} 
	if (med_name == "")
	{
		document.getElementById('emed_name').innerHTML = "Please Enter the Media Release Title!";
		document.frmcmsadd.med_name.focus();
		error = false;
	} 
	if (datepicker == "")
	{
		document.getElementById('edatepicker').innerHTML = "Please Enter the Date of publishing!";
		document.frmcmsadd.datepicker.focus();
		error = false;
	} 
	
	return error;
}
</script>
