<?php
@session_start();
include("../../common/app_function.php");
include("../../common/config.php");
if($_SESSION[username]=="")
{
		displayerror("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Login,../index.php", 0);
		exit();
}
$id=$_GET[id];
$mode=$_REQUEST[mode];
if($_GET[status] != "") 
{
		$query = sprintf("UPDATE " . $tblpref . "gallery SET img_status = '' WHERE img_album_id = '%d'", $id);
		if(!($result_sel=mysqli_query($connection,$query))) { echo "Query :- " . $query . "<br>Error :- " . mysqli_errno($connection); exit; }
				
		$query = sprintf("UPDATE " . $tblpref . "gallery SET img_status = 'Active' WHERE image_id= '%d'", $_GET[status]);
		if(!($result_sel=mysqli_query($connection,$query))) { echo "Query :- " . $query . "<br>Error :- " . mysqli_errno($connection); exit; }
}
$condition2=" ORDER BY image_id DESC";	
/*if ($_GET[sorton]!="")
{
 $condition2=" ORDER BY ". $_GET[sorton]. " ". $_GET[sortby];
}


$txtname = $_GET[txtname];
if($txtname!="")
	$condition[]=sprintf("cat_id='%d'", $txtname);
*/
$condition=sprintf("WHERE img_album_id=%d", $id);
/*if(is_array($condition))
{
	$condition=" WHERE " . implode(" AND ",$condition);
}*/

$que="SELECT * FROM ".$tblpref."gallery $condition $condition2"; 

$curr_query="sorton=".$_GET[sorton]."&sortby=".$_GET[sortby]."&txtname=".$txtname;
$pagesize=16;
$the_query  = pagination($que,$_REQUEST[page],null,$curr_query,$pagesize);	
$real_string     = explode("~" , $the_query);
$que= $que.$cstr." LIMIT ". $real_string[0];
$show_status     = $real_string[2];
$show_pagination = $real_string[1];
if (!($page_res = mysqli_query($connection,$que))) 
{ echo "FOR QUERY: $strsql<BR>".mysqli_errno($connection); 	exit;}
$rowCount = mysqli_num_rows($page_res);
$srnum=$real_string[0][0];
$srnum= $real_string[0];//--this is used to the next page no so that the srno at page comes  								in sequence
$srnum=explode(",",$srnum);
$count=$srnum[0];

