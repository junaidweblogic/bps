<?php 
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");
//include("../../fckeditor.php") ;
if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

/*$query="select * from ".$tblpref."admin where admin_id='$id'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);*/
//echo $vaus=$_SESSION["username"];
$que="SELECT * from ".$tblpref."admin  where admin_id='$id'";
if(!($result=mysqli_query($connection,$que))){ echo $que.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);
//$id = $row_add['admin_mgmts'];
admin_header('../../','Admin User',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
?>

<SCRIPT LANGUAGE="JavaScript">
function validate()
{

		var error = false;
		var chks = document.getElementsByName('checkbox1[]');
		
		var cnt = -1;
		for (var i=document.getElementsByName('chksuper').length-1; i > -1; i--) 
		{
			if (document.frmcmsadd.chksuper[i].checked) 
			{
				error = true;
				break;
			}
		}
		

		for (var i = 0; i < chks.length; i++)
		{

			if (chks[i].checked)
			{
				error = true;
				break;
			}
			
		}

		if(error == false) {
			document.getElementById('echksuper').innerHTML = "Please Admin Type !";
			error=false;
		}

		if(error == false) {
			document.getElementById('echeckbox1').innerHTML = "Please Select atleast one Mgmt Name !";
			error = false;
		}
		
		
		if(document.frmcmsadd.adminname.value=="")
		{
			document.getElementById('eadminname').innerHTML = "Please Enter Name !";
			document.frmcmsadd.adminname.focus();
			error =  false;
		 }

		if(document.frmcmsadd.txtname.value=="")
		{
			document.getElementById('etxtname').innerHTML = "Please Enter Username !";
			document.frmcmsadd.txtname.focus();
			error =  false;
		}

		if(document.frmcmsadd.txtpassword.value=="")
		{
			document.getElementById('etxtpassword').innerHTML = "Please Enter Password !";
			document.frmcmsadd.txtpassword.focus();
			error =  false;
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

</SCRIPT>
<script type="text/javascript">
set = function( id )
{
	if(id == "1")
	{
		document.getElementById("cms").disabled = true;
		document.getElementById("cms").checked = false;
	}
	else
	{
		document.getElementById("cms").disabled = false;
		if(id=="2")
		{
			document.getElementById("cms").checked = true;
			document.getElementById("version").checked = false;
		}
		if(id=="3")
		{
			document.getElementById("version").checked = true;
			document.getElementById("cms").checked = false;
		}
	}
	
}
</script>

<!--body start -->
<div class="adminbody">
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="index.php"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>
<div class="gap"></div>
<?
$flag = $_REQUEST[flag];
if($flag=="exist"){?>
<p align="center" class="error">Record is already exist.</p>
<? } ?>	   

<div class="box">
    <div class="hdr">
	<? if($id!=""){?><h1 class="ico-edit">Edit</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt="">Admin User</h1>
    </div>
    </div> 
	 <div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return validate();" action="submit_user.php" enctype="multipart/form-data">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<td> Type of Admin  :     </td>
     </tr>
     <tr>
     <td>
		<INPUT TYPE="radio" NAME="chksuper"  onclick="javascript:set(this.value);" value="1" <?php if($row_add[user_type]=="subadmin"){?>checked<?php }?>>
			Sub-Admin&nbsp;&nbsp;&nbsp;
			<INPUT TYPE="radio" NAME="chksuper" onclick="javascript:set(this.value);" value="2" <?php if($row_add[user_type]=="approver"){?>checked<?php }?>>
			Approver&nbsp;&nbsp;&nbsp;
            <INPUT TYPE="radio" NAME="chksuper" onclick="javascript:set(this.value);" value="3" <?php if($row_add[user_type]=="moderator"){?>checked<?php }?>>
			Moderator&nbsp;&nbsp;&nbsp;
	 </td>
     </tr>
	  <tr class="even">
		<td> Choose Management:  :     </td>
     </tr>
     <tr>
     <td>
		<div id="check2">
			<TABLE>
			<!-- Check box code with validation -->
			<?php 
			
			$res=$row_add['admin_mgmts'];
					$resu=explode(',',$res);
			//cms,police,gallery,link,publication,property,form,banner,missing,wanted,media,project,news,polling,events,faq
			//echo $result= $resu[0].",".$resu[1].",".$resu[2].",".$resu[3]; 
					if (in_array('cms', $resu)){$a="checked";}
					if (in_array('police', $resu)){$b="checked"; }
					if (in_array('gallery', $resu)){$c="checked"; }
					if (in_array('link', $resu)){$d="checked";}	
					if (in_array('publication', $resu)){$e="checked";}
					if (in_array('property', $resu)){$f="checked";}
					if (in_array('form', $resu)){$g="checked";}
					if (in_array('banner', $resu)){$h="checked";}	
					if (in_array('missing', $resu)){$i="checked";}
					if (in_array('wanted', $resu)){$j="checked";}
					if (in_array('media', $resu)){$k="checked"; }
					//if (in_array('project', $resu)){$l="checked"; }
					if (in_array('news', $resu)){$m="checked";}	
					if (in_array('polling', $resu)){$n="checked";}
					if (in_array('event', $resu)){$o="checked";}
					if (in_array('faq', $resu)){$p="checked";}
					if (in_array('forum', $resu)){$q="checked";}
					if (in_array('version', $resu)){$r="checked";}
					
				//if(in_array(news,$res)){$b=checked;}
				//if(in_array(banner,$res)){$c=checked;}
				//if(in_array(gallery,$res)){$d=checked;}exit;
			?>
			<tr>
                  <td><input type="checkbox" NAME="checkbox1[]" id='cms' value="cms"  <?if($row_add[user_type]=='subadmin'){?>disabled<? } ?><?php echo $a;?> /></td>
                  <td>CMS Management</td>
                  <td><input type="checkbox" NAME="checkbox1[]" value="police"  <?php echo $b;?> /></td>
				  <td>Police Station Management </td>
			</tr>
			<tr>
                  <td><input type="checkbox" NAME="checkbox1[]" value="gallery"  <?php echo $c;?> /></td>
                  <td>Gallery Management</td>
                  <td><input type="checkbox" NAME="checkbox1[]" value="link"  <?php echo $d;?> /></td>
				  <td>Usefull Link Management </td>
			</tr>
			<tr>
                  <td><input type="checkbox" NAME="checkbox1[]" value="publication"  <?php echo $e;?> /></td>
                  <td>Publication Management</td>
                  <td><input type="checkbox" NAME="checkbox1[]" value="property"  <?php echo $f;?> /></td>
				  <td>Missing Property </td>
			</tr>
			<tr>
                  <td><input type="checkbox" NAME="checkbox1[]" value="form"  <?php echo $g;?> /></td>
                  <td>Form Management</td>
                  <td><input type="checkbox" NAME="checkbox1[]" value="banner"  <?php echo $h;?> /></td>
				  <td>Banner Management </td>
			</tr>
			<tr>
                  <td><input type="checkbox" NAME="checkbox1[]" value="missing"  <?php echo $i;?> /></td>
                  <td>Missing Person </td>
                  <td><input type="checkbox" NAME="checkbox1[]" value="wanted"  <?php echo $j;?> /></td>
				  <td>Wanted Person </td>
			</tr>
			<tr>
                  <td><input type="checkbox" NAME="checkbox1[]" value="media"  <?php echo $k;?> /></td>
                  <td>Media Center Management</td>
                 <td><input type="checkbox" NAME="checkbox1[]" value="news"  <?php echo $m;?> /></td>
				  <td>News Management </td>
			</tr>
			<tr>
                  
                  <td><input type="checkbox" NAME="checkbox1[]" value="polling"  <?php echo $n;?> /></td>
                  <td>Polling Management</td>
				  <td><input type="checkbox" NAME="checkbox1[]" value="event"  <?php echo $o;?> /></td>
                  <td>Event Management</td>
			</tr>
			<tr>
                  
                  <td><input type="checkbox" NAME="checkbox1[]" value="faq"  <?php echo $p;?> /></td>
				  <td>FAQ </td>
				  <td><input type="checkbox" NAME="checkbox1[]" value="forum"  <?php echo $q;?> /></td>
                  <td>Forum Management</td>
			</tr>
			<tr>                  
                  <td><input type="checkbox" NAME="checkbox1[]" id='version' value="version"  <?php echo $r;?> /></td>
				  <td>Version Management </td>
				  <td>&nbsp;</td>
                  <td>&nbsp;</td>
			</tr>
			
                  
			</TABLE>
			</div>
	 </td>
     </tr>
	 <tr class="even">
		<td> Admin Name  <FONT COLOR="#FF0000">*</FONT> :     </td>
     </tr>
     <tr>
     <td>
		<INPUT TYPE="text" NAME="adminname" id="adminname" class="smlinput" value="<?php  echo $row_add[admin_name]?>" onchange="empty(this.id);">
	 </td>
     </tr>
	 <tr class="even">
		<td> Username  <FONT COLOR="#FF0000">*</FONT> :     </td>
     </tr>
     <tr>
     <td>
		<INPUT TYPE="text" NAME="txtname" id="txtname" class="smlinput" value="<?php  echo $row_add[username]?>" onchange="empty(this.id);">
	 </td>
     </tr>
	 <tr class="even">
		<td> Password  <FONT COLOR="#FF0000">*</FONT> :     </td>
     </tr>
     <tr>
     <td>
		<INPUT TYPE="password" NAME="txtpassword" id="txtpassword" class="smlinput" value="<?php  echo $row_add[password]?>" onchange="empty(this.id);">
	 </td>
     </tr>
	 <tr class="even">
		<td>&nbsp;</td>
	 </tr>     
     <tr >
     	<td>
        <input type="submit" class="button" value="Submitt" name="submit">
		<?if($id==""){?>
		<input type="hidden" value="add" name="txtmode" >
		<?}else{?>
		<input type="hidden" value="<?=$id?>" name="id" >
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