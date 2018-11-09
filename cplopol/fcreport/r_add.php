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

$query="select * from ".$tblpref."feedback_commend where fc_id='$rid'"; 
if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
$row_add=mysqli_fetch_array($result);

if($row_add[fc_status]=="New")
{
		$query = "UPDATE " . $tblpref . "feedback_commend SET fc_status = 'View' WHERE fc_id = '$rid'";
		if(!($result=mysqli_query($connection,$query))){ echo $query.mysqli_errno($connection); exit;}
		
		if($row_add[fc_email]!="")
		{
		$queryau = "SELECT * FROM " . $tblpref . "autoresponders WHERE a_id = '2'";
		if(!($resultau=mysqli_query($connection,$queryau))){echo $queryau.mysqli_errno($connection); exit;}
		$row_autoresp = mysqli_fetch_array($resultau);
			
		$msg = "Dear $row_add[fc_name], <br /> ";
		$msg .= "we have received your Feedback & Commendation Report and we will get back to you as soon as possiblet<br />";
		$msg .= "<br /> You had wrote the Feedback & Commendation Report as : <br /> $row_add[fc_report]";

		$msg .= "<br /><br /><br />Regards - <br />Administrator <br/> $sitename";
		
		$mesheader =  "From: ".$row_autoresp[a_default]."\n" . "Reply-To: ". $row_autoresp[a_default] . "\r\n";
		$mesheader .= "MIME-Version: 1.0\n";
		$mesheader .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		
		
		@mail($row_add[fc_email],"Re : BPS : Feedback & Commendation Report : From: $row_autoresp[a_default]",$msg,$mesheader);

		}
}

admin_header('../../','Feedback & Commendation Report ',$tblpref,$db,$sitepath,$siteurl,$path1,$ckpath,$row_admin);
?>
<!--body start -->
<div class="adminbody">
<div class="flt"><a href="../home.php"><img src="../../images/dashboard.png" alt="Home" title="Home"/></a></div>
<div class="frt" style="padding-right:5px;"><a href="index.php"><img src="../../images/back32.png" alt="Back" title="Back" /></a></div>
<div class="gap"></div>


<div class="box">
    <div class="hdr">
	<h1 class="ico-view">View</h1>
	<div class="rtheading">
        <h1 class="ico"><img src="icon/icon.png" alt=""><?if($rid!=""){?>
            View Feedback & Commendation
            <?}else{?>
            Feedback & Commendation Report
            <?}?></h1>
    </div>
    </div> 
	<div class="padtb">
     <form name="frmcmsadd" method="POST" onsubmit="return validate();" action="submit_r.php">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr class="even">
		<td width="35%"> Reporter Name :     </td>
		<td> <?=stripslashes($row_add[fc_name])?></td>
     </tr>
     <tr>
		<td> Tel No :     </td>
		<td> <?=stripslashes($row_add[fc_contact_no])?></td>
     </tr>
	  <tr class="even">
		<td> Email Id:     </td>
		<td><?=stripslashes($row_add[fc_email])?></td>
     </tr>
     <tr>
		<td> Reporter IP Address :     </td>
		<td><?=stripslashes($row_add[fc_ip])?></td>
     </tr>
	 <tr class="even">
		<td> Type of report :     </td>
		<td><?=stripslashes($row_add[fc_report_type])?></td>
     </tr>
     <tr>
		<td> Reporting on :     </td>
		<td><?php echo stripslashes($row_add[fc_reporting_on]);?></td>
     </tr>
	  <tr class="even">
		<td> Date of Incident  :     </td>
		<td>
			<? 
		  $date1 = explode(" ",$row_add[fc_date]); 
		  echo dateformate($date1[0]);
		  ?>
		</td>
     </tr>
     <tr>
		<td> Time of Incident  :     </td>
		<td><? echo $date1[1]." ".$row_add[fc_timeset];?></td>
     </tr>
	 <tr class="even">
		<td> Location of Incident :     </td>
		<td>
			<?=stripslashes($row_add[fc_loc_contact])?>
		</td>
     </tr>
     <tr>
		<td> Name (Employee / Station or leader of group) :     </td>
		<td><?=stripslashes($row_add[fc_emp])?></td>
     </tr>
	 <tr class="even">
		<td> What initiated his/her contact with the Police ?  </td>
		<td>
			<table width="100%" cellspacing="0" cellpadding="0">
			<? 
			$queryinit="select * from ".$tblpref."intiat_contact where int_fc_id='$rid'"; 
			if(!($resultinit=mysqli_query($connection,$queryinit))){ echo $queryinit.mysqli_errno($connection); exit;}
			while($rowinit=mysqli_fetch_array($resultinit)) 
			{ 
			?>
			<tr><td width="20px"><img src="../../images/tick.jpg" alt=""></td><td><?=$rowinit[int_answer]?></td></tr>
			<? } ?>
			</table>
		</td>
     </tr>
	 <?php
		if($row_add[fc_other]!=""){?>
	 <tr class="even">
		<td> Other :     </td>
		<td><?=stripslashes($row_add[fc_other])?></td>
     </tr>
	 <?php
			} ?>
     <tr>
		<td> Report :     </td>
		<td><?=stripslashes($row_add[fc_report])?></td>
     </tr>
	 
<tr >
     	<td>
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
