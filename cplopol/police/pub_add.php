<?php 
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
include_once '../../common/ckeditor/ckeditor.php';

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

	$query="select * from ".$tblpref."content_master where cms_id='$puid'"; 
	if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
	$row_add=mysqli_fetch_array($result);

admin_header('../../','Police Station',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
include("funfile1.php");
?>
<script type="text/javascript" src="../../common/ckeditor/ckeditor.js"></script>
<!--body start -->
<div class="adminbody">
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="index.php"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>

<?php  
	if($flag=="exists"){?>
		<p class="error"> Police Station Name already exists</p>
	<?php  } ?>

<div class="gap"></div>

<div class="box">
    <div class="hdr">
	<? if($puid!=""){?><h1 class="ico-edit">Edit</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt="">Police Station</h1>
    </div>
    </div> 
	<div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return val();" action="submit_pub.php">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<td> City <font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td>
		<select NAME="pub_city" id="pub_city" onchange="xmlReply(this.value),empty(this.id);" class="smlinput">
        <option value="">Please Select</option>
        <?php  
        $query1="select * from ".$tblpref."category WHERE cat_type = 'city' ORDER BY cat_title"; 
        if(!($result1=mysqli_query($connection,$query1))){ echo $query.mysqli_errno($connection); exit;}
        while($row=mysqli_fetch_array($result1)){?>
        <option value="<?php  echo $row[cat_title]?>" <?php if($row[cat_title]==$row_add[cms_page_title]){ ?>selected <?php }?>><?php  echo $row[cat_title]?> </option>
        <?php } ?></select>
	 </td>
     </tr>
	 <tr class="even">
		<td> Area <font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td>
		<div id="areas">
        <select NAME="cmsarea" id="cmsarea" onchange="empty(this.id),display(this.value);" class="smlinput">
		    <option value="<?php  echo $row_add[cms_subtype]?>"><?php  echo $row_add[cms_subtype]?> </option>
        </select>
        </div>
		 <input type="hidden" name="hcmsarea" id="hcmsarea" value="<?php  echo $row_add[cms_subtype]?>" />
	 </td>
     </tr>
	 <tr class="even">
		<td> Police Station Name  <font color="#ff0000">* </font> :     </td>
     </tr>
     <tr>
     <td>
        		<input type="text" name="pub_name" id="pub_name" class="smlinput" value="<?php  echo stripslashes($row_add[cms_title])?>" onchange="empty(this.id);">
	 </td>
     </tr>
	 <tr class="even">
		<td> Location :     </td>
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
			$ckeditor->config['filebrowserFlashUploadUrl'] = $ckpath.'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';				$ckeditor->editor('linkcontect',stripslashes($row_add[cms_desc]));		
		?>
	 </td>
     </tr>
	 <tr class="even">
		<td> Google Map :     </td>
     </tr>
     <tr>
     <td>
		<textarea name="googlecode" id="googlecode" class="smlinput"><?php echo stripslashes($row_add[cms_sitelink]);?></textarea>
	 </td>
     </tr>
<tr class="even">
		<td>&nbsp;</td>
	 </tr>     
     <tr >
     	<td>
        <input type="submit" class="button" value="Submitt" name="submit">
		<?if($puid==""){?>
		<input type="hidden" value="add" name="txtmode" >
		<?}else{?>
		<input type="hidden" value="<?=$puid?>" name="puid" >
		<?}?>
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

<script language="javascript">
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
function val()
{
	var warning = true;
	
	if (document.frmpubadd.pub_city.value=="")
	{ 
  		document.getElementById('epub_city').innerHTML = "Please Enter City Name !";
		document.frmpubadd.pub_city.focus();
		warning =  false;
	}

	if (document.frmpubadd.cmsarea.value=="")
	{ 
  		document.getElementById('ecmsarea').innerHTML = "Please Enter Area !";
		document.frmpubadd.cmsarea.focus();
		warning =  false;
	}
		
	if (document.frmpubadd.pub_name.value=="")
	{ 
  		document.getElementById('epub_name').innerHTML = "Please Enter Police Station Name !";
		document.frmpubadd.pub_name.focus();
		warning =  false;
	}

	
return warning;
}
</script>