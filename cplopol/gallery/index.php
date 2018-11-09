<?php
@session_start();
include("../../common/app_function.php");
include("../../common/config.php");

if($_SESSION[username]=="")
{
	displayerror("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Login,../index.php", 0);
	exit();
}
$condition2=" ORDER BY cat_id DESC";	
if ($_GET[sorton]!="")
{
 $condition2=" ORDER BY ". $_GET[sorton]. " ". $_GET[sortby];
}


$txttitle = $_GET[txttitle];
if($txttitle!="")
	$condition[]=sprintf("cat_title LIKE '%s%s%s'", '%',$txttitle,'%');

$txtcat = $_GET[txtcat];
if($txtcat!="")
	$condition[]=sprintf("cms_news_img_4 LIKE '%s%s%s'", '%',$txtcat,'%');

$type = $_GET[type];
if($type=="2" )
	$condition[]=sprintf("cms_archived='yes'", $type);

$type = $_GET[type];
if($type=="3" )
	$condition[]=sprintf("cms_featured='yes'", $type);


$condition[]=sprintf("cat_type='album'");
if(is_array($condition))
{
	$condition=" WHERE " . implode(" AND ",$condition);
}

$que="SELECT * FROM ".$tblpref."category $condition $condition2"; 

$curr_query="sorton=".$_GET[sorton]."&sortby=".$_GET[sortby]."&txtname=".$txtname;
$pagesize=10;
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

admin_header('../../','Album List',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
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
			posY: 190
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
		<h1 class="ico-search">Search</h1>
    </div>
    <div class="padtb">
      <form name="frmcms" method="GET" action="index.php">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr  class="alt-row">
				<td width="20%" align="right">Title :</td>
				<td width="25%">
						<input type="text" name="txttitle" id="txttitle" class="slct" value="<?=$_GET[txttitle]?>">
				</td>
		</tr>
		<tr >
            <td colspan="2" align="center">
              <input type="submit" class="button" value="Search" name="submit">
            </td>
		</tr>
        </table>
      </form>
    </div>
</div>    
<?php $flag=$_REQUEST[flag];?>
<?php if($rowCount==0){?>
<p align="center" class="error">No Records found.</p>
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
<div class="gap"></div>
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt"><a href="../home.php"><img src="../../images/back32.png" alt="Back" title="Back"/></a></div>

<div class="clear"></div>
<div class="gap"></div>
<div class="box">
    <div class="hdr">
		<h1 class="ico"><img src="icon/icon.png" alt="">Album List</h1>
        <div class="addnew">
						<a  href="add.php" class="add">Add New</a>
                        <!-- <a  href="#" class="import">Import</a>
                        <a  href="#" class="export">Export</a>  -->
		</div>
	</div>   
      
    <div class="padtb">
  <!--   <p align="right"></p> -->
	<p align="right"><?php echo $show_status; ?> </p>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<thead>
	  <tr>
		<th class="minth">Sr. No.</th>
		<th width="60%">Title</th>
		<th class="minth">Action</th>
	  </tr>
	</thead>
	<tbody>
	<?php 
		$clcnt=0;
		
		while($row_alb=mysqli_fetch_array($page_res))
		{ 
			$id=$row_alb[cat_id];
			$count++;
			if($clcnt%2==0){$class="even";}else{$class="";}

			$clcnt++;
		?>
	
		<tr class="<?php echo $class; ?>">
		<td><b><?php echo $count; ?></b></td>
		<td><?php echo stripslashes(ucfirst($row_alb[cat_title])); ?></td>
		<td class="center">
		<ul class="actions">
			<li><a title="edit" href="add.php?mode=edit&id=<?php echo $id; ?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
			<li><a href="submit.php?id=<?php echo $id; ?>&mode=del" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../images/delete.png" alt="delete"></a></li>
			<li><a href="home.php?id=<?php echo $id; ?>" ><img src="../../images/image.png" alt="Image Gallery"></a></li>
		</ul></td>
	</tr>
  </tbody>  
<?php  } ?>
</table>
<div class="pagination">
<!-- pagination underneath the box's content -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" align="center" style=" color:#000000; font-size:14px; font-weight:bold;"><div id="pageNavPosition"><?php echo $show_pagination;  ?></div></td>
  </tr>
</table>			
</div>
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</div>
<?php admin_footer();?>