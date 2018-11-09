<?php
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");

if($_SESSION[username]=="")	{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

	if(isset($version)) :
	
		$version = explode(",", $version);
	
		$query = "UPDATE " . $tblpref . "content_master SET cms_featured = '' WHERE cms_id = '$version[1]' OR cms_count = '$version[1]'";
		if(!($result = mysqli_query($connection,$query))) { echo "Query - " . $query . "<br />Error - " . mysqli_errno($connection); }
	
		$query = "UPDATE " . $tblpref . "content_master SET cms_featured = 'Active' WHERE cms_id = '$version[0]'";
		if(!($result = mysqli_query($connection,$query))) { echo "Query - " . $query . "<br />Error - " . mysqli_errno($connection); }
	endif;

admin_header('../../','Versions',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
?>

<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" src="../../js/thickbox-admin.js"></script>

<link href="../../css/thickbox.css" rel='stylesheet' media='screen' type="text/css" />



<!--body start -->
<div class="adminbody">

<?php
$flag=$_REQUEST[flag];
if($rowCount==0)
{?>
	<!-- <p align="center" class="error">No Record found.</p> -->
<?php
}
if($flag=="edit")
{?>
	<p align="center" class="error">Record is edited Successfully.</p>
<?php
}
if($flag=="add")
{ ?>
	<p align="center" class="error">New Record is added successfully.</p>
<?php
}
if($flag=="exist")
{ ?>
	<p align="center" class="error">Record is already exits.</p>
<?php
}
if($flag=="del")
{ ?>
	<p align="center" class="error">Record is deleted Successfully.</p>
<?php
} ?>
<div class="gap"></div>
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt"><a href="../home.php"><img src="../../images/back32.png" alt="Back" title="Back"/></a></div>
<div class="gap"></div>
<div class="box">
    <div class="hdr">
		<h1 class="ico"><img src="icon/icon.png" alt="">Version List</h1>
        <div class="addnew">
						<!-- <a  href="add.php" class="add">Add New</a> -->
                        <!-- <a  href="#" class="import">Import</a>
                        <a  href="#" class="export">Export</a>  -->
		</div>
	</div> 
	<div class="padtb">
  <!--   <p align="right"></p> -->
	<p align="right"><?=$show_status?> </p>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tbody>



		<?php 
			$frm = 1;
			$count = 1;
			$query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_subtype = 'Main Pages' AND cms_count = '0' ORDER BY cms_id";
			if(!($result = mysqli_query($connection,$query))) { echo "Query - " . $query . "<br />Error - " . mysqli_errno($connection); }
			while($row = mysqli_fetch_object($result)) {
		?>
        <tr>
          <td width="12%" align="left" style="background-color:#eeeeee; color:#FF0000; font-weight:bold;"><?php echo $count; ?></td>
          <td align="left" style="background-color:#eeeeee; color:#FF0000; font-weight:bold;">
		  
		  <a class="thickbox" href="contentpopup.php?cmsid=<?php echo stripslashes($row->cms_id); ?>&amp;TB_iframe=true&amp;height=400&amp;width=780" title="<?php echo stripslashes($row->cms_title); ?> : Page Content "><?php echo stripslashes($row->cms_title); ?></a>
		  
		  </td>
          <td align="right" width="8%" style="background-color:#eeeeee; color:#FF0000; font-weight:bold;">Default</td>
        </tr>
        <?php 
                $query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_count = '$row->cms_id' ORDER BY cms_title,cms_id ASC";
                if(!($results = mysqli_query($connection,$query))) { echo "Query - " . $query . "<br />Error - " . mysqli_errno($connection); }
                if(mysqli_num_rows($results) > 0) :
				$cnt = 1;
            ?>
            <form name="frm<?php echo $frm++;?>" method="post" >
            <?php  while($rows = mysqli_fetch_object($results)) { ?>
            <tr>
              <td scope="col" align="left" width="1%" ><?php echo $cnt++; ?></td>
              <td scope="col" width="90%" align="left" style="padding-left:20px;"><?php 
				$time = explode(":", $rows->cms_time);
				if($time[0] > 12) {
					$hour = $time[0] % 12;
					$time = $hour . ":". $time[1] . ":" . $time[2]. " PM";
				}
				else {
					$time = $rows->cms_time . " AM";
				}
			  ?>
			  <a class="thickbox" href="contentpopup.php?cmsid=<?php echo stripslashes($rows->cms_id); ?>&amp;TB_iframe=true&amp;height=400&amp;width=780" title="<?php echo stripslashes($rows->cms_title); ?> : Page Content "><?
			  	echo dateformate($rows->cms_date) . " -- " . $time . " -- " . stripslashes($rows->cms_title); 
			?></a></td>
              <td scope="col" align="right" style="padding-right:10px;"><input type="radio" name="version" <?php if($rows->cms_featured == "Active") : echo "checked"; endif; ?> onclick="this.form.submit();" value="<?php echo $rows->cms_id; ?>,<?php echo $row->cms_id; ?>"  /></td>
            </tr>
            <?php } ?>
            <tr>
             <td scope="col" align="left" width="1%" ><?php echo $cnt; ?></td>
              <td scope="col" align="left" style="padding-left:20px;">
			  <a class="thickbox" href="contentpopup.php?order_code=KWL-JFE&amp;quantity=3&amp;TB_iframe=true&amp;height=400&amp;width=780" title="Page Content"><?php echo stripslashes($row->cms_title); ?></a>
			  
			  </td>
              <td scope="col" align="right" style="padding-right:10px;"><input type="radio" name="version" <?php if($row->cms_featured == "Active") : echo "checked"; endif; ?> onclick="this.form.submit();" value="<?php echo $row->cms_id; ?>,<?php echo $row->cms_id; ?>"  /></td>
            </tr>
          </form>
        <?php  endif; ?>
		<?php 
			$counter = 1;
			$query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_subtype = '$row->cms_id' AND cms_count = '0' ORDER BY cms_title,cms_id ASC";
			if(!($results = mysqli_query($connection,$query))) { echo "Query - " . $query . "<br />Error - " . mysqli_errno($connection); }
			while($rows = mysqli_fetch_object($results)) {
		?>
        <tr>
          <td align="left" style="color:#FF0000; padding-left:10px; font-weight:bold;"><?php echo $count . '.' . $counter; ?></td>
          <td align="left" style="color:#FF0000; font-weight:bold;">
		   <a class="thickbox" href="contentpopup.php?cmsid=<?php echo stripslashes($rows->cms_id); ?>&amp;TB_iframe=true&amp;height=400&amp;width=780" title="<?php echo stripslashes($rows->cms_title); ?> : Page Content "><?php echo stripslashes($rows->cms_title); ?></a></td>
          <td align="right" style="color:#FF0000; font-weight:bold;">Default</td>
        </tr>
        <?php 
                $query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_count = '$rows->cms_id' ORDER BY cms_title,cms_id ASC";
                if(!($resultss = mysqli_query($connection,$query))) { echo "Query - " . $query . "<br />Error - " . mysqli_errno($connection); }
                if(mysqli_num_rows($resultss) > 0) :
				$cnt = 1;
            ?>
            <form name="frm<?php echo $frm++;?>" method="post" >
            <?php  while($rowss = mysqli_fetch_object($resultss)) { ?>
            <tr>
              <td scope="col" align="left" style="color:#FF0000; padding-left:10px; font-weight:bold;"><?php echo $cnt++; ?></td>
              <td scope="col" width="90%" align="left" style="padding-left:20px;"><?php 
				$time = explode(":", $rowss->cms_time);
				if($time[0] > 12) {
					$hour = $time[0] % 12;
					$time = $hour . ":". $time[1] . ":" . $time[2]. " PM";
				}
				else {
					$time = $rowss->cms_time . " AM";
				}
				?>
				<!-- 21-11-11 -->
				<a class="thickbox" href="contentpopup.php?cmsid=<?php echo stripslashes($rowss->cms_id); ?>&amp;TB_iframe=true&amp;height=400&amp;width=780" title="<?php echo stripslashes($rowss->cms_title); ?> : Page Content ">
				<!-- 21-11-11 -->  
				<?
			  	echo "".dateformate($rowss->cms_date) . " -- " . $time . " -- ". stripslashes($rowss->cms_title); 
				?>
				</a>
			</td>
              <td scope="col" align="right" style="padding-right:10px;"><input type="radio" name="version" <?php if($rowss->cms_featured == "Active") : echo "checked"; endif; ?> onclick="this.form.submit();" value="<?php echo $rowss->cms_id; ?>,<?php echo $rows->cms_id; ?>"/></td>
            </tr>
            <?php } ?>
            <tr>
             <td scope="col" align="left" style="color:#FF0000; padding-left:10px; font-weight:bold;"><?php echo $cnt; ?></td>
              <td scope="col" align="left" style="padding-left:20px;">
				<a class="thickbox" href="contentpopup.php?cmsid=<?php echo stripslashes($rows->cms_id); ?>&amp;TB_iframe=true&amp;height=400&amp;width=780" title="<?php echo stripslashes($rows->cms_title); ?> : Page Content ">
			  <?php echo stripslashes($rows->cms_title); ?></a></td>
              <td scope="col" align="right" style="padding-right:10px;"><input type="radio" name="version" <?php if($rows->cms_featured == "Active") : echo "checked"; endif; ?> onclick="this.form.submit();" value="<?php echo $rows->cms_id; ?>,<?php echo $rows->cms_id; ?>"  /></td>
            </tr>
          </form>
        <?php  endif; ?>
        <?php 
			$counts = 1;
			$query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_subtype = '$rows->cms_id' AND cms_count = '0' ORDER BY cms_title,cms_id ASC";
			if(!($results1 = mysqli_query($connection,$query))) { echo "Query - " . $query . "<br />Error - " . mysqli_errno($connection); }
			while($rows1 = mysqli_fetch_object($results1)) {
		?>
        <tr>
          <td align="left" style="background-color:#eeeeee; color:#FF0000; padding-left:20px; font-weight:bold;"><?php echo $count . '.' . $counter  . '.' . $counts; ?></td>
          <td align="left" style="background-color:#eeeeee; color:#FF0000; font-weight:bold;">
		  <a class="thickbox" href="contentpopup.php?cmsid=<?php echo stripslashes($rows1->cms_id); ?>&amp;TB_iframe=true&amp;height=400&amp;width=780" title="<?php echo stripslashes($rows1->cms_title); ?> : Page Content "><?php echo stripslashes($rows1->cms_title); ?></a></td>
          <td align="right" style="background-color:#eeeeee; color:#FF0000; font-weight:bold;">Default</td>
        </tr>
        <?php 
                $query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_count = '$rows1->cms_id' ORDER BY cms_title,cms_id ASC";
                if(!($resultss = mysqli_query($connection,$query))) { echo "Query - " . $query . "<br />Error - " . mysqli_errno($connection); }
                if(mysqli_num_rows($resultss) > 0) :
				$cnt = 1;
            ?>
            <form name="frm<?php echo $frm++;?>" method="post" >
            <?php  while($rowss = mysqli_fetch_object($resultss)) { ?>
            <tr>
              <td scope="col" align="left" style="color:#FF0000; padding-left:10px; font-weight:bold;"><?php echo $cnt++; ?></td>
              <td scope="col" width="90%" align="left" style="padding-left:20px;"><?php 
				$time = explode(":", $rowss->cms_time);
				if($time[0] > 12) {
					$hour = $time[0] % 12;
					$time = $hour . ":". $time[1] . ":" . $time[2]. " PM";
				}
				else {
					$time = $rowss->cms_time . " AM";
				}
				 ?>
				<a class="thickbox" href="contentpopup.php?cmsid=<?php echo stripslashes($rowss->cms_id); ?>&amp;TB_iframe=true&amp;height=400&amp;width=780" title="<?php echo stripslashes($rows->cms_title); ?> : Page Content ">
				<?
				echo "".dateformate($rowss->cms_date) . " -- " . $time . " -- " . stripslashes($rowss->cms_title); 
				?>
				</a>
			  </td>
              <td scope="col" align="right" style="padding-right:10px;"><input type="radio" name="version" <?php if($rowss->cms_featured == "Active") : echo "checked"; endif; ?> onclick="this.form.submit();" value="<?php echo $rowss->cms_id; ?>,<?php echo $rows1->cms_id; ?>"  /></td>
            </tr>
            <?php } ?>
            <tr>
             <td scope="col" align="left" style="color:#FF0000; padding-left:10px; font-weight:bold;"><?php echo $cnt; ?></td>
              <td scope="col" align="left" style="padding-left:20px;">
				<a class="thickbox" href="contentpopup.php?cmsid=<?php echo stripslashes($rows1->cms_id); ?>&amp;TB_iframe=true&amp;height=400&amp;width=780" title="<?php echo stripslashes($rows1->cms_title); ?> : Page Content ">
			  <?php echo stripslashes($rows1->cms_title); ?></a></td>
              <td scope="col" align="right" style="padding-right:10px;"><input type="radio" name="version" <?php if($rows1->cms_featured == "Active") : echo "checked"; endif; ?> onclick="this.form.submit();" value="<?php echo $rows1->cms_id; ?>,<?php echo $rows1->cms_id; ?>"  /></td>
            </tr>
          </form>
        <?php  endif; ?>
        <?php 
			$counts1 = 1;
			$query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_subtype = '$rows1->cms_id' AND cms_count = '0' ORDER BY cms_title,cms_id ASC";
			if(!($results2 = mysqli_query($connection,$query))) { echo "Query - " . $query . "<br />Error - " . mysqli_errno($connection); }
			while($rows2 = mysqli_fetch_object($results2)) {
		?>
        <tr>
          <td align="left" style="color:#FF0000; padding-left:30px; font-weight:bold;"><?php echo $counts1 . '.' . $counts . '.' . $count . '.' . $counter; ?></td>
          <td align="left" style="background-color:#eeeeee; color:#FF0000; font-weight:bold;">
		  <a class="thickbox" href="contentpopup.php?cmsid=<?php echo stripslashes($rows2->cms_id); ?>&amp;TB_iframe=true&amp;height=400&amp;width=780" title="<?php echo stripslashes($rows2->cms_title); ?> : Page Content "><?php echo stripslashes($rows2->cms_title); ?></a></td>
          <td align="right" style="background-color:#eeeeee; color:#FF0000; font-weight:bold;">Default</td>
        </tr>
        <?php 
                $query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_count = '$rows2->cms_id' ORDER BY cms_title,cms_id ASC";
                if(!($resultss = mysqli_query($connection,$query))) { echo "Query - " . $query . "<br />Error - " . mysqli_errno($connection); }
                if(mysqli_num_rows($resultss) > 0) :
				$cnt = 1;
            ?>
            <form name="frm<?php echo $frm++;?>" method="post" >
            <?php  while($rowss = mysqli_fetch_object($resultss)) { ?>
            <tr>
              <td scope="col" align="left" style="color:#FF0000; padding-left:10px; font-weight:bold;"><?php echo $cnt++; ?></td>
              <td scope="col" width="90%" align="left" style="padding-left:20px;"><?php 
				$time = explode(":", $rowss->cms_time);
				if($time[0] > 12) {
					$hour = $time[0] % 12;
					$time = $hour . ":". $time[1] . ":" . $time[2]. " PM";
				}
				else {
					$time = $rowss->cms_time . " AM";
				}
				  
			  	echo "".dateformate($rowss->cms_date) . " -- " . $time . " -- " . stripslashes($rowss->cms_title); 
			?></td>
              <td scope="col" align="right" style="padding-right:10px;"><input type="radio" name="version" <?php if($rowss->cms_featured == "Active") : echo "checked"; endif; ?> onclick="this.form.submit();" value="<?php echo $rowss->cms_id; ?>,<?php echo $rows2->cms_id; ?>"  /></td>
            </tr>
            <?php } ?>
            <tr>
             <td scope="col" align="left" style="color:#FF0000; padding-left:10px; font-weight:bold;"><?php echo $cnt; ?></td>
              <td scope="col" align="left" style="padding-left:20px;">
				<a class="thickbox" href="contentpopup.php?cmsid=<?php echo stripslashes($rows->cms_id); ?>&amp;TB_iframe=true&amp;height=400&amp;width=780" title="<?php echo stripslashes($rows->cms_title); ?> : Page Content ">
			  <?php echo stripslashes($rows->cms_title); ?></a></td>
              <td scope="col" align="right" style="padding-right:10px;"><input type="radio" name="version" <?php if($rows->cms_featured == "Active") : echo "checked"; endif; ?> onclick="this.form.submit();" value="<?php echo $rows2->cms_id; ?>,<?php echo $rows2->cms_id; ?>" /></td>
            </tr>
          </form>
        <?php  endif; ?>
		<?php 
						$counts1++;
					}
					$counts++;
				}
				$counter++;
			}
			$count++;
		} ?>	
     </table>
	 </tbody>  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td class="center">&nbsp;</td>
  </tr>
</table>

    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>



</div>
<?admin_footer();?>