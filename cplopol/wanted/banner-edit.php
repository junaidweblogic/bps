<?php  session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
include_once '../../common/ckeditor/ckeditor.php';

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

admin_header('../../','Wanted Person ',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
if($bnid1!='')
{
	$query = "SELECT * FROM c_banner WHERE bn_id='$bnid1'";
	if (!($result = mysqli_query($connection,$query))){  echo $query.mysqli_errno($connection);  exit(); }
	$row = mysqli_fetch_array($result);
	$bn_id=$row[bn_id];
	$bn_name=stripslashes($row[bn_name]);
	$bn_parentid=$row[bn_parentid];
	$bn_image=$row[bn_image];
	$bn_url=$row[bn_url];
	$bn_exdate=dateformate($row[bn_exdate]);
	$bn_height=$row[bn_height];
	$bn_width=$row[bn_width];
	$bn_countnumber=$row[bn_numberofcount]+0;

}
//$ldate=dateformate($row[bn_exdate]);
?>
<script type="text/javascript" src="../../common/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="../../js/jquery-1.3.1.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.7.1.custom.min.js"></script>
<script type="text/javascript" src="../../js/daterangepicker.jQuery.js"></script>
<link rel="stylesheet" href="../../css/ui.daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="../../css/redmond/jquery-ui-1.7.1.custom.css" type="text/css" title="ui-theme" />
<script type="text/javascript"> 
$(function(){
  $('#datepicker').daterangepicker({
posX:470,
posY: 180
  }); 
});
</script>
<style type="text/css">
.ui-daterangepickercontain {
	top:220px;
	left:400px;
	position: absolute;
	z-index: 999;
}
</style>

<!--body start -->
<div class="adminbody">
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="bannerlist.php"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>
<div class="gap"></div>
<?
$flag = $_REQUEST[flag];
if($nomatch=="1"){?>
<p align="center" class="error">Banner entered successfuly.</p>
<? } ?>	   
<div class="box">
    <div class="hdr">
	<? if($bnid1!=""){?><h1 class="ico-edit">Edit</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt="">Wanted Person Management</h1>
    </div>
    </div> 
	<div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return validateform1('<?=$bnid1?>');" action="submit-banner.php" enctype="multipart/form-data">
	 <input type="hidden" name="txtid" value="<?php  echo $bnid1?>">
		<input type="hidden" name="txtbnid" value="<?php  echo $bnid?>">
		<input type="hidden" name="bn_parentid" value="<?php  echo $bn_parentid?>">
		<input type="hidden" name="bn_countnumber" value="<?php  echo $bn_countnumber?>">
		<?php 
			if($bnid==1)
			{
		?>
		<input type="hidden" name="bnheight" value="<?php  echo $bn_height?>">
		<input type="hidden" name="bnwidth" value="<?php  echo $bn_width?>">
		<?php 
			}	
		?>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<td> Person&nbsp;Name:<font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td>
		 <input type="text" name="bnname" id="bnname" value="<?php  echo $bn_name?>" class="smlinput" >
	 </td>
     </tr>
	 <tr class="even">
		<td> Show Till Date :     </td>
     </tr>
     <tr>
     <td>
		 <input type="text" name="datepicker" id="datepicker" class="smlinput" value="<?php  echo $bn_exdate?>" />
	 </td>
     </tr>

	<tr class="even">
		<td> Banner&nbsp;image: <?php  if($bnid==1){ ?> <span class='warning'>Image width=634 <br/> & height=250 required</span><?php  }if($bnid==2){?><span class='warning'>Image width=226<br/> & height=100 required</span><?php  }if($bnid==3){?><span class='warning'>Image width =120<br/> & height =100 required</span><?php }if($bnid==4){?><span class='warning'>Image width=704<br/> & height=307 required</span><?php } ?>   </td>
     </tr>
     <tr>
     <td>
		 <input class="smlinput" type="file" name="bnimage"  value="<?php  echo $bn_image?>" />&nbsp;&nbsp;<?php  if(trim($bn_image)!=""){?><a href="#" onclick="open('../../possbpser/<?php  echo $bn_image?>','barcode','scrollbars=1,toolbar=0,location=0,resizable=0,width=600,height=400')" class="menu">View&nbsp;Image</a><?php }?> 
                    <br><label id='ebnimage' class='warning' ><?php  if($flag=="filetype"){?>File should be image!<?php  }?><?php  if($flag=="width"){?>Image Width or Height exceeded!<?php  }?> 
	 </td>
     </tr>
	 <?php 
						switch($bnid) {
							case 1 : $widthval = 635; $heightval = 251; break;
							case 2 : $widthval = 227;  $heightval = 101; break;
							case 3 : $widthval = 208;  $heightval = 208; break;
							case 4 : $widthval = 705;  $heightval = 308; break;
						}
					?>
					<input type="hidden" name="widthval" value="<?php  echo $widthval; ?>" />
	                <input type="hidden" name="heightval" value="<?php  echo $heightval; ?>" />

			<tr class="even">
						<td> Description :    </td>
					</tr>
					<tr>
						<td>
							<?php 
								$ckeditor = new CKEditor();
								$ckeditor->basePath = '/ckeditor/';

								$ckeditor->config['filebrowserBrowseUrl'] = $ckpath.'/ckfinder/ckfinder.html';
								$ckeditor->config['filebrowserImageBrowseUrl'] = $ckpath.'/ckfinder/ckfinder.html?type=Images';
								$ckeditor->config['filebrowserFlashBrowseUrl'] = $ckpath.'/ckfinder/ckfinder.html?type=Flash';
								$ckeditor->config['filebrowserUploadUrl'] = $ckpath.'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
								$ckeditor->config['filebrowserImageUploadUrl'] = $ckpath.'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
								$ckeditor->config['filebrowserFlashUploadUrl'] = $ckpath.'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';				$ckeditor->editor('linkcontect',stripslashes($row[bn_desc]));			

								?>
						</td>
					</tr>
<tr class="even">
		<td>&nbsp;</td>
	 </tr>     
     <tr >
     	<td>
        <input type="submit" class="button" value="Submitt" name="submit">
        </td>
     </tr>   
     </table>
    </form>
     <p>&nbsp;</p>
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
		 if (document.pform.datepicker.value=="")
		 { 
  			document.getElementById('edatepicker').innerHTML = "Please Enter Date !";
		  	document.pform.datepicker.focus();
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