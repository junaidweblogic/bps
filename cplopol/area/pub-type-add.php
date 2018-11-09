<?php session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

$query="select * from ".$tblpref."category where cat_id='$pid'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_connect_errno(); exit;}
$row_add=mysqli_fetch_array($result);

admin_header('../../','Area List',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
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
<div class="adminbody">
		<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
		<div class="frt" style="padding-right:5px;"><a href="index.php"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>
		<div class="gap"></div>
		<?php
if($flag=="exist")
{?>
		<p align="center" class="error">Area already exists.</p>
<? } 	 ?>	

		<div class="box">
		<div class="hdr">
		<? if($pid!=""){?><h1 class="ico-edit">Edit</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
			<div class="rtheading">
					<h1 class="ico-cms">Area</h1>
			</div>
		</div>       
	    <div class="padtb">
		<form name="frmcmsadd" method="POST" onsubmit="return validate();" action="submit-pub-type.php" enctype="multipart/form-data"> 
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		 	<tr class="even">
					<td>City :</td>
			</tr>
			<tr>
					<td>
							<select name="selcity" style="width:300px;" class="smlslct">
							<?php
								$query = "SELECT * FROM " . $tblpref . "category WHERE cat_type = 'city' ORDER BY cat_title ASC";
								if(!($result = mysqli_query($connection,$query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_connect_errno(); }
								while($row = mysqli_fetch_array($result)) : 
							?>
								<option value="<?php echo stripslashes($row[cat_title]);?>" 
									<?php  if($row_add[cat_image] == $row[cat_title]) { echo "selected"; }?>>
									<?php echo stripslashes($row[cat_title]);?>
							   </option>
							<?php endwhile; ?>
							</select>
					</td>
			</tr>
			<tr class="even">
					<td>Area :</td>
			</tr>
			<tr>
					<td>
							<INPUT TYPE="text" NAME="docname" class="smlslct" value="<?php  echo stripslashes($row_add[cat_title])?>">
					</td>
			</tr>
			<tr class="even">
					<td>
							<input type="submit" class="button" value="Submit" name="submit">
							<?if($pid=="")
							{?>
							<input type="hidden" value="add" name="mode" >
<?						}
							else{?>
							<input type="hidden" value="<?=$pid?>" name="pid" >
							<input type="hidden" value="edit" name="mode" >
							<?}?>
					</td>
			</tr>   
</table>
     
     </form>   
     
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</div>
<?admin_footer()?>