<?php 
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
include_once '../../common/ckeditor/ckeditor.php';

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}
$cid = $_REQUEST['cid'];
$query="select * from ".$tblpref."content_master where cms_id='$cid'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);
$row_add[cms_subtype];

$query1="select * from ".$tblpref."category where cat_type='cms'"; 
if(!($result1=mysqli_query($connection,$query1))){ echo $query1.mysqli_errno($connection); exit;}

admin_header('../../','CMS',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
//admin_nav("../../");
?>
<script type="text/javascript" src="../../common/ckeditor/ckeditor.js"></script>
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
<!--body start -->
<div class="adminbody">
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="index.php"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>
<div class="gap"></div>
<?
$flag = $_REQUEST[flag];
if($flag=="exists"){?>
<p align="center" class="error">CMS Name already exists.</p>
<? }  
		if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') 
		{ ?>
		<div class="box">
			<div class="hdr">
			<? if($cid!=""){?><h1 class="ico-edit">Edit</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
			<div class="rtheading">
				<h1 class="ico"><img src="icon/icon.png" alt="">Content Management System</h1>
			</div>
			</div>
			<div class="padtb">
			 <form name="frmcmsadd" method="POST" onsubmit="return validate();" action="submit_cms.php">
				 <table width="100%" border="0" cellspacing="0" cellpadding="0">
					 <tr class="even">
						<td> CMS Category <font color="#ff0000">* </font> :     </td>
					 </tr>
					 <tr>
						<td>
							<?php  
					if($cid=="")
					{ ?>
						<select name="cmscat" class="smlinput" >
						<!-- <option value="Parent" <?php  if($parentid=="") { ?> selected <?php  } ?>>Add New</option> -->
						<?php 	
							$count=1;
							$coursequery="SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_subtype = 'Main Pages' AND cms_count = '0' ORDER BY cms_id ASC ";
							if(!($courseresult=mysqli_query($connection,$coursequery))){echo mysqli_error($coursequery); exit;}
							while($course_row=mysqli_fetch_array($courseresult)) 
							{ ?>
								<option value="<?php  echo $course_row[cms_id]?>" <?php if($cid==$course_row[cms_id]){?>selected <?php }?>><?php echo $count."&nbsp;".$course_row[cms_title]?></option>
								<?php 	
								$count1=1;
								$parentquery="select * from ".$tblpref."content_master WHERE cms_type = 'mcms' AND cms_subtype = '$course_row[cms_id]' AND cms_count = '0'  ORDER BY cms_id ASC";
								if(!($parentresult=mysqli_query($connection,$parentquery))){echo mysqli_error($parentquery); exit;}
								$num = mysqli_num_rows($parentresult);
								while($parent_row=mysqli_fetch_array($parentresult)) 
								{ ?>
									<option value="<?php echo $parent_row[cms_id]?>" <?php if(($row_add[cms_subtype]==$cid) && ($cid != "")){?>selected <?php }?>><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;$count.$count1 ".$parent_row[cms_title]?></option>
                                    <?php 	
										$count2=1;
										$parentquery="select * from ".$tblpref."content_master WHERE cms_type = 'mcms' AND cms_subtype = '$parent_row[cms_id]' AND cms_count = '0' ORDER BY cms_id ASC";
										if(!($pparentresult=mysqli_query($connection,$parentquery))){echo mysqli_error($parentquery); exit;}
										$pnum = mysqli_num_rows($pparentresult);
										while($pparent_row=mysqli_fetch_array($pparentresult)) 
										{ ?>
											<option value="<?php echo $pparent_row[cms_id]?>" <?php if(($row_add[cms_subtype]==$cid) && ($cid != "")){?>selected <?php }?>><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$count.$count1.$count2 ".$pparent_row[cms_title]?></option>
									<?php  
											$count2++;
										}
										$count1++;
									}
									$count++;
								} ?>
							</select>
					<?php
							}
							else
							{
								$coursequery="select * from ".$tblpref."content_master WHERE cms_id = '$cid'";
								if(!($courseresult=mysqli_query($connection,$coursequery))){echo mysqli_error($coursequery); exit;}
								$course_row=mysqli_fetch_array($courseresult);
								if($course_row[cms_subtype] == "Main Pages") 
								$type = $course_row[cms_id];
								else
								$type = $course_row[cms_subtype]; ?>                        	
								<input value="<?php  echo $type;?>" type='hidden' name="cmscat"><?php echo $count."&nbsp;".$course_row[cms_title]?>						
						<?php 
							}
							?>
						</td>
					</tr>
					<tr class="even">
						<td> Name<font color="#ff0000">* </font> :     </td>
					</tr>
					<tr>
						<td>
							<input type="text" name="name" id="name" value="<?=stripslashes($row_add[cms_title])?>" onBlur="text(this.id);" class="smlinput" />
						</td>
					</tr>
					<tr class="even">
						<td> Window Title<font color="#ff0000">* </font> :     </td>
					</tr>
					<tr>
						<td>
							<input type="text" name="wtitle" id="wtitle" value="<?=stripslashes($row_add[cms_page_title])?>" onBlur="text(this.id);" class="smlinput" />
						</td>
					</tr>
					<?php 
					if($row_add[cms_date]!="")
					{
						$datepicker=dateformate($row_add[cms_date]); ?>
						<tr class="even">
							<td> Last Update Date  :     </td>
						</tr>
						<tr>
						<td>
							<input type="text" name="txtdate" id="txtdate" value="<?php  echo $datepicker . " " . $row_add[cms_time]; ?>"  class="smlinput" readonly/>
						</td>
					</tr>
			<?php 
					} ?>
					<tr class="even">
						<td> Description :     </td>
					</tr>
					<tr>
						<td>
							<?php 
								$ckeditor = new CKEditor();
								$ckeditor->basePath = '/ckeditor/';

								$ckeditor->config['filebrowserBrowseUrl'] = $ckpath.'/ckfinder/ckfinder.html';
								$ckeditor->config['filebrowserImageBrowseUrl'] = $ckpath.'/ckfinder/ckfinder.html?type=Images';
								$ckeditor->config['filebrowserFlashBrowseUrl'] = $ckpath.'/ckfinder/ckfinder.html?type=Flash';
								$ckeditor->config['filebrowserUploadUrl'] = $ckpath.'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
								$ckeditor->config['filebrowserImageUploadUrl'] = $ckpath.'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
								$ckeditor->config['filebrowserFlashUploadUrl'] = $ckpath.'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';				$ckeditor->editor('linkcontect',stripslashes($row_add[cms_desc]));			

								?>
						</td>
					</tr>
					<tr class="even">
						<td> Meta Tags  :     </td>
					</tr>
					<tr>
						<td>
							<textarea name="metatag" class="smlinput"><?=$row_add[meta_tags]?></textarea>
						</td>
					</tr>
					<tr class="even">
						<td> Meta Meta Description  :     </td>
					</tr>
					<tr>
						<td>
							<textarea name="metakeyword" class="smlinput"><?=$row_add[meta_key_word]?></textarea>
						</td>
					</tr>
					 <tr class="even">
						<td>
							<input type="submit" class="button" value="Submit" name="submit">
							<input type="hidden" value="add" name="txtmode" >
							<input type="hidden" value="<?php echo $cid; ?>" name="cid" >
					</td>
				 </tr>   
				 </table>
				 
				 </form>
		<?php
		}
		 if($_SESSION[user_type]=='approver') 
		{ ?>
		<div class="box">
			<div class="hdr">
			<h1 class="ico-view">View</h1>
			<div class="rtheading">
				<h1 class="ico"><img src="icon/icon.png" alt="">Content Management System</h1>
			</div>
			</div>
			<div class="padtb">
			 <table width="100%" border="0" cellspacing="0" cellpadding="0">
			 <tr class="even">
				<td> CMS Category :     </td>
			 </tr>
			 <tr>
			 <td>
				<?php
					$coursequery="select * from ".$tblpref."content_master WHERE cms_id = '$cid'";
					if(!($courseresult=mysqli_query($connection,$coursequery))){echo mysqli_error($coursequery); exit;}
					$course_row=mysqli_fetch_array($courseresult);
					echo $count."&nbsp;".stripslashes($course_row[cms_title]); ?>
			</td>
			 </tr>
			 <tr class="">
				<td> Name :     </td>
				<td>
				<?php  echo stripslashes($row_add[cms_title]); ?>
				</td>
				</tr>
				<tr class="even">
				<td> Window Title :     </td>
				<td>
				<?php  echo stripslashes($row_add[cms_page_title]); ?>
				</td>
				</tr>
				<?php  if($row_add[cms_date]!="")
					{ ?>
						<tr class="">
						<td> Last Update Date :     </td>
						<td>
						<?php  
								$datepicker=dateformate($row_add[cms_date]);
								echo $datepicker; ?>
						</td>
						</tr>
						<?php
					} ?>
				<tr class="even">
				<td> Description :     </td>
				<td>
					<?php  echo stripslashes($row_add[cms_desc]); ?>
				</td>
				</tr>
				 <tr >
				<td>
					<a href="index.php"><input type="submit" class="button" value="Submitt" name="submit"></a>
				</td>
			 </tr>   
			 </table>
		<?php
		} 
		?>
<p>&nbsp;</p>
    
     
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</div>
<?admin_footer()?>
