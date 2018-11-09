<?php 
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
include("../../common/fckeditor/fckeditor_php5.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

	$query="select * from ".$tblpref."content_master where cms_id='$puid'"; 
	if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
	$row_add=mysqli_fetch_array($result);

admin_header("../../","Publications Management");
admin_nav("../../");
?>
<table cellspacing="0" cellpadding="0" width="100%" border="0" align="center">
<tr>
	<td>
	<table cellspacing="0" cellpadding="0" border="0" width="90%" align="center" >
	<tr><td align="center" ><h2>Publications Management</h2></td></tr>
	<?php if($flag=="filesize"){?>
	<tr><td height="20" class="warning" align="center">
	File size is not more then 100 KB
	</td></tr>
	<?php  }
	if($flag=="exists"){?>
		<tr>
			<td colspan="8" align="center"><font color="red"> Publications Name already exists</font></td>
		</tr>
	
	<?php  }
	if($flag=="type"){?>
		<tr>
			<td colspan="8" align="center"><font color="red"> Document type must be PDF only</font></td>
		</tr>
	<?php  }
	?>
	<tr><td height="12px"></td></tr>
	<tr><th>
	<form name="frmpubadd" method="POST" action="submit_pub.php" enctype="multipart/form-data">
		<table class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%" >
		
		<tr><th colspan="2" align="center" ><?php if($puid!=""){?>Edit Publication<?php }else{?>Add New Publication<?php }?></th>
		</tr>

 		<tr>
		<td align="right" class="tbborder">Publications Category :<font color="#FF0000">*</font></td>
		<td align="left" style="padding-left:5px;" class="tbborder">
		<select name="pub_cat" id="pub_cat" style="width:400px" onchange="empty(this.id);">
		<option value="" >Please Select</option>
		<?php  $query1="select * from ".$tblpref."category WHERE cat_type = 'Publication'"; 
		if(!($result1=mysqli_query($connection,$query1))){ echo $query.mysqli_errno($connection); exit;}
		while($row=mysqli_fetch_array($result1)){?>
		<option value="<?php  echo $row[cat_id]?>" <?php if($row[cat_id]==$row_add[cms_subtype]){?>selected <?php }?>><?php  echo $row[cat_title]?> </option>
		<?php }?>
		</select>
		<br><label id='epub_cat' class='warning'></label></td>
		</tr>		
 
		<tr>
		<td align="right" class="tbborder" >Publications Name :<font color="#FF0000">*</font></td>
		<td align="left" style="padding-left:5px;" class="tbborder"><input type="text" name="pub_name" id="pub_name" maxlength="255" size="50" value="<?php  echo stripslashes($row_add[cms_title])?>" onchange="empty(this.id);">
		<br><label id='epub_name' class='warning'></label></td>
		</tr>
		
		<tr>
		<td align="right" class="tbborder" >Author :<font color="#FF0000">*</font></td>
		<td align="left" style="padding-left:5px;" class="tbborder"><input type="text" name="author" id="author" value="<?php  echo stripslashes($row_add[cms_page_title])?>" onchange="empty(this.id);">
		<br><label id='eauthor' class='warning'></label></td>
		</tr>

		<tr>
		<td align="right" class="tbborder">Description :</FONT></td>
		<td align="left" style="padding-left:5px;" class="tbborder"><?php 
								$oFCKeditor = new FCKeditor('linkcontect') ;
								$oFCKeditor->BasePath = '../../common/fckeditor/';
								//$oFCKeditor->ToolbarSet = "Standard";
								$oFCKeditor->Value = stripslashes($row_add[cms_desc]);
								$oFCKeditor->Width  = '550' ;
								$oFCKeditor->Height = '450' ;
								$oFCKeditor->Create() ;
								?>

			</td>
			</tr>
	
	<tr>
	<td align="right" class="tbborder" >Picture Upload:</td>
	<td align="left" style="padding-left:5px;" class="tbborder">
	<input type="file" name="upload" value="<?php  echo $row_add[cms_file] ?>">
	<?php if($row_add[cms_file] !=""){?>						
	<a href="#" onclick="open('../../tmposs/<?php  echo $row_add[cms_file]?>','barcode','scrollbars=1,toolbar=0,location=0,resizable=0,width=500,height=520')"> View Image</a> 
	<?php }?>
	<label class='warning'>Picture should be less than 100 KB </label>
	<br><label id='vupload' class='warning'></label>
	</td>
	</tr>	
	
	<tr>
	<td align="right" class="tbborder" >Pdf  Upload:</td>
	<td align="left" style="padding-left:5px;" class="tbborder">
	<input type="file" name="upload1" value="<?php  echo $row_add[cms_file1] ?>">
	<?php if($row_add[cms_file1] !=""){?>						
	<a href="#" onclick="open('../../tmposs/<?php  echo $row_add[cms_file1]?>','barcode','scrollbars=1,toolbar=0,location=0,resizable=0,width=500,height=520')"> View Document</a> 
	<?php }?>
	<!-- <label class='warning'>Document should be less than 100 KB </label> -->
	<br><label id='vupload' class='warning'></label>
	</td>
	</tr>	
	
	<tr>
		<td align="center" colspan="2" class="tbborder">
		<input type="hidden" value="add" name="txtmode" >
		<input type="hidden" value="<?php  echo $puid?>" name="puid" >
		<input type="submit" value="Submit" name="submit" class="mybutton" onclick="return val();" >&nbsp;&nbsp;</td>
	</tr>
		
	</table>
</form>
</TD>
</TR>
</table>
</TD>
</TR>
<tr><td>&nbsp;</td></tr>
</table>
<?php admin_footer("../../");?>
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