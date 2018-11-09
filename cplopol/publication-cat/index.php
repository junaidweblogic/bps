<?php 
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

$query="select * from ".$tblpref."category WHERE cat_type = 'Publication' order by cat_id DESC"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}

if ($_GET[sorton]!="")
		{
			 $condition2=" ORDER BY ". $_GET[sorton]. " ". $_GET[sortby];
		}
		else
		{
			 $condition2=" order by cat_id DESC";
		}
		
		$typev=$txtname;
		if($txtname!="")
		{
			$condition[]="cat_title='$txtname'";
			
		}		
		$condition[]="cat_type = 'Publication'";

			if(is_array($condition))
			{
				$condition=" WHERE " . implode(" AND ",$condition);
			}

		 $que="SELECT * FROM  ".$tblpref."category  $condition $condition2"; 

							$curr_query="sorton=".$_GET[sorton]."&sortby=".$_GET[sortby];
							$pagesize=10;
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

admin_header('../../','Publication Category',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
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
            <td width="40%" align="right">Name: :</td>
            <td width="60%">
			  <select name="txtname"  class="inpt">
				<option value="" >Please Select</option>			
				<?php  while($row=mysqli_fetch_array($result))
				{?>
				<option value="<?php  echo $row[cat_title]?>" <?php if($row[cat_title]==$typev){?>selected <?php }?>><?php  echo $row[cat_title]?> </option>
                
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
		<h1 class="ico"><img src="icon/icon.png" alt="">Publication Category List</h1>
        <div class="addnew">
						<a  href="pub-type-add.php?mode=add" class="add">Add New</a>
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
		<th width="35%">Category</th>
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
		$id=$row_country[cat_id];
		$count++;

		?>
	
		<tr class="<?=$class?>">
		<td><b><?=$count?></b></td>
		<td><?=stripslashes($row_country[cat_title])?></td>
		<td class="center">
		<ul class="actions">
			<li><a title="edit" href="pub-type-add.php?mode=edit&pid=<?php  echo $id?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
			<li><a href="submit-pub-type.php?pid=<?php  echo $id?>&mode=del" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../images/delete.png" alt="delete"></a></li>
		</ul></td>
	</tr>
<? } ?>
  </tbody> 
<tr>    
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