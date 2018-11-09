<?php 
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

$query="select * from ".$tblpref."category WHERE cat_type = 'area' order by cat_id DESC"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_connect_errno(); exit;}

if ($_GET[sorton]!="")
		{
			 $condition2=" ORDER BY ". $_GET[sorton]. " ". $_GET[sortby];
		}
		else
		{
			$condition2=" ORDER BY cat_id DESC";
		}
		
		$typev=$txtname;
		if($txtname!="")
		{
			$condition[]="cat_title='$txtname'";
			
		}		
		$condition[]="cat_type = 'area'";

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
			

			if (!($page_res = mysqli_query($connection,$que))){ echo "FOR QUERY: $strsql<BR>".mysqli_error($connection); 	exit;}

			$rowCount = mysqli_num_rows($page_res);
			$srnum=$real_string[0][0];
			$srnum= $real_string[0];//--this is used to the next page no so that the srno at page comes  								in sequence
			$srnum=explode(",",$srnum);
			$count=$srnum[0];

admin_header('../../','Area Management',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
//admin_nav("../../");
?>
<!--body start -->
<div class="adminbody">

<div class="box smlsizenews">
    <div class="hdr">
		<h1 class="ico-search">Search</h1>
    </div>
    <div class="padtb">
      <form name="frmnews" method="GET" action="index.php">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr class="alt-row">
            <td align="right" width="40%">Area Name</td>
            <td>
					<select name="txtname" class="smlinput1">
				<option value="" >Please Select</option>			
				<?php  while($row=mysqli_fetch_array($result))
				{?>
				<option value="<?php  echo $row[cat_title]?>" <?php if($row[cat_title]==$typev){?>selected <?php }?>><?php  echo $row[cat_title]?> </option>
                
				<?php }?>
				</select>
			</td>
		    
		</tr> 
		<tr class="alt-row">
			<td colspan="4" align="center">
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
		<p align="center" class="error">No record found.</p>
<?php
	}
	if($flag=="edit")
	{ ?>
		<p align="center" class="error">Record is edited Successfully.</p>
<?php
	} 
	if($flag=="add")
	{ ?>
		<p align="center" class="error">New record is added successfully.</p>
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
		<h1 class="ico-cms">Area Management</h1>
        <div class="addnew">
			<a href="pub-type-add.php?mode=add" class="add">Add New</a>			
		</div>
	</div>   
	<div class="padtb">
  <!--   <p align="right"></p> -->
	<p align="right"><?=$show_status?> </p>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<thead>
	  <tr>
		<th class="minth">Sr. No.</th>
		<th width="30%">Area</th>
		<th width="15%">City</th>
		<th class="minth">Action</th>
	  </tr>
	</thead>
	<tbody>
	<?php 
		$clcnt=0;
		
		while($row_news=mysqli_fetch_array($page_res))
		{ 
			$id=$row_news[cat_id];
			$count++;
			if($clcnt%2==0){$class="even";}else{$class="";}

			$clcnt++;
		?>
	
		<tr class="<?=$class?>">
		<td><b><?=$count?></b></td>
		<td><?php  echo stripslashes($row_news[cat_title])?></td>
		<td><?php  echo stripslashes($row_news[cat_image])?></td>
		<td class="center">
		<ul class="actions">
			<li><a title="edit" href="pub-type-add.php?mode=edit&pid=<?php  echo $id?>" ><img alt="edit" src="../../images/pencil.png"></a></li>
			<li><a href="submit-pub-type.php?pid=<?php  echo $id?>&mode=del" onclick="if(confirm('Do You Want To Delete This ?')){return true;}else{return false;}"><img src="../../images/delete.png" alt="delete"></a></li>
		</ul></td>
	</tr>
<? } ?>
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
