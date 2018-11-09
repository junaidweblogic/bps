<?php 
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");

if($_SESSION[username]=="")	{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

$query="select * from ".$tblpref."content_master where cms_type='mcms' AND cms_count='0'"; //Query for search dropdown
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}

$query1="select * from ".$tblpref."category where cat_type='cms'";
if(!($result1=mysqli_query($connection,$query1))){ echo $query1.mysqli_errno($connection); exit;}

	$typev=$txtname;
	$condition[]="cms_type='mcms'";

	$condition[]="cms_subtype='Main Pages'";

	if($txtname!="")
	{
		$condition[]="cms_id='$txtname'";
	}


if(is_array($condition)) { $condition=" WHERE " . implode(" AND ",$condition); }

if($datepicker!="" AND $txtname=="")
{
	$datep=explode(" ", $datepicker);
	if($datep[1]=="TO")
	{
		$datep1=dateformate($datep[0]);
		$datep2=dateformate($datep[2]);
		$cond[]=" cms_date BETWEEN '".$datep1."' AND '".$datep2."'";
	}
	else
	{
		$datep1=dateformate($datep[0]);
		$datep2=dateformate($datep[2]);
		$cond[]=" cms_date ='".$datep1."'";
	}
	
	$cond[]="cms_type='mcms'";

	if(is_array($cond)) { $cond=" WHERE " . implode(" AND ",$cond);}

	echo $que="SELECT * FROM ".$tblpref."content_master $cond ORDER BY cms_title";
}
else{

$que="SELECT * FROM ".$tblpref."content_master $condition ORDER BY cms_id";

}

$curr_query="sorton=".$_GET[sorton]."&sortby=".$_GET[sortby];
$pagesize=200;
$the_query  = pagination($que,$page,null,$curr_query,$pagesize);	
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

