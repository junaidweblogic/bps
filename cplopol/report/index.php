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
	$default = $_REQUEST['autoresp'];
	
	$query = "UPDATE " . $tblpref . "autoresponders SET 
		a_default 	=	'$default',
		a_email1 	=	'$txtemail1',
		a_email2	=	'$txtemail2',
		a_email3	=	'$txtemail3' WHERE a_id = '1'";
	if(!($result=mysqli_query($connection,$query))){ echo "Query:- " . $query. "<br>Error:-  " . mysqli_errno($connection); exit;}	
endif;

$query="select * from ".$tblpref."autoresponders WHERE a_id = '1'";  //Query for search dropdown
if(!($result=mysqli_query($connection,$query))){ echo "Query:- " . $query. "<br>Error:-  " . mysqli_errno($connection); exit;}
$emails = mysqli_fetch_object($result);


/* $query="select * from ".$tblpref."report ORDER BY r_id ASC";  //Query for search dropdown
if(!($result=mysqli_query($connection,$query))){ echo "Query:- " . $query. "<br>Error:-  " . mysqli_errno($connection); exit;} */

if ($_GET[sorton]!="")  
{	
	$condition2=" ORDER BY ". $_GET[sorton]. " ". $_GET[sortby]; 	
}
if($_REQUEST[txtname]!="")	
{	
	$condition[]="r_name='$_REQUEST[txtname]'"; 			
}
if($_REQUEST[txttype]!="")		{	$condition[]="r_type='$_REQUEST[txttype]'"; 			}
if(is_array($condition)){	$condition =" WHERE " . implode(" AND ",$condition);				}


$que="SELECT * FROM ".$tblpref."report $condition $condition2  ORDER BY r_id DESC"; 
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
$srnum= $real_string[0];//--this is used to the next page no so that the srno at page comes  								in sequence
$srnum=explode(",",$srnum);
$count=$srnum[0];

admin_header('../../','Crime Report ',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
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
            <td width="30%" align="right">Auto Responder 1 :</td>
            <td width="50%">
				<input type="text" name="txtemail1" id="txtemail1" class="inpt" value="<?php echo $emails->a_email1;?>" />
            </td>
			<td width="20%" align="center"><input type="radio" name="autoresp" value="<?php echo $emails->a_email1;?>" <?php if($emails->a_default == $emails->a_email1){echo 'checked';}?>></td>
          </tr>
		  <tr>
            <td width="30%" align="right">Auto Responder 2 :</td>
            <td width="50%">
				<input type="text" name="txtemail2" id="txtemail2" class="inpt" value="<?php echo $emails->a_email2;?>" />
            </td>
			<td width="20%" align="center"><input type="radio" name="autoresp" value="<?php echo $emails->a_email2;?>" <?php if($emails->a_default == $emails->a_email2){echo 'checked';}?>></td>
          </tr>
		  <tr>
            <td width="30%" align="right">Auto Responder 3 :</td>
            <td width="50%">
				<input type="text" name="txtemail3" id="txtemail3" class="inpt" value="<?php echo $emails->a_email3;?>" />
            </td>
			<td width="20%" align="center"><input type="radio" name="autoresp" value="<?php echo $emails->a_email3;?>" <?php if($emails->a_default == $emails->a_email3){echo 'checked';}?>></td>
			<input type="hidden" name="txtemails" value="set">
          </tr>
		  
		  
		  <tr >
            <td align="right">&nbsp;</td>
            <td colspan="2">
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
      <form name="frmcms" method="POST" action="index.php">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="40%" align="right">Crime Type: :</td>
            <td width="60%">
              			  <?$query="select * from ".$tblpref."category WHERE cat_type = 'crime' order by cat_id"; 
					if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
					?>
					<select name="txttype" id="txttype"  onchange="empty(this.id);"  class="inpt">
					<option value="">Please Select</option>			
					<?php  while($row=mysqli_fetch_array($result))
					{?>
					<option value="<?php  echo $row[cat_title]?>" <?php if($row[cat_title]==$txttype){?>selected <?php }?>><?php  echo $row[cat_title]?> </option>
					<?php }?>
					</select>
            </td>
          </tr>
		  <tr>
            <td width="40%" align="right">Crime Location: :</td>
            <td width="60%">
				<select NAME="txtname" class="inpt">
						<option value="">Please Select</option>			
						<? 
						$querycat="select DISTINCT(r_name) from ".$tblpref."report ORDER BY r_id DESC"; 
						if(!($resultcat=mysqli_query($connection,$querycat))){ echo "Query:- " . $querycat. "<br>Error:-  " . mysqli_errno($connection); exit;}
						while($rowcat=mysqli_fetch_array($resultcat)){?>
							<option value="<?=$rowcat[r_name]?>" <? if($rowcat[r_name]==$txtname){?>selected <?}?>><?=$rowcat[r_name]?> </option>
						<? } ?>
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
		<h1 class="ico"><img src="icon/icon.png" alt="">Crime Report List</h1>
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
		<th width="10%">Crime Type</th>
		<th width="10%">Crime Location</th>
		<th width="10%">Reporter Name</th>
		<th width="10%">Email</th>
		<th width="15%">Reporter IP Address </th>
		<th width="10%">Date </th>
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
		$id=$row_country[r_id];
		$count++;			
		?>
	
		<tr class="<?=$class?>">
		<td><b><?=$count?></b></td>
		<td><?=stripslashes($row_country[r_type])?></td>
		<td><?=stripslashes($row_country[r_name])?></td>
		<td><?=stripslashes($row_country[r_reporter])?></td>
		<td><?=stripslashes($row_country[r_email])?></td>
		<td><?=stripslashes($row_country[r_ip])?></td>
		<td><?=dateformate($row_country[r_date])?></td>
		<td class="center">
		<ul class="actions">
			<li><a href="r_add.php?mode=edit&rid=<?=$id?>" <?php if($row_country[r_status] == "New") : ?> style="color:#FF0000;" <?php endif; ?> ><?=$row_country[r_status]?></a></li>
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