admin_header('../../','Picture - Gallery Management',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
?>
<!-- <script type="text/javascript" src="../../cal_js/jquery-1.3.1.min.js"></script> -->
<script type="text/javascript" src="../../cal_js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../cal_js/daterangepicker.jQuery.js"></script>
<link rel="stylesheet" href="../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />

<script type="text/javascript">	
	$(function(){
		  $('#datepicker').daterangepicker({
			posX:360,
			posY: 260
		  }); 
	 });
</script>

<style type="text/css">
.ui-daterangepickercontain 
{
	top:255px;
	left:448px;
	position: absolute;
	z-index: 999;
}
</style>
<!--body start -->
<div class="adminbody">
<div class="box smlsizenews">
		<div class="hdr">
				<h1 class="ico"><img src="icon/icon.png" alt="">Upload Image</h1>
		</div>
		<div class="padtb">
				<form name="frmcms" method="POST" action="submit-home.php" onsubmit="return picgallery();" enctype="multipart/form-data">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<!-- <tr class="alt-row">
									<td width="20%" align="right">Caption :</td>
									<td width="25%">
											<textarea name="imgcap" id="imgcap" cols="17" rows="3" onBlur="alphanumvalid(this.id);">
											</textarea>
											<input type="text" value="" name="imgcap" id="imgcap" class="inpt" onBlur="alphanumvalid(this.id);"/>
									</td>
								</tr>	
								<tr >
										<td width="20%" align="right">Date :</td>
										<td width="25%">
												<input type="text" value="" name="date" id="datepicker" class="inpt"/>
										</td>
								</tr>	 -->
								<tr class="alt-row">
									<td width="20%" align="right">Caption :</td>
									<td width="25%">
											<input type="text" value="" name="imgcap" id="imgcap" class="inpt" onBlur="alphanumvalid(this.id);"/>
									</td>
								</tr>	
								<tr  class="alt-row">
										<td width="40%" align="right">Image Path :</td>
										<td width="60%">
												<!-- <input type="file" name="the_file[]" id="the_file" class="inpt" onBlur="notnull(this.id);" multiple/> -->
												<input type="file" name="the_file" id="the_file" class="inpt" onBlur="notnull(this.id);" />
												<input type="hidden" name="mode" value="<?php  echo $mode; ?>">
												<input type="hidden" name="newsid" value="<?php  echo $_GET[id]; ?>">
										</td>
								</tr>	
								<tr  class="alt-row">
										
										<td colspan="2" align="center">
												<input type="submit" class="button" value="Upload" name="submit">
										</td>
										
								</tr>
						</table>
				</form>
		</div>
</div>    
<?php $flag=$_REQUEST[flag];?>
	
<?php if($flag=="type"){?>
<p align="center" class="error">Please Upload image Only.</p>
<?php  } ?>	
<?php if($flag=="filesize"){?>
<p align="center" class="error">Please Upload 2MB size of image Only.</p>
<?php  } ?>	
<?php if($flag=="edit"){?>
<p align="center" class="error">Record is edited Successfully.</p>
<?php  } ?>	
<?php if($flag=="add"){?>
<p align="center" class="error">New Record is added successfully.</p>
<?php  } ?>	

<?php if($flag=="del"){?>
<p align="center" class="error">Record is deleted Successfully.</p>
<?php  } ?>
<?php if($flag=="exists"){?>
<p align="center" class="error">Record already exists.</p>
<?php  } ?>		
<div class="gap"></div>
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="index.php"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>
<div class="clear"></div>
<div class="gap"></div>

<div class="box">
    <div class="hdr">
	<? $seltitle=sprintf("SELECT * FROM ".$tblpref."category WHERE cat_id='%d'",$_GET[id]);
		  if(!($result_seltitle=mysqli_query($connection,$seltitle))) { echo "Query :- " . $seltitle . "<br>Error :- " . mysqli_errno($connection); exit; }
		  $row_title=mysqli_fetch_array($result_seltitle);
		  $title=stripslashes($row_title[cat_title])
	?>
		<h1 class="ico"><img src="icon/icon.png" alt="">Uploaded Images For <?=$title?></h1>
        <div class="addnew">
						<!-- <a  href="add.php" class="add">Add New</a> -->
                        <!-- <a  href="#" class="import">Import</a>
                        <a  href="#" class="export">Export</a>  -->
		</div>
	</div>   
    <div class="padtb">
	<p align="right"><?php echo $show_status; ?> </p>
	<?php if($rowCount>0)
	{?>
			<form name="frmmemdisp" action="home.php" method="GET">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tbody>
									<tr>
<?php 							$clcnt=0;
										while($row_gal=mysqli_fetch_array($page_res))
										{ 
											if($clcnt%2==0){$class="even";}else{$class="";}
											$count++;
											$clcnt++;
											$file_id = $row_gal["image_id"];     
											$filename = stripslashes($row_gal["image_path"]);
											$image_cap = stripslashes($row_gal["image_name"]);
										?>
											<td>
													<table width="100%" border="0" cellspacing="0" cellpadding="3">
														<tr>
																<td><img src="../../possbpser/<?php echo $filename; ?>" height="80" /></td>
														</tr>
														<tr>
																<td><?php echo $image_cap; ?>
																		<input type="hidden" name="id" value="<?php echo $id; ?>" />	
																		<input type="hidden" name="imgid" value="<?php echo $file_id; ?>" />
																		<input type="hidden" name="imgcap" value="<?php echo $image_cap; ?>" />
																</td>
														</tr>
														<tr>
																<td >Make Album Image : <input type="radio" name="status" value="<?php  echo $row_gal[image_id]?>" <?php  if($row_gal[img_status] == "Active") { ?> checked="checked" <?php  } ?> onclick="javascript:make();" /></td>
														</tr>
														<?php  if($row_gal[img_status] != "Active") { ?>
														<tr>
																<td><a href="submit-home.php?fn=<?php echo $filename; ?>&fid=<?php echo $file_id; ?>&id=<?php echo $_REQUEST[id]; ?>&mode=del" onclick="if(confirm('Confirm delete?')) return true; else return false;">Delete File</a></td>
														</tr>
														<?php }?>
													</table>
											</td>
											<?php 
											if($count >= 2)
											{
												echo "</tr><tr class='".$class."'>";
												$count = 0;
											}
										}?>
									</tr>
							</tbody>  
					</table>
			</form>
	<?php } ?>
	<?php if($rowCount==0){?>
<p align="center" class="error">No Records found.</p>
<?php  } ?>
<div class="pagination">
<!-- pagination underneath the box's content -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" align="center" style=" color:#000000; font-size:14px; font-weight:bold;"><div id="pageNavPosition"><?php echo $show_pagination; ?></div></td>
  </tr>
  
  
</table>			
</div>

    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>

</div>
<?php admin_footer();?>
<script type="text/javascript">
make =  function() {
  document.frmmemdisp.submit();
}

function fwdname(imid,pid)
{
	document.frmmemdisp.action="submit-home.php?flag=main&imid="+ imid + "&pid="+ pid;
	document.frmmemdisp.submit();
}
</script>