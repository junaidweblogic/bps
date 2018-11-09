<?php 
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");

if(@$_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}


admin_header('../../','FAQ List',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);

 $query="SELECT * FROM ".$tblpref."content_master where cms_type='faq' ORDER BY cms_date"; //query for drop down list
	if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}


	if ($_GET[sorton]!="")
		{
			 $condition2=" ORDER BY ". $_GET[sorton]. " ". $_GET[sortby];
		}

		$typev=$txtname;
		$condition[]="cms_type = 'faq'";
		if($txtname!="")
		{
			$condition[]="cms_title = '$txtname'";
		}
		
		if(is_array($condition))
		{
			$condition=" WHERE " . implode(" AND ",$condition);
		}

		$que="SELECT * FROM ".$tblpref."content_master $condition $condition2"; 

			$curr_query="sorton=".$_GET[sorton]."&sortby=".$_GET[sortby]."&mode=".$mode;
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
			$srnum= $real_string[0];//--this is used to the next page no so that the srno at page comes  							in sequence
			$srnum=explode(",",$srnum);
			$count=$srnum[0];
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
            <td width="40%" align="right">Question :</td>
            <td width="60%">
			  <select NAME="txtname"  class="inpt" >
					<option value="" >Please Select</option>			
					<?php  while($row=mysqli_fetch_array($result))
					{?>
					<option value="<?php  echo $row[cms_title]?>" <?php if($row[cms_title]==$typev){?>selected <?php }?>><?php  echo $row[cms_title]?> </option>
					<?php }?>
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
	if($flag=="update")
	{ ?>
		<p align="center" class="error">FAQ is Updated Successfully.</p>
<?php
	}
	if($flag=="add")
	{ ?>
		<p align="center" class="error">FAQ is Added Successfully.</p>
<?php
	}
	if($flag=="del") 
	{ ?>
		<p align="center" class="error">FAQ is deleted Successfully.</p>
<?php
	} ?>	

	<div class="gap"></div>
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt"><a href="../home.php"><img src="../../images/back32.png" alt="Back" title="Back"/></a></div>
<div class="gap"></div>
<div class="box">
    <div class="hdr">
		<h1 class="ico"><img src="icon/icon.png" alt="">FAQ List</h1>
        <div class="addnew">
						<a  href="add_faq.php?mode=add" class="add">Add New</a>
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
		<th width="40%">Title</th>
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
		<td class="center">
		<ul class="actions">
			<li><a title="edit" href="add_faq.php?mode=edit&faqid=<?php  echo $id?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
			<li><a href="submit_faq.php?did=<?php  echo $id?>&mode=del" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../images/delete.png" alt="delete"></a></li>
		</ul></td>
	</tr>
 
<? } ?>
<tr>
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