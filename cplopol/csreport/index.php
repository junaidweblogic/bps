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
if($txttype!="")
{
	$condition[]="cs_name='$txttype'"; 								
}

if(is_array($condition))
{	
	$condition=" WHERE " . implode(" AND ",$condition);				
}

$que="SELECT * FROM ".$tblpref."cust_satisfaction $condition $condition2 ORDER BY cs_id DESC"; 
$curr_query="sorton=".$_GET[sorton]."&sortby=".$_GET[sortby];
$pagesize=12;
$the_query  = pagination($que,$page,null,$curr_query,$pagesize);	
$real_string     = explode("~" , $the_query);
$que= $que.$cstr." LIMIT ". $real_string[0];
$show_status     = $real_string[2];
$show_pagination = $real_string[1];
if (!($page_res = mysqli_query($connection,$que))) 
{ echo "FOR QUERY: $strsql<BR>".mysqli_errno($connection); 	exit;}
$rowCount = mysqli_num_rows($page_res);
$srnum=$real_string[0][0];
$srnum= $real_string[0];
$srnum=explode(",",$srnum);
$count=$srnum[0];

admin_header('../../','Customer Satisfaction Report ',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
//admin_nav("../../");
?>

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
            <td width="40%" align="right">Person Name :</td>
            <td width="60%">
              <input name="cnt_name" type="text" value="<?=$cnt_name?>" class="inpt"/>
				<?php
					$query="select * from ".$tblpref."cust_satisfaction WHERE cs_name!=''"; 
					if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
					?>
					<select name="txttype" id="txttype" class="inpt"onchange="empty(this.id);">
					<option value="">Please Select</option>			
					<?php  
					while($row=mysqli_fetch_array($result))
					{ ?>
					<option value="<?php  echo $row[cs_name]?>" <?php if($row[cs_name]==$txttype){?>selected <?php }?>><?php  echo $row[cs_name]?></option>
					<?php } ?>
					</select>
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
if($flag=="send")
{ ?>
	<p align="center" class="error">Your response has been sent.</p>
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
		<h1 class="ico-cur">Customer Satisfaction Report List</h1>
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
	<thead>
	  <tr>
		<th class="minth">Sr. No.</th>
		<th width="20%">Person Name</th>
		<th width="15%">Email</th>
		<th width="15%">Tel No.</th>
		<th width="15%">Date</th>
		<th width="15%">IP Address</th>
		<th class="minth">Action</th>
	  </tr>
	</thead>
	<tbody>
	<?php 
		$clcnt=0;
		
		while($row_country=mysqli_fetch_array($page_res))
		{ 
		if($clcnt%2==0){$class="even";}else{$class="";}
		$clcnt++;
		$id=$row_country[cs_id];
		$count++;
			
		?>
	
		<tr class="<?=$class?>">
		<td><b><?=$count?></b></td>
		<td><?=stripslashes($row_country[cs_name])?></td>
		<td><?=stripslashes($row_country[cs_email])?></td>
		<td><?=stripslashes($row_country[cs_tel])?></td>
		<td><? $date1 = explode(" ",$row_country[cs_date]); $fcdate =  dateformate($date1[0]); echo $fcdate." ".$date1[1];  ?></td>
		<td><?=$row_country[cs_ip]?></td>
		<td class="center">
		<ul class="actions">
			<li><a href="r_add.php?mode=edit&rid=<?=$id?>" <?php if($row_country[cs_status] == "New") : ?> style="color:#FF0000;" <?php endif; ?> ><?=$row_country[cs_status]?></a></li>
			<li><a title="edit" href="print_csreport.php?mode=print&id=<?=$id?>" ><img alt="print" src="../../images/print.png"></a></li>
		</ul></td>
	</tr>
	
  
  </tbody>  
  <!-- <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td class="center">&nbsp;</td>
  </tr> -->
<? } ?>
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