<?php 
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");

 if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

	if ($_GET[sorton]!="")
	{
		 $condition2=" ORDER BY ". $_GET[sorton]. " ". $_GET[sortby];
	}
	$typev=$txtname;
	$txtname=trim(addslashes($txtname));		
	if($txtname!="")
	{
		$condition[]="cms_title='$txtname'";
	}	
	$typegame=$txtgame;
	
		$datepicker1= $datepicker;
	if($datepicker!="")
	{	
		$datepicker=dateformate($datepicker);
		$condition[]="cms_subdate ='$datepicker'";
	}
	$condition[]="cms_type='Event'";
	if(is_array($condition))
	{
		$condition=" WHERE " . implode(" AND ",$condition);
	}
		$que="SELECT * FROM ".$tblpref."content_master $condition  ORDER BY cms_subdate DESC"; 
		$curr_query="txtname=".$_GET[txtname]."&datepicker=".$_GET[datepicker];
		$pagesize=20;
		$the_query  = pagination($que,$page,null,$curr_query,$pagesize);	
		$real_string     = explode("~" , $the_query);
		$que= $que.$cstr." LIMIT ". $real_string[0];
		$show_status     = $real_string[2];
		$show_pagination = $real_string[1];
		if (!($page_res = mysqli_query($connection,$que))) 
		{ echo "FOR QUERY: $strsql<BR>".mysqli_errno($connection); 	exit;}
		$rowCount = mysqli_num_rows($page_res);
		$srnum=$real_string[0][0];
		$srnum= $real_string[0];//--this is used to the next page no so that the srno at page comes in sequence
		$srnum=explode(",",$srnum);
		$count=$srnum[0]; 
		
		/*$query = "SELECT * FROM " . $tblpref . "content_master $condition ORDER BY cms_id ASC";
	if(!($result = mysqli_query($connection,$query))) { echo "Query :- " . $query . "<br />Error :- " . mysqli_errno($connection); exit; }	*/

admin_header('../../','Event List',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
?>

<script type="text/javascript" src="../../js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../js/daterangepicker.jQuery.js"></script>
<link rel="stylesheet" href="../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />

<script type="text/javascript"> 
$(function(){
  $('#datepicker').daterangepicker({
posX:600,
posY: 250
  }); 
});
</script>
<style type="text/css">
.ui-daterangepickercontain {
	top:220px;
	left:400px;
	position: absolute;
	z-index: 999;
}
</style>
<!--body start -->
<div class="adminbody">

<div class="box smlsize">
    <div class="hdr">
		<h1 class="ico-search">Search</h1>
    </div>
    <div class="padtb">
      <form name="frmcms" method="GET" action="index.php">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="40%" align="right">Event Title :</td>
            <td width="60%">
				<select name="txtname" class="inpt" >
						<option value="" >Please Select</option>
							<?php $que2="select * from ".$tblpref."content_master where cms_type='Event'";
					if (!($page1 = mysqli_query($connection,$que2))) 
					{ echo "FOR QUERY: $strsql<BR>".mysqli_errno($connection); 	exit;}
					while($row1=mysqli_fetch_array($page1)){?>
						<option value="<?php  echo htmlentities($row1[cms_title])?>" <?php if($row1[cms_title]==$txtname){echo "Selected";}?>><?php  echo htmlentities(stripslashes($row1[cms_title]))?></option> 
					<?php }?>
					</select>
            </td>
          </tr>
		  <tr>
            <td width="40%" align="right">Date&nbsp;Of&nbsp;Event :</td>
            <td width="60%">
			  <input type="text" value="<?php  echo $datepicker1?>" name="datepicker" id="datepicker" class="inpt">
            </td>
          </tr>
		  <tr >
            <td align="right">&nbsp;</td>
            <td>
              <input type="submit" class="button" value="Search" name="submit">
            </td>
          </tr>
        </table>
      </form>
    </div>
</div>    
<?php
	$flag=$_REQUEST[flag];
	if($rowCount==0)
	{ ?>
		<p align="center" class="error">No Record found.</p>
<?php
	}
	if($flag=="edit")
	{ ?>
		<p align="center" class="error">Record is edited Successfully.</p>
<?php
	}
	if($flag=="add")
	{ ?>
		<p align="center" class="error">New Record is added successfully.</p>
<?php
	}
	if($flag=="del") 
	{ ?>
		<p align="center" class="error">Record is deleted Successfully.</p>
<?php
	}
	if($flag=="exist") 
	{ ?>
		<p align="center" class="error">Record already exist.</p>
<?php
	} ?>	

	<div class="gap"></div>
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt"><a href="../home.php"><img src="../../images/back32.png" alt="Back" title="Back"/></a></div>
<div class="gap"></div>
<div class="box">
    <div class="hdr">
		<h1 class="ico"><img src="icon/icon.png" alt="">Event List</h1>
        <div class="addnew">
						<a  href="event_add.php?mode=add" class="add">Add New</a>
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
		<th class="minth">Sr. No.</th>
		<th width="40%">Event Title</th>
		<th width="50%">Date</th>
		<th class="minth">Action</th>
	  </tr>
	</thead>
	<tbody>
	<?php 
		$clcnt=0;
		
		while($row_currency=mysqli_fetch_array($page_res))
		{ 
			$id=$row_currency[cms_id];
			$count++;
			if($clcnt%2==0){$class="even";}else{$class="";}

			$clcnt++;
		?>
	
		<tr class="<?=$class?>">
		<td><b><?=$count?></b></td>
		<td><?=stripslashes($row_currency[cms_title])?></td>
		<td><?=dateformate($row_currency[cms_subdate])?></td>
		<td class="center">
		<ul class="actions">
			<li><a title="edit" href="event_add.php?pid=<?php echo $row_currency['cms_id'] ?>&mode=edit" ><img alt="edit" src="../../images/pencil.png"></a></li>
			<li><a href="submit_event.php?pid=<?php echo $row_currency['cms_id'] ?>&mode=del" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../images/delete.png" alt="delete"></a></li>
		</ul></td>
	</tr>
 
<? } ?>


	
	<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td class="center">&nbsp;</td>
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