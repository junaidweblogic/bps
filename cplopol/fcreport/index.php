<?
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}
$txtemail1=$_GET[txtemail1];
if($txtemail1 != "") :
	$default = $_GET['autoresp'];
	$query = "UPDATE " . $tblpref . "autoresponders SET 
		a_default 	=	'$default',
		a_email1 	=	'$txtemail1',
		a_email2	=	'$txtemail2',
		a_email3	=	'$txtemail3' WHERE a_id = '2'";
	if(!($result=mysqli_query($connection,$query))){ echo "Query:- " . $query. "<br>Error:-  " . mysqli_errno($connection); exit;}	
endif;

$query="select * from ".$tblpref."autoresponders WHERE a_id = '2'";  //Query for search dropdown
if(!($result=mysqli_query($connection,$query))){ echo "Query:- " . $query. "<br>Error:-  " . mysqli_errno($connection); exit;}
$emails = mysqli_fetch_object($result);

$query="select * from ".$tblpref."report ORDER BY r_id ASC";
if(!($result=mysqli_query($connection,$query))){ echo "Query:- " . $query. "<br>Error:-  " . mysqli_errno($connection); exit;}

if ($_GET[sorton]!="")  
{	
	$condition2=" ORDER BY ". $_GET[sorton]. " ". $_GET[sortby]; 	
}
if($txtname!="")
{
	$condition[]="fc_id='$txtname'"; 								
}
if($txttype!="")
{
	$condition[]="fc_report_type='$txttype'"; 								
}
$condition[]="fc_category='FC'";
if(is_array($condition))
{	
	$condition=" WHERE " . implode(" AND ",$condition);				
}

$que="SELECT * FROM ".$tblpref."feedback_commend $condition $condition2  ORDER BY fc_id DESC"; 
$curr_query="txttype=".$_GET[txttype]."&sortby=".$_GET[sortby];
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

admin_header('../../','Feedback & Commendation List',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
//admin_nav("../../");
?>
<!--body start -->
<div class="adminbody">

<div class="box smlsize">
    <div class="hdr">
		<h1 class="ico-search">Set Autoresponders Emails</h1>
    </div>
    <div class="padtb">
      <form name="frmcms" method="GET" action="index.php">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="40%" align="right">Auto Responder 1:</td>
            <td width="60%">
              <input type="text" name="txtemail1" id="txtemail1" class="inpt" value="<?php echo $emails->a_email1;?>" />
            </td>
			<td width="20%"><input type="radio" name="autoresp" value="<?php echo $emails->a_email1;?>" <?php if($emails->a_default == $emails->a_email1){echo 'checked';}?>></td>
          </tr>
		  <tr>
            <td width="30%" align="right">Auto Responder 2:</td>
            <td width="50%">
			  <input type="text" name="txtemail2" id="txtemail2" class="inpt" value="<?php echo $emails->a_email2;?>" />
            </td>
			<td width="20%"><input type="radio" name="autoresp" value="<?php echo $emails->a_email2;?>" <?php if($emails->a_default == $emails->a_email2){echo 'checked';}?>></td>
          </tr>
		  <tr>
            <td width="40%" align="right">Auto Responder 3:</td>
            <td width="60%">
			  <input type="text" name="txtemail3" id="txtemail3" class="inpt" value="<?php echo $emails->a_email3;?>" />
            </td>
			<td width="20%"><input type="radio" name="autoresp" value="<?php echo $emails->a_email3;?>" <?php if($emails->a_default == $emails->a_email3){echo 'checked';}?>></td>
          </tr>
		  
		  <tr >
            <td align="right">&nbsp;</td>
            <td>
              <input type="submit" class="button" value="Set Email" name="submit">
            </td>
          </tr>
        </table>
      </form>
    </div>
</div>    

<div class="box smlsize">
    <div class="hdr">
		<h1 class="ico-search">Search</h1>
    </div>
    <div class="padtb">
      <form name="frmcms" method="GET" action="index.php">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="40%" align="right">Type of Report</td>
            <td width="60%">
			  <select name="txttype" id="txttype"  class="inpt" onchange="empty(this.id);">
					<option value="">Please Select</option>	
					<option value="Commendation" <?php if($_GET[txttype]=="Commendation") { ?> selected <?php }?>>Commendation</option>	
					<option value="Complaint" <?php if($_GET[txttype]=="Complaint") { ?> selected <?php }?>>Complaint</option>	
					<option value="Feedback" <?php if($_GET[txttype]=="Feedback") { ?> selected <?php }?>>Feedback</option>	
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
<div class="frt"><a href="../home.php"><img src="../../images/back32.png" alt="back" title="back"/></a></div>
<div class="gap"></div>
<div class="box">
    <div class="hdr">
		<h1 class="ico-cur">Feedback & Commendation Report List</h1>
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
		<th width="15%">Type of report</th>
		<th width="15%">Reporting on</th>
		<th width="15%">Date</th>
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
		$id=$row_country[fc_id];
		$count++;			
		?>
	
		<tr class="<?=$class?>">
		<td><b><?=$count?></b></td>
		<td><?=stripslashes($row_country[fc_name])?></td>
		<td><?=stripslashes($row_country[fc_email])?></td>
		<td><?=stripslashes($row_country[fc_report_type])?></td>
		<td><?=stripslashes($row_country[fc_reporting_on])?></td>
		<td><? $date1 = explode(" ",$row_country[fc_date]); $fcdate =  dateformate($date1[0]); echo $fcdate." ".$date1[1]; echo $row_country[fc_timeset]; ?></td>
		<td class="center">
		<ul class="actions">			
			<li><a href="r_add.php?mode=edit&rid=<?=$id?>" <?php if($row_country[fc_status] == "New") : ?> style="color:#FF0000;" <?php endif; ?> ><?=$row_country[fc_status]?></a></li>		
			<li><a title="Print" href="print_fcreport.php?mode=print&id=<?=$id?>" ><img alt="Print" src="../../images/print.png"></a></li>
			<li><a title="Send Response" href="r_add-email.php?mode=edit&rid=<?=$id?>" ><img alt="Send Response" src="../../images/mail.png"></a></li>
		</ul></td>
	</tr>
<? } ?>
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
