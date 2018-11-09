<?php 
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}
if($mid!="")
{
$query="select * from ".$tblpref."media where med_id='$mid'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);
 mysqli_free_result($result);
$mpub = stripslashes($row_add[med_pub]);
$med_type = $row_add[med_type];
}
admin_header("../../","Media Publishers");
admin_nav("../../");
?>
<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0" align="center">
  <tr>
	<td>
	    <table cellspacing="0" cellpadding="0" border="0" width="90%" align="center" >
	       <tr><td align="center" ><h2>Media Publishers</h2></td></tr>
		   <tr><td height="12px"></td></tr>
		   <?php  if($flag=="exists"){?>
		<tr>
			<td colspan="8" align="center"><font color="red"> Publishers already exists</font></td>
		</tr>
	<?php  }
	?>
		   <tr><td align="center">
		       <FORM NAME="frmmedadd" METHOD="POST" ACTION="submit-pub-media.php" onsubmit="return validate();" enctype="multipart/form-data">
			    <TABLE 	cellspacing="1" cellpadding="5" border="1" style="border-collapse:collapse; "  bordercolor="#ABD4E7" width="90%" >
				<TR><TH colspan="2" align="center" ><?php if($puid!=""){?>Edit Publisher<?php }else{?>Add New Publisher<?php }?></TH></TR>
				
				<?php
					if($_REQUEST['flag'] != "") {
						switch($_REQUEST['flag']) {
							case "size" : $msg = "File Size should be 15 MB not more than that!";	break;
							case "msg" : $msg = "Upload only Image!";	break;
						}
					?>
				<TR>
		         <TD colspan='2' align="center" class="tbborder"><label class='warning'><?php echo $msg;?></label></TD>
				 
				 </TR>
				<?php } ?>
				
				
				 <TR>
		         <TD align="right" class="tbborder">Publisher :<FONT COLOR="#FF0000">*</FONT></TD>
				 <TD align="left" style="padding-left:5px;" class="tbborder"><input type="text" name="mpub" id="mpub" value="<?php  echo $mpub;?>" onchange="empty(this.id);"/>
				 <br><label id='empub' class='warning'></label></TD>
				 </TR>

				 <TR>
				  <TD align="right" class="tbborder">Media Type:</TD>
				  <TD align="left" style="padding-left:5px;" class="tbborder">
					  <select NAME="med_type" id="med_type" style="width:600px" >
					  <option value="Print Media" <?php if($med_type=="Print Media"){?>selected<?php  	} ?>>Print Media</option>
					  <option value="Audio Media" <?php if($med_type=="Audio Media"){?>selected<?php  	} ?>>Audio Media</option>
					  <option value="Video media" <?php if($med_type=="Video media"){?>selected<?php  	} ?>>Video media</option>
					  <option value="Newsletter" <?php if($med_type=="Newsletter"){?>selected<?php  	} ?> >Newsletter</option>
					  </select>
					</TD>
				</TR>
				<TR>
				<TD align="right" class="tbborder" >Logo of Publisher:</TD>
				<TD align="left" style="padding-left:5px;" class="tbborder">
				<input type="file" name="upload" value="">
				<?php  if($row_add[med_pub_logo]!=""){?>						
				 <a href="#" ONCLICK="open('../../possbpser/<?php  echo $row_add[med_pub_logo]?>','barcode','scrollbars=1,toolbar=0,location=0,resizable=0,width=600,height=600')"> View Image<a>  
				<?php  }?>
				<label class='warning'>Picture should be less than 100 KB </label>
				<br><label id='vupload' class='warning'></label>
				</TD>
				</TR>
				<TR>
		        <TD align="center" colspan="2" class="tbborder">
				<input type="hidden" value="<?php  echo $mid?>" name="mid" >
				<INPUT TYPE="submit" value="Submit" Name="submit" class="mybutton" onclick="return val();" >&nbsp;&nbsp;</TD>
		        </TR>
				
				 
				</TABLE>
			   </FORM>
		   </td></tr>
		   </table>
	</td>
  </tr>
  <tr><td>&nbsp;</td></tr>
</TABLE>	

<?php  admin_footer("../../");?>
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
	    if(document.frmmedadd.mpub.value=="")
		{
			document.getElementById('empub').innerHTML = "Please Enter Publisher  !";
			document.frmmedadd.mpub.focus();
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