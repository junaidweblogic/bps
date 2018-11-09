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
	if(!($result = mysqli_query($connection,$query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_errno($connection); exit; }
}

	$query = "SELECT * FROM " . $tblpref . "banner_time WHERE b_bnid = '$_REQUEST[bnid]'";
	if(!($result = mysqli_query($connection,$query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_errno($connection); exit; }
	$row = mysqli_fetch_array($result);

admin_header('../../','Missing People ',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
?>

<!--body start -->
<div class="adminbody">

<div class="box smlsize">
    <div class="hdr">
		<h1 class="ico-search">Search</h1>
    </div>
    <div class="padtb">
      <form action="bannerlist.php?bnid=<?php echo $bnid?>" method="post" name="updatetime" target="_self">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="40%" align="right">Missing People Time  :</td>
            <td width="60%">
			  <input type="text" name="bntime" id="bntime" value="<?php echo $row[b_time]; ?>" class="inpt" />
            </td>
          </tr>
		  
		  <tr >
            <td align="right">&nbsp;</td>
            <td>
              <input type="submit" class="button" value="Set Time" name="submit">
            </td>
          </tr>
        </table>
      </form>
    </div>
</div>  

<?php
$flag=$_REQUEST[msg];
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
		<h1 class="ico"><img src="icon/icon.png" alt="">Missing People List</h1>
        <div class="addnew">
						<a  href="banner-edit.php?bnid=<?php  echo $bnid?>" class="add">Add New</a>
                        <!-- <a  href="#" class="import">Import</a>
                        <a  href="#" class="export">Export</a>  -->
		</div>
	</div>   
	<div class="padtb">
  <!--   <p align="right"></p> -->
	<p align="right"><?=$show_status?> </p>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<thead>
	  <tr>
		<th class="minth">Missing People Name</th>
		<th width="35%">Missing People Type</th>
		<th width="20%">Missing People Image</th>
		<th class="minth">Action</th>
	  </tr>
	</thead>
	<tbody>
	<?php 
		$clcnt=0;
		$query = "SELECT * FROM c_banner WHERE bn_parentid='$bnid' AND bn_delete='n' ORDER BY bn_name";
		if (!($result = mysqli_query($connection,$query))){  echo $query.mysqli_errno($connection);  exit(); }
		if(0<mysqli_num_rows($result))
		{
		while($row_country=mysqli_fetch_array($result))
		{ 
		if($clcnt%2==0){$class="even";}else{$class="";}
		$clcnt++;
		$id=$row_country[cnt_id];
		$count++;
		?>
	
		<tr class="<?=$class?>">
		<!-- <td><b><?=$count?></b></td> -->
		<td><?=stripslashes($row_country[bn_name])?></td>
		<td><?php  $isflash=explode(".",$row_country[bn_image]);
			if($isflash[1]=="swf"){echo "FLASH";}else{echo "IMAGE";}?></td>
		<td><img src="../../possbpser/<?php  echo $row_country["bn_image"]?>" height="50"></td>
		<td class="center">
		<ul class="actions">
			<li><a title="edit" href="banner-edit.php?bnid1=<?php  echo $row_country["bn_id"]?>&bnid=<?php  echo $bnid?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
			<li><a href="submit-banner.php?bnid1=<?php  echo $row_country["bn_id"]?>&flag=del&bnid=<?php  echo $bnid?>" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../images/delete.png" alt="delete"></a></li>
		</ul></td>
	</tr>
<? 
		}
		}
		else
		{ ?>
			<tr>
				<td align="center" colspan="4">No Record Found</td>
			  </tr>
		<?php  }?>
  </tbody>  

	<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td class="center">&nbsp;</td>
  </tr>
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