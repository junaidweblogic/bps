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
	$autoresp = $_POST['autoresp'];
	for($k=0;$k<count($autoresp);$k++)
	{
		$default = $autoresp[$k];
	}
	$query = "UPDATE " . $tblpref . "autoresponders SET 
		a_default 	=	'$default',
		a_email1 	=	'$txtemail1',
		a_email2	=	'$txtemail2',
		a_email3	=	'$txtemail3' WHERE a_id = '3'";
	if(!($result=mysqli_query($connection,$query))){ echo "Query:- " . $query. "<br>Error:-  " . mysqli_connect_errno(); exit;}	
endif;

$query="select * from ".$tblpref."autoresponders WHERE a_id = '3'";  //Query for search dropdown
if(!($result=mysqli_query($connection,$query))){ echo "Query:- " . $query. "<br>Error:-  " . mysqli_connect_errno(); exit;}
$emails = mysqli_fetch_object($result);

if ($_GET[sorton]!="")  
{	
	$condition2=" ORDER BY ". $_GET[sorton]. " ". $_GET[sortby]; 	
}
if($txttype!="")
{
	$condition[]="ap_name='$txttype'"; 								
}


if(is_array($condition))
{	
	$condition=" WHERE " . implode(" AND ",$condition);				
}

$que="SELECT * FROM ".$tblpref."askpolice $condition $condition2  ORDER BY ap_id DESC"; 
$curr_query="sorton=".$_GET[sorton]."&sortby=".$_GET[sortby];
$pagesize=12;
$the_query  = pagination($que,$page,null,$curr_query,$pagesize);	
$real_string     = explode("~" , $the_query);
$que= $que.$cstr." LIMIT ". $real_string[0];
$show_status     = $real_string[2];
$show_pagination = $real_string[1];
if (!($page_res = mysqli_query($connection,$que))) 
{ echo "FOR QUERY: $strsql<BR>".mysqli_connect_errno(); 	exit;}
$rowCount = mysqli_num_rows($page_res);
$srnum=$real_string[0][0];
$srnum= $real_string[0];
$srnum=explode(",",$srnum);
$count=$srnum[0];

admin_header('../../','Ask the Police Report ',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
//admin_nav("../../");
?>

<div class="adminbody">

<div class="box smlsize">
    <div class="hdr">
		<h1 class="ico-autoemail">Set Autoresponders Emails</h1>
    </div>
    <div class="padtb">
		<FORM NAME="frmcms" METHOD="POST" ACTION="index.php">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="40%" align="right">Auto Responder 1:</td>
            <td width="50%">
              <input name="txtemail1" id="txtemail1" type="text" value="<?php echo $emails->a_email1;?>" class="inpt"/>
            </td>
			<td width="10%" align="right">
				<input type="radio" name="autoresp[]" value="<?php echo $emails->a_email1;?>" <?php if($emails->a_default == $emails->a_email1){echo 'checked';}?>>
			</td>
          </tr>
		  <tr>
            <td width="40%" align="right">Auto Responder 2 :</td>
            <td width="50%">
              <input name="txtemail2" id="txtemail2" type="text" value="<?php echo $emails->a_email2;?>" class="inpt"/>
            </td>
			<td width="10%" align="right">
				<input type="radio" name="autoresp[]" value="<?php echo $emails->a_email2;?>" <?php if($emails->a_default == $emails->a_email2){echo 'checked';}?>>
			</td>
          </tr>
		  <tr>
            <td width="40%" align="right">Auto Responder 3 :</td>
            <td width="50%">
              <input name="txtemail3" id="txtemail3" type="text" value="<?php echo $emails->a_email3;?>" class="inpt"/>
            </td>
			<td width="10%" align="right">
				<input type="radio" name="autoresp[]" value="<?php echo $emails->a_email3;?>" <?php if($emails->a_default == $emails->a_email3){echo 'checked';}?>>
			</td>
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
		<FORM NAME="frmcms" METHOD="POST" ACTION="index.php">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="40%" align="right">Person Name :</td>
            <td width="50%">
				<?$query="select * from ".$tblpref."askpolice where ap_name!=''"; 
					if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_connect_errno(); exit;}
					?>
					<select name="txttype" id="txttype" style="width:300px" onchange="empty(this.id);" class="inpt">
					<option value="">Please Select</option>			
					<?php  
					while($row=mysqli_fetch_array($result))
					{ ?>
					<option value="<?php  echo $row[ap_name]?>" <?php if($row[ap_name]==$txttype){?>selected <?php }?>><?php  echo $row[ap_name]?></option>
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
	$flag=$_GET[flag];
	if($rowCount==0)
	{ ?>
		<p align="center" class="error">No Record found.</p>
	<?php
	}
	if($flag=="edit")
	{ ?>
		<p align="center" class="error">Record is updated successfully.</p>
	<?php
	}
	if($flag=="add")
	{ ?>
		<p align="center" class="error">New record is added successfully.</p>
	<?php
	}
	if($flag=="send")
	{ ?>
		<p align="center" class="error">Your response has been sent.</p>
	<?php
	}
	if($flag=="del")
	{ ?>
		<p align="center" class="error">Record is deleted successfully.</p>
	<?php
	} ?>

<div class="gap"></div>
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="../home.php"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>
<div class="gap"></div>
<div class="box">
    <div class="hdr">
		<h1 class="ico"><img src="icon/icon.png" alt="">Ask the Police Report Management List</h1>
	</div>   
	
<div class="padtb">
  <!--   <p align="right"></p> -->
	<p align="right"><?=$show_status?> </p>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<thead>
	  <tr>
		<th class="minth">Sr. No.</th>
		<th width="20%">Person Name</th>
		<th width="20%">Email</th>
		<th width="15%">Tel No.</th>
		<th width="15%">Date</th>
		<th width="15%">IP Address</th>
		<th width="15%">Action</th>
	  </tr>
	</thead>
	<tbody>
	<?php 
		$clcnt=0;
		
		while($row_category=mysqli_fetch_array($page_res))
		{ 
		if($clcnt%2==0){$class="even";}else{$class="";}
		$clcnt++;
		$id=$row_category[ap_id];
		$count++; ?>
	
		<tr class="<?=$class?>">
		<td><b><?=$count?></b></td>
		<td><?=stripslashes($row_category[ap_name])?></td>
		<td><?=stripslashes($row_category[ap_email])?></td>
		<td><?=stripslashes($row_category[ap_tel])?></td>
		<td><? $date1 = explode(" ",$row_category[ap_date]); $fcdate =  dateformate($date1[0]); echo $fcdate." ".$date1[1];  ?></td>
		<td><?=$row_category[ap_ip]?></td>
		<td class="center">
		<ul class="actions">
			<li><a href="r_add.php?mode=edit&rid=<?=$id?>" <?php if($row_category[ap_status] == "New") : ?> style="color:#FF0000;" <?php endif; ?> title="status"><?=$row_category[ap_status]?></a></li>
			<li><a href="print_apreport.php?mode=print&id=<?=$id?>"><img alt="Print" src="../../images/print.png" title="Print"></a></li>
			<li><a href="r_add-email.php?mode=edit&rid=<?=$id?>"><img alt="Send Response" src="../../images/mail.png" title="Send Response"></a></li>
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

