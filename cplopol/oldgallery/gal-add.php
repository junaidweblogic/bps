<?php 
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}
$query="select * from ".$tblpref."category  where cat_id='$gid' ";
if(!($res=mysqli_query($connection,$query))){ echo "FOR QUERY: $query<BR>".mysqli_errno($connection); exit;}
$row=mysqli_fetch_array($res);

admin_header("../../","Picture Gallery");
admin_nav("../../");
?>
<script language="JavaScript">

function checkform()
{

	if (document.frmform.imgcap.value == "")
		{
			alert("Please Enter Album Caption");
			document.frmform.imgcap.focus();
			return false;
		}
	


}

</script>
<table cellspacing="0" cellpadding="0" width="100%" border="0" align="center">
<tr>
	<td>
	<table cellspacing="0" cellpadding="0" border="0" width="80%" align="center" >
	<tr><td align="center" class="body">&nbsp;<b><h2>Album Management</h2></b></td></tr>
	<tr><td height="12px"></td></tr>

	<?php if($flag=="del"){	?>
		<tr>
			<td colspan="8" align="center"><font color="red">Gallery image has been deleted successfully.</font></td>
		</tr>
	<?php  }
	if($flag=="add"){?>
		<tr>
			<td colspan="8" align="center"><font color="red">New image has been added successfully.</font></td>
		</tr>
	
	<?php  }
	if($flag=="exists"){?>
		<tr>
			<td colspan="8" align="center"><font color="red"> Image Name already exists</font></td>
		</tr>
	<?php  }
	?>
	
			<tr><th>
			<table class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%" >
				<form method="POST" name="frmform" action="submit-gal.php" onsubmit="return checkform()" enctype="multipart/form-data">
				<input type="hidden" name="gid" value="<?php  echo $gid?>" />
				
					<tr>
						<th align="center" height="22" colspan=2><?php  if($mode=="add"){ ?> ADD New Caption <?php  }else{?>Edit Caption<?php  }?></B></td>
					</tr>
					<tr>
						<td width="30%" align="right" class="tbborder">&nbsp;Album Caption:<font color="red">*</font>:</font></td>
						<td class="tbborder"><input type="text" name="imgcap" value="<?php  echo stripslashes($row[cat_title])?>" style="width:300px"> 
						</td>
					</tr>

					<tr>
						<td colspan="2" align="center" class="tbborder"><input type="submit" name="submit" value="Submit" class="mybutton">&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="mybutton"></font></td>
					</tr>

				</form>
				</table>
				</td>
			</tr>
			</td>
</tr>
</table>
</td>
</tr>
</table>



	<?php   admin_footer("../../");?>