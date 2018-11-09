<?php  session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}
admin_header('../../','Wanted Person ',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
?>

<!--body start -->
<div class="adminbody">

<div class="gap"></div>
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt"><a href="../home.php"><img src="../../images/back32.png" alt="Back" title="Back"/></a></div>
<div class="gap"></div>
<div class="box">
    <div class="hdr">
		<h1 class="ico"><img src="icon/icon.png" alt="">Wanted Person</h1>
        <div class="addnew">
                        <!-- <a  href="#" class="import">Import</a>
                        <a  href="#" class="export">Export</a>  -->
		</div>
	</div>
	<div class="padtb">
		<div class="adminbanner" style="height:40px; padding-top:20px;"><a href="bannerlist.php?bnid=2"><B>Click here to set Wanted People</B></a></div>
  <!--   <p align="right"></p> -->
  </div>

    <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>



</div>
<?admin_footer();?>
