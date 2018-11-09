<?php 	session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}


if($_REQUEST[bntime] != "") {
	$query = "UPDATE " . $tblpref . "banner_time SET
		b_time = '$_REQUEST[bntime]' WHERE b_bnid = '$_REQUEST[bnid]'";
	if(!($result = mysqli_query($connection,$query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_connect_errno(); exit; }
}

	$query = "SELECT * FROM " . $tblpref . "banner_time WHERE b_bnid = '$_REQUEST[bnid]'";
	if(!($result = mysqli_query($connection,$query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_connect_errno(); exit; }
	$row = mysqli_fetch_array($result);


admin_header("../../","Banner Management");
//admin_nav("../../");
$bnid = $_GET[bnid];
switch($bnid)
{
	case 1:
			$banner_type = "Top Banner";
			$targetimagesize = 250;
			break;
	case 2:
			$banner_type = "Right Side Banner 01";
			$targetimagesize = 60;
			break;
	case 3:
			$banner_type = "Right Side Banner 02";
			$targetimagesize = 60;
			break;
	case 4:
			$banner_type = "Right Side Bottom Banner";
			$targetimagesize = 60;
			break;
	case 5:
			$banner_type = "Bottom Banner";
			$targetimagesize = 250;
			break;
}
?>
<!--body start -->
<div class="adminbody">

<div class="box smlsize">
    <div class="hdr">
		<h1 class="ico-edit">Set Time</h1>
    </div>
    <div class="padtb">
      <form name="frmcms" method="GET" action="bannerlist.php?bnid=<?php echo $bnid?>">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="40%" align="right">Banner Time  :</td>
            <td width="60%">
				<input type="text" name="bntime" id="bntime" value="<?php echo $row[b_time]; ?>" class="slct"/>		</td>
            </td>
          </tr>
		  
		 <tr >
            <td align="right">&nbsp;</td>
            <td>
              <input type="submit" class="button" value="Set Time" name="submit">
			  <input type="hidden" name="ban_pos" value="<?php echo $ban_pos;?>">
            </td>
          </tr>
        </table>
      </form>
    </div>
</div> 

<?php
if($flag=="add")
{ ?>
	<p align="center" class="error">Record has been successfully added.</p>
<?php
}
if($flag=="edit")
{ ?>
	<p align="center" class="error">Record has been successfully updated.</p>
<?php
}
if($flag=="del")
{ ?>
	<p align="center" class="error">Record has been successfully deleted.</p>
<?php
}?>	
<div class="gap"></div>
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="index.php"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>
<div class="gap"></div>
<div class="box">
    <div class="hdr">
		<h1 class="ico"><img src="icon/icon.png" alt="">Advertising Banner List :: Top Banner </h1>
        <div class="addnew">
						<a  href="banner-edit.php?bnid=<?php  echo $bnid?>" class="add">Add New</a>
                        <!-- <a  href="#" class="import">Import</a>  -->
						<?php if($rowCount>0){?>
                        <!-- <a  href="export.php?ban_pos=<?=$ban_pos?>" class="export">Export</a> -->
						<?php }?>
		</div>
	</div>   
      
    <div class="padtb">
  <!--   <p align="right"></p> -->
	<p align="right"><?=$show_status?> </p>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<thead>
	  <tr>
		<th width="8%">Banner Name</th>
		<th >Banner Type</th>
		<th width="40%">Banner Type</th>
		<th class="minth">Action</th>
	  </tr>
	</thead>
	<tbody>
	<?php 
		$clcnt=0;
		
	$query = "SELECT * FROM c_banner WHERE bn_parentid='$bnid' AND bn_delete='n' ORDER BY bn_id DESC";
	if (!($result = mysqli_query($connection,$query))){  echo $query.mysqli_connect_errno();  exit(); }

	if(0<mysqli_num_rows($result))
	{
		while($row=mysqli_fetch_array($result)) { ?>
	
	  <tr>
		<td><?php  echo $row["bn_name"]?>&nbsp;</td>
		<td><?php  $isflash=explode(".",$row[bn_image]);
			if($isflash[1]=="swf"){echo "FLASH";}else{echo "IMAGE";}?></B>&nbsp;
		</td>
        <td align="center"><img src="../../possbpser/<?php  echo $row["bn_image"]?>" height="50"></td>
		<td class="center">
		<ul class="actions">
			<li><a title="edit" href="banner-edit.php?bnid1=<?php  echo $row["bn_id"]?>&bnid=<?php  echo $bnid?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
			<li><a href="submit-banner.php?bnid1=<?php  echo $row["bn_id"]?>&flag=del&bnid=<?php  echo $bnid?>" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../images/delete.png" alt="delete"></a></li>
		</ul></td>
	  </tr>
		<?php  } } else	{ ?>
			  <tr>
				<td align="center" colspan=20>Zero records </td>
			  </tr>
		<?php  }?>


		
		
	</tr>
	
  
  </tbody>  

</table>

<div class="pagination">
<!-- pagination underneath the box's content -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" align="center" style=" color:#000000; font-size:14px; font-weight:bold;"><div id="pageNavPosition"><?=$show_pagination ?></div></td>
  </tr>  
</table>			
</div>

    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>



</div>
<?admin_footer();?>