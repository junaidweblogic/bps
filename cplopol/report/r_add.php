<?
session_start();
include("../../common/cploconfig.php");
include("../../common/app_function.php");

if($_SESSION[username]=="")
{
	DisplayError("Login Error.","","For security of your account,we have expired your session.<br>&nbsp;Please login to your account again.", "Home,../index.php", 0);
	exit();
}
$rid = $_GET[rid];

echo $query="select * from ".$tblpref."report where r_id='$rid'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);

$query = "UPDATE " . $tblpref . "report SET r_status = 'View' WHERE r_id = '$rid'";
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}

admin_header('../../','Crime Report ',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
?>
<SCRIPT LANGUAGE="JavaScript">
function validate()
{
	   if(document.frmcmsadd.name.value=="")
		{
			alert("Please enter name");
			document.frmcmsadd.name.focus();
			return false;
		}

	  				
 return true;
}


</SCRIPT>
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
	<? if($rid!=""){?><h1 class="ico-edit">Edit</h1><?}else{?><h1 class="ico-addnew">Add New</h1><?}?>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt="">Crime Report</h1>
    </div>
    </div> 
	<div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return validate();" action="submit_r.php" enctype="multipart/form-data">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<td width="30%"> Location of Crime :     </td>
		<td><?=stripslashes($row_add[r_name])?></td>
     </tr>
     <tr>
		<td> Reporter Name :     </td>
		<td><?=stripslashes($row_add[r_reporter])?></td>
     </tr>
	 <tr class="even">
		<td> Reporter Email :     </td>
		<td><?=stripslashes($row_add[r_email])?></td>
     </tr>
     <tr>
		<td> Tel No :     </td>
		<td><?=stripslashes($row_add[r_app])?></td>
     </tr>
	  <tr class="even">
		<td> Details :     </td>
		<td><?=stripslashes($row_add[r_details])?></td>
     </tr>
      <tr class="even">
		<td colspan="2">&nbsp;</td>
	 </tr>     
     <tr >
     	<td colspan="2">
        <a href="index.php"><input type="button" class="button" value="Back" name="submit"></a>
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

