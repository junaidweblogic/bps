<?
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
		$condition[]="f_type='post'";
		$typev=$_GET[txtname];
		if($txtname!="")
		{
			$condition[]="f_name='$txtname'";
		}		
		
		if(is_array($condition))
		{
			$condition=" WHERE " . implode(" AND ",$condition);
		}

		$que="SELECT * FROM  ".$tblpref."forum $condition $condition2"; 

							$curr_query="sorton=".$_GET[sorton]."&sortby=".$_GET[sortby];
							$pagesize=10;
							$the_query  = pagination($que,$page,null,$curr_query,$pagesize);	
							$real_string     = explode("~" , $the_query);
							$que= $que.$cstr." LIMIT ". $real_string[0];
							$show_status     = $real_string[2];
							$show_pagination = $real_string[1];
							if (!($page_res =mysqli_query($connection,$que))) 
							{ echo "FOR QUERY: $strsql<BR>".mysqli_errno($connection); 	exit;}
							$rowCount = mysqli_num_rows($page_res);
							$srnum=$real_string[0][0];
							$srnum= $real_string[0];//--this is used to the next page no so that the srno at page comes  								in sequence
							$srnum=explode(",",$srnum);
							$count=$srnum[0];


admin_header('../../','Forum',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
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
            <td width="40%" align="right">Name :</td>
            <td width="60%">
			  <select NAME="txtname" class="inpt" >
				<option value="" >Please Select</option>			
				<? 
				$query="select distinct(f_name) from ".$tblpref."forum"; 
				if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
				while($row = mysqli_fetch_array($result))
				{ ?>
				<option value="<?=$row[f_name]?>" <? if($row[f_name]==$typev){?>selected<?}?>><?=$row[f_name]?> </option>
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
if($flag=="exits")
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
		<h1 class="ico"><img src="icon/icon.png" alt="">Forum</h1>
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
		<th width="20%">Name</th>
		<th width="15%">Date</th>
		<th width="15%">Poster IP Address</th>
		<th width="20%">Topic / Comments</th>
		<th width="15%">Status</th>
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
		$id=$row_country[f_id];
		$count++;
			
		?>
	
		<tr class="<?=$class?>">
		<td><b><?=$count?></b></td>
		<td><?=stripslashes($row_country[f_name])?></td>
		<td><? $date = explode(" ",$row_country[f_date]); echo dateformate($date[0]);?>&nbsp;&nbsp;<?php echo $date[1]?></td>
		<td><?=$row_country[f_ip]?></td>
		<td align="left"><b>
			<?
			$exp = explode(" ",$row_country[f_post]);
			for($i=0;$i<=15;$i++)
			{
				echo $topic = $exp[$i]." ";
			}
			echo "....";			
			?></b></td>
			<td align="left"><a href="submit_forum.php?id=<?=$row_country[f_id]?>&status=<?=$row_country[f_status]?>"><b>
			<? if($row_country[f_status]=="Active"){ echo "Approved"; } 
				if($row_country[f_status]=="Inactive"){ echo "Inactive"; } 
					if($row_country[f_status]==""){ echo "New"; } 
			?>&nbsp;
			
			</b></a></td>
		<td class="center">
		<ul class="actions">
			<li><a title="View" href="forum_add.php?mode=edit&id=<?=$id?>" ><img alt="View" src="../../images/view.png"></a></li>
			<li><a href="submit_forum.php?id=<?=$id?>&mode=del" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../images/delete.png" alt="delete"></a></li>
		</ul></td>
	</tr>

	<?
		$querycom ="SELECT * FROM  ".$tblpref."forum WHERE f_type='Comment' And f_post_id='$id' ORDER BY f_id DESC";	
		if(!($resultcom=mysqli_query($connection,$querycom))){ echo $querycom.mysqli_errno($connection); exit;}
		$numrow1 = mysqli_num_rows($resultcom);
		if($numrow1>0)
		{
			?>
		<tr class="<?=$class?>"><td colspan="8" align="left" ><b>Comments</b>
        <TABLE cellspacing="1" cellpadding="3" border="1" width="100%" bordercolor="#000000" style="border-collapse:collapse;">   
			<?
		while($rowcom = mysqli_fetch_array($resultcom))
		{
			$eid = $rowcom[f_id];
			$count1 ++;
		?>
		
		<TR>
			<TD width="5%" ><?=$count . "." .$count1?></TD>
			<TD align="left"><?=$rowcom[f_name]?></TD>
			<TD align="left"><? $date = explode(" ",$rowcom[f_date]); echo dateformate($date[0]);?>&nbsp;&nbsp;<?php echo $date[1]?></TD>
			<TD align="left"><?=$rowcom[f_ip]?></TD>
			<TD align="left">
			<? 
			$exp = explode(" ",$rowcom[f_post]);
			for($i=0;$i<=5;$i++)
			{
				echo $topic = $exp[$i]." ";
			}
			echo "....";		
			?>
			</TD>

			<TD align="left"><a href="submit_forum.php?id=<?=$rowcom[f_id]?>&status=<?=$rowcom[f_status]?>">
			<? if($rowcom[f_status]=="Active"){ echo "Approved"; } 
				if($rowcom[f_status]=="Inactive"){ echo "Inactive"; } 
					if($rowcom[f_status]==""){ echo "New"; } 
			?>&nbsp;
			
			</a>
			</TD>
			<td class="center">
		<ul class="actions">
			<li><a title="View" href="forum_add.php?mode=edit&id=<?=$eid?>" ><img alt="View" src="../../images/view.png"></a></li>
			<li><a href="submit_forum.php?id=<?=$eid?>&mode=del" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../images/delete.png" alt="delete"></a></li>
		</ul></td>
			
		</TR> 
		<? }		?>
		</table>
		</td>
		</tr>
		<?php
		}
		}?>
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