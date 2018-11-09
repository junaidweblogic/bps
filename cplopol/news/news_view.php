<?php session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}


$query="select * from ".$tblpref."news where news_id='$id'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);


admin_header("../../","News Management");
admin_nav("../../");
?>

<script language="JavaScript" src="../../common/date-picker.js"></script>	
<TABLE cellSpacing="0" cellPadding="0" width="100%" border="0" align="center">
<TR>
	<TD>
	<table cellspacing="0" cellpadding="0" border="0" width="90%" align="center" >
	<tr><td align="center" ><h2>News Management</h2></td></tr>
	<tr><td height="12px"></td></tr>
	<tr><th>
			<TABLE class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%" >
					
			<tr><th colspan="2" align="center" >View</th>
			</td></tr>
				
				<TR>
				<TD align="right" class="tbborder" width="50%"> Game :</FONT></TD>
				<TD align="left" style="padding-left:5px;" class="tbborder">
				<?php  echo $row_add[news_game]?>
				</TD>
				</TR>	

				<TR>
				<TD align="right" class="tbborder" >News Name :</TD>
				<TD align="left" style="padding-left:5px;" class="tbborder"><?php  echo $row_add[news_name]?></TD>
				</TR>

				<TR>
				<TD align="right" class="tbborder" >Archieved :</TD>
				<TD align="left" style="padding-left:5px;" class="tbborder">
				<?php  echo $row_add[news_archieved]?>
				</TD>
				</TR>

				
				<TR>
				<TD align="right" class="tbborder" >Age:</TD>
				<TD align="left" style="padding-left:5px;" class="tbborder">
				<?php  echo $row_add[news_age]?>
				</TD>
				</TR>
				


			<TR>
			<TD align="right" class="tbborder">Description :</FONT></TD>
			 <TD align="left" style="padding-left:5px;" class="tbborder"><?php  echo stripslashes($row_add[news_desc])?>

			</td>
			</TR>
				


			
			<TR>
				<td align="right" class="tbborder"> View Doc:
				</td>
				<td align="left" style="padding-left:5px;" class="tbborder">
					<a href="#"  ONCLICK="open('../../possbpser/<?php  echo $row_add[news_pic_path]?>','barcode','scrollbars=1,toolbar=0,location=0,resizable=0,width=600,height=600')">Show<a> 
					
				</td>
		  </TR>

		    <TR>
		    <TD align="right" class="tbborder" >Show on Home :</TD>
			<TD align="left" style="padding-left:5px;" class="tbborder"><INPUT TYPE="checkbox" NAME="chkshow" value="1" <?php if($row_add[news_home]=="yes"){?>checked<?php }?>></TD>
			</TR>

						

															  	
		 <TR>
		<td align="center" colspan="2" class="tbborder">
		<INPUT TYPE="submit" value="<<Back" Name="submit" class="mybutton" onclick="history.back();">&nbsp;&nbsp;</td>
		</tr> 
		</TABLE>

</TD>
</TR>
</table>
</TD>
</TR>
<tr><td>&nbsp;</td></tr>
</table>

<?php admin_footer("../../");?>