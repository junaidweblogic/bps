<?php 
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}


admin_header("../../","Picture Gallery");
admin_nav("../../");
?>
<script language="JavaScript">
<!--
function checkform()
{

	if (document.frmform.the_file.value == "")
		{
			alert("Please select image by clicking on \" Browse..\".");
			document.frmform.the_file.focus();
			document.frmform.the_file.select();
			return false;
		}
	if (document.frmform.the_file.value != "") {
		var path = new String(document.frmform.the_file.value)
		fileName =path.substr(path.lastIndexOf(".")+1);
		fileName =fileName.toLowerCase();
		if ( !(fileName=="jpg" || fileName=="jpeg" || fileName=="gif" || fileName == "png"))
		{
			alert("You have tried to upload an invalid image format.\nUpload .jpg, .gif, .png images only.");
			document.frmform.the_file.focus();
			document.frmform.the_file.select();
			return false;
		}
	}

	if (document.frmform.imgcap.value == "")
		{
			alert("Please enter image caption.");
			document.frmform.imgcap.focus();
			return false;
		}


}
-->
</script>
<table cellspacing="0" cellpadding="0" width="100%" border="0" align="center">
<tr>
	<td>
	<table cellspacing="0" cellpadding="0" border="0" width="80%" align="center" >
	<tr><td align="center" class="body">&nbsp;<b><h2>Album Management</h2></b></td></tr>
	<tr><td height="12px"></td></tr>

	<?php if($flag=="del"){	?>
		<tr>
			<td colspan="8" align="center"><font color="red">Gallery image has been deleted successfully.</font></td>
		</tr>
	<?php  }
	if($flag=="add"){?>
		<tr>
			<td colspan="8" align="center"><font color="red">New image has been added successfully.</font></td>
		</tr>
	
	<?php  }
	if($flag=="exists"){?>
		<tr>
			<td colspan="8" align="center"><font color="red"> Image Name already exists</font></td>
		</tr>
	<?php  }
	?>
	
			<tr><th>
			<table class="tbborder"	cellspacing="1" cellpadding="2" border="0" width="100%" >
				<form method="POST" name="frmform" action="submit_uploadalbum.php" onsubmit="return checkform();" enctype="multipart/form-data">
				<input type="hidden" name="mode" value="<?php  echo $mode?>">
				<input type="hidden" name="pid" value="<?php  echo $prod_id?>">
					<tr >
						<th align="center" height="22" colspan=2>Upload Image</B></td>
					</tr>
					<tr>
						<td width="30%" align="right" class="tbborder">&nbsp;Album Caption:<font color="red">*</font>:</font></td>
						<td class="tbborder"><input type="text" name="imgcap" value="" style="width:300px"> 
						</td>
					</tr>
					<!-- <tr>
						<td width="30%" align="right" class="tbborder">&nbsp;Album Path<font color="red">*</font>:</font></td>
						<td class="tbborder"><input type="file" name="the_file" > <font color="#FF0000"><br>Diamention: Width :500px and Height : 400px </font>
						</td> 
					</tr>-->
					
					<tr>
						<td colspan="2" align="center" class="tbborder"><input type="submit" name="submit" value="Submit" class="mybutton">&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="mybutton"></font></td>
					</tr>
				</form>

				</table>
				</td>
			</tr>


<tr>
	<td>
<?php 
/////// display existing uploaded files //////
//$query="select * from ".$tblpref."category  where cat_type='album' ORDER BY cat_id";  
//if(!($result=mysqli_query($query))){ echo $query.mysqli_errno($connection); exit;}
	//$rowCount=mysqli_num_rows($result);
	
	$que="select * from ".$tblpref."category  where cat_type='album' ORDER BY cat_id"; 
	$curr_query="sorton=".$_GET[sorton]."&sortby=".$_GET[sortby];
	$pagesize=30;
	$the_query  = pagination($que,$page,null,$curr_query,$pagesize);	
	$real_string     = explode("~" , $the_query);
	$que= $que.$cstr." LIMIT ". $real_string[0];
	$show_status     = $real_string[2];
	$show_pagination = $real_string[1];
	if (!($result =mysqli_query($connection,$que))) 
	{ echo "FOR QUERY: $strsql<BR>".mysqli_errno($connection); 	exit;}
	$rowCount = mysqli_num_rows($result);
	$srnum=$real_string[0][0];
	$srnum= $real_string[0];//--this is used to the next page no so that the srno at page comes  								in sequence
	$srnum=explode(",",$srnum);
	$count=$srnum[0];
	
	$count=0;
	if ($rowCount > 0)
	{   
?>

   <table width="100%" border="0" cellspacing="0" cellpadding="3" class="text">
	<tr> 
	  <td colspan=5> <br>&nbsp;
		<p style="margin-left: 15"><b>Existing Uploaded Images</b></p>
	  </td>
	</tr>
    <tr>
	<td align="right" colspan="5">
	 <table cellspacing="0" cellpadding="0" border="0" width="100%">
		<td  align= "center" width="80%" class="tdclass1"><?php  echo $show_pagination ?></td>
		<td align= "right" width="20%"class="tdclass1"><?php  echo $show_status?></td>
	</table>
	</td>
	</tr>
 
  <tr> 
  <form method=POST  name="frmmemdisp">
<?php  
       while($row=mysqli_fetch_array($result))
		{
			$count++;
			$file_id = $row["cat_id"];     
			$filename = $row["cat_image"];
			$image_cap = $row["cat_title"];
	
?>

<td style="padding-top:20px;">

   <table border="0" cellspacing="0" cellpadding="3" class="text">
	  <tr>
		  <td >
			<a href="../../possbpser/<?php  echo $filename?>" target="_blank"><img src="../../possbpser/<?php  echo $filename?>" border="0" width="100" height="80"></a>
		  </td>
	  </tr>

  
		<tr>
		<td align="center" class="bodytext"><a href="index.php?aid=<?php  echo $row["cat_id"]?>" ><strong><?php  echo $image_cap?></strong></a>
		</td>
		</tr>

		<tr>
		<td align="center" class="bodytext">
		<a href="submit_uploadimage.php?fn=<?php  echo $filename?>&fid=<?php  echo $file_id?>&mode=del" onclick="if(confirm('Confirm delete?')) return true; else return false;">Delete File</a>
		</td>
		</tr>

	</table>
</td>


<?php 
	if($count >= 5)
	{
		echo "</tr><tr>";
		$count = 0;
	}
		}

?>

 </tr>
 
 
	</table>

<?php  } ?>

</form>
	</td>
</tr>

	</table>
	</td>
</tr>
</table>
</td>
</tr>
</table>
<script language='javascript'>
function fwdname(imid,pid)
{
	document.frmmemdisp.action="submit-uploadalbum.php?flag=main&imid="+ imid + "&pid="+ pid;
	document.frmmemdisp.submit();
}
</script>
<?php admin_footer("../../");?>
