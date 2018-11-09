<?
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}
if($txtemails != "") :
	echo $default = $_REQUEST['autoresp'];
	
	$query = "UPDATE " . $tblpref . "autoresponders SET 
		a_default 	=	'$default',
		a_email1 	=	'$txtemail1',
		a_email2	=	'$txtemail2',
		a_email3	=	'$txtemail3' WHERE a_id = '5'";
	if(!($result=mysqli_query($connection,$query))){ echo "Query:- " . $query. "<br>Error:-  " . mysqli_errno($connection); exit;}	
endif;

$query="select * from ".$tblpref."autoresponders WHERE a_id = '5'";  //Query for search dropdown
if(!($result=mysqli_query($connection,$query))){ echo "Query:- " . $query. "<br>Error:-  " . mysqli_errno($connection); exit;}
$emails = mysqli_fetch_object($result);

if ($_GET[sorton]!="")  
{	
	$condition2=" ORDER BY ". $_GET[sorton]. " ". $_GET[sortby]; 	
}
if($txttype!="")
{
	$condition[]="sa_name='$txttype'"; 								
}

if(is_array($condition))
{	
	$condition=" WHERE " . implode(" AND ",$condition);				
}

$que="SELECT * FROM ".$tblpref."susp_alleg $condition $condition2  ORDER BY sa_id DESC"; 
$curr_query="txttype=".$_GET[txttype]."&sortby=".$_GET[sortby];
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
$srnum= $real_string[0];
$srnum=explode(",",$srnum);
$count=$srnum[0];

admin_header('../../','Crime Report/Incident Management',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);

?>

<!--body start -->
<div class="adminbody">

<div class="box smlsize">
    <div class="hdr">
		<h1 class="ico-search">Set Autoresponders Emails</h1>
    </div>
    <div class="padtb">
      <form name="frmcms" method="POST" action="index.php">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="30%" align="right">Auto Responder 1:</td>
            <td width="50%">
			  <input type="text" name="txtemail1" id="txtemail1" class="inpt" value="<?php echo $emails->a_email1;?>" />
            </td>
			<td width="30%" align="center"><input type="radio" name="autoresp" value="<?php echo $emails->a_email1;?>" <?php if($emails->a_default == $emails->a_email1){echo 'checked';}?>></td>
          </tr>
		  <tr>
            <td width="30%" align="right">Auto Responder 2:</td>
            <td width="50%">
			  <input type="text" name="txtemail2" id="txtemail2" class="inpt" value="<?php echo $emails->a_email2;?>" />
            </td>
			<td width="30%" align="center"><input type="radio" name="autoresp" value="<?php echo $emails->a_email2;?>" <?php if($emails->a_default == $emails->a_email2){echo 'checked';}?>></td>
          </tr>
		  <tr>
            <td width="30%" align="right">Auto Responder 3:</td>
            <td width="50%">
			  <input type="text" name="txtemail3" id="txtemail3" class="inpt" value="<?php echo $emails->a_email3;?>" />
            </td>
			<td width="30%" align="center"><input type="radio" name="autoresp" value="<?php echo $emails->a_email3;?>" <?php if($emails->a_default == $emails->a_email3){echo 'checked';}?>></td>
			<input type="hidden" name="txtemails" value="set">
          </tr>
		  
		  <tr >
            <td align="right">&nbsp;</td>
            <td>
              <input type="submit" class="button" value="Set Emails" name="submit">
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
            <td width="40%" align="right">Person Name: :</td>
            <td width="60%">
			  <?$query="select * from ".$tblpref."susp_alleg where sa_name!=''"; 
					if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
					?>
					<select name="txttype" id="txttype" class="inpt" onchange="empty(this.id);">
					<option value="">Please Select</option>			
					<?php  
					while($row=mysqli_fetch_array($result))
					{ ?>
					<option value="<?php  echo $row[sa_name]?>" <?php if($row[sa_name]==$txttype){?> selected <?php }?>><?php  echo $row[sa_name]?></option>
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
	<p align="center" class="error">Record is already exits.</p>
<?php
}
if($flag=="del")
{ ?>
	<p align="center" class="error">Your response has been sent.</p>
<?php
} ?>		
<div class="gap"></div>
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt"><a href="../home.php"><img src="../../images/back32.png" alt="Back" title="Back"/></a></div>
<div class="gap"></div>
<div class="box">
    <div class="hdr">
		<h1 class="ico"><img src="icon/icon.png" alt="">Report Crime/ Incident  List</h1>
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
		$id=$row_country[sa_id];
		$count++;	
		?>
	
		<tr class="<?=$class?>">
		<td><b><?=$count?></b></td>
		<td><?=stripslashes($row_country[sa_name])?></td>
		<td><?=stripslashes($row_country[sa_email])?></td>
		<td><?=stripslashes($row_country[sa_tel])?></td>
		<td>
			<? 
				$date1 = explode(" ",$row_country[sa_datetime]); 
				$fcdate =  dateformate($date1[0]); 
				echo $fcdate." ".$date1[1];
			?>
		</td>
		<td><?=stripslashes($row_country[sa_ip])?></td>
		<td class="center">
		<ul class="actions">
			<li><a href="r_add.php?mode=edit&rid=<?=$id?>" <?php if($row_country[sa_status] == "New") : ?> style="color:#FF0000;" <?php endif; ?> ><?=$row_country[sa_status]?></a></li>
			<li><a title="Print" href="print_sareport.php?mode=print&id=<?=$id?>" ><img alt="Print" src="../../images/print.png"></a></li>
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
