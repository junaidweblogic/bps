<?php  session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

admin_header("../../","Banner Management");
//admin_nav("../../");

$bnid1 = $_GET[bnid1];
switch($bnid1)
{
	case 1:
			$banner_type = "Top Banner";
			break;
	case 2:
			$banner_type = "Right Side Banner 01";
			break;
	case 3:
			$banner_type = "Right Side Banner 02";
			break;
	case 4:
			$banner_type = "Right Side Bottom Banner";
			break;
	case 5:
			$banner_type = "Bottom Banner";
			break;
}
if($bnid1!='')
{
	$query = "SELECT * FROM c_banner WHERE bn_id='$bnid1'";
	if (!($result = mysqli_query($connection,$query))){  echo $query.mysqli_connect_errno();  exit(); }
	$row = mysqli_fetch_array($result);
	$bn_id=$row[bn_id];
	$bn_name=$row[bn_name];
	$bn_parentid=$row[bn_parentid];
	$bn_image=$row[bn_image];
	$bn_url=$row[bn_url];
	$bn_exdate=dateformate($row[bn_exdate]);
	$bn_height=$row[bn_height];
	$bn_width=$row[bn_width];
	$bn_countnumber=$row[bn_numberofcount];

}
//$ldate=dateformate($row[bn_exdate]);
?>
<!--body start -->
<div class="adminbody">
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="bannerlist.php?bnid=<?=$bnid?>"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>
<div class="gap"></div>

<div class="box">
    <div class="hdr">
	<? if($bnid1!=""){?><h1 class="ico-edit">Edit</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt="">Advertising Banner :: <?php echo $banner_type?></h1>
    </div>
    </div> 
	<div class="padtb">
     <form name="pform" method="POST" onsubmit="return validateform1('<?=$bnid1?>');" action="submit-banner.php" enctype="multipart/form-data">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<input type="hidden" name="txtid" value="<?php  echo $bnid1?>">
		<input type="hidden" name="txtbnid" value="<?php  echo $bnid?>">
		<input type="hidden" name="bn_parentid" value="<?php  echo $bn_parentid?>">
		<?php 
			if($bnid==1)
			{
		?>
		<input type="hidden" name="bnheight" value="<?php  echo $bn_height?>">
		<input type="hidden" name="bnwidth" value="<?php  echo $bn_width?>">
		<?php 
			}	
		?>
		<td> Banner&nbsp;Name<font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
		<td>
		 <input type="text" name="bnname" id="bnname" value="<?php  echo stripslashes($bn_name)?>" class="smlinput" onchange="empty(this.id);">
					<br><label id='ebnname' class='error'></label>
		</td>
     </tr>
	 <?php   if($bnid1!=""){?>

	<tr class="even">
		<td> Last Update Date <font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
		<td>
			<input type="text" name="exdate" id="datepicker" style="width:250px;" value="<?php  echo $bn_exdate?>" class="smlinput" >
		</td>
     </tr>
            <?php }?>
			<tr class="even">
		<td> Banner&nbsp;image  : </br><?php  if($bnid==1){ ?> <span class='error'>Image width=1200 <br/> & height=600 required</span><?php  }if($bnid==2){?><span class='error'>Image width=226<br/> & height=100 required</span><?php  }if($bnid==3){?><span class='error'>Image width =207<br/> & height =207 required</span><?php }if($bnid==4){?><span class='error'>Image width=704<br/> & height=307 required</span><?php }?>     </td>
     </tr>
     <tr>
		<td>
			<input size="40" type="file" name="bnimage" class="smlinput"  value="<?php  echo $bn_image?>" />&nbsp;&nbsp;<?php  if(trim($bn_image)!=""){?><a href="#" onclick="open('../../possbpser/<?php  echo $bn_image?>','barcode','scrollbars=1,toolbar=0,location=0,resizable=0,width=600,height=400')" class="menu">View&nbsp;Image</a><?php }?> 
                    <br><label id='ebnimage' class='error' ><?php  if($flag=="filetype"){?>File should be image!<?php  }?><?php  if($flag=="width"){?>Image Width or Height exceeded!<?php  }?> 
		</td>
		<?php 
						switch($bnid) {
							case 1 : $widthval = 634; $heightval = 250; break;
							case 2 : $widthval = 227;  $heightval = 101; break;
							case 3 : $widthval = 208;  $heightval = 208; break;
							case 4 : $widthval = 705;  $heightval = 308; break;
						}
					?>
					<input type="hidden" name="widthval" value="<?php  echo $widthval; ?>" />
	                <input type="hidden" name="heightval" value="<?php  echo $heightval; ?>" />                
     </tr>
	 <tr class="even">
     	<td>
        <input type="submit" class="button" value="Submit" name="submit">
        </td>
     </tr>   
     </table>
     
     </form>   
     
    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
</div>
<?admin_footer()?>


               
				
<script language="JavaScript">
empty = function (id)
{
		eid = "e" + id;
		var obj = document.getElementById(id).value;

		if (obj != "")
		{
			document.getElementById(eid).innerHTML = "";
			return;
		}	
		else
		{
			document.getElementById(eid).innerHTML = "Please Enter!";	
			document.getElementById(id).focus();
		}
}
function validateform1(bnid)
{		
		var error = true;
		
		if (document.pform.bnname.value=="")
		 { 
  			document.getElementById('ebnname').innerHTML = "Please Enter Banner Name !";
		  	document.pform.bnname.focus();
			error =  false;
		 }
		 
		 if(bnid=="")
		{
		 if (document.pform.bnimage.value=="")
		 { 
  			document.getElementById('ebnimage').innerHTML = "Please Enter Banner Image !";
		  	document.pform.bnimage.focus();
			error =  false;
		 }
		}
		 if (error != true)
		{
		
			return false;
		}
		else
		{
			return true;
		}
}
</script>

