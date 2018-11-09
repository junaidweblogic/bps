<?php
@session_start();
include("../common/cploconfig.php");
include("../common/app_function.php");
admin_header("../","Edit Admin Info",$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row);

$query=sprintf("SELECT * FROM ".$tblpref."admin WHERE username='%s'", $_SESSION[username]); 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_connect_errno(); exit;}
$row_add=mysqli_fetch_array($result);

?>
<!--body start -->
<div class="adminbody">
<div class="flt"><a href="home.php"><img src="../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="#" onclick="history.go(-1)"><img src="../images/back32.png" alt="Back" title="Back" /></a></div>
<div class="gap"></div>
<?if($_GET[flag]=="edit")
	{?>
	<div style="margin-top:1px;color:#f00;text-align:center;font-weight:bold;">Admin Info Edited Successfully!!</div>
	<div class="clear"></div>
	<?}?>
<div class="box">
	
    <div class="hdr">
		<h1 class="ico-edit">Edit </h1>
		<div class="rtheading">
			<h1 class="ico-admin">Admin Info</h1>
		</div>
    </div>      
    <div class="padtb">
		<form action="submit-admininfo.php" method="POST" name="frmadmn" onSubmit="return admninfo();">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr class="even">
					<td>Username<font color="#ff0000">* </font> :</td>
				</tr>
				<tr>
					<td><input type="text" name="username" id="username" value="<?=stripslashes($row_add[username])?>" class="smlinput" onBlur="notnull(this.id);" /></td>
				</tr>
				<!-- <tr class="even">
					<td>Password :</td>
				</tr>
				<tr>
					<td><input type="text" name="password" id="password" value="<?=stripslashes($row_add[a_pass])?>" class="smlinput" onBlur="notnull(this.id);" /></td>
				</tr> -->
				<tr class="even">
					<td>EmailID<font color="#ff0000">* </font> :</td>
				</tr>
				<tr>
					<td><input type="text" name="emailid" id="emailid" value="<?=stripslashes($row_add[admin_email])?>" class="smlinput" onBlur="validEmail(this.id);" /></td>
				</tr>
				<tr class="even">
					<td>Admin Name<font color="#ff0000">* </font> :</td>
				</tr>
				<tr>
					<td><input type="text" name="name" id="name" value="<?=stripslashes($row_add[admin_name])?>" class="smlinput" onBlur="notnull(this.id);" /></td>
				</tr>
				<tr class="even">
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<input type="hidden" name="aid" value="<?=$row_add[admin_id]?>">
						<input type="submit" class="button" value="Submit" name="submit">
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