<?php
@session_start();
include("../common/cploconfig.php");

if($_SESSION[username]!="")
{
	$_SESSION[username]="";
}
/*$createcmsquery = "CREATE TABLE IF NOT EXISTS ".$tblpref."content_master
( cms_id int(11)  NOT NULL auto_increment,
cms_title varchar(255),
cms_desc longtext,
cms_page_title longtext,
cms_parent int(255),
cms_type varchar(50),
cms_date date,
cms_sitelink varchar(255),
cms_doc_upload varchar(255),
cms_image_upload varchar(255),
cms_archived varchar(11),
cms_time time,
cms_modify date,
PRIMARY KEY ( `cms_id` )
)"; 
if (!($page1 = mysqli_query($connection,$createcmsquery))) 
{ echo "FOR QUERY: $createcmsquery<BR>".mysqli_connect_errno(); 	exit;}
*/
include("../common/app_function.php");

$alltables = mysqli_query($connection,"SHOW TABLES");
while ($table = mysqli_fetch_assoc($alltables))
{
   foreach ($table as $db => $tablename)
   {
			$qry_optimize = "OPTIMIZE TABLE ".$tablename."";
			if(!($res_optimize = mysqli_query($connection,$qry_optimize)))
			{
				echo $qry_optimize.mysqli_connect_errno();
				exit();
			}
			$qry_repair = "REPAIR TABLE ".$tablename."";
			if(!($res_repair = mysqli_query($connection,$qry_repair)))
			{
				echo $qry_repair.mysqli_connect_errno();
				exit();
			}
	}
}

admin_header("../","Admin Login",$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row);

if($_GET[flag]=="logout")
{
	$msg="You have successfully logged out";
}
if($_GET[flag]=="invalid")
{
	$msg="Username/Password Invalid";
}
if($_GET[flag]=="invalidcode")
{
	$msg="Entered code is wrong";
	$username=stripslashes($_GET[username]);
}
?>
<div id="login-box">
	<H2>Admin Panel</H2>
	<br />
	<FORM METHOD="POST" ACTION="submit-login.php" name="login" onsubmit="return log()">
	<?if($_GET[flag]!="")
	{?>
	<div style="margin-top:1px;color:#ff6;text-align:center;font-weight:bold;"><?=$msg?></div>
	<div class="clear"></div>
	<?}?>

	<div id="login-box-name" style="margin-top:10px;">Username :</div>
	<div id="login-box-field" style="margin-top:10px;">
		<input name="username" id="username" class="form-login" title="Username" value="<?=$username?>" size="30" onBlur="notnulls(this.id);" autofocus/>
	</div>
	<div id="login-box-name">Password:</div>
	<div id="login-box-field">
		<input name="password" id="password" type="password" class="form-login" title="Password" value="" size="30"  onBlur="notnulls(this.id);" />
	</div>
	<div id="login-box-name">Solve this :</div>
    <div class="capture">
		<img src="../math-captcha/MathchaSecurityImages.php?difficulty=1&theme=t5"  BORDER="0"/>
	</div>
	<div class="cans">
		<input name="captcha" id="captcha" type="text" class="captcha" title="captcha" value="" size="30" onBlur="notnulls(this.id);" />
	</div>
	<!--<div class="capture">
		<img src="../math-captcha/MathchaSecurityImages.php?difficulty=1&theme=t5"  BORDER="0"/>
	</div> -->
	<br />
	<p class="login-box-options">
		<a href="forgotpass.php">Forgot password?</a>
		<span style="margin-left:45px;">
			<a href="../.">View the Site</a>
		</span>
	</p>
	<br />
	<!--<a href="#" onclick="log()">
		<img src="../images/login-btn.png" width="79" height="33" style="margin-left:130px;" />
	</a> -->
    <input type="image" src="../images/login-btn.png" style="margin-left:130px;"/>
	</form>
</div>
<SCRIPT LANGUAGE="JavaScript">
<!--

function log() {
	var result = new Array();
	result[0] = notnulls('username');
	result[1] = notnulls('password');
	result[2] = notnulls('captcha');


	var count = 0;
	while(count < 3) {
		if(result[count++] == false) {
			return false;
			break;
		}
	}
	return true;	
}
function notnulls(id) {
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
//-->
</SCRIPT>


<?admin_footer();?>