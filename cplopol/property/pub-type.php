<?php 
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

$query="select * from ".$tblpref."category WHERE cat_type = 'property' order by cat_id DESC"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}

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
		$condition[]="cat_type = 'property'";

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

admin_header("../../","Property Category");
admin_nav("../../");
?>
<br>
<table cellspacing="3" cellpadding="0" border="0" width="100%" align="center"  valign="top" class="tbborder">
	<tr><td align="center" ><b><h2>Property Category List</h2></b></td></tr>
    <tr>
    <td valign="top" width="75%">
				<table class="tbborder"	cellspacing="0" cellpadding="0" border="0" width="70%" align="center" valign="top">
				<tr>
				<th valign="top" width="75%" >
					<table class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%" align="center" valign="top">
				<form name="frmcms" method="POST" action="pub-type.php">
				<tr ><th colspan="2" align="center"><b>&nbsp;Search</b></font>
				</td></tr>
				<tr>
				<td align="right" class="tbborder">Name:</FONT></td>
				<td align="left" style="padding-left:5px;" class="tbborder">
				<select name="txtname" style="width:300px" >
				<option value="" >Please Select</option>			
				<?php  while($row=mysqli_fetch_array($result))
				{?>
				<option value="<?php  echo $row[cat_title]?>" <?php if($row[cat_title]==$typev){?>selected <?php }?>><?php  echo $row[cat_title]?> </option>
                
				<?php }?>
				</TD>
				</TR>		

				<tr>
				<td align="center" colspan="2" class="tbborder">
				<input type="submit" value="Search" name="txtsearch" class="mybutton">&nbsp;&nbsp;</td>
				</tr>
				</form>
				</table>
				</td>
				</tr>				
				</table>
	</td>
	</tr>

<?php if($rowCount==0){?>
				<tr>
				<td align="center" class="warning" valign="middle">No record found.</td>
				</tr>
				<?php  } ?>	
				<?php if($flag=="edit"){?>
				<tr>
				<td align="center" class="warning" valign="middle">Record is edited Successfully.</td>
				</tr>
				<?php  } ?>	
				<?php if($flag=="add"){?>
				<tr>
				<td align="center" class="warning" valign="middle">New record is added successfully.</td>
				</tr>
				<?php  } ?>	
				<?php if($flag=="exits"){?>
				<tr>
				<td align="center" class="warning" valign="middle">Record is already exits.</td>
				</tr>
				<?php  } ?>	
				<?php if($flag=="del"){?>
				<tr>
				<td align="center" class="warning" valign="middle">Record is deleted Successfully.</td>
				</tr>
<?php  } ?>	

	
	
	<tr>
	<td align="right">
	<a href="pub-type-add.php?mode=add">ADD NEW</a> 
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
	
		<table class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%">
		   <tr>
			<th>Sr.no</th>
			<th><a href="?sorton=cat_name&sortby=<?php 
			if($_GET[sorton]=="cat_name" && ($_GET[sortby])=="desc") 
				echo "asc";
			    else
				echo "desc";
				?>" class="nav"> Category</th>
			<th>Action</th>
		</tr>
		<?php 
		while($row_category=mysqli_fetch_array($page_res)){ 
			$id=$row_category[cat_id];
			$count ++;
			
			?>
			<tr width="100%">
			<td width="5%" class="tbborder"><?php  echo $count?></td>
			<td class="tbborder"  align="left"><?php  echo $row_category[cat_title]?></td>
			
			<td width="15%" class="tbborder" align="center"><a href="pub-type-add.php?mode=edit&pid=<?php  echo $id?>" > Edit</a>&nbsp; |&nbsp;<a href="submit-pub-type.php?pid=<?php  echo $id?>&mode=del" class="menu" onclick='if(confirm("Do You Want To Delete This ?")){return true;}else{return false;}'> Delete</a> </td>
			
		</tr>
		<?php }?>
		</table>

</table>
</td>
</tr>


<?php admin_footer("../../");?>