<?php
include("../common/app_function.php");
admin_header_new("../","Forgot Password",$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row);
if($_GET[flag]=="blank")
{
	$msg="Please enter Username/EmailID";
}
if($_GET[flag]=="invalid")
{
	$msg="Username/EmailID Invalid";
}
if($_GET[flag]=="sent")
{
	$msg="Your credentials has been sent to your Email-id.";
}
?>
<div id="login-box">
	<H2>Forgot Password?</H2>
	<br />
	<FORM METHOD=POST ACTION="submit-forgotpass.php" name="forgot" >
	<?if($_GET[flag]!="")
	{?>
	<div style="margin-top:1px;color:#ff6;text-align:center;font-weight:bold;"><?=$msg?></div>
	<div class="clear"></div>
	<?}?>

	<div id="login-box-name" style="margin-top:10px;">Username :</div>
	<div id="login-box-field" style="margin-top:10px;">
		<input name="username" id="username" class="form-login" title="Username" value="" size="30" onBlur="notnulls(this.id);" />
	</div>
	<div class="clear"></div>
	<div style="margin-top:1px;color:#ff6;text-align:center;font-weight:bold;">OR</div>

	<div id="login-box-name" style="margin-top:10px;">EmailID :</div>
	<div id="login-box-field" style="margin-top:10px;">
		<input name="emailid" id="emailid" class="form-login" title="Username" value="" size="30" onBlur="validEmails(this.id);" />
	</div>
	
	<br />
	<p class="login-box-options">
		<a href="index.php">Admin Login</a>
		<span style="margin-left:45px;">
			<a href="../.">View the Site</a>
		</span>
	</p>
	<br />
	<a href="#" onclick="log()">
		<img src="../images/login-send.png" width="79" height="33" style="margin-left:130px;" />
	</a>
	</form>
</div>
<SCRIPT LANGUAGE="JavaScript">
<!--
function log()
{
	var res = forgot();
	if(res==true)
	{
		document.forgot.submit();
	}
	else
	{
		return false;
	}
}
forgot = function () {
	var result = new Array();
	result[0] = notnulls('username');
	result[1] = validEmails('emailid');
	
	
	if(result[0]==false && result[1]==false)
	{
		return false;
	}
	else{return true;	}
}
notnulls = function (id) {
	var result = document.getElementById(id).value;
	if(result == "") {
		document.getElementById(id).style.padding = "5px 4px 5px 3px";
		document.getElementById(id).style.border  = "1px solid #ff0000";
		//document.getElementById(id).style.backgroundColor  = "#ff0000";
		return false;
	}
	else {
		document.getElementById(id).style.padding = "5px 4px 5px 3px";
		document.getElementById(id).style.border  = "1px solid #0D2C52";
		return true;
	}
}
validEmails = function(id) {
	var email = document.getElementById(id).value;
	if(email == "") {
		document.getElementById(id).style.border="1px solid #FF0000";	
		//document.getElementById(id).style.backgroundColor  = "#ff0000";
		//document.getElementById(id).focus();
		return false;
	}
	
	if(email != "") { 
	
		var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		if(!(email.match(emailExp)))
		{
			document.getElementById(id).style.border="1px solid #FF0000";	
			//document.getElementById(id).style.backgroundColor  = "#ff0000";
			//document.getElementById(id).focus();
			return false;
		}
		else
		{
			document.getElementById(id).style.border="1px solid #0D2C52";
			return true;   
		}
	}
}
//-->
</SCRIPT>
<?admin_footer();?>