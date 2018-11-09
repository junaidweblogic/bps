<?php
@session_start();
include("../common/cploconfig.php");
include("../common/app_function.php");
if($_SESSION[username]=="")
{
	displayerror("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Login,index.php", 0);
	exit();
}

admin_header("../","Change Password",$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row);

?>
<!--body start -->
<div class="adminbody">
<div class="flt"><a href="home.php"><img src="../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="#" onclick="history.go(-1)"><img src="../images/back32.png" alt="Back"  title="Back" /></a></div>
<div class="gap"></div>
<?if($_GET[flag]=="dn")
	{?>
	<div style="margin-top:1px;color:#f00;text-align:center;font-weight:bold;">Password Edited Successfully!!</div>
	<div class="clear"></div>
	<?}
	if($_GET[flag]=="invalid")
	{?>
	<div style="margin-top:1px;color:#f00;text-align:center;font-weight:bold;">Entered password is wrong!!</div>
	<div class="clear"></div>
	<?}?>
<div class="box">
	
    <div class="hdr">
		<h1 class="ico-edit">Edit </h1>
		<div class="rtheading">
			<h1 class="ico-password">Change Password</h1>
		</div>
    </div>      
    <div class="padtb">
		<form action="submit-pass.php" method="POST" name="frmadmn" onSubmit="return validpass();">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr class="even">
					<td>Old Password<font color="#ff0000">* </font> :</td>
				</tr>
				<tr>
					<td><input type="password" name="old" id="old" class="smlinput" onBlur="notnull(this.id);" /></td>
				</tr>
				
				<tr class="even">
					<td>New Password<font color="#ff0000">* </font> :</td>
				</tr>
				<tr>
					<td><input type="password" name="newpsw" id="newpsw" class="smlinput" onBlur="notnull(this.id);" /></td>
				</tr>
				<tr class="even">
					<td>Re-Enter New Password<font color="#ff0000">* </font> :</td>
				</tr>
				<tr>
					<td><input type="password" name="rnew" id="rnew" class="smlinput" onBlur="match(this.id);" /></td>
				</tr>
				<tr class="even">
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<input type="submit" class="button" value="Change Password" name="submit">
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
<?admin_footer();?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function validpass()
{
	old = document.getElementById('old').value;
	psw = document.getElementById('newpsw').value;
	rpsw = document.getElementById('rnew').value;
	if(old == "")
	{
		document.getElementById('old').style.padding = "2px 3px";
		document.getElementById('old').style.border  = "1px solid #ff0000";
		window.setTimeout(function () { document.getElementById('old').focus();}, 0);
		return false;
	}
	
	if(psw == "")
	{
		document.getElementById('newpsw').style.padding = "2px 3px";
		document.getElementById('newpsw').style.border  = "1px solid #ff0000";
		window.setTimeout(function () { document.getElementById('newpsw').focus();}, 0);
		return false;
	}
	
	if(rpsw == "")
	{
		document.getElementById('rnew').style.padding = "2px 3px";
		document.getElementById('rnew').style.border  = "1px solid #ff0000";
		window.setTimeout(function () { document.getElementById('rnew').focus();}, 0);
		return false;
	}
	
	if(psw != "" && rpsw!="")
	{
		match();
	}
	
}
function match(id)
{
	psw = document.getElementById('newpsw').value;
	rpsw = document.getElementById('rnew').value;
	if(rpsw!="")
	{
		if(psw != rpsw)
		{
			document.getElementById('rnew').style.padding = "2px 3px";
			document.getElementById('rnew').style.border  = "1px solid #ff0000";
			alert("Password Mismatch");
			window.setTimeout(function () { document.getElementById('rnew').focus();}, 0);
			return false;
		}
		else
		{
			document.getElementById('rnew').style.padding = "2px 3px";
			document.getElementById('rnew').style.border  = "1px solid #A5ACB2";
			return true;
		}
	}
	else
	{
		document.getElementById('rnew').style.padding = "2px 3px";
		document.getElementById('rnew').style.border  = "1px solid #ff0000";
	}
}
	
//-->
</SCRIPT>