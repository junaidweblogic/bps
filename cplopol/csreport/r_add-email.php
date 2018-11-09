<?
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
include("../../common/fckeditor/fckeditor_php5.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}
$rid = $_GET[rid];

$query="select * from ".$tblpref."askpolice where ap_id='$rid'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);

admin_header("../../","Ask the Police Report Management");
admin_nav("../../");
?>

<SCRIPT LANGUAGE="JavaScript">
function validate()
{
	   if(document.frmcmsadd.name.value=="")
		{
			alert("Please enter name");
			document.frmcmsadd.name.focus();
			return false;
		}
  				
 return true;
}


</SCRIPT>

<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0" align="center">
<TR>
	<TD>
	<table cellspacing="0" cellpadding="0" border="0" width="90%" align="center" >
	<tr><td align="center" ><h2>Ask the Police Report Management</h2></td></tr>
	<tr><td height="12px"></td></tr>
	<tr><td>
			<TABLE border="1" cellspacing="1" cellpadding="3" bordercolor="#679ebe" style="border-collapse:collapse; "  width="100%" >
			<FORM NAME="frmcmsadd" METHOD="POST" onsubmit="return validate();" ACTION="submit_r.php">
			<input type="hidden" name="sendresponse" value="yes" />
			<tr><th colspan="2" align="center" ><?if($id!=""){?>Send Response Of Ask the Police Report<?}else{?>Add New Ask the Police Report<?}?></th>
			</td></tr>

			<TR>
		    <TD align="right" >Reporter Name :</TD>
			<TD align="left" style="padding-left:5px;" ><?=stripslashes($row_add[ap_name])?></TD>
			</TR>

			<TR>
		    <TD align="right" >Reporter Email :</TD>
			<TD align="left" style="padding-left:5px;"><?=stripslashes($row_add[ap_email])?></TD>
			</TR>
			
            <TR>
			<TD align="right" >Your Response :</TD>
			 <TD align="left" style="padding-left:5px;"><?php
								$oFCKeditor = new FCKeditor('linkcontect') ;
								$oFCKeditor->BasePath = '../../common/fckeditor/';
								$oFCKeditor->Value = stripslashes($row_add[r_response]);
								$oFCKeditor->Width  = '550' ;
								$oFCKeditor->Height = '450' ;
								$oFCKeditor->Create() ;
								?>
			</td>
			</TR>
															  	
		<TR>
		<td align="center" colspan="2" >
		<input type="hidden" value="add" name="txtmode" >
		<input type="hidden" value="<?=$rid?>" name="rid" >
		<INPUT TYPE="submit" value="Submit" Name="submit" class="mybutton">&nbsp;&nbsp;</td>
		</tr>
		
		</FORM>
		</TABLE>

</TD>
</TR>
</table>
</TD>
</TR>
<tr><td>&nbsp;</td></tr>
</table></td>
 </tr>
  </table>

<?admin_footer("../../");?>