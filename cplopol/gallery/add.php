<?php
@session_start();
include("../../common/app_function.php");
include("../../common/config.php");
include("../../common/diffrence.php");
if($_SESSION[username]=="")
{
	displayerror("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Login,../index.php", 0);
	exit();
}
$id = $_REQUEST[id];
$mode = $_REQUEST[mode];
$query=sprintf("select * from ".$tblpref."category  where cat_id='%d'", $id); 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);

admin_header('../../','Picture Management',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);

?>
<!--body start -->
<div class="adminbody">
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="index.php"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>
<div class="gap"></div>
<?php 
$flag = $_REQUEST[flag];
if($flag=="exist"){?>
<p align="center" class="error">Record is already exist.</p>
<?php  } 	 
if($flag=="filesize"){?>
<p align="center" class="error">File size should not be more than 100 KB.</p>
<?php  } 
if($flag=="type"){?>
<p align="center" class="error">File should be of Image type.</p>
<?php  } ?>		 

<div class="box">
    <div class="hdr">
	<?php  if($id!=""){?><h1 class="ico-edit">Edit</h1><?php } else{?><h1 class="ico-addnew">Add New</h1><?php } ?>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt="">Gallery</h1>
    </div>
    </div> 
	
      
    <div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return album();" action="submit.php" enctype="multipart/form-data">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
	 
     <tr class="even">
		<td> Title<font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
		<td>
			<input type="text" name="albtitle" id="albtitle" value="<?php echo stripslashes($row_add[cat_title]); ?>" onBlur="notnull(this.id);" class="smlinput">
		</td>
     </tr>
	 
	 
     <tr  class="even">
     	<td>
        <input type="submit" class="button" value="Submit" name="submit">
		<?php if($id==""){?>
		<input type="hidden" value="add" name="mode" >
		<?php } else{?>
		<input type="hidden" value="<?php echo $id; ?>" name="id" >
		<?php } ?>
        </td>
     </tr>   
     </table>
     
     </form>   
     
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</div>
<?php admin_footer(); ?>