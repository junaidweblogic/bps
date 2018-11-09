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
$typev=$txtname;
		
if($txtname!="")
{
	$condition[]="cat_id='$txtname'";
	
}	



$condition[]="cat_type='album'";

if(is_array($condition))
{
	$condition=" WHERE " . implode(" AND ",$condition);
}

$que="select * from ".$tblpref."category $condition ORDER BY cat_id DESC"; 

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

admin_header("../../","Picture Gallery");
admin_nav("../../");


?>
<style type="text/css">
.ui-daterangepickercontain {
	top:220px;
	left:400px;
	position: absolute;
	z-index: 999;
}
</style>

<table cellspacing="3" cellpadding="0" border="0" width="100%" align="center"  valign="top" class="tbborder">
	<tr><td align="center" ><b><h2>Album Management</h2></b></td></tr>
    <tr>
    <td valign="top" width="85%" >
				<table class="tbborder"	cellspacing="0" cellpadding="0" border="0" width="70%" align="center" valign="top">
				<tr>
				<th valign="top" width="85%" >
					<table class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%" align="center" valign="top">
					<form name="frmcms" method="POST" action="indexmain.php">
					<tr ><th colspan="2" align="center"><b>&nbsp;Search</b></font>
					</th></tr>
					<tr>
					<td align="right" width="35%" class="tbborder"> Album :</FONT></td>
					<td align="left" style="padding-left:5px;" class="tbborder">
					<select name="txtname" id="txtname" style="width:300px" onchange="xmlReply();">
					<option value="" >Please Select</option>
					<?php  $query="select * from ".$tblpref."category where cat_type='album'"; 
					if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
					while($ro1=mysqli_fetch_array($result)){ ?>
					 <option value="<?php  echo $ro1[cat_id]?>" <?php if(trim($ro1[cat_id])==$txtname){echo "selected";}?>><?php  echo $ro1[cat_title]?> </option>    
					<?php  }?>
					</select>
				</td>
				</tr>	
				
					<tr>
					<td align="center" colspan="2" class="tbborder">
					<input type="submit" value="Search" name="txtsearch" class="mybutton">&nbsp;&nbsp;</td>
					</tr>
					</FORM>
					</table>
				</td>
				</tr>				
				</table>
	</td>
	</tr>


	<tr>
	<td align="center" class="warning">
	<?php  if($flag=="edit")
		{
		echo "Record is updated successfully.";
		}
	if($flag=="del")
		{
		echo "Record is deleted successfully.";
		}
	if($flag=="add")
		{
		echo "New record is added successfully.";
		}
		if($rowCount==0)
		{
		echo "No record found.";
		}
	if($flag=="exist")
		{
		echo "Record is already exist.";
		}
	?>
	</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	</tr>

 <tr>
	<td align="right">
	<a href="../gallery/gal-add.php?mode=add">ADD NEW</a> 
	</td>
	</tr>
	
	
	<tr>
	<td align="right">
	 <table cellspacing="0" cellpadding="0" border="0" width="100%">
		<td  align= "center" width="80%" class="tdclass1"><?php  echo $show_pagination ?></td>
		<td align= "right" width="20%"class="tdclass1"><?php  echo $show_status?></td>
	</table>
	</td>
	</tr>

	<tr>
	<th align="center">
	
		<table class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%" >
		   <tr>
			<th >Sr.no </th>
			
			<th><a href="?sorton=cat_title&sortby=<?php 
			if($_GET[sorton]=="cat_title" && ($_GET[sortby])=="desc") 
				echo "asc";
			else
				echo "desc";
				?>" class="nav">Name</th>	
			
			
			<th>Action</th>
		   </tr>
		<?php  
		while($row_category=mysqli_fetch_array($page_res)){ 
			$id=$row_category[cat_id];
			$count ++;
			?>
			<tr width="100%">
				<td width="3%" class="tbborder"><?php  echo $count?></td>
				<td class="tbborder"  align="left" width="25%"><?php  echo $row_category[cat_title]?></td>
				
				<td width="15%" class="tbborder" align="center"><a href="gal-add.php?gid=<?php  echo $id?>"> Edit</a>&nbsp; |&nbsp;<a href="submit-gal.php?mode=del&aid=<?php  echo $id?>" class="menu" onclick='if(confirm("Do You Want To Delete This ?")){return true;}else{return false;}'> Delete</a>&nbsp; |&nbsp;<a href="index.php?aid=<?php  echo $id?>">Image Gallery </a> </td>
				
			</tr>
		<?php  }?>
		</table>

</table><br>
</td>
</tr>
<?php admin_footer("../../");?>
