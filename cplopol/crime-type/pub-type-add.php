<?php session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

$query="select * from ".$tblpref."category where  cat_id='$pid'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);

admin_header('../../','Crime Type',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
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

<!--body start -->
<div class="adminbody">
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="index.php"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>
<div class="gap"></div>
<?
$flag = $_REQUEST[flag];
if($flag=="exists"){?>
<p align="center" class="error">Crime Type already exists.</p>
<? } ?>	 
<div class="box">
    <div class="hdr">
	<? if($pid!=""){?><h1 class="ico-edit">Edit</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt="">Crime Type</h1>
    </div>
    </div>
<div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return validate();" action="submit-pub-type.php">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<td> Crime Type<font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td><input type="text" name="docname" id="docname" value="<?=stripslashes($row_add[cat_title])?>" onBlur="notnull(this.id);" class="smlinput" /></td>
     </tr>
	 <tr class="even">
					<td>&nbsp;</td>
				</tr>     
     <tr >
     	<td>
			<input type="hidden" value="add" name="txtmode" >
		<input type="hidden" value="<?=$pid?>" name="pid" >
        <input type="submit" class="button" value="Submitt" name="submit">		
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