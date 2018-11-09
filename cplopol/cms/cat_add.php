<?php session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

$query="select * from ".$tblpref."category where cat_id='$id'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);

admin_header_new("../../","CMS Category");
//admin_nav("../../");
?>


<SCRIPT LANGUAGE="JavaScript">
function validate()
{
	   if(document.frmcmsadd.docname.value=="")
		{
			alert("Please enter Category!");
			document.frmcmsadd.docname.focus();
			return false;
		}

				
 return true;
}


</SCRIPT>
<script language="JavaScript" src="../../common/date-picker.js"></script>	
<script language="JavaScript" type="text/javascript" src="wysiwyg_cs.js"></script>
<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0" align="center">
<TR>
	<TD>
	<table cellspacing="0" cellpadding="0" border="0" width="80%" align="center" >
	<tr><td align="center" class="body">&nbsp;<b><h2>CMS Category</h2></b></td></tr>
	<tr><td height="12px"></td></tr>
	<tr><td>
			<TABLE width="80%" style="border-collapse: collapse" border="1" cellspacing="0" cellpadding="3" align="center">
			<FORM NAME="frmcmsadd" METHOD="POST" onsubmit="return validate();" ACTION="submit_cat.php" enctype="multipart/form-data">
			<tr><th colspan="2" align="center" ><?php if($id!=""){?>Edit<?php }else{?>Add<?php }?></th>
			</td></tr>

            <TR>
		    <TD align="right" width="30%">Category Name :</TD>
			<TD align="left" style="padding-left:5px;"><INPUT TYPE="text" NAME="docname" maxLength="150" size="50" value="<?php  echo $row_add[cat_title]?>"></TD>
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