admin_header('../../','Content List',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
//admin_nav("../../");
?>
<script type="text/javascript" src="../../js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../js/daterangepicker.jQuery.js"></script>
<link rel="stylesheet" href="../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />
<script type="text/javascript">	
$(function(){
	  $('#datepicker').daterangepicker({
		posX: 630,
		posY: 250
	  }); 
 }); 
</script>
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
            <td width="40%" align="right">Last Updated On  :</td>
            <td width="60%">
              <input value="<?php  echo $datepicker?>" name="datepicker" id="datepicker" class="inpt"/>
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
	if($flag=="title") 
	{ ?>
		<p align="center" class="error">Title Updated successfully.</p>
<?php
	}?>	

	<div class="gap"></div>
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt"><a href="../home.php"><img src="../../images/back32.png" alt="Back" title="Back"/></a></div>
<div class="gap"></div>
<div class="box">
    <div class="hdr">
		<h1 class="ico"><img src="icon/icon.png" alt="">Content List</h1>
        <div class="addnew">
						<a  href="cms_add.php?mode=add" class="add">Add New</a>
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
		<th width="15%">Name</th>
		<th width="15%">Link url</th>
		<th width="15%">Date</th>
		<th width="15%">Time</th>
		<th width="15%">Default</th>
		<th class="minth">Action</th>
	  </tr>
	</thead>
	<tbody>
	<?php 
		$clcnt=0;
		if($datepicker!="")
		 {
		while($row_currency=mysqli_fetch_array($page_res))
		{ 
			$id=$row_currency[cms_id];
			$count ++;
		?>

		<tr >
          <td width="8%" align="left" class="tbborder"><strong><?php echo $count;?></strong></td>
          <td class="tbborder"  align="left" width="15%"><?php  echo $row_currency[cms_title]?></td>
          <td class="tbborder"  align="left"><?php echo $path1.$row_currency[cms_sitelink];?></td>
          <td class="tbborder"  align="left"><?php echo dateformate($row_currency[cms_date]);?></td>
          <td class="tbborder"  align="left"><?php //echo $row_currency[cms_time]; 
				$time = explode(":", $row_currency[cms_time]);
				if($time[0] > 12) {
					$hour = $time[0] % 12;
					echo $hour . ":". $time[1] . ":" . $time[2]. " PM";
				}
				else {
					echo $row_currency[cms_time] . " AM";
				}
			?></td>
          <td class="tbborder"  align="left"><strong><?php echo $row_currency['cms_featured'];?></strong></td>
          <td class="center">
			<ul class="actions">
		  <?php 
			if(mysqli_num_rows($result1) == 0) 
			{ 
				if($row_currency[cms_subtype]!="Main Pages")
				{
					if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') 
					{?>
						<li><a title="edit" href="cms_add.php?mode=edit&cid=<?php  echo $id?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
         <?php }
					if($_SESSION[user_type]=='approver') 
					{ ?>
					<li><a title="View" href="cms_add.php?mode=view&cid=<?php  echo $id?>" ><img alt="View" src="../../images/view.png"></a></li>
            <?php 
					}
					if($_SESSION[user_type]!='moderator') 
					{ ?>
						<li><a href="submit_cms.php?cid=<?php  echo $row_currency[cms_id]?>&mode=del" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../images/delete.png" alt="delete"></a></li>
            <?php 
					}
				}
				else
				{
					if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') 
					{ ?>
						<li><a title="edit" href="cms_add.php?mode=edit&cid=<?php  echo $id?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
            <?php 
					}
					if($_SESSION[user_type]=='approver') 
					{ ?>
						<li><a title="View" href="cms_add.php?mode=view&cid=<?php  echo $id?>" ><img alt="View" src="../../images/view.png"></a></li>
            <?	}
				}
			}
			else 
			{?>
			<li><a title="edit" href="updatetitle.php?cid=<?php  echo $id?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
            <?php 
			} ?> 
			</ul>
          </td>
        </tr>
		<? } } else { ?>
        <?php 
			$count = 0;
			while($row_category=mysqli_fetch_array($page_res)){ 
			$id=$row_category[cms_id];
			$count ++;
			//Main Pages
			
			$query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_subtype = '$row_category[cms_id]' AND cms_count = '0' ORDER BY cms_id ASC";
			if(!($result1=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
		?>
        <tr >
          <td width="8%" align="left" class="tbborder"><strong><?php echo $count;?></strong></td>
          <td class="tbborder"  align="left" width="15%"><?php  echo $row_category[cms_title]?></td>
          <td class="tbborder"  align="left"><?php echo $path1.$row_category[cms_sitelink];?></td>
          <td class="tbborder"  align="left"><?php echo dateformate($row_category[cms_date]);?></td>
          <td class="tbborder"  align="left"><?php //echo $row_category[cms_time]; 
				$time = explode(":", $row_category[cms_time]);
				if($time[0] > 12) {
					$hour = $time[0] % 12;
					echo $hour . ":". $time[1] . ":" . $time[2]. " PM";
				}
				else {
					echo $row_category[cms_time] . " AM";
				}
			?></td>
          <td class="tbborder"  align="left"><strong><?php echo $row_category['cms_featured'];?></strong></td>
          <td class="center">
			<ul class="actions">
		  <?php 
				if(mysqli_num_rows($result1) == 0) 
				{ 
					if($row_category[cms_subtype]!="Main Pages")
					{
						if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') 
						{?>
							<li><a title="edit" href="cms_add.php?mode=edit&cid=<?php  echo $id?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
            <?php  }
						if($_SESSION[user_type]=='approver') 
						{ ?>
							<li><a title="View" href="cms_add.php?mode=view&cid=<?php  echo $id?>" ><img alt="View" src="../../images/view.png"></a></li>
            <?php } 
						if($_SESSION[user_type]!='moderator') 
						{ ?>
							<li><a href="submit_cms.php?cid=<?php  echo $row_category[cms_id]?>&mode=del" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../images/delete.png" alt="delete"></a></li>
            <?php  } 
					}
					else
					{
						if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') 
						{ ?>
							<li><a title="edit" href="cms_add.php?mode=edit&cid=<?php  echo $id?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
            <?php } 
						if($_SESSION[user_type]=='approver') 
						{ ?>
							<li><a title="View" href="cms_add.php?mode=view&cid=<?php  echo $id?>" ><img alt="View" src="../../images/view.png"></a></li>
            <?		}
					}
				}
				else 
				{?>
					<li><a title="edit" href="updatetitle.php?cid=<?php  echo $id?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
            <?php 
				} ?>
				</ul>
          </td>
        </tr>
        <?php 


                $query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_count = '$row_category[cms_id]' ORDER BY cms_id ASC"; 
                if(!($results = mysqli_query($connection,$query))) { echo "Query - " . $query . "<br />Error - " . mysqli_errno($connection); }
                if(mysqli_num_rows($results) > 0) {
				$count4 = 1;
					while($rows = mysqli_fetch_array($results)){
					
				$time = explode(":", $rows[cms_time]);
				if($time[0] > 12) {
					$hour = $time[0] % 12;
					$time = $hour . ":". $time[1] . ":" . $time[2]. " PM";
				}
				else {
					$time =  $rows[cms_time] . " AM";
				}
		?>
        <tr >
          <td align="left" class="tbborder"><strong>
            <?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;V." . $count4++ ;?>
            </strong></td>
          <td class="tbborder"  align="left" width="15%" colspan=2><?php  echo stripslashes($rows[cms_title]). " -- " . dateformate($rows[cms_date]) . " -- " . $time  ?></td>
          <!--           <td class="tbborder"  align="left"><?php echo $path1.$rows[cms_sitelink];?></td> -->
          <td class="tbborder"  align="left"><?php echo dateformate($rows[cms_date]);?></td>
          <td class="tbborder"  align="left"><?php //echo $row_category[cms_time]; 
				echo $time
			?></td>
          <td class="tbborder"  align="left"><strong><?php echo $rows['cms_featured'];?></strong></td>
          <td class="center">
			<ul class="actions">
		  <?php  
				if($rows[cms_subtype]!="Main Pages")
				{ 
					if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') 
					{?>
						<li><a title="edit" href="cms_add.php?mode=edit&cid=<?php  echo $rows[cms_id]?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
            <?	}
					if($_SESSION[user_type]=='approver') 
					{ ?>
						<li><a title="View" href="cms_add.php?mode=view&cid=<?php  echo $rows[cms_id]?>" ><img alt="View" src="../../images/view.png"></a></li>
            <?	}
					if($_SESSION[user_type]!='moderator') 
					{ ?>
						<li><a href="submit_cms.php?cid=<?php  echo $rows[cms_id]?>&mode=del" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../images/delete.png" alt="delete"></a></li>
            <?php 
					}
				}
				else
				{ 
					if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') 
					{?>
						<li><a title="edit" href="cms_add.php?mode=edit&cid=<?php  echo $rows[cms_id]?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
             <?	}
					if($_SESSION[user_type]=='approver') 
					{ ?>
						<li><a title="View" href="cms_add.php?mode=view&cid=<?php  echo $rows[cms_id]?>" ><img alt="View" src="../../images/view.png"></a></li>
            <?php 
					} 
				}?>
				</ul>
				</td>
        </tr>
        <?php 					
					}

				}



			$count1 = 0;
			
			while($row1=mysqli_fetch_array($result1)){ 
			$count1++;
			//Child
			
			$query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_subtype = '$row1[cms_id]' AND cms_count = '0' ORDER BY cms_id ASC";
			if(!($result2=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
			
		?>
        <tr >
          <td align="left" class="tbborder"><strong>
            <?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;" . $count . "." .$count1;?>
            </strong></td>
          <td class="tbborder"  align="left" width="15%"><?php  echo $row1[cms_title]?></td>
          <td class="tbborder"  align="left"><?php echo $path1.$row1[cms_sitelink];?></td>
          <td class="tbborder"  align="left"><?php echo dateformate($row1[cms_date]);?></td>
          <td class="tbborder"  align="left"><?php //echo $row_category[cms_time]; 
				$time = explode(":", $row1[cms_time]);
				if($time[0] > 12) {
					$hour = $time[0] % 12;
					echo $hour . ":". $time[1] . ":" . $time[2]. " PM";
				}
				else {
					echo $row1[cms_time] . " AM";
				}
			?></td>
          <td class="tbborder"  align="left"><strong><?php echo $row1['cms_featured'];?></strong></td>
          <td class="center">
		<ul class="actions">
		  <?php 
				if(mysqli_num_rows($result2)==0) 
				{ 
					if($row1[cms_subtype]!="Main Pages")
					{
						if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') 
						{?>
							<li><a title="edit" href="cms_add.php?mode=edit&cid=<?php  echo $row1[cms_id]?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
            <?		}
						if($_SESSION[user_type]=='approver') 
						{?>
							<li><a title="View" href="cms_add.php?mode=view&cid=<?php  echo $row1[cms_id]?>" ><img alt="View" src="../../images/view.png"></a></li>
				<?	}
						if($_SESSION[user_type]!='moderator') 
						{ ?>
							<li><a href="submit_cms.php?cid=<?php  echo $row1[cms_id]?>&mode=del" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../images/delete.png" alt="delete"></a></li>
            <?php	}
					}
					else
					{ 
						if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') 
						{?>
							<li><a title="edit" href="cms_add.php?mode=edit&cid=<?php  echo $row1[cms_id]?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
							<a href="cms_add.php?mode=edit&cid=<?php  echo $row1[cms_id]?>" > Edit</a>
            <?php	}
						if($_SESSION[user_type]=='approver') 
						{ ?>
							<li><a title="View" href="cms_add.php?mode=view&cid=<?php  echo $row1[cms_id]?>" ><img alt="View" src="../../images/view.png"></a></li>
            <?php	}
					}
				}
				else 
				{ ?>
				 ------
            <?php 
				} ?>
				</ul>
          </td>
        </tr>
        <?php 



             $query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_count = '$row1[cms_id]' ORDER BY cms_id ASC"; 
                if(!($results = mysqli_query($connection,$query))) { echo "Query - " . $query . "<br />Error - " . mysqli_errno($connection); }
                if(mysqli_num_rows($results) > 0) {
				$count4 = 1;
					while($rows = mysqli_fetch_array($results)){
					
				$time = explode(":", $rows[cms_time]);
				if($time[0] > 12) {
					$hour = $time[0] % 12;
					$time = $hour . ":". $time[1] . ":" . $time[2]. " PM";
				}
				else {
					$time =  $rows[cms_time] . " AM";
				}
		?>
        <tr >
          <td align="left" class="tbborder"><strong>
            <?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;V." . $count4++ ;?>
            </strong></td>
          <td class="tbborder"  align="left" width="15%" colspan=2><?php  echo stripslashes($rows[cms_title]). " -- " . dateformate($rows[cms_date]) . " -- " . $time  ?></td>
          <!--           <td class="tbborder"  align="left"><?php echo $path1.$rows[cms_sitelink];?></td> -->
          <td class="tbborder"  align="left"><?php echo dateformate($rows[cms_date]);?></td>
          <td class="tbborder"  align="left"><?php //echo $row_category[cms_time]; 
				echo $time
			?></td>
          <td class="tbborder"  align="left"><strong><?php echo $rows['cms_featured'];?></strong></td>
          <td class="center">
			<ul class="actions">
		  <?php  
				if($rows[cms_subtype]!="Main Pages")
				{
					if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') 
					{?>
						<li><a title="edit" href="cms_add.php?mode=edit&cid=<?php  echo $rows[cms_id]?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
            <?	}
					if($_SESSION[user_type]=='approver') 
					{ ?>
						<li><a title="View" href="cms_add.php?mode=view&cid=<?php  echo $rows[cms_id]?>" ><img alt="View" src="../../images/view.png"></a></li>
            <?	}
					if($_SESSION[user_type]!='moderator') 
					{ ?>
						<li><a href="submit_cms.php?cid=<?php  echo $rows[cms_id]?>&mode=del" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../images/delete.png" alt="delete"></a></li>
            <?php 
					}
				}
				else
				{ 
					if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') 
					{?>
						<li><a title="edit" href="cms_add.php?mode=edit&cid=<?php  echo $rows[cms_id]?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
            <?php 
					} 
					if($_SESSION[user_type]=='approver') 
					{ ?>
						<li><a title="View" href="cms_add.php?mode=view&cid=<?php  echo $rows[cms_id]?>" ><img alt="View" src="../../images/view.png"></a></li>
                 
			<?	}
				}?>
				</ul>
				</td>
        </tr>
        <?php 					
					}

				}

			$count2 = 0;
			
			while($row2=mysqli_fetch_array($result2)){ 
			$count2++;
			$query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_subtype = '$row2[cms_id]' AND cms_count = '0' ORDER BY cms_title,cms_id";
			if(!($result3=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
		?>
        <tr >
          <td align="left" class="tbborder"><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $count . "." . $count1 . "." . $count2;?></td>
          <td class="tbborder"  align="left" width="15%"><?php  echo $row2[cms_title]?></td>
          <td class="tbborder"  align="left"><?php echo $path1.$row2[cms_sitelink];?></td>
          <td class="tbborder"  align="left"><?php echo dateformate($row2[cms_date]);?></td>
          <td class="tbborder"  align="left"><?php //echo $row_category[cms_time]; 
				$time = explode(":", $row2[cms_time]);
				if($time[0] > 12) {
					$hour = $time[0] % 12;
					echo $hour . ":". $time[1] . ":" . $time[2]. " PM";
				}
				else {
					echo $row2[cms_time] . " AM";
				}
			?>
          </td>
          <td class="tbborder"  align="left"><strong><?php echo $row2['cms_featured'];?></strong></td>
          <td class="center">
			<ul class="actions"><?php 
				if(mysqli_num_rows($result3)==0) 
				{
					if($row2[cms_subtype]!="Main Pages")
					{
						if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') 
						{?>
							<li><a title="edit" href="cms_add.php?mode=edit&cid=<?php  echo $row2[cms_id]?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
            <?php	}
						if($_SESSION[user_type]=='approver') 
						{ ?>
							<li><a title="View" href="cms_add.php?mode=view&cid=<?php  echo $row2[cms_id]?>" ><img alt="View" src="../../images/view.png"></a></li>
            <?		}
						if($_SESSION[user_type]!='moderator') 
						{ ?>
							<li><a href="submit_cms.php?cid=<?php  echo $row2[cms_id]?>&mode=del" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../images/delete.png" alt="delete"></a></li>
            <?php	}
					}
					else
					{
						if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') 
						{?>
							<li><a title="edit" href="cms_add.php?mode=edit&cid=<?php  echo $row2[cms_id]?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
            <?php	}
						if($_SESSION[user_type]=='approver') 
						{ ?>
							<li><a title="View" href="cms_add.php?mode=view&cid=<?php  echo $row2[cms_id]?>" ><img alt="View" src="../../images/view.png"></a></li>			
			<?		} 
					}
				} 
				else 
				{ ?>
					-----
            <?php 
				} ?>
				</ul>
          </td>
        </tr>
		<?php 
             $query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_count = '$row2[cms_id]' ORDER BY cms_id ASC"; 
                if(!($results11 = mysqli_query($connection,$query))) { echo "Query - " . $query . "<br />Error - " . mysqli_errno($connection); }
                if(mysqli_num_rows($results11) > 0) {
				$count11 = 1;
					while($rows11 = mysqli_fetch_array($results11)){
					
				$time = explode(":", $rows11[cms_time]);
				if($time[0] > 12) {
					$hour = $time[0] % 12;
					$time = $hour . ":". $time[1] . ":" . $time[2]. " PM";
				}
				else {
					$time =  $rows11[cms_time] . " AM";
				}
		?>
        <tr >
          <td align="left" class="tbborder"><strong>
            <?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;V." . $count11++ ;?>
            </strong></td>
          <td class="tbborder"  align="left" width="15%" colspan=2><?php  echo stripslashes($rows11[cms_title]). " -- " . dateformate($rows11[cms_date]) . " -- " . $time  ?></td>
          <!--           <td class="tbborder"  align="left"><?php echo $path1.$rows[cms_sitelink];?></td> -->
          <td class="tbborder"  align="left"><?php echo dateformate($rows11[cms_date]);?></td>
          <td class="tbborder"  align="left"><?php //echo $row_category[cms_time]; 
				echo $time
			?></td>
          <td class="tbborder"  align="left"><strong><?php echo $rows11['cms_featured'];?></strong></td>
          <td class="center">
			<ul class="actions">
		  <?php  
				if($rows11[cms_subtype]!="Main Pages")
				{
					if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') 
					{?>
						<li><a title="edit" href="cms_add.php?mode=edit&cid=<?php  echo $rows11[cms_id]?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
            <?	}
					if($_SESSION[user_type]=='approver') 
					{ ?>
						<li><a title="View" href="cms_add.php?mode=view&cid=<?php  echo $rows11[cms_id]?>" ><img alt="View" src="../../images/view.png"></a></li>
            <?	}
					if($_SESSION[user_type]!='moderator') 
					{ ?>
						<li><a href="submit_cms.php?cid=<?php  echo $rows11[cms_id]?>&mode=del" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../images/delete.png" alt="delete"></a></li>
            <?php 
					} 
				}
				else
				{ 
					if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') 
					{?>
						<li><a title="edit" href="cms_add.php?mode=edit&cid=<?php  echo $rows11[cms_id]?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
            <?php 
					} 
					if($_SESSION[user_type]=='approver') 
					{ ?>
						<li><a title="View" href="cms_add.php?mode=view&cid=<?php  echo $rows11[cms_id]?>" ><img alt="View" src="../../images/view.png"></a></li>
			<?	}
				}?>
				</ul>
			</td>
        </tr>
        <?php 					
					}
				}
        	$count3 = 0;
			
			while($row3=mysqli_fetch_array($result3)){ 
			$count3++;
		?>
        <tr >
          <td align="left" class="tbborder"><?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $count . "." . $count1 . "." . $count2 . "." . $count3;?></td>
          <td class="tbborder"  align="left" width="15%"><?php  echo $row3[cms_title]?></td>
          <td class="tbborder"  align="left"><?php echo $path1.$row3[cms_sitelink];?></td>
          <td class="tbborder"  align="left"><?php echo dateformate($row3[cms_date]);?></td>
          <td class="tbborder"  align="left"><?php //echo $row_category[cms_time]; 
				$time = explode(":", $row3[cms_time]);
				if($time[0] > 12) {
					$hour = $time[0] % 12;
					echo $hour . ":". $time[1] . ":" . $time[2]. " PM";
				}
				else {
					echo $row3[cms_time] . " AM";
				}
			?></td>
          <td class="tbborder"  align="left"><strong><?php echo $row3['cms_featured'];?></strong></td>
          <td class="center">
			<ul class="actions">
		  <?php  
			if($row3[cms_subtype]!="Main Pages")
			{ 
				if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') 
				{?>
					<li><a title="edit" href="cms_add.php?mode=edit&cid=<?php  echo $row3[cms_id]?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
            <? }
				if($_SESSION[user_type]=='approver') 
				{?>
					<li><a title="View" href="cms_add.php?mode=view&cid=<?php  echo $row3[cms_id]?>" ><img alt="View" src="../../images/view.png"></a></li>
            <? } 
				if($_SESSION[user_type]!='moderator') 
				{ ?>
					<li><a href="submit_cms.php?cid=<?php  echo $row3[cms_id]?>&mode=del" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../images/delete.png" alt="delete"></a></li>
            <?php 
				} 
			}
			else
			{
				if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') 
				{?>
					<li><a title="edit" href="cms_add.php?mode=edit&cid=<?php  echo $row3[cms_id]?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
            <?php 
				}
				if($_SESSION[user_type]=='approver') 
				{ ?>
					<li><a title="View" href="cms_add.php?mode=view&cid=<?php  echo $row3[cms_id]?>" ><img alt="View" src="../../images/view.png"></a></li>
			<? } 
			}?>
			</ul>
			</td>
        </tr>
		<?php 
             $query = "SELECT * FROM " . $tblpref . "content_master WHERE cms_type = 'mcms' AND cms_count = '$row2[cms_id]' ORDER BY cms_id ASC"; 
                if(!($results12 = mysqli_query($connection,$query))) { echo "Query - " . $query . "<br />Error - " . mysqli_errno($connection); }
                if(mysqli_num_rows($results12) > 0) {
				$count12 = 1;
					while($rows12 = mysqli_fetch_array($results12)){
					
				$time = explode(":", $rows12[cms_time]);
				if($time[0] > 12) {
					$hour = $time[0] % 12;
					$time = $hour . ":". $time[1] . ":" . $time[2]. " PM";
				}
				else {
					$time =  $rows12[cms_time] . " AM";
				}
		?>
        <tr >
          <td align="left" class="tbborder"><strong>
            <?php  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;V." . $count12++ ;?>
            </strong></td>
          <td class="tbborder"  align="left" width="15%" colspan=2><?php  echo stripslashes($rows12[cms_title]). " -- " . dateformate($rows12[cms_date]) . " -- " . $time  ?></td>
          <!--           <td class="tbborder"  align="left"><?php echo $path1.$rows[cms_sitelink];?></td> -->
          <td class="tbborder"  align="left"><?php echo dateformate($rows12[cms_date]);?></td>
          <td class="tbborder"  align="left"><?php //echo $row_category[cms_time]; 
				echo $time
			?></td>
          <td class="tbborder"  align="left"><strong><?php echo $rows12['cms_featured'];?></strong></td>
          <td class="center">
			<ul class="actions">
		  <?php  
				if($rows12[cms_subtype]!="Main Pages")
				{
					if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') 
					{?>
						<li><a title="edit" href="cms_add.php?mode=edit&cid=<?php  echo $rows12[cms_id]?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
					<? 
					}  
					if($_SESSION[user_type]=='approver') 
					{ ?>
						<li><a title="View" href="cms_add.php?mode=view&cid=<?php  echo $rows12[cms_id]?>" ><img alt="View" src="../../images/view.png"></a></li>
				<? }
					if($_SESSION[user_type]!='moderator') 
					{ ?>
						<li><a href="submit_cms.php?cid=<?php  echo $rows12[cms_id]?>&mode=del" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../images/delete.png" alt="delete"></a></li>
            <?php 
					} 
				}
				else
				{ 
					if($_SESSION[user_type]=='moderator' || $_SESSION[user_type]=='superadmin') 
					{?>
						<li><a title="edit" href="cms_add.php?mode=edit&cid=<?php  echo $rows12[cms_id]?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
            <?php 
					} 
					if($_SESSION[user_type]=='approver') 
					{ ?>
						<li><a title="View" href="cms_add.php?mode=view&cid=<?php  echo $rows12[cms_id]?>" ><img alt="View" src="../../images/view.png"></a></li>                 
			<?	}
				}?>
				</ul>
				</td>
			</tr>
        <?php 					
					}

				}
		}
			} 
			}
			}
			} ?>
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