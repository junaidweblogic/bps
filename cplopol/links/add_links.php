<?php session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}
include("../../common/fckeditor/fckeditor_php5.php");

admin_header('../../','Links',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);

	$query="select * from ".$tblpref."content_master where cms_id='$lid' ";
	if(!($result=mysqli_query($connection,$query))){echo $query.mysqli_errno($connection); exit;}
	$row_add=mysqli_fetch_array($result);
	mysqli_free_result($result);
?>

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
function validateform3()
{	
 	var ten_name = document.frmcmsadd.ten_name.value;
 
	var error=true;

	if (ten_name == "")
	{
		document.getElementById('eten_name').innerHTML = "Please Enter link Name!";
		document.frmcmsadd.ten_name.focus();
		error = false;
	} 
	
	if (document.frmcmsadd.s_url.value == "")
	{
		document.getElementById('es_url').innerHTML = "Please Enter Site URL to Open !";
		document.frmcmsadd.s_url.focus();
		error = false;
	} 
	return error;
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
	<? if($lid!=""){?><h1 class="ico-edit">Edit</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt="">Link</h1>
    </div>
    </div> 

	 <div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return validateform3();" action="submit_links.php" enctype="multipart/form-data">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<td> Name of the Link <font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td>
		<INPUT TYPE="text" NAME="ten_name" id="ten_name" class="smlinput" value="<?php  echo stripslashes($row_add[cms_title])?>" onchange="empty(this.id);">
	</td>
     </tr>
	  <tr class="even">
		<td> Site URL to Open  <font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td>
		http:// <input type="text" value="<?php  echo stripslashes($row_add[cms_sitelink])?>" name="s_url" id="s_url" class="smlinput" >
	</td>
     </tr>
	  <tr class="even">
		<td> Thumbnail&nbsp;Image&nbsp; :  </td>
     </tr>
     <tr>
     <td>
		<INPUT TYPE="file" NAME="produ_image" id="produ_image" class="smlinput">
			<?php  if($row_add[cms_file1] !=""){?>					
			<a href="#"  ONCLICK="open('../../possbpser/<?php  echo $row_add[cms_file1]?>','barcode','scrollbars=1,toolbar=0,location=0,resizable=0,width=500,height=520')"> View Image <a>
			<?php
	 } ?>
	</td>
     </tr>
	 <tr class="even">
		<td> Description :  </td>
     </tr>
     <tr>
     <td>
			<textarea name="linkcontect" class="smlinput"><?php  echo stripslashes($row_add[cms_desc])?></textarea>
	</td>
     </tr>
	 <tr >
     	<td>
        <input type="submit" class="button" value="Submitt" name="submit">
		<?if($lid==""){?>
		<input type="hidden" value="add" name="txtmode" >
		<?}else{?>
		<input type="hidden" value="<?=$lid?>" name="lid" >
		<?}?>
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