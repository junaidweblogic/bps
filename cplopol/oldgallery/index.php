<?php 
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

if($_REQUEST[status] != "") {
			$query = "UPDATE " . $tblpref . "gallery SET img_status = '' WHERE img_album_id = '$_REQUEST[aid]'";
			if(!($result_sel=mysqli_query($connection,$query))) { echo "Query :- " . $query . "<br>Error :- " . mysqli_errno($connection); exit; }
			
			$query = "UPDATE " . $tblpref . "gallery SET img_status = 'Active' WHERE image_id = '$_REQUEST[status]'";
			if(!($result_sel=mysqli_query($connection,$query))) { echo "Query :- " . $query . "<br>Error :- " . mysqli_errno($connection); exit; }
		}

		$aid=$_REQUEST[aid];

		$que="select * from ".$tblpref."gallery where img_album_id='$_REQUEST[aid]' ORDER BY image_id DESC"; 
	$pagesize=30;
	$the_query  = pagination($que,$page,null,$curr_query,$pagesize);	
	$real_string     = explode("~" , $the_query);
	$que= $que.$cstr." LIMIT ". $real_string[0];
	$show_status     = $real_string[2];
	$show_pagination = $real_string[1];
	if (!($result = mysqli_query($connection,$que))) 
	{ echo "FOR QUERY: $strsql<BR>".mysqli_errno($connection); 	exit;}
	$rowCount = mysqli_num_rows($result);
	$srnum=$real_string[0][0];
	$srnum= $real_string[0];//--this is used to the next page no so that the srno at page comes in sequence
	$srnum=explode(",",$srnum);
	$count=$srnum[0];

		
admin_header('../../','Picture Gallery',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
?>
<script language="JavaScript">
<!--
function checkform()
{

	if (document.frmform.the_file.value == "")
		{
			alert("Please select image by clicking on \" Browse..\".");
			document.frmform.the_file.focus();
			document.frmform.the_file.select();
			return false;
		}
	if (document.frmform.the_file.value != "") {
		var path = new String(document.frmform.the_file.value)
		fileName =path.substr(path.lastIndexOf(".")+1);
		fileName =fileName.toLowerCase();
		if ( !(fileName=="jpg" || fileName=="jpeg" || fileName=="gif" || fileName == "png"))
		{
			alert("You have tried to upload an invalid image format.\nUpload .jpg, .gif, .png images only.");
			document.frmform.the_file.focus();
			document.frmform.the_file.select();
			return false;
		}
	}

	if (document.frmform.imgcap.value == "")
		{
			alert("Please enter image caption.");
			document.frmform.imgcap.focus();
			return false;
		}


}
-->
</script>
<!--body start -->
<div class="adminbody">

<div class="box smlsize">
    <div class="hdr">
		<h1 class="ico"><img src="icon/icon.png" alt="">Upload Image</h1>
    </div>
    <div class="padtb">
      <form name="frmcms" action="submit_uploadimage.php" onsubmit="return checkform();" enctype="multipart/form-data" method="POST">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="40%" align="right">Image Caption: :</td>
            <td width="60%">
              <input name="imgcap" type="text" value="" class="inpt"/>
            </td>
          </tr>
		  <tr>
            <td width="40%" align="right">Image Path :</td>
            <td width="60%">
			  <input type="file" name="the_file" class="inpt"> <font color="#FF0000"><br>Dimension: Width :500px and Height : 400px </font>
            </td>
          </tr>
		  
		  <tr >
            <td align="right">&nbsp;</td>
            <td>
              <input type="submit" class="button" value="Submit" name="submit">
            </td>
          </tr>

        </table>
      </form>
    </div>
</div> 
<?php
$flag=$_REQUEST[flag];
if($rowCount==0)
{?>
	<p align="center" class="error">No Record found.</p>
<?php
}
if($flag=="edit")
{?>
	<p align="center" class="error">Record is edited Successfully.</p>
<?php
}
if($flag=="add")
{ ?>
	<p align="center" class="error">New image has been added successfully.</p>
<?php
}
if($flag=="exists")
{ ?>
	<p align="center" class="error">Image Name already exists.</p>
<?php
}
if($flag=="del")
{ ?>
	<p align="center" class="error">Gallery image has been deleted successfully.</p>
<?php
} ?>		

<div class="gap"></div>
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt"><a href="../home.php"><img src="../../images/back32.png" alt="Back" title="Back"/></a></div>

<div class="clear"></div>
<div class="gap"></div>

<div class="box">
    <div class="hdr">
		<h1 class="ico"><img src="icon/icon.png" alt="">Existing Uploaded Images</h1>
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
			<form name="frmmemdisp" action="index.php" method="GET">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tbody>
									<tr>
<?php 							$clcnt=0;
										while($row=mysqli_fetch_array($result))
										{ 
											if($clcnt%2==0){$class="even";}else{$class="";}
											$count++;
											$file_id = $row["image_id"];     
											$filename = $row["image_path"];
											$image_cap = $row["image_name"];
										?>
											<td>
													<table width="100%" border="0" cellspacing="0" cellpadding="3">
														<tr>
																<td><a href="../../possbpser/<?php  echo $filename?>" target="_blank"><img src="../../possbpser/<?php  echo $filename?>" border="0" width="100" height="80"></a></td>
														</tr>
														<tr>
																<td><?php  echo $image_cap?>
																		<input type="hidden" name="aid" value="<?php  echo $_REQUEST[aid]?>" />
																		<input type="hidden" name="imgid" value="<?php  echo $row[image_id]?>" />
																		<input type="hidden" name="imgcap" value="<?php  echo $row[image_name]?>" />
																</td>
														</tr> 																
														<tr>
																<td >Make Album Image : <input type="radio" name="status" value="<?php  echo $row[image_id]?>" <?php  if($row[img_status] == "Active") { ?> checked="checked" <?php  } ?> onclick="javascript:make();" /></td>
														</tr>
														<?php  if($row[img_status] != "Active") { ?>
																	<tr>
																	<td align="center" class="bodytext">
																	<a href="submit_uploadimage.php?fn=<?php  echo $filename?>&fid=<?php  echo $file_id?>&aid=<?php  echo $_REQUEST[aid]?>&mode=del" onclick="if(confirm('Confirm delete?')) return true; else return false;">Delete File</a>
																	</td>
																	</tr>
															<?php  } ?>
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
	document.frmmemdisp.action="submit_uploadimage.php?flag=main&imid="+ imid + "&pid="+ pid;
	document.frmmemdisp.submit();
}
</script>
<?php admin_footer("../../");?>