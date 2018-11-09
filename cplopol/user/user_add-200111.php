<?php 
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
//include("../../fckeditor.php") ;
if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

$query="select * from ".$tblpref."admin where admin_id='$id'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);
admin_header("../../","Admin Management");
admin_nav("../../");
?>

<SCRIPT LANGUAGE="JavaScript">
function validate()
{
	   if(document.frmcmsadd.clientcode.value=="")
		{
			alert("Please enter Clientcode");
			document.frmcmsadd.clientcode.focus();
			return false;
		}

	  if(document.frmcmsadd.clientname.value=="")
		{
			alert("Please enter Client Name");
			document.frmcmsadd.clientname.focus();
			return false;
		}

				
 return true;
}


</SCRIPT>
<script type="text/javascript">
set = function( id )
{
	if(id == "1")
	{
		document.getElementById("check_1").disabled = true;
		document.getElementById("check_1").checked = false;
	}
	else
	{
		document.getElementById("check_1").disabled = false;
		
	}
}
</script>
<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0" align="center">
<TR>
	<TD>
	<table cellspacing="0" cellpadding="0" border="0" width="80%" align="center" >
	<tr><td align="center" class="body">&nbsp;<b><h2>Admin Management </h2></b></td></tr>
	<tr><td height="12px"></td></tr>
	<tr><td>
			<TABLE width="80%" style="border-collapse: collapse" border="1" cellspacing="0" cellpadding="3" align="center">
			<FORM NAME="frmcmsadd" METHOD="POST" onsubmit="return validate();" ACTION="submit_user.php">
			<tr><th colspan="2" align="center" ><?php if($id!=""){?>Edit<?php }else{?>Add<?php }?></th>
			
			 
			<TR>
			<TD align="right" >Type of Admin :</FONT></TD>
			<TD align="left" style="padding-left:5px;" >
			<INPUT TYPE="radio" NAME="chksuper"  onclick="javascript:set(this.value);" value="1" <?php if($row_add[user_type]=="subadmin"){?>checked<?php }?>>
			Sub-Admin&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="radio" NAME="chksuper" onclick="javascript:set(this.value);" value="2" <?php if($row_add[user_type]=="approver"){?>checked<?php }?>>
			Approver&nbsp;&nbsp;&nbsp;
            <INPUT TYPE="radio" NAME="chksuper" onclick="javascript:set(this.value);" value="3" <?php if($row_add[user_type]=="moderator"){?>checked<?php }?>>
			Moderator&nbsp;&nbsp;&nbsp;
			</TD>
			</TR> 
						
			<TR>
			<TD align="right" class="tbborder" >
			<div id="check1">
			Choose Management:<FONT COLOR="#FF0000">*</FONT></div></TD>
			<TD align="left" style="padding-left:5px;" class="tbborder" >
			<div id="check2">
			<TABLE>
			<!-- Check box code with validation -->
			<?php 
			$cond = false;$i=1;$j=1;
			$query1="SELECT * FROM ".$tblpref."management";
			if(!($result1=mysqli_query($connection,$query1))){ echo $query1.mysqli_errno($connection); exit;}
			while($rowman=mysqli_fetch_array($result1))
			{	
				$j++;
				if($row_add[admin_name]!="")
				{
					$query2="SELECT * FROM ".$tblpref."admin_manage WHERE admin_manage_adminname='$row_add[admin_name]'";
				
					if(!($result2=mysqli_query($connection,$query2))){ echo $query2.mysqli_errno($connection); exit;}						
					while($row2=mysqli_fetch_array($result2))
					{		
							if($row2[manage_name] == $rowman[manage_id])
									$cond = true;							
					}
				}
				
			?>					
			<?php if($i==1){ echo "<tr>";}?>
				<TD><input name="checkbox[]" type="checkbox" id="check_<?php  echo $rowman[manage_id]?>" value="<?php  echo $rowman[manage_id]?>"  <?php  
					if($cond == true) { ?> checked <?php   $cond = false; }?> /></TD>
				<TD><?php  echo $rowman[manage_name];?></TD>
			<?php if($i==2){ echo "</tr>";$i=0;}$i++;?>		
			<?php 
				$cond = false;
			}?>	
			</TABLE>
			</div>
			</td>
			</TR>
			
			<TR>
		    <TD align="right">Admin Name :</TD>
			<TD align="left" style="padding-left:5px;"><INPUT TYPE="text" NAME="adminname" maxLength="255" size="50" value="<?php  echo $row_add[admin_name]?>"></TD>
			</TR>

            <TR>
		    <TD align="right">Username :</TD>
			<TD align="left" style="padding-left:5px;"><INPUT TYPE="text" NAME="name" maxLength="255" size="50" value="<?php  echo $row_add[username]?>"></TD>
			</TR>

			<TR>
		    <TD align="right">Password :</TD>
			<TD align="left" style="padding-left:5px;"><INPUT TYPE="password" NAME="password" maxLength="255" size="50" value="<?php  echo $row_add[password]?>"></TD>
			</TR>
 	
		<TR>
		<td align="center" colspan="2">
		<input type="hidden" value="add" name="txtmode" >
		<input type="hidden" value="<?php  echo $id?>" name="id" >
		<INPUT TYPE="submit" value="Submit" Name="submit" class="mybutton">&nbsp;&nbsp;</td>
		</tr>
		</FORM>
		</TABLE>

</TD>
</TR>
</table>
</TD>
</TR>
</table>
<?php admin_footer("../../");?>