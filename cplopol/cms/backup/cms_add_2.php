<?php 
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
include("../../common/fckeditor/fckeditor_php5.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

$query="select * from ".$tblpref."content_master where cms_id='$cid'"; 
if(!($result=mysql_query($query))){ echo $query.mysql_error(); exit;}
$row_add=mysql_fetch_array($result);
$row_add[cms_subtype];

$query1="select * from ".$tblpref."category where cat_type='cms'"; 
if(!($result1=mysql_query($query1))){ echo $query1.mysql_error(); exit;}
admin_header("../../","CMS Management");
admin_nav("../../");
?>

<script language="JavaScript">
function validate()
{
	   if(document.frmcmsadd.name.value=="")
		{
			alert("Please enter name");
			document.frmcmsadd.name.focus();
			return false;
		}

	  				
 return true;
}


</script>

<table cellspacing="0" cellpadding="0" width="100%" border="0" align="center">
<tr>
	<td>
	<table cellspacing="0" cellpadding="0" border="0" width="90%" align="center" >
	<tr><td align="center" ><h2>Content Management System</h2></td></tr>
	<tr><td height="12px"></td></tr>
	<?php  
	if($flag=="exists"){?>
		<tr>
			<td colspan="8" align="center"><font color="red"> CMS Name already exists</font></td>
		</tr>
	<?php  }
	?>
    
    <?php if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') { ?>
    
	<tr><th>
			<table class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%" >
			<form name="frmcmsadd" method="POST" onsubmit="return validate();" action="submit_cms.php">
			
			<tr><th colspan="2" align="center" ><?php if($cid!=""){?>Edit CMS Page<?php }else{?>Add New CMS Page<?php }?></th></tr>
			

			<tr>
					<td align="right" class="tbborder">CMS Category :</FONT></td>
					<td align="left" style="padding-left:5px;" class="tbborder">
			<?php  if($cid==""){ ?>
					<select name="cmscat" style="width:400px" >
						<option value="Parent">Add as Main</option>
						<?php 	$count=1;
						$coursequery="SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_subtype = 'Main Pages' AND cms_featured = 'Active' ORDER BY cms_id ASC ";
						if(!($courseresult=mysql_query($coursequery))){echo mysql_error($coursequery); exit;}
						while($course_row=mysql_fetch_array($courseresult)) {
						?>
						<option value="<?php  echo $course_row[cms_id]?>" <?php if($cid==$course_row[cms_id]){?>selected <?php }?>><?php echo $count."&nbsp;".$course_row[cms_title]?></option>
							<?php 	$count1=1;
							$parentquery="select * from ".$tblpref."content_master WHERE cms_type = 'mcms' AND cms_featured = 'Active' AND cms_subtype = '$course_row[cms_id]' ORDER BY cms_id ASC";
							if(!($parentresult=mysql_query($parentquery))){echo mysql_error($parentquery); exit;}
							$num = mysql_num_rows($parentresult);
							while($parent_row=mysql_fetch_array($parentresult)) {
							?>
									<option value="<?php echo $parent_row[cms_id]?>" <?php if(($row_add[cms_subtype]==$cid) && ($cid != "")){?>selected <?php }?>><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;$count.$count1 ".$parent_row[cms_title]?></option>
                                    <?php 	$count2=1;
										$parentquery="select * from ".$tblpref."content_master WHERE cms_type = 'mcms' AND cms_featured = 'Active' AND cms_subtype = '$parent_row[cms_id]' ORDER BY cms_id ASC";
										if(!($pparentresult=mysql_query($parentquery))){echo mysql_error($parentquery); exit;}
										$pnum = mysql_num_rows($pparentresult);
										while($pparent_row=mysql_fetch_array($pparentresult)) {
									?>
									<option value="<?php echo $pparent_row[cms_id]?>" <?php if(($row_add[cms_subtype]==$cid) && ($cid != "")){?>selected <?php }?>><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$count.$count1.$count2 ".$pparent_row[cms_title]?></option>
									<?php  $count2++;} 
								$count1++;} ?>
					<?php  $count++;} ?>
                    </select>
					<?php  }
							else
							{
						$coursequery="select * from ".$tblpref."content_master WHERE cms_id = '$cid'";
						if(!($courseresult=mysql_query($coursequery))){echo mysql_error($coursequery); exit;}
						$course_row=mysql_fetch_array($courseresult);

						?>
						<input value="<?php  echo $course_row[cms_subtype]?>" type=hidden name="cmscat"><?php echo $count."&nbsp;".$course_row[cms_title]?>
						
						<?php 

							
							}
							?>

					</td>
			</tr>		

            <tr>
		    <td align="right" class="tbborder" >Name :<font color="#FF0000">*</font></td>
			<td align="left" style="padding-left:5px;" class="tbborder"><input type="text" name="name" maxlength="255" size="50" value="<?php  echo $row_add[cms_title]?>"></td>
			</tr>

			<tr>
		    <td align="right" class="tbborder" >Window Title :<font color="#FF0000">*</font></td>
			<td align="left" style="padding-left:5px;" class="tbborder"><input type="text" name="wtitle" maxlength="255" size="50" value="<?php  echo $row_add[cms_page_title]?>"></td>
			</tr>
			<tr>
			<?php  if($row_add[cms_date]!=""){
				$datepicker=dateformate($row_add[cms_date]);
				
					?>
		    <td align="right" class="tbborder" >Last Update Date :<font color="#FF0000">*</font></td>
			<td align="left" style="padding-left:5px;" class="tbborder"><input type="text" name="txtdate" id ="txtdate" maxlength="255" size="50" value="<?php  echo $datepicker?>" readonly >  </td>
			</tr>
			<?php } ?>

			<tr>
			<td align="right" class="tbborder">Description :</FONT></td>
			 <td align="left" style="padding-left:5px;" class="tbborder"><?php 
								$oFCKeditor = new FCKeditor('linkcontect') ;
								$oFCKeditor->BasePath = '../../common/fckeditor/';
								//$oFCKeditor->ToolbarSet = "Standard";
								$oFCKeditor->Value = stripslashes($row_add[cms_desc]);
								$oFCKeditor->Width  = '550' ;
								$oFCKeditor->Height = '450' ;
								$oFCKeditor->Create() ;
								?>

			</td>
			</tr>
			
			

															  	
		<tr>
		<td align="center" colspan="2" class="tbborder">
		<input type="hidden" value="add" name="txtmode" >
		<input type="hidden" value="<?php  echo $cid?>" name="cid" >
		<input type="submit" value="Submit" name="submit" class="mybutton">&nbsp;&nbsp;</td>
		</tr>
		
		</form>
		</table>

</td>
</tr>

            <?php }  if($_SESSION[user_type]=='approver') { ?>


  
	<tr><th>
			<table class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%" >
			<tr><th colspan="2" align="center" >View CMS Page</th></tr>
			

			<tr>
					<td align="right" class="tbborder">CMS Category :</FONT></td>
					<td align="left" style="padding-left:5px;" class="tbborder">
			
					<?php $coursequery="select * from ".$tblpref."content_master WHERE cms_id = '$cid'";
						if(!($courseresult=mysql_query($coursequery))){echo mysql_error($coursequery); exit;}
						$course_row=mysql_fetch_array($courseresult);

						?>
						<?php echo $count."&nbsp;".$course_row[cms_title]?>
						
					</td>
			</tr>		

            <tr>
		    <td align="right" class="tbborder" >Name :<font color="#FF0000">*</font></td>
			<td align="left" style="padding-left:5px;" class="tbborder"><?php  echo $row_add[cms_title]?></td>
			</tr>

			<tr>
		    <td align="right" class="tbborder" >Window Title :<font color="#FF0000">*</font></td>
			<td align="left" style="padding-left:5px;" class="tbborder"><?php  echo $row_add[cms_page_title]?></td>
			</tr>
			<tr>
			<?php  if($row_add[cms_date]!=""){
				$datepicker=dateformate($row_add[cms_date]);
				
					?>
		    <td align="right" class="tbborder" >Last Update Date :<font color="#FF0000">*</font></td>
			<td align="left" style="padding-left:5px;" class="tbborder"><?php  echo $datepicker?> </td>
			</tr>
			<?php } ?>

			<tr>
			<td align="right" class="tbborder">Description :</FONT></td>
			 <td align="left" style="padding-left:5px;" class="tbborder"><?php 
								echo stripslashes($row_add[cms_desc]);
								?>

			</td>
			</tr>
			
			

															  	
		<tr>
		<td align="center" colspan="2" class="tbborder">
        	<a href=".">BACK</a>
		</td></tr>	
		</table>

</td>
</tr>
<? } ?>











</table>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
</table>
<?php admin_footer("../../");?>