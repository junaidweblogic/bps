<?php  session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}

admin_header('../../','Advertising Banners',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
//admin_nav("../../");
?>

<!--body start -->
<div class="adminbody">
	<?php
	$flag=$_REQUEST[flag];
	if($flag=="ip"){?>
		<p align="center" class="error">Invalid Position..</p>
	<?php 
	}?>
	<div class="gap"></div>
	<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
	<div class="frt"><a href="../home.php"><img src="../../images/back32.png" alt="Home" title="Home"/></a></div>
	<div class="gap"></div>
	<div class="box">
		<div class="hdr">
			<h1 class="ico"><img src="icon/icon.png" alt="">Advertising Banners </h1>
			<div class="addnew">
				
			</div>
		</div>      
		<div class="padtb">
			<!-- Banner Images goes here -->
<div style="width:80%; margin:auto;">
            	<div class="adminbanner" style="height:40px; padding-top:20px;"><a href="bannerlist.php?bnid=1"><B>Click here to set Banner</B></a></div>
            <!-- 	<div class="frt adminbanner" style="width:70px; height:150px; padding-top:100px;"><a href="index.php?ban_pos=3"><B>Right Side Banner 02</B></a></div>
            	       			<div class="frt adminbanner" style="width:70px; height:150px; padding-top:100px;"><a href="index.php?ban_pos=2"><B>Right Side Banner 01</B></a></div>
            	        		<div class="clear"></div>
            	                <div class="frt adminbanner" style="width:170px; height:70px; padding-top:50px;"><a href="index.php?ban_pos=4"><B>Right Side Bottom Banner</B></a></div>
            	        <div class="clear"></div>
            	                <div class="adminbanner" style="height:40px; padding-top:20px;"><a href="index.php?ban_pos=5"><B>Bottom Banner</B></a></div> -->
          </div>      
		<div class="clear"></div>
           
		</div>
		<div class="clear"></div>
	</div>
</div>
<?admin_footer();?>
