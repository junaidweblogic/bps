<?
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

$query="select * from ".$tblpref."forum where f_id='$id'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);

admin_header("../../","Forum Management");
admin_nav("../../");
?>


<SCRIPT LANGUAGE="JavaScript">
/* function validate()
{
	   if(document.frmcmsadd.docname.value=="")
		{
			alert("Please enter Category!");
			document.frmcmsadd.docname.focus();
			return false;
		}

				
 return true;
}
 */

</SCRIPT>
<script language="JavaScript" src="../../common/date-picker.js"></script>	
<script language="JavaScript" type="text/javascript" src="wysiwyg_cs.js"></script>
<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0" align="center">
<TR>
	<TD>
	<table cellspacing="0" cellpadding="0" border="0" width="80%" align="center" >
	<tr><td align="center" class="body">&nbsp;<b><h2>Comment Management</h2></b></td></tr>
	<tr><td height="12px"></td></tr>
	<tr><td>
			<TABLE width="80%" style="border-collapse: collapse" border="1" cellspacing="0" cellpadding="3" align="center">
			<FORM NAME="frmcmsadd" METHOD="POST" onsubmit="return validate();" ACTION="submit1_forum.php" enctype="multipart/form-data">
			<tr><th colspan="2" align="center" ><?if($id!=""){?>Edit<?}else{?>Add<?}?></th>
			</td></tr>

            <TR>
		    <TD align="right" width="30%">Name :</TD>
			<TD align="left" style="padding-left:5px;"><?=$row_add[f_name]?></TD>
			</TR>
            
            
             <TR>
		    <TD align="right" width="30%">Topic :</TD>
			<TD align="left" style="padding-left:5px;">
            <? $que="SELECT * FROM ".$tblpref."forum WHERE f_id='$row_add[f_post_id]'"; 
			if(!($res=mysqli_query($connection,$que))){ echo $que.mysqli_errno($connection); exit;}
			$row_cat=mysqli_fetch_array($res)?>
           <?=$row_cat[f_post]?></TD>
			</TR>
            
            
            <TR>
		    <TD align="right" width="30%">Post Description :</TD>
			<TD align="left" style="padding-left:5px;">
            <TEXTAREA NAME="comments" COLS=70 ROWS=6 > <?=$row_add[f_post]?>
            </TEXTAREA></TD>
			</TR>

			
							  	
		<TR>
		<td align="center" colspan="2">
		<input type="hidden" value="add" name="txtmode" >
		<input type="hidden" value="<?=$id?>" name="id" >
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
<? admin_footer("../../");?>