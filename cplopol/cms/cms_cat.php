<?php session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

$query="select * from ".$tblpref."category where cat_type='cms' order by cat_id"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}

if ($_GET[sorton]!="")
		{
			 $condition2=" ORDER BY ". $_GET[sorton]. " ". $_GET[sortby];
		}
		$condition[]="cat_type='cms'";
		$typev=$txtname;
		if($txtname!="")
		{
			$condition[]="cat_title='$txtname'";
			
		}		
		

			if(is_array($condition))
			{
				$condition=" WHERE " . implode(" AND ",$condition);
			}

		 $que="SELECT * FROM  ".$tblpref."category $condition $condition2"; 

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

admin_header_new("../../","CMS Category");
//admin_nav("../../");
?>
<BR>
<table cellspacing="3" cellpadding="0" border="0" width="100%" align="center"  valign="top" class="tbborder">
	<tr><td align="center" ><b><h2>CMS Category</h2></b></td></tr>
    <TR>
    <TD valign="top" width="75%">
				<TABLE class="tbborder"	cellspacing="0" cellpadding="0" border="0" width="70%" align="center" valign="top">
				<TR>
				<Th valign="top" width="75%" >
					<TABLE class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%" align="center" valign="top">
				<FORM NAME="frmcms" METHOD="POST" ACTION="doc_cat.php">
				<tr ><th colspan="2" align="center"><b>&nbsp;Search</b></font>
				</td></tr>
				<TR>
				<TD align="right" class="tbborder">Name:</FONT></TD>
				<TD align="left" style="padding-left:5px;" class="tbborder">
				<select NAME="txtname" style="width:300px" >
				<option value="" >Please Select</option>			
				<?php  while($row=mysqli_fetch_array($result))
				{?>
				<option value="<?php  echo $row[cat_title]?>" <?php if($row[cat_title]==$typev){?>selected <?php }?>><?php  echo $row[cat_title]?> </option>
                
				<?php }?>
				</TD>
				</TR>		

				<TR>
				<td align="center" colspan="2" class="tbborder">
				<INPUT TYPE="submit" value="Search" Name="txtsearch" class="mybutton">&nbsp;&nbsp;</td>
				</tr>
				</FORM>
				</TABLE>
				</td>
				</tr>				
				</TABLE>
	</td>
	</tr>

<?php if($rowCount==0){?>
				<TR>
				<TD align="center" class="warning" valign="middle">No record found.</TD>
				</TR>
				<?php  } ?>	
				<?php if($flag=="edit"){?>
				<TR>
				<TD align="center" class="warning" valign="middle">Record is edited Successfully.</TD>
				</TR>
				<?php  } ?>	
				<?php if($flag=="add"){?>
				<TR>
				<TD align="center" class="warning" valign="middle">New record is added successfully.</TD>
				</TR>
				<?php  } ?>	
				<?php if($flag=="exits"){?>
				<TR>
				<TD align="center" class="warning" valign="middle">Record is already exits.</TD>
				</TR>
				<?php  } ?>	
				<?php if($flag=="del"){?>
				<TR>
				<TD align="center" class="warning" valign="middle">Record is deleted Successfully.</TD>
				</TR>
<?php  } ?>	

	
	
	<TR>
	<TD align="right">
	<a href="cat_add.php?mode=add">ADD NEW</a> 
	</TD>
	</TR>
	<TR>
	<TD align="right">
	 <TABLE cellspacing="0" cellpadding="0" border="0" width="100%">
		<TD  align= "center" width="80%" class="tdclass1"><?php  echo $show_pagination ?></TD>
		<TD align= "right" width="20%"class="tdclass1"><?php  echo $show_status?></TD>
	</table>
	</TD>
	</TR>
	<TR>
	<Th align="center">
	
		<TABLE class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%">
		   <TR>
			<th>Sr.no</th>
			<th><A HREF="?sorton=cat_title&sortby=<?php 
			if($_GET[sorton]=="cat_title" && ($_GET[sortby])=="desc") 
				echo "asc";
			    else
				echo "desc";
				?>" class="nav">Category Name</th>
			<th>Action</th>
		</TR>
		<?php 
		while($row_category=mysqli_fetch_array($page_res)){ 
			$id=$row_category[cat_id];
			$count ++;
			?>
			<TR width="100%">
			<TD width="5%" class="tbborder"><?php  echo $count?></TD>
			<TD class="tbborder"  align="left"><?php  echo $row_category[cat_title]?></TD>
			
			<TD width="15%" class="tbborder" align="center"><a href="cat_add.php?mode=edit&id=<?php  echo $id?>" > Edit</a>&nbsp; |&nbsp;<a href="submit_cat.php?id=<?php  echo $id?>&mode=del" class="menu" onClick='if(confirm("Do You Want To Delete This ?")){return true;}else{return false;}'> Delete</a> </TD>
			
		</TR>
		<?php }?>
		</TABLE>

</table>
</td>
</tr>


<?php admin_footer("../../");?